<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Graph;
use App\Report;
use App\Rrd;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('content.report');
    }


    public function create()
    {
        $graphs = Graph::all();
        $customers = Customer::all();
        return view('content.createReport', compact('graphs', 'customers'));
    }


    public function store(Request $request)
    {
        //

        date_default_timezone_set("Asia/Bangkok");
        $uid = Auth::id();

        $customer_id = '';

        if ($request->filled('new_customer')) {

            $this->validate($request, [
                'rrd.*.rrd_name' => 'required|regex:/(^(.*?[.]+rrd)?$)/',
                // 'rrd.*.rrd_name' => 'required',
                'rrd.*.rrd_title' => 'required',
                'report_title' => 'required',
                'report_type' => 'required  ',
                'new_customer' => 'required|unique:customers,customer_name',
                'email' => 'required|email|unique:customers,customer_email',
                'periodic_graph' => 'required'
            ]);

            $new_customer = Customer::create([
                'customer_name' => $request->new_customer,
                'customer_email' => $request->email
            ]);

            $customer_id = $new_customer->id;
        } else {
            $request->validate([
                'rrd.*.rrd_name' => 'required|regex:/(^(.*?[.]+rrd)?$)/',
                'rrd.*.rrd_title' => 'required',
                'report_title' => 'required',
                'report_type' => 'required  ',
                'ext_customer' => 'required',
                'periodic_graph' => 'required'
            ]);

            $customer_id = $request->ext_customer;
        }

        // var_dump($request->periodic_graph);
        // die;
        $report = Report::create([

            'user_id' => $uid,
            'report_title' => $request->report_title,
            'customer_id' => $customer_id,
            'graph_id' => $request->report_type,
            'periodic_graph' => $request->periodic_graph,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $report_id = $report->id;

        foreach ($request->get('rrd') as $value) {
            $rrd = new Rrd();
            $rrd->rrd_name = $value['rrd_name'];
            $rrd->rrd_title = $value['rrd_title'];
            $rrd->report_id = $report_id;
            $rrd->save();
        }

        return redirect('/report')->with('status', 'Data Already Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 
        $query = 'DELETE reports, rrds
                    FROM reports
                    JOIN rrds ON rrds.report_id = reports.id
                    WHERE report_id = ?';
        DB::delete($query, array($id));
        return redirect('/report')->with('danger', 'Data Is Deleted');
    }

    public function getReport()
    {
        $users = Auth::id();
        $data =
            DB::table('reports')
            ->join('graphs', 'graphs.id', '=', 'reports.graph_id')
            ->join('users', 'users.id', '=', 'reports.user_id')
            ->join('customers', 'customers.id', '=', 'reports.customer_id')
            ->select('customers.customer_name', 'customers.customer_email', 'reports.report_title', 'graphs.graph_type', 'users.name', 'reports.id')
            ->where('users.id', $users)
            ->orderBy('reports.created_at', 'DESC')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn() //untuk add index pada column
            ->addColumn('action', function ($report) {
                // var_dump($report);
                // die;
                $c = csrf_field();
                $m = method_field('DELETE');
                return "<form action='{{url ('report/$report->id') }}' method='POST'>
                      $c
                    $m

                    <button  type='submit'
                            class='btn btn-sm btn-outline-danger btn-delete'>
                        <i class='fe fe-trash-2'></i>
                    </button>
                </form>";

                // return '<a href="/report/' . $report->id . '/edit" class="btn btn-sm btn-outline-primary"><i class="fe fe-edit"></i></a>'
                //     . " " .
                //     '<button class="btn btn-sm btn-outline-danger btn-delete" data-remote="/report/' . $report->id . '"><i class="fe fe-trash-2"></i></button>';


                // '<a href="/report/' . $report->id . '" class="btn btn-sm btn-outline-danger"><i class="fe fe-trash-2"></i></a>';
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);
    }
}
