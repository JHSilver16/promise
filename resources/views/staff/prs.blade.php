@extends('layouts.staff')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
  <nav class="breadcrumb pd-0 mg-0 tx-12">
    <a class="breadcrumb-item" href="{{route('dashboard')}}">Home</a>
    <span class="breadcrumb-item active">Purchase Requests</span>
  </nav>
</div>
 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"><!-- br-pageheader -->
<div class="bd-y bd-gray-500 bg-light" id="employeeoptions">
  <div class="ht-md-60 wd-200 wd-md-auto pd-y-20 pd-md-y-0 d-md-flex align-items-center justify-content-center tx-poppins" >
      <ul class="nav nav-effect nav-effect-5 tx-uppercase tx-bold tx-spacing-2 flex-column flex-md-row" role="tablist">
        <li class="nav-item">
          <a href="{{route('addprstaff')}}">
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-plus-circle tx-20"></i>
            <span class="menu-item-label">Create Purchase Request</span>
          </div><!-- menu-item -->
        </a>
        </li>

      </ul>
    </div>
  </div>
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="br-pagebody">
  <div class="br-section-wrapper">
     <div class="d-sm-flex align-items-center pd-t-10">
        <i class="fas fa-credit-card tx-50 lh-0 tx-gray-800"></i>
        <div class="pd-sm-l-20">
          <h4 class="tx-gray-800 mg-b-5">List of Purchase Requests</h4>
          <p class="mg-b-0">As of</p>
        </div>
      </div><!-- d-flex -->
    <div class="row pd-t-40 align-items-center" id="comps">
            
            <div class="col-md-12">
              <table class="table table-bordered" id="products">
                  <thead class="thead-colored thead-dark tx-black">
                    <tr>
                      <th class="wd-15p">PR No</th>
                      <th class="wd-15p">Purpose</th>
                      
                      <th class="wd-15p">Requesting Employee</th>
                      
                      <th class="wd-15p">Total No. of Items</th>
                      <th class="wd-15p">Date</th>
                      <th class="wd-15p">Total</th>
                      <th class="wd-15p">Status</th>
                      <th class="wd-15p">Within PPMP?</th>
                      <th class="wd-10p">Action</th>
                    </tr>
                  </thead>
                   <tbody class="tx-inverse">
                     @foreach($prs as $pr)
                       <tr>
                        <td>{{$pr['no']}}</td>
                        <td>{{$pr['purpose']}}</td>
                        
                         <td>{{$pr['employee']}}</td>
                         
                        <td>{{$pr['items']}}</td>
                        <td>{{$pr['date'] }}</td>
                        <td>{{$pr['total_amount']}}</td>
                        <td>{{$pr['status']}}</td>
                        <td><input type="checkbox" checked="{{$pr['ppmp']}}"></td>
                        <td><div class="btn-group" role="group" aria-label="Basic example">
                          @if($pr['status'] == "FOR DC's APPROVAL")
                            @if($auth['designation'] == 'DC')
                             <button type="button" class="btn btn-warning edit" data-id="{{$pr['id']}}"><i class="fa fa-edit"></i> Edit PR</button>
                             @else
                            @if($pr['requested_by'] == $auth['id'])
                             <button type="button" class="btn btn-warning edit" data-id="{{$pr['id']}}"><i class="fa fa-edit"></i> Edit PR</button>
                            @endif
                           @endif
                           @endif
                           @if($pr['status'] == "FOR DC's APPROVAL" && $auth['designation'] == 'DC')
                            <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                              <span class="caret"></span></button>
                             <div class="dropdown-menu pd-10 wd-300">
                                <nav class="nav nav-style-2 flex-column">
                                  <a href="{{route('updatepr', ['id' => $pr['id'], 'status' => 'PENDING', 'type'=>'approval', 'remarks'=>'none'])}}" class="nav-link"><i class="fa fa-money-check fa-xs"></i> Approve PR</a>
                                  <a  class="nav-link remarks" style="display: none;" data-status="FOR REVISION"><i class="fa fa-clipboard-list fa-xs"></i>For Revision</a>
                                  <a class="nav-link remarks" style="display: none;" data-status="DISAPPROVE"><i class="fa fa-th-list fa-xs"></i> Disapprove</a>
                                
                                </nav>
                              </div><!-- dropdown-menu -->
                            </div>
                           @endif
                        
                         
                           <button type="button" class="btn btn-info group" title="Edit" data-id="{{$pr['id']}}" data-name="{{$pr['no']}}" data-total="{{$pr['total_amount']}}" data-date="{{$pr['date']}}"><i class="fa fa-box"></i> View Items</button>
                           <button type="button" class="btn btn-teal print" title="Edit" data-id="{{$pr['id']}}" data-name="{{$pr['no']}}" data-total="{{$pr['total_amount']}}" data-date="{{$pr['date']}}"><i class="fa fa-print"></i> Print Item</button>

                          
                          
                        </div>
                        </td>
                      </tr>
                     @endforeach
                   </tbody>
                 </table>
            </div>
  </div>
