@extends('layouts.app')
@section('content')
 <div class="br-header bg-white">
      <div class="br-header-left pd-l-20">
       <h6 class="tx-gray-800 tx-uppercase tx-bold tx-20">REPORT GENERATOR</h6>
   </div>
</div>
<div class="br-pagebody">
  <div class="br-section-wrapper">
     <div class="table-wrapper pd-t-20">
     <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
      <form action="{{route('issuedreport')}}" method="GET">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="card">
              <div class="card-header" role="tab" id="headingOne">
                <h6 class="mg-b-0">
                  <a data-toggle="collapse" data-parent="#accordion" href="#prod" aria-expanded="true" aria-controls="prod" class="tx-gray-800 transition">
                    Report of Supplies and Materials Issued
                  </a>
                </h6>
              </div><!-- card-header -->
              <div id="prod" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="card-block pd-20">
                  <div class="row">
                     <div class="col-md-4 tx-inverse tx-16">Report Category: <div class="pd-r-10"></div>
                        <input name="rdio" value="1" class="pd-x-10 radio" type="radio">
                        <span>Whole Office</span>

                         <input name="rdio" value="2" class="pd-x-10 radio" type="radio">
                        <span>Per Division</span>
                         <input name="rdio" value="3" class="pd-x-10 radio" type="radio">
                        <span>Per Staff</span>
                    </div>
                    <div class="col-md-1 tx-inverse tx-16">Date Range</div>
                      <div class="col-md-2"> <input type="text" class="form-control daterange" name="daterange" /></div>
                      <div class="col-md-1 tx-inverse tx-16">Entity</div>
                      <div class="col-md-2"> 
                        <select class="form-control select" style="width: 100%;" name="entity">
                            @foreach($masters as $master)
                              <option value="{{$master->id}}">{{$master->name}}</option>
                            @endforeach
                        </select>
                      </div>
                    
                     
                       <div class="col-md-2"><button class="btn btn-primary">Generate</button></div>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
            </form>

      <form action="{{route('pmr')}}" method="GET" id="pmrform">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" name="type" class="type" value="">
            <div class="card">
              <div class="card-header" role="tab" id="headingOne">
                <h6 class="mg-b-0">
                  <a data-toggle="collapse" data-parent="#accordion" href="#pmr" aria-expanded="true" aria-controls="pmr" class="tx-gray-800 transition">
                    Procurement Monitoring Report
                  </a>
                </h6>
              </div><!-- card-header -->
              <div id="pmr" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="card-block pd-20">
                  <div class="row">
                    <div class="col-md-1 tx-inverse tx-16">Date Range</div>
                      <div class="col-md-2"> <input type="text" class="form-control daterange" name="daterange" /></div>
                      <div class="col-md-1 tx-inverse tx-16">Entity</div>
                      <div class="col-md-2"> 
                        <select class="form-control select" style="width: 100%;" name="entity">
                            @foreach($masters as $master)
                              <option value="{{$master->id}}">{{$master->name}}</option>
                            @endforeach
                        </select>
                      </div>
                       <div class="col-md-2"><button class="btn btn-primary generate">Generate</button> 
                        <button type="button" data-form="accform" class="btn btn-info csv pd-l-20" >Export to CSV</button></div>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
            </form>
            <form action="{{route('inventory')}}" method="GET" id="inform">
            <input type="hidden" name="_token" id="token"  value="{{ csrf_token() }}">

            <input type="hidden" name="type" class="type" value="">
            <div class="card">
              <div class="card-header" role="tab" id="headingOne">
                <h6 class="mg-b-0">
                  <a data-toggle="collapse" data-parent="#accordion" href="#inventory" aria-expanded="true" aria-controls="inventory" class="tx-gray-800 transition">
                    Inventory of Supplies and Materials
                  </a>
                </h6>
              </div><!-- card-header -->
              <div id="inventory" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="card-block pd-20">
                  <div class="row">
                    <div class="col-md-1 tx-inverse tx-16">Date </div>
                      <div class="col-md-2"> <input type="text" class="form-control date" name="date" /></div>
                      <div class="col-md-1 tx-inverse tx-16">Entity</div>
                      <div class="col-md-2"> 
                        <select class="form-control select" style="width: 100%;" name="entity">
                            @foreach($masters as $master)
                              <option value="{{$master->id}}">{{$master->name}}</option>
                            @endforeach
                        </select>
                      </div>
                       <div class="col-md-2"><button class="btn btn-primary generate">Generate</button> 
                        <button type="button" data-form="accform" class="btn btn-info csv pd-l-20" >Export to CSV</button></div>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
            </form>
            <form action="{{route('acclist')}}" method="GET" id="accform">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" name="type" class="type" value="">
            <div class="card">
              <div class="card-header" role="tab" id="headingOne">
                <h6 class="mg-b-0">
                  <a data-toggle="collapse" data-parent="#accordion" href="#acc" aria-expanded="true" aria-controls="acc" class="tx-gray-800 transition">
                    List of Inspected POs
                  </a>
                </h6>
              </div><!-- card-header -->
              <div id="acc" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="card-block pd-20">
                  <div class="row">
                    <div class="col-md-1 tx-inverse tx-16">Date Range</div>
                      <div class="col-md-2"> <input type="text" class="form-control daterange" name="daterange" /></div>
                      <div class="col-md-1 tx-inverse tx-16">Entity</div>
                      <div class="col-md-2"> 
                        <select class="form-control select" style="width: 100%;" name="entity">
                            @foreach($masters as $master)
                              <option value="{{$master->id}}">{{$master->name}}</option>
                            @endforeach
                        </select>
                      </div>
                       <div class="col-md-2"><button class="btn btn-primary generate">Generate</button> <button type="button" data-form="accform" class="btn btn-info csv pd-l-20" >Export to CSV</button></div>
                       <div class="col-md-2"></div>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
            </form>
                        <form action="{{route('formlist')}}" method="GET" id="listform">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" name="type" class="type" value="">
            <div class="card">
              <div class="card-header" role="tab" id="headingOne">
                <h6 class="mg-b-0">
                  <a data-toggle="collapse" data-parent="#accordion" href="#forms" aria-expanded="true" aria-controls="forms" class="tx-gray-800 transition">
                    List of Forms
                  </a>
                </h6>
              </div><!-- card-header -->
              <div id="forms" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="card-block pd-20">
                  <div class="row">
                    <div class="col-md-1 tx-inverse tx-16">Date Range</div>
                      <div class="col-md-2"> <input type="text" class="form-control daterange" name="daterange" /></div>
                      <div class="col-md-1 tx-inverse tx-16">Type of Form</div>
                      <div class="col-md-2"> <select class="form-control select" style="width: 100%;" name="typeform">
                              <option value="prs">PURCHASE REQUESTS</option>
                              <option value="rfqs">REQUEST FOR QUOTATIONS</option>
                              <option value="pos">PURCHASE ORDERS with ACCEPTANCE Reports</option>
                              <option value="abs">ABSTRACT of CANVASS</option>
                        </select>
                      </div>
                       <div class="col-md-2"></div>
                       <div class="col-md-2"><button class="btn btn-primary generate">Generate</button> <button type="button" data-form="listform" class="btn btn-info csv pd-l-20" >Export to CSV</button></div>
                       <div class="col-md-2"></div>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
            </form>
           </div>
        </div><!-- accordion -->
     </div>
   </div>
