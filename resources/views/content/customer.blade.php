@extends('layouts.base')

@section('title', 'Schedule Report')

@section('stylesheet')
    <link rel="stylesheet" href="{{asset('Admin/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/css/bootstrap-select.css')}}">

@endsection

@section('content')
    {{-- @livewire('report-component') --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="page-title">Customers List</h1>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                {{-- <a href="{{url ('report/create')}}"><button class="btn btn-sm btn-primary">Add Report</button></a><br> --}}
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
                                        <th>Action</th>
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
        ajax: '{{ url("customer/getCustomer") }}',
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
                    data: 'action', 
                    name: 'action',
                    orderable: false, searchable: false
                }

        //     {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
 });
</script>
<script>
    $('#mytable').on('click', '.btn-delete[data-remote]', function (e) { 
    e.preventDefault();
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var url = $(this).data('remote');
    // confirm then
    if (confirm('Are you sure you want to delete this?')) {
        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'json',
            data: {method: '_DELETE', submit: true}
        }).always(function (data) {
            $('#mytable').DataTable().draw(false);
        });
    }else
        alert("You have cancelled!");
});
</script>
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
    });    
</script>

@endsection