</div>

<div id="modaldemo1" class="modal fade">
    <div class="modal-dialog modal-dialog-vertical-center modal-lg" style="width: 80%" role="document">
      <div class="modal-content bd-0 tx-14">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold">Update PR </h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" id="id" value="">
        <div class="modal-body pd-25 wd-1000">
          <h4 class="lh-3 mg-b-20 name tx-uppercase tx-b tx-bold"></h4>
          <div class="row">
            <div class="col-md-12">Remarks</div>
            <div class="col-md-12"><input type="text" style="width: 100%" name="qty" id="remarks" class="form-control" placeholder="Enter your remarks" required></div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="{{route('updatepr', ['id' => '1', 'status' => 'FOR REVISION', 'type'=>'approval', 'remarks' => ''])}}"  class="btn btn-primary updatepr tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save changes</a>
          <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
   <!-- modal-dialog -->
  </div><!-- modal -->

<div id="groupdemo" class="modal fade">
    <div class="modal-dialog modal-dialog-vertical-center modal-lg" role="document">
      <div class="modal-content bd-0 tx-14">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold">Item List</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
  
        <div class="modal-body pd-25">
              <table class="table">
                <thead class="thead-colored thead-dark">
                  <tr>
                    <th class="wd-15p">Stock No.</th>
                    <th class="wd-15p">Item</th>
                    <th class="wd-15p">Quantity</th>
                    <th class="wd-15p">Unit</th>
                    <th class="wd-15p">Unit Cost</th>
                    <th class="wd-15p">Total</th>
                  </tr>
                </thead>
                <tbody id="tbpolines" class="tx-inverse"></tbody>
                <tfoot>
                   <tr>
                      <td class="tx-right" colspan="5"><b>Grand Total:</b></td>
                      <td class="text-right">
                          <input type="text" class="form-control text-right total" name="gtotal" tabindex="-1" value="0.00" readonly="readonly" />
                      </td>
                  </tr>
                 </tfoot>
              </table>
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
   <!-- modal-dialog -->
  </div><!-- modal -->

   <div id="mySidenav" class="sidenav2">
<form action="{{route('submitrfq')}}" method="POST">
<input type="hidden" name="type" id="type" value="save">
 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <br>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55"><input type="hidden" class="pr_id" name="prid">PR No.</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="prid"></div>
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">PR Date</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="prdate"></div>
  </div>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">Purpose.</div>
    <div class="col-md-10 tx-left pd-y-10 pd-x-55" id="prpurpose"></div>
  </div>

<hr>

<br>
<h3 class="tx-inverse" id="lbl">REQUEST FOR QUOTATION</h3>
<br>

