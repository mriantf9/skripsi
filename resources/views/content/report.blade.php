@extends('layouts.base')

@section('title', 'Schedule Report')

@section('stylesheet')
    <link rel="stylesheet" href="{{asset('Admin/css/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
    {{-- @livewire('report-component') --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="page-title">Scheduling Report</h1>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                <a href="{{url ('report/create')}}"><button class="btn btn-sm btn-primary">Add Report</button></a><br>
                <br>
                <div class="card shadow">
                    <div class="card-header">
                        List Schedule Report
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover" id="mytable" style="font-size: 13px;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Report Title</th>
                                        <th>Report Type</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection

@section('javascripts')

<script src="{{asset ('Admin/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset ('Admin/js/dataTables.bootstrap4.min.js')}}"></script>

<script type="text/javascript">

 $(document).ready(function(){
     $('#mytable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url("report/getReport") }}',
        columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'customer_name',
                    name: 'customer_name'
                },
                {
                    data: 'customer_email',
                    name: 'customer_email'
                },
                {
                    data: 'report_title', 
                    name: 'report_title'
                },
                {
                    data: 'graph_type', 
                    name: 'graph_type'
                }
        //     {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
 });
</script>
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 4000);
    });    
</script>

@endsection