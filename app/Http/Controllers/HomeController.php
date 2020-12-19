<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countcust = DB::table('customers')->count();
        $countreports = DB::table('reports')->count();
        return view('content.dashboard', compact('countcust', 'countreports'));
    }

    public function getReport()
    {
        $data =
            DB::table('reports')
            ->join('graphs', 'graphs.id', '=', 'reports.graph_id')
            ->join('users', 'users.id', '=', 'reports.user_id')
            ->join('customers', 'customers.id', '=', 'reports.customer_id')
            ->select('customers.customer_name', 'customers.customer_email', 'reports.report_title', 'graphs.graph_type', 'users.name', 'reports.id')
            ->orderBy('reports.created_at', 'DESC')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn() //untuk add index pada column
            ->editColumn('id', '{{$id}}')
            ->make(true);
    }
}