<div class="row pd-x-55">
    <div class="col-md-4">
     <div class="form-layout form-layout-2">
        <div class="row no-gutters">
          <div class="col-md-6 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label" id="lbltxt">RFQ Ref No: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16 refno" value="{{$rfqno}}" type="text" name="refno" readonly="" placeholder="PHILGEPS Ref No" />
            </div>
          </div><!-- col-4 -->
          <div class="col-md-6 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">Date: <span class="tx-danger">*</span></label>
              <input type="text" class="form-control date" name="date" placeholder="MM/DD/YYYY">
            </div>
          </div><!-- col-4 -->
          <div class="col-md-12 mg-t--1 mg-md-t-0" id="phil">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">PHILGEPS Ref No: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16 phgpsno" type="text" name="phgpsno" placeholder="PHILGEPS Ref No" />
            </div>
          </div><!-- col-4 -->
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-control-label">Supplier: <span class="tx-danger">*</span></label>
              <select class="form-control select2-show-search suppliers" name="supplier" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                @foreach($suppliers as $supplier)
                  <option value="{{$supplier->id}}" data-address="{{$supplier->address}}">{{$supplier->name}}</option>
                @endforeach
              </select>
            </div>
          </div><!-- col-4 -->
          <div class="col-md-12 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16 address" type="text" name="amountpaid" readonly="" placeholder="Address" />
            </div>
          </div>
          
        </div>

        <div class="form-layout-footer bd pd-20 bd-t-0 paydiv">
             
            </div><!-- form-group -->
    </div>
    <hr>
    <div class="row return">
    <div class="col-md-12 tx-left">
      <button type="submit" class="btn btn-primary">Submit Form</button>
    </div>
  </div>
  </div>
  <div class="col-md-8">
    <table class="table">
  <thead class="thead-colored thead-dark">
    <tr>
      <th class="wd-15p"></th>
      <th class="wd-15p">Stock No.</th>
      <th class="wd-15p">Item</th>
      <th class="wd-15p">Quantity</th>
      <th class="wd-15p">Unit</th>
      <th class="wd-15p">ABC Cost</th>
      <th class="wd-15p">Total</th>
    </tr>
  </thead>
  <tbody id="prlines" class="tx-inverse"></tbody>
  <tfoot>
     <tr>
        <td class="tx-right" colspan="6"><b>Grand Total:</b></td>
        <td class="text-right">
            <input type="text" id="total" class="form-control text-right total" name="gtotal" tabindex="-1" value="0.00" readonly="readonly" />
        </td>
    </tr>
   </tfoot>
</table>
<div class="row delivery">
  <div class="col-md-12">
     <div class="form-layout form-layout-2">
        <div class="row no-gutters tx-center">
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-control-label">Amount in Words: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16" type="text" readonly="" name="amountwords" placeholder="Amount in Words" id="amountwords" />
            </div>
          </div>
          <br>
          <!-- col-4 -->  
        </div>
      </div>
    </div>
  </div>
  <div class="row return">
    <div class="col-md-12 tx-left">
    </div>
  </div>
</div>

</div>
  </form>
  </div>
 <div id="mySidenav2" class="sidenav2">

<form action="{{route('submitpo')}}" method="POST">

 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
  <br>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55"><input type="hidden" class="pr_id" name="prid">PR No.</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="prid"></div>
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">PR Date</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55 prdate" id=""></div>
  </div>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">Purpose.</div>
    <div class="col-md-10 tx-left pd-y-10 pd-x-55 prpurpose" id=""></div>
  </div>

<hr>

<br>
<h3 class="tx-inverse" id="lbl">PURCHASE ORDER</h3>
<br>

<div class="row pd-x-55">

    <div class="col-md-4">
      <div class="row">
        <h6 class="tx-inverse" id="lbl">PO From:</h6>
         <select class="form-control select2-show-search potype" name="supplier" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
              <option value="">Select..</option>
              <option value="DBM">Department of Budget and Management</option>
              <option value="supplier">Suppliers</option>
            
          </select>
      </div>
