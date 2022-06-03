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
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Add Property Transfer Report</h6>
          <hr/>

              <form action="{{route('submitptr')}}" method="POST" data-parsley-validate="">
                 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                  <input type="hidden" name="id" id="id" value="{{ csrf_token() }}">
                  <input type="hidden" name="type" id="type" value="save">
                  <div class="form-layout form-layout-2">
                      <div class="row no-gutters">
                          
                        <div class="col-md-3 mg-t--1 mg-md-t-0">
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

                          <div class="col-md-4 mg-t--1 mg-md-t-0">
                            <div class="form-group mg-md-l--1">
                              <label class="form-control-label" id="lbltxt">From Accountable Officer: <span class="tx-danger">*</span></label>
                              <select class="form-control select2-show-search" name="from" id="from" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                                  @foreach($employees as $emp)
                                     <option value="{{$emp->id}}" >{{$emp->first_name.' '.$emp->last_name}}</option>
                                  @endforeach
                              </select>
                              <div id="fromentity">
                                  <label class="form-control-label" id="lbltxt">Agency/Fund Cluster: <span class="tx-danger">*</span></label>
                                  <input class="form-control tx-16 froment"  type="text" name="froment" id="froment"  placeholder="Agency/Fund Cluster" />
                                </div>
                            </div>
                          </div><!-- col-4 -->
                          <div class="col-md-4 mg-t--1 mg-md-t-0">
                            <div class="form-group mg-md-l--1">
                              <label class="form-control-label" id="lbltxt">To Accountable Officer: <span class="tx-danger">*</span></label>
                              <select class="form-control select2-show-search" name="to" id="to" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                                  @foreach($employees as $emp)
                                     <option value="{{$emp->id}}" >{{$emp->first_name.' '.$emp->last_name}}</option>
                                  @endforeach
                              </select>
                               <div id="transentity">
                                  <label class="form-control-label" id="lbltxt">Agency/Fund Cluster: <span class="tx-danger">*</span></label>
                                  <input class="form-control tx-16 toent"  type="text" name="toent" id="froment"  placeholder="Agency/Fund Cluster" />
                                </div>
                            </div>
                          </div><!-- col-4 -->
                        
                          <div class="col-md-4 mg-t--1 mg-md-t-0 pno">
                            <div class="form-group mg-md-l--1">
                              <label class="form-control-label">Transfer Type: <span class="tx-danger">*</span></label>
                              <select class="form-control select2-show-search " name="transfer" id="transfer" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                             @foreach($trans as $tran)
                                  <option value="{{$tran->id}}" >{{$tran->name}}</option>
                                @endforeach
                              </select>
                              <div id="others">
                              <label class="form-control-label" id="lbltxt">Others: <span class="tx-danger">*</span></label>
                              <input class="form-control tx-16 other"  type="text" name="other" id="other"  placeholder="Please Specify" />
                            </div>
                          </div>
                          </div>
                            <div class="col-md-12 mg-t--1 mg-md-t-0 pno">
                              <div class="form-group mg-md-l--1">
                                <label class="form-control-label">Reason for Transfer: <span class="tx-danger">*</span></label>
                                <input class="form-control tx-16 reason"  type="text" name="reason" id="reason"  placeholder="Reason for Transfer" />
                              </div>
                          </div>
                          <div class="col-md-6 mg-t--1 mg-md-t-0">
                            <div class="form-group mg-md-l--1">
                              <label class="form-control-label" id="lbltxt">Approved By: <span class="tx-danger">*</span></label>
                              <select class="form-control select2-show-search" name="approved" id="approved" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                                  @foreach($employees as $emp)
                                     <option value="{{$emp->id}}" >{{$emp->first_name.' '.$emp->last_name}}</option>
                                  @endforeach
                              </select>
                              <div id="appentity">
                                  <label class="form-control-label" id="lbltxt">Agency/Fund Cluster: <span class="tx-danger">*</span></label>
                                  <input class="form-control tx-16 appent"  type="text" name="appent" id="appent"  placeholder="Agency/Fund Cluster" />
                                </div>
                            </div>
                          </div><!-- col-4 -->
                          <div class="col-md-6 mg-t--1 mg-md-t-0">
                            <div class="form-group mg-md-l--1">
                              <label class="form-control-label" id="lbltxt">Issued By: <span class="tx-danger">*</span></label>
                              <select class="form-control select2-show-search" name="issued" id="issued" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                                  @foreach($employees as $emp)
                                     <option value="{{$emp->id}}" >{{$emp->first_name.' '.$emp->last_name}}</option>
                                  @endforeach
                              </select>
                              <div id="isentity">
                                  <label class="form-control-label" id="lbltxt">Agency/Fund Cluster: <span class="tx-danger">*</span></label>
                                  <input class="form-control tx-16 isent"  type="text" name="isent" id="isent"  placeholder="Agency/Fund Cluster" />
                                </div>
                            </div>
                          </div><!-- col-4 -->
                      </div><!-- row -->
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
                  <th class="wd-10p">PROPERTY NO</th>
                  <th class="wd-20p">DESCRIPTION</th>
                  <th class="wd-10p">BRAND</th>
                  <th class="wd-5p">UNIT</th>
                  <th class="wd-10p">ITEM TYPE</th>
                  <th class="wd-10p">PPE/EQUIPMENT TYPE</th>
                  <th class="wd-10p">AMOUNT</th>
                  <th class="wd-10p">CONDITION OF PPE</th>
                  <th class="wd-15p">ACTION</th>
                </tr>
              </thead>
              <tbody class="tbody">
                <tr>
                  <td>
                    <input type="text" class="form-control date"  name="items[1][date]">
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
                    <input type="text" class="form-control brand"  name="items[1][brand]">
                  </td>
                   <td>
                    <select class="form-control" style="width: 100%;" name="items[1][unit]">
                        @foreach($units as $pt)
                          <option value="{{$pt->id}}">{{$pt->name}}</option>
                        @endforeach
                    </select>
                  </td>
                   <td>
                     <select class="form-control type" style="width: 100%;" name="items[1][type]">
                        <option value="prop">Property</option>
                        <option value="equip">Equipment</option>
                    </select>
                  </td>
                  <td>
                     <select class="form-control ppe" style="width: 100%;" name="items[1][ppe]">
                        @foreach($ppes as $pt)
                          <option value="{{$pt->id}}">{{$pt->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control eqtype" style="width: 100%;" name="items[1][eqtype]">
                        @foreach($equipment_types as $pt)
                          <option value="{{$pt->id}}">{{$pt->name}}</option>
                        @endforeach
                    </select>
                  </td>
                 
                  <td>
                    <input type="number" step=".01" class="form-control cost"  name="items[1][cost]">
                  </td>
                  <td>
                    <input type="text" step=".01" class="form-control status"   name="items[1][status]">
                  </td>
                   
                </tr>

              </tbody>
            </table>
          </div>
          <hr/>
      <button type="submit" class="btn btn-primary btn-lg submit" id="load">Submit Transfer Form</button>
       
         </form>
      </div>
     
  </div>
<div id="modaldemo4" class="modal fade">
    <div class="modal-dialog" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-body tx-center pd-y-20 pd-x-20">
            <div class="col-md-6 col-xl-4 mg-t-30">
              <div class="ht-100 pos-relative l-20 align-items-center">
                <div class="sk-cube-grid">
                  <div class="sk-cube sk-cube1"></div>
                  <div class="sk-cube sk-cube2"></div>
                  <div class="sk-cube sk-cube3"></div>
                  <div class="sk-cube sk-cube4"></div>
                  <div class="sk-cube sk-cube5"></div>
                  <div class="sk-cube sk-cube6"></div>
                  <div class="sk-cube sk-cube7"></div>
                  <div class="sk-cube sk-cube8"></div>
                  <div class="sk-cube sk-cube9"></div>
                </div>
              </div><!-- d-flex -->
            </div>
          <h4 class="tx-info tx-semibold mg-b-20">Loading Data</h4>
          </div><!-- modal-body -->
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div>
<script>
$(function(){
  $('#others').hide();
$('.eqtype').hide();
  $('.date').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      numberOfMonths: 1
    });

          $('#to').on('change', function(){
            var id = $(this).val();
            if(id == 54){
              $('#transentity').show();
            }
            else{
              $('#transentity').hide();
            }
        });
          $('#approved').on('change', function(){
            var id = $(this).val();
            if(id == 54){
              $('#appentity').show();
            }
            else{
              $('#appentity').hide();
            }
        });
          $('#issued').on('change', function(){
            var id = $(this).val();
            if(id == 54){
              $('#isentity').show();
            }
            else{
              $('#isentity').hide();
            }
        });

          $('#transfer').on('change', function(){
            var id = $(this).val();
            if(id == 4){
              $('#others').show();
            }
            else{
              $('#others').hide();
            }
        });
        $('#from').on('change', function(){
            var id = $(this).val();
            if(id == 54){
              $('#fromentity').show();
            }
            else{
              $('#fromentity').hide();
            }
        });
var row = document.getElementById("lines").rows.length;
function isKeyPressed(event) {  
  var x = document.getElementById("demo");
  if (event.keyCode == 9) {
//console.log(row);
     

  } else {
   
  }
}
$(document).on('change', '.type', function (event) {
    var type = $(this).val();
    var td = $(this);
    if(type == 'prop'){
      $(td).closest("td").next().find('.ppe').show()
      $(td).closest("td").next().find('.eqtype').hide()
    }
    else{
      $(td).closest("td").next().find('.ppe').hide()
      $(td).closest("td").next().find('.eqtype').show()
    }
  });
$(document).on('keydown', '.status', function (event) {
  if(event.which == 9){
  var html =  '<tr>'+
                  '<td>'+
                    '<input type="text" class="form-control date" name="items['+row+'][date]">'+
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
                    '<input type="text" class="form-control brand"  name="items['+row+'][brand]">'+
                  '</td>'+
                  '<td>'+
                   ' <select class="form-control" style="width: 100%;"  name="items['+row+'][unit]>'+
                       ' @foreach($units as $pt)'+
                          '<option value="{{$pt->id}}">{{$pt->name}}</option>'+
                        '@endforeach'+
                    '</select>'+
                  '</td>'+
                  '<td>'+
                     '<select class="form-control type" style="width: 100%;" name="items['+row+'][type]">'+
                        '<option value="prop">Property</option>'+
                        '<option value="equip">Equipment</option>'+
                    '</select>'+
                 ' </td>'+
                  '<td>'+
                       '<select class="form-control ppe" style="width: 100%;" name="items['+row+'][ppe]">'+
                        '@foreach($ppes as $pt)'+
                          '<option value="{{$pt->id}}">{{$pt->name}}</option>'+
                        '@endforeach'+
                    '</select>'+
                    '<select class="form-control eqtype" style="width: 100%;" name="items['+row+'][eqtype]">'+
                        '@foreach($equipment_types as $pt)'+
                          '<option value="{{$pt->id}}">{{$pt->name}}</option>'+
                        '@endforeach'+
                    '</select>'+
                  '</td>'+
                  '<td>'+
                    '<input type="number" step=".01" class="form-control cost"  name="items['+row+'][cost]">'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" step=".01" class="form-control status"  name="items['+row+'][status]">'+
                  '</td>'+
                  '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm delete">Remove</button>'+
                  '</td>'+
                '</tr>';
      
    $('.tbody').append(html);
    $('.eqtype').hide();
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
                    '<input type="text" class="form-control date" name="items['+row+'][date]">'+
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
                    '<input type="text" class="form-control brand"  name="items['+row+'][brand]">'+
                  '</td>'+
                  '<td>'+
                   ' <select class="form-control" style="width: 100%;"  name="items['+row+'][unit]>'+
                       ' @foreach($units as $pt)'+
                          '<option value="{{$pt->id}}">{{$pt->name}}</option>'+
                        '@endforeach'+
                    '</select>'+
                  '</td>'+
                  '<td>'+
                     '<select class="form-control type" style="width: 100%;" name="items['+row+'][type]">'+
                        '<option value="prop">Property</option>'+
                        '<option value="equip">Equipment</option>'+
                    '</select>'+
                 ' </td>'+
                  '<td>'+
                     '<select class="form-control ppe" style="width: 100%;" name="items['+row+'][ppe]">'+
                        '@foreach($ppes as $pt)'+
                          '<option value="{{$pt->id}}">{{$pt->name}}</option>'+
                        '@endforeach'+
                    '</select>'+
                    '<select class="form-control eqtype" style="width: 100%;" name="items['+row+'][eqtype]">'+
                        '@foreach($equipment_types as $pt)'+
                          '<option value="{{$pt->id}}">{{$pt->name}}</option>'+
                        '@endforeach'+
                    '</select>'+
                  '</td>'+
                  
                  '<td>'+
                    '<input type="number" step=".01" class="form-control cost"  name="items['+row+'][cost]">'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" step=".01" class="form-control status"  name="items['+row+'][status]">'+
                  '</td>'+
                  '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm delete">Remove</button>'+
                  '</td>'+
                '</tr>';
      
      
    $('.tbody').append(html);
    $('.eqtype').hide();
    row++;
})
})
</script>
@endsection

