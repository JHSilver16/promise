@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('dashboard')}}">Home</a>
           <a class="breadcrumb-item" href="{{route('ptrs')}}">Property Transfer Forms</a>
          <span class="breadcrumb-item active">Add PTR</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Add Disposal Report</h6>
          <hr/>

              <form action="{{route('submitdisposal')}}" method="POST" data-parsley-validate="">
                 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                  <input type="hidden" name="id" id="id" value="{{ csrf_token() }}">
                  <input type="hidden" name="type" id="type" value="save">
                  <div class="form-layout form-layout-2">
                      <div class="row no-gutters">
                          
                        <div class="col-md-12 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">PTR No: <span class="tx-danger">*</span></label>
                           <input type="text" name="no" class="form-control" value="{{$ref}}" readonly="" id="prno" placeholder="Purchase Request Number">
                          </div>
                        </div>
                        <div class="col-md-3 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                          <label class="form-control-label vlabel">Entity: <span class="tx-danger">*</span></label>
                           <select class="form-control" name="entity" style="width: 100%"  tabindex="-1" aria-hidden="true">

                              @foreach($mas as $cl)
                                <option value="{{$cl->name}}">{{$cl->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                         <div class="col-md-3 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">Fund Cluster: <span class="tx-danger">*</span></label>
                           <input type="text" name="fc" class="form-control" value="101" readonly="" id="entity" placeholder="Account Code">
                          </div>
                        </div>
                         <div class="col-md-3 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">Date: <span class="tx-danger">*</span></label>
                           <input type="text" class="form-control date" name="date" required="" placeholder="MM/DD/YYYY">
                          </div>
                        </div>
                         
                          <div class="col-md-3 mg-t--1 mg-md-t-0 pno">
                            <div class="form-group mg-md-l--1">
                              <label class="form-control-label">Mode of Disposal: <span class="tx-danger">*</span></label>
                              <select class="form-control select2-show-search " name="mode" id="mode" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                             @foreach($disposal_modes as $dm)
                                  <option value="{{$dm->id}}" >{{$dm->name}}</option>
                                @endforeach
                              </select>
                            <div id="others">
                              <label class="form-control-label" id="lbltxt">Others: <span class="tx-danger">*</span></label>
                              <input class="form-control tx-16 other"  type="text" name="other" id="other"  placeholder="Please Specify" />
                            </div>
                                <div id="or">
                                  <label class="form-control-label" id="lbltxt">OR No: <span class="tx-danger">*</span></label>
                                  <input class="form-control tx-16 or"  type="text" name="or" id="or"  placeholder="Please Specify" />
                                </div>
                              </div>
                            </div><!-- row -->
                          <div class="col-md-6 mg-t--1 mg-md-t-0">
                            <div class="form-group mg-md-l--1">
                              <label class="form-control-label" id="lbltxt">Approved By: <span class="tx-danger">*</span></label>
                              <select class="form-control select2-show-search" name="approved" id="approved" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                                  @foreach($employees as $emp)
                                     <option value="{{$emp->id}}" >{{$emp->first_name.' '.$emp->last_name}}</option>
                                  @endforeach
                              </select>
                            
                            </div>
                          </div><!-- col-4 -->
                          <div class="col-md-6 mg-t--1 mg-md-t-0">
                            <div class="form-group mg-md-l--1">
                              <label class="form-control-label" id="lbltxt">Released/Issued By: <span class="tx-danger">*</span></label>
                              <select class="form-control select2-show-search" name="issued" id="issued" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                                  @foreach($employees as $emp)
                                     <option value="{{$emp->id}}" >{{$emp->first_name.' '.$emp->last_name}}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div><!-- col-4 -->
                        
                    </div>
      <div>
        <hr>
        <button class="btn btn-info btn-sm add" type="button">Add New Row</button>
        </div>
 <div class="table-wrapper pd-t-20">
  
            <table id="lines" class="table display responsive table-bordered nowrap tx-inverse tx-semibold tx-uppercase" style="width: 100%">
              <thead class="thead-colored thead-dark">
                <tr>
                  <th class="wd-10p">DATE ACQUIRED</th>
                  <th class="wd-15p">PROPERTY NO</th>
                  <th class="wd-20p">DESCRIPTION</th>
                  <th class="wd-10p">QTY</th>
                  <th class="wd-5p">AMOUNT</th>
                  <th class="wd-15p">ACTION</th>
                </tr>
              </thead>
              <tbody class="tbody">
                <tr>
                  <td>
                    <input type="text" class="form-control date"  name="items[1][date]">
                    <input type="hidden" class="form-control id"  name="items[1][id]">
                     <input type="hidden" class="form-control type"  name="items[1][type]">
                  </td>
                  <td>
                    <div class="autocomplete">
                      <input type="text" class="form-control property"  name="items[1][property]">
                    </div>
                  </td>
                  <td>
                    <div class="autocomplete">
                      <input class="form-control items" name="items[1][item]" placeholder="Item Description">
                    </div>
                  </td>
                  <td>
                    <input type="text" class="form-control qty"  name="items[1][qty]">
                  </td>           
                  <td>
                    <input type="number" step=".01" class="form-control amount"  name="items[1][amount]">
                  </td>                   
                </tr>

              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4"></td>
                  <td>Total</td>
                  <td><input type="text" class="form-control" readonly="" name="total" id="total"><br/>
                </tr>
              </tfoot>
            </table>
          </div>
          <hr/>
      <button type="submit" class="btn btn-primary btn-lg submit" id="load">Submit Transfer Form</button>
       
         </form>
      </div>
     
  </div>
<script>
  var ics = {!!json_encode($ics)!!};
  var props = {!!json_encode($props)!!};
  //console.log(items);
  var array = [];
  var unitsarr = [];
$(function(){
  $('#others').hide();
  $('#or').hide();

  ics.forEach(function(key){

    array.push({
            'id': key.id,
            'code': key.item_no,
            'name': key.item_no+'|'+key.name,
            'cost': key.unit_cost,
            'qty': key.qty,
            'date': key.date_acquired,
            'type': 'ics'
         })
  })

  props.forEach(function(key){

  array.push({
            'id' : key.id,
            'code': key.property_no,
            'name': key.property_no+'|'+key.name,
            'cost': key.amount,
            'qty': key.qty,
            'date': key.date_acquired,
            'type': 'par'
         })
  })
  
  //console.log(array)
    autocomplete2(".items", array);
  $('.date').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      numberOfMonths: 1
    });


          $('#mode').on('change', function(){
            var id = $(this).val();
            if(id == 4){
              $('#others').show();
              $('#or').hide();
            }
            else if(id == 1){
              $('#others').hide();
              $('#or').show();
            }
            else{
              $('#others').hide();
              $('#or').hide();
            }
        });
var row = document.getElementById("lines").rows.length;

$(document).on('keydown', '.amount', function (event) {
  if(event.which == 9){
  var html =  '<tr>'+
                  '<td>'+
                    '<input type="text" class="form-control date" name="items['+row+'][date]"><input type="hidden" class="form-control id"  name="items['+row+'][id]"><input type="hidden" class="form-control type"  name="items['+row+'][type]">'
                     +
                  '</td>'+
                  '<td>'+
                    '<div class="autocomplete">'+
                      '<input type="text" class="form-control property"  name="items['+row+'][property]">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                    '<div class="autocomplete">'+
                      '<input class="form-control items" name="items['+row+'][item] placeholder="Item Description">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" class="form-control qty"  name="items['+row+'][qty]">'+
                  '</td>'+
                  '<td>'+
                    '<input type="number" step=".01" class="form-control amount"  name="items['+row+'][amount]">'+
                  '</td>'+
                
                  '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm delete">Remove</button>'+
                  '</td>'+
                '</tr>';
      
    $('.tbody').append(html);
    autocomplete2(".items", array);
    row++;
  }

});
$(document).on('click', '.delete', function () { // <-- changes
             $(this).closest('tr').remove();
         });  

   //console.log(vouchers);
$('.add').click(function(){
     var html =  '<tr>'+
                  '<td>'+
                    '<input type="text" class="form-control date" name="items['+row+'][date]"><input type="hidden" class="form-control id"  name="items['+row+'][id]"><input type="hidden" class="form-control type"  name="items['+row+'][type]">'+
                  '</td>'+
                  '<td>'+
                    '<div class="autocomplete">'+
                      '<input type="text" class="form-control property"  name="items['+row+'][property]">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                    '<div class="autocomplete">'+
                      '<input class="form-control items" name="items['+row+'][item] placeholder="Item Description">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" class="form-control qty"  name="items['+row+'][qty]">'+
                  '</td>'+
                  '<td>'+
                    '<input type="number" step=".01" class="form-control amount"  name="items['+row+'][amount]">'+
                  '</td>'+
                
                  '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm delete">Remove</button>'+
                  '</td>'+
                '</tr>';
      
      autocomplete2(".items", array);
    $('.tbody').append(html);
    row++;

})
})
</script>
@endsection