<hr/>
     <div class="form-layout form-layout-2">
        <div class="row no-gutters">
          <div class="col-md-6 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label" id="lbltxt">PO Ref No: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16 refno" value="{{$pono}}" type="text" name="refno" readonly="" placeholder="PHILGEPS Ref No" />
            </div>
          </div><!-- col-4 -->
          <div class="col-md-6 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">Date: <span class="tx-danger">*</span></label>
              <input type="text" class="form-control date" name="date" placeholder="MM/DD/YYYY">
            </div>
          </div><!-- col-4 -->
         <div class="col-md-12 mg-t--1 mg-md-t-0 pno">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">PS APR No.: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16" type="text" name="pno" placeholder="PS APR No. (Provided by the DBM)" />
            </div>
          </div>
          <div class="col-md-12 supplierrow">
            <div class="form-group">
              <label class="form-control-label">Supplier: <span class="tx-danger">*</span></label>
              <select class="form-control select2-show-search suppliers" name="supplier" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                @foreach($suppliers as $supplier)
                  <option value="{{$supplier->id}}" data-address="{{$supplier->address}}">{{$supplier->name}}</option>
                @endforeach
              </select>
            </div>
          </div><!-- col-4 -->
          <div class="col-md-12 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16 address" type="text" name="amountpaid" readonly="" placeholder="Address" />
            </div>
          </div>
          
        </div>

        <div class="form-layout-footer bd pd-20 bd-t-0 paydiv">
             
            </div><!-- form-group -->
    </div>
    <hr>
    <div class="row return">
    <div class="col-md-12 tx-left">
      <button type="submit" class="btn btn-primary">Submit Form</button>
    </div>
  </div>
  </div>
  <div class="col-md-8">
    <table class="table">
  <thead class="thead-colored thead-dark">
    <tr>
      <th class="wd-15p">Stock No.</th>
      <th class="wd-15p">Item</th>
      <th class="wd-15p">Quantity</th>
      <th class="wd-15p">Unit</th>
      <th class="wd-15p">ABC Cost</th>
      <th class="wd-15p">Total</th>
    </tr>
  </thead>
  <tbody id="prlines2" class="tx-inverse"></tbody>
  <tfoot>
     <tr>
        <td class="tx-right" colspan="5"><b>Grand Total:</b></td>
        <td class="text-right">
            <input type="text" id="ptotal" class="form-control text-right total" name="gtotal" tabindex="-1" value="0.00" readonly="readonly" />
        </td>
    </tr>
   </tfoot>
</table>
<div class="row delivery">
  <div class="col-md-12">
     <div class="form-layout form-layout-2">
        <div class="row no-gutters tx-center">
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-control-label">Amount in Words: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16" type="text" readonly="" name="amountwords" placeholder="Amount in Words" id="pamountwords" />
            </div>
          </div>
          <br>
          <!-- col-4 -->  
        </div>
      </div>
    </div>
  </div>
  <div class="row return">
    <div class="col-md-12 tx-left">
    </div>
  </div>
</div>

</div>
  </form>
  </div>
<script type="text/javascript">
   $(function(){
        'use strict';

        $('#products').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
          }
        });
    $(document).on('click', '.edit', function(){
      window.location.href = '{{route ("editprstaff", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

   $(document).on('click', '.print', function(){
      window.location.href = '{{route ("pr", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

$(document).on('click', '.remarks', function(){

  $('#modaldemo1').modal('show');
  console.log($(this).data('status'))
  $('.updatepr').attr('href')
});

$('.suppliers').on('change', function (e) {
    var optionSelected = $("option:selected", this).data('address');
    var valueSelected = this;
    $(".address").val(optionSelected);
    
});

$('.potype').on('change', function (e) {
    var type = $(this).val();

    if(type == 'DBM'){
      $('.suppliers').val(58);
      $('.address').val('Koronadal City');
      $('.pno').show();
    }
    else{
      $('.pno').hide();
       $('.suppliers').val(3);
      $('.address').val('');
    }
  })

$('.date').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true,
  numberOfMonths: 2
});
    var suppliers = {!! json_encode($suppliers->toArray()) !!};
$('.addpo').click(function(){
  $('.prid').text($(this).data('name'));
         $('.prpurpose').text($(this).data('purpose'));
         $('.prdate').text($(this).data('date'));
         $('.prpurpose').text($(this).data('purpose'));
        $('.pr_id').val($(this).data('id'));
         $.get("{{route('getprlines')}}",
        {
           _token: document.getElementById('token').value,
            id: $(this).data('id')
        },
         function(data,status){
          var tr='';
          var a=1;
           if(status == 'success'){
            console.log(data)
            var table = document.getElementById('prlines2');
             data.forEach(function(key){
                tr += "<tr>"+                     
                       '<td class="wd-10p tx-center"><input type="hidden" name="items['+a+'][id]" value='+key.id+'>'+key.stock+'</td>'+
                       '<td class="wd-10p tx-center">'+key.name+'</td>'+
                       '<td class="wd-10p tx-center"><input type="text" class="qtys" name="items['+a+'][qty]" value='+key.qty+'></td>'+
                       '<td class="wd-10p tx-center"><input type="hidden" class="unit" name="items['+a+'][unit]" value='+key.unit+'>'+key.unit+'</td>'+
                       '<td class="wd-10p tx-center"><input type="text" class="costs" name="items['+a+'][unit_cost]" value='+key.unit_cost+'></td>'+
                       '<td class="wd-10p tx-center"><input type="text" class="totals" readonly name="items['+a+'][total_cost]" value='+key.total_cost+'></td></tr>';
                a++;
               });
            
            table.innerHTML = tr;
            openNav2();
            
           }
      });
  
})

$('.submitpo').click(function(){
         
     
});

    $('.add').click(function(){
        $('#prid').text($(this).data('name'));
         $('#prpurpose').text($(this).data('purpose'));
         $('#prdate').text($(this).data('date'));
         $('#prpurpose').text($(this).data('purpose'));
        $('.pr_id').val($(this).data('id'));

        //if($(this).data(''))

        $.get("{{route('getprlines')}}",
        {
           _token: document.getElementById('token').value,
            id: $(this).data('id')
        },
         function(data,status){
          var tr='';
          var a=1;
           if(status == 'success'){
            console.log(data)
            var table = document.getElementById('prlines');
             data.forEach(function(key){
                tr += "<tr>"+
                       '<td class="wd-10p"><input type="checkbox" class="itemchk" data-amount="'+key.total_cost+'" name="items['+a+'][prline_id]" value='+key.id+'></td>'+
                       '<td class="wd-10p">'+key.stock+'</td>'+
                       '<td class="wd-10p">'+key.name+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][qty]" value='+key.qty+'>'+key.qty+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][unit]" value='+key.unit+'>'+key.unit+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][unit_cost]" value='+key.unit_cost+'>'+key.unit_cost+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][total_cost]" value='+key.total_cost+'>'+key.total_cost+'</td></tr>';
                        a++;
               });
            
            table.innerHTML = tr;
            openNav();
            
           }
      });
        //$('#modaldemo1').modal('show');
        openNav();

    })

 $(document).on('click', '.group', function(){
        $('#tbpolines').empty();
$('.total').val($(this).data('total'));
        $.get("{{route('getprlines')}}",
        {
           _token: document.getElementById('token').value,
            id: $(this).data('id')
        },
         function(data,status){
          var tr='';
          var a=1;
           if(status == 'success'){
             data.forEach(function(key){
                tr +=  '<tr>'+
                       '<td class="wd-10p">'+key.stock+'</td>'+
                       '<td class="wd-10p">'+key.name+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][qty]" value='+key.qty+'>'+key.qty+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][unit]" value='+key.unit+'>'+key.unit+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][unit_cost]" value='+key.unit_cost+'>'+key.unit_cost+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][total_cost]" value='+key.total_cost+'>'+key.total_cost+'</td></tr>';
               });
            
            $('#tbpolines').append(tr);
            $('#groupdemo').modal('show');
           }
      });

    });

$(document).on('keyup', '.qtys', function(){
  
    var cost = $(this).closest("td").next().next().find('.costs').val();
    var qty = $(this).val();
    var total = cost * qty;
    //console.log(total)
    $(this).closest("td").next().next().next().find('.totals').val(total.toFixed(2))
    gettotal();
  
});

$(document).on('keyup', '.costs', function(){
  
    var qty = $(this).closest("td").prev().prev().find('.qtys').val();
    var cost = $(this).val();
    var total = cost * qty;
    //console.log(total)
    $(this).closest("td").next().find('.totals').val(total.toFixed(2))
    gettotal();
  
});
$(document).on("change", '.itemchk', function(){
  gettotald();
})

function gettotald(){
  var total=0;
  $(".itemchk:checkbox:checked").each(function() {
      total += parseFloat($(this).data('amount'));
    });

    $('#total').val(total.toFixed(2));

    $("#amountwords").val(inWords(total)+"pesos only")

}

function gettotal(){
  var total=0;
  $(".totals").each(function() {
    console.log($(this).val())
      if($(this).val() != ''){

        total += parseFloat($(this).val());
      }
    });
    $('#ptotal').val(total.toFixed(2));
$("#pamountwords").val(inWords(total)+"pesos only")
}

});
</script>
@endsection