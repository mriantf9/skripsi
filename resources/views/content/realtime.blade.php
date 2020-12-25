@extends('layouts.base')

@section('title', 'Realtime Report')

@section('stylesheet')

<!-- Date Range Picker CSS -->
<link rel="stylesheet" href="{{asset('Admin/css/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('Admin/css/jquery.timepicker.css')}}">
    
@endsection


@section('cotent')
    @section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                <h1 class="page-title">Create Realtime Report</h1>
                <p class="text-muted font-italic">*Note: Realtime report need time arround 5 minutes to collect the data</p>
                <form action="{{url ('realtime')}}" method="POST">
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
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="report_name">Report Title</label>
                            <input type="text" class="form-control @error ('report_title') is-invalid @enderror" name="report_title" value="{{old("report_title")}}" />
                            @error('report_title')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div> 
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                          <label for="date-input1">Start Date From</label>
                          <div class="input-group">
                            <input type="text" class="form-control drgpicker @error ('startdate') is-invalid @enderror" name="startdate" id="StartDate" value="" aria-describedby="button-addon2">
                            <div class="input-group-append">
                              <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                            </div>
                          </div>
                             @error('startdate')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div> 
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                          <label for="date-input1">End Date</label>
                          <div class="input-group">
                            <input type="text" class="form-control drgpicker @error ('enddate') is-invalid @enderror" name="enddate" value="" id="EndDate" aria-describedby="button-addon2">
                            <div class="input-group-append">
                              <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                            </div>
                          </div>
                          @error('enddate')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div> 
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="report_type">Periodic Graphic Capture</label>
                            <select class="form-control @error ('periodic_graph') is-invalid @enderror" name="periodic_graph">
                                <option value="">Select Periodic Capture</option>
                                <option value="Days">per Days</option>
                                <option value="Weeks">per Weeks</option>
                                <option value="Months">per Months</option>
                            </select>
                            @error('periodic_graph')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div> 
                            @enderror
                        </div>
                         <div class="form-group col-md-3">
                            <label for="rrd">Sent To Email</label>
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
                                <thead>
                                    <tr>
                                    <th><strong>Input  <i>Filename.rrd</i></strong></th>
                                    <th><strong>Input <i>Title Interface</i></strong></th>
                                    </tr> 
                                </thead> 
                                <tbody id="rrd">
                                    <tr>
                                        <td><input type="text" name="rrd[0][rrd_name]" placeholder="Enter RRD name" class="form-control @error ('rrd[0][rrd_name]') is-invalid @enderror"/>
                                        </td> 
                                        <td><input type="text" name="rrd[0][rrd_title]" placeholder="Enter RRD Title" class="form-control @error ('rrd[0][rrd_title]') is-invalid @enderror"/>
                                        </td> 
                                        <td><button type="button" name="add" id="add" class="btn btn-sm btn-primary">Add More</button></td>  
                                    </tr>
                                </tbody>
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
@endsection




@section('javascripts')

<script src="{{asset('Admin/js/daterangepicker.js')}}"></script>
<script src="{{asset('Admin/js/jquery.timepicker.js')}}"></script>

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

    $('.drgpicker').daterangepicker(
      {
        singleDatePicker: true,
        timePicker: true,
        use24hours: true,
        showDropdowns: true,
        locale:
        {
          format: 'MM/DD/YYYY hh:mm A',
        }
      });
      $('.time-input').timepicker(
      {
        'scrollDefault': 'now',
        'timeFormat': 'HH:mm:ss',
        'zindex': '9999' /* fix modal open */
      });
</script>

{{-- <script>
    $("#EndDate").change(function () {
    var startDate = document.getElementById("StartDate").value;
    var endDate = document.getElementById("EndDate").value;

    console.log(startDate);
    if ((Date.parse(startDate) >= Date.parse(endDate))) {
        alert("End date should be greater than Start date");
        document.getElementById("EndDate").value = "";
    }
});
</script> --}}
    
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(1100, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 4000);
    });    
</script>
@endsection