</div>

<script type="text/javascript">
   $(function() {
$('.date').datepicker({
showOtherMonths: true,
selectOtherMonths: true,
numberOfMonths: 2
});
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
  var csv = document.getElementsByClassName('csv');
  var generate = document.getElementsByClassName('generate');


  for (var i = 0; i < csv.length; i++) {
    csv[i].addEventListener('click', function(){
  //      console.log(this)
        var type = document.getElementsByClassName('type');
        var f = document.getElementById(this.dataset.form);
        for (n = 0; n < type.length; ++n) {
          type[n].value='csv';
        }
        //if()
        f.submit();

    }, false);
}

for (var i = 0; i < generate.length; i++) {
    generate[i].addEventListener('click', function(){
  //      console.log(this)
        var type = document.getElementsByClassName('type');
        var f = document.getElementById(this.dataset.form);
        for (n = 0; n < type.length; ++n) {
          type[n].value='generate';
        }
        //if()
        f.submit();

    }, false);
}

$('#salesreport').submit(function(e){
    var count_checked = $(".saleschk:checked").length; // count the checked rows
      if(count_checked == 0) 
      {
         swal('Please check at least one product');
         return false;
      }
      else{
        return true;
      }
});

$('#inventoryreport').submit(function(e){
    var count_checked = $(".invchk:checked").length; // count the checked rows
      if(count_checked == 0) 
      {
         swal('Please check at least one product');
         return false;
      }
      else{
        return true;
      }
});

$('#requistion_report').submit(function(e){
    var count_checked = $(".reqchk:checked").length; // count the checked rows
      if(count_checked == 0) 
      {
         swal('Please check at least one category');
         return false;
      }
      else{
        return true;
      }
});

  $("#salesbtn").click(function() {
    
});
  var masters = {!! json_encode($masters->toArray()) !!};
  var employees = {!! json_encode($employees->toArray()) !!};

  $('.radio').change(function(){
    var id = $(this).val();
    var opt = '';
    if(id == 1){
      masters.forEach(function(key){
        if(key.type == 'master'){
           opt += '<option value="'+key.id+'">'+key.name+'</option>';
         }
      })
     
    }
    else if(id == 2){
      masters.forEach(function(key){
        if(key.type == 'sub'){
           opt += '<option value="'+key.id+'">'+key.name+'</option>';
         }
      })
     
    }

    else if(id == 3){
      employees.forEach(function(key){
       
           opt += '<option value="'+key.id+'">'+key.last_name+' '+key.first_name+'</option>';
         
      })
     
    }

    $('.select')
    .find('option')
    .remove();
    $('.select').append(opt);
    $('.select').select2();
  })

  var date = new Date();
   var newdate = new Date(date);

    newdate.setDate(newdate.getDate() + 3);
    
    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();
   $('.daterange').data('daterangepicker').setStartDate(date);
   $('.daterange').data('daterangepicker').setEndDate(mm+'/'+dd+'/'+y);
  })
</script>

@endsection
