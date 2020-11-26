@extends('layouts.base')

@section('title', 'Schedule Report')

@section('content')
    {{-- @livewire('report-component') --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="page-title">Scheduling Report</h1>
                <a href="{{url ('report/create')}}"><button class="btn btn-sm btn-primary">Add Report</button></a><br>
                <br>
                <div class="card">
                    <div class="card-header">
                        List Schedule Report
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="mytable" style="font-size: 13px;">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Report Title</th>
                                    <th>Graph Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection

@section('javascripts')
    
@endsection