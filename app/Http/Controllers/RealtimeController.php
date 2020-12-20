<?php

namespace App\Http\Controllers;

use App\Graph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RealtimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $graphs = Graph::all();
        return view('content.realtime', compact('graphs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uniqid = Str::random(5);

        date_default_timezone_set("Asia/Bangkok");
        $this->validate($request, [
            'rrd.*.rrd_name' => 'required|regex:/(^(.*?[.]+rrd)?$)/',
            'rrd.*.rrd_title' => 'required',
            'report_title' => 'required',
            'startdate' => 'required  ',
            'enddate' => 'required  ',
            'email' => 'required|email',
            'periodic_graph' => 'required'
        ]);
        $filename = $uniqid . "_realtime_task.csv";
        $myfile = storage_path('realtime_task/' . $filename);
        foreach ($request->get('rrd') as $value) {
            $data = array(
                array(
                    $uniqid,
                    $request->report_title,
                    $request->startdate,
                    $request->enddate,
                    $request->email,
                    $request->periodic_graph,
                    $value['rrd_name'],
                    $value['rrd_title']
                )
            );

            foreach ($data as $key) {
                $myfile = storage_path('realtime_task/' . $filename);
                $second_var = implode(";", $key);
                if (!is_file($myfile)) {
                    $second_var = implode(";", $key);
                    Storage::append("realtime_task/" . $filename, $second_var);
                } else {
                    Storage::put("realtime_task/" . $filename, $second_var);
                }
            }
        }
        return redirect('/realtime')->with('status', 'Data Already Added with uniq code "' . $uniqid . '"');
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
    }
}
