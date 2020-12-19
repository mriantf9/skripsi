@extends('layouts.base')

@section('title', 'Dashboard')

@section('stylesheet')
    <link rel="stylesheet" href="{{asset('Admin/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/css/bootstrap-select.css')}}">

@endsection

@section('content')
    {{-- @livewire('dash-component') --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="w-50 mx-auto text-center justify-content-center py-0 my-5">
                    <h2 class="page-title mb-0">Welcome To Dashboard Report</h2>
                    <p class="lead text-muted mb-4">Make easy to create the report bandwidth</p>
                    <div class="row my-4">
                        <div class="col-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <i class="fe fe-users fe-32 text-primary"></i>
                                    <h3 class="h5 mt-4 mb-1">Total Customers</h3>
                                    <h3 class="card-title mb-0">{{$countcust}}</h3>
                                    <a href="{{url ('/customer')}}">
                                        <p class="text-muted">See The Customers</p>
                                    </a>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                        </div> <!-- .col-md-->
                        <div class="col-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <i class="fe fe-edit fe-32 text-success"></i>
                                    <h3 class="h5 mt-4 mb-1">Total Report</h3>
                                    <h3 class="card-title mb-0">{{$countreports}}</h3>
                                    <a href="{{url('report')}}">
                                        <p class="text-muted">Create Reports</p>
                                    </a>
                                </div> <!-- .card-body -->
                            </div> <!-- .card -->
                        </div> <!-- .col-md-->
                    </div>
                </div>
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
                                        <th>Report Created By</th>
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
        responsive: true,
        ajax: '{{ url("dashboard/getReport") }}',
        columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
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

        ]
    });
 });
</script>
    
@endsection