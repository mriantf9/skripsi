<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('content.customer', compact('customers'));
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
        //
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
        $customers = Customer::find($id);
        $customers->delete();
        return response()->json($customers);
    }

    public function getCustomer()
    {

        $data = Customer::all();
        return Datatables::of($data)
            ->addIndexColumn() //untuk add index pada column
            ->addColumn('action', function ($customers) {
                // var_dump($report);
                // die;
                return '<a href="/customer/' . $customers->id . '/edit" class="btn btn-sm btn-outline-primary"><i class="fe fe-edit"></i></a>'
                    . " " .
                    '<button class="btn btn-sm btn-outline-danger btn-delete" data-remote="/customer/' . $customers->id . '"><i class="fe fe-trash-2"></i></button>';
                // '<a href="/report/' . $report->id . '" class="btn btn-sm btn-outline-danger"><i class="fe fe-trash-2"></i></a>';
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);
    }
}
