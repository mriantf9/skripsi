@extends('layouts.base')

@section('title', 'Create Report')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="page-title">Create Report</h1>
                <form action="{{url ('report')}}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="cb_add" value="cb_add">
                        <label class="form-check-label" for="cb_add"><small>Add New Customer</small></label>
                    </div><br>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="customer_name">Customer Name</label>
                            <select name="ext_customer" id="ext_cust" class="form-control">
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="customer_name">New Customer Name</label>
                            <input type="text" name="new_customer" class="form-control @error ('new_customer') is-invalid @enderror" id="new_cust" value="{{old("new_customer")}}" />
                            @error('new_customer')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div> 
                            @enderror
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="report_name">Report Title</label>
                            <input type="text" class="form-control @error ('report_title') is-invalid @enderror" name="report_title" value="{{old("report_title")}}" />
                            @error('report_title')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div> 
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="report_type">Schedule Report For</label>
                            <select class="form-control @error ('report_type') is-invalid @enderror" id="report_type_id" name="report_type">
                                <option value="">Select Schedule</option>
                                @foreach ($graphs as $graph)
                                <option value="{{$graph->id}}">{{$graph->graph_type}}</option>
                                @endforeach
                            </select>
                            @error('report_type')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div> 
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="report_type">Periodic Graphic Capture</label>
                            <select class="form-control" name="report_type">
                                {{-- <option value="">select per graphs</option>
                                @foreach ($graphs as $graph)
                                <option value="{{$graph->id}}">{{$graph->graph_type}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="rrd">Customer Email</label>
                            <input type="text" class="form-control @error ('email') is-invalid @enderror" name="email" id="email_cust" value="{{old('email')}}" />
                            @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div> 
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <table class="table table-borderless" id="dynamicTable">  
                                <tr>
                                    <th>.RRD Name</th>
                                </tr>
                                <tr>  
                                    <td><input type="text" name="rrd[0][rrd_name]" placeholder="Enter RRD name" class="form-control"/></td> 
                                    <td><input type="text" name="rrd[0][rrd_title]" placeholder="Enter RRD Title" class="form-control"/></td> 
                                    <td><button type="button" name="add" id="add" class="btn btn-sm btn-primary">Add More</button></td>  
                                </tr>  
                            </table>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                   </div>
                </form>
             </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection

@section('javascripts')

<script type="text/javascript">
   
    var i = 0;
    $("#add").click(function(){
        ++i;
        $("#dynamicTable").append('<tr><td><input type="text" name="rrd['+i+'][rrd_name]" placeholder="Enter RRD name" class="form-control" /></td><td><input type="text" name="rrd['+i+'][rrd_title]" placeholder="Enter RRD Title" class="form-control" /></td><td><button type="button" class="btn btn-sm btn-danger remove-tr">Remove</button></td></tr>');
    });
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>

<script type="text/javascript">

    var email_fields = document.getElementById('email_cust');
    var new_cust = document.getElementById('new_cust');
    var ext_cust = document.getElementById('ext_cust');

    new_cust.disabled = true;
    email_fields.disabled = true;

    document.getElementById('cb_add').onchange = function() {

    new_cust.disabled = !this.checked;
    ext_cust.disabled = this.checked;
    email_fields.disabled = !this.checked;

    };
</script>

<script type="text/javascript">
// 2.1 "Store" all books in some place on the page, for example, you can pass PHP variable into JS variable like this
var cust = <?= json_encode($customers); ?>;
console.log(cust);

/*
 * 2.2 Create function for search book by its name 
 * (if each value of the field "name" in the $books is unique) or by some unique field, for example, "id"
 */

// get book by name
var getEmailByCustomer = function (custName) {
    if (typeof cust === 'object') {
        for (var key in cust) {
            if (typeof cust[key].customer_name !== 'undefined' && cust[key].customer_name === custName) {
                return cust[key];
            }
        }
    }
    return false;
}

$(document).ready(function () {
    // add event listener on the select with the attribute name="name"
    $('select[name="ext_customer"]').on('change', function (e) {

        // get book by selected name of the book
        var selectedEmail = getEmailByCustomer($(e.target).find('option:selected').text());
        if (selectedEmail) {
            // set new value for the input with the attribute name="description"
            $('input[name="email"]').val(selectedEmail.customer_email);
        }
        // we can't find email by it's name
        else {
            alert("Sorry, we can find description for this book");
        }

    });
});
</script>

@endsection