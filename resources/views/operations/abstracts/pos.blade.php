@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
  <nav class="breadcrumb pd-0 mg-0 tx-12">
    <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
    <span class="breadcrumb-item active">Products</span>
  </nav>
</div>
 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"><!-- br-pageheader -->

  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="br-pagebody">
  <div class="br-section-wrapper">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">List of Purchase Orders</h6>
    <div class="row pd-t-40 align-items-center" id="comps">
            
            <div class="col-md-12">
              <table class="table table-bordered" id="products">
                  <thead class="thead-colored thead-dark tx-black">
                    <tr>
                      <th class="wd-15p">PO No</th>
                      <th class="wd-15p">Supplier</th>
                      <th class="wd-15p">Purpose</th>
                      <th class="wd-5p">No. of Items</th>
                      <th class="wd-10p">Date</th>
                      <th class="wd-15p">Total</th>
                      <th class="wd-15p">Status</th>
                      <th class="wd-15p">IAR No</th>
                      <th class="wd-15p">IAR Date</th>
                      <th class="wd-15p">Inspected By:</th>
                      <th class="wd-15p">Inspected Date:</th>
                      <th class="wd-15p">Received By:</th>
                      <th class="wd-15p">Received Date:</th>
                      <th class="wd-15p">Action</th>
                    </tr>
                  </thead>
                   <tbody class="tx-inverse">
                     @foreach($pos as $pr)
                       <tr>
                        <td>{{$pr['no']}}</td>
                        <td>{{$pr['supplier']}}</td>
                        <td>{{$pr['purpose']}}</td>
                        <td>{{$pr['items']}}</td>
                        <td>{{$pr['date']}}</td>
                        <td>{{$pr['total_amount']}}</td>
                        <td>{{$pr['status']}}</td>
                        <td>{{$pr['iarno']}}</td>
                        <td>{{$pr['iardate']}}</td>
                        <td>{{$pr['inemployee']}}</td>
                        <td>{{$pr['indate']}}</td>
                        <td>{{$pr['rcemployee']}}</td>
                        <td>{{$pr['rcdate']}}</td>
                        <td><div class="btn-group" role="group" aria-label="Basic example">
                          @if($pr['status'] == 'FOR ORS/BURS')
                           <button type="button" class="btn btn-primary view" data-type="set"  title="Edit" data-id="{{$pr['id']}}" data-supplier="{{$pr['supplier']}}" data-name="{{$pr['no']}}" data-total="{{$pr['total_amount']}}" data-id="{{$pr['id']}}" data-status="{{$pr['status']}}"><i class="fa fa-plus-square"></i> Set ORS</button>
                           <button type="button" class="btn btn-warning editpo" data-type="rfq"  title="Edit" data-id="{{$pr['id']}}" data-supplier="{{$pr['supplier']}}" data-name="{{$pr['no']}}" data-amount="{{$pr['total_amount']}}" data-date="{{$pr['date']}}"><i class="fa fa-plus-square"></i> Edit PO</button>
                          @elseif($pr['status'] == 'PENDING')
                           <button type="button" class="btn btn-primary add" data-type="rfq"  title="Edit" data-id="{{$pr['id']}}" data-supplier="{{$pr['supplier']}}" data-name="{{$pr['no']}}" data-amount="{{$pr['total_amount']}}" ><i class="fa fa-plus-square"></i> Create IAR</button>
                           <button type="button" class="btn btn-warning editpo" data-type="rfq"  title="Edit" data-id="{{$pr['id']}}" data-supplier="{{$pr['supplier']}}" data-name="{{$pr['no']}}" data-amount="{{$pr['total_amount']}}" data-date="{{$pr['date']}}" data-supp="{{$pr['supplier_id']}}" data-proc="{{$pr['procmode']}}"><i class="fa fa-plus-square"></i> Edit PO</button>
                           <button type="button" class="btn btn-secondary printors" title="Edit" data-id="{{$pr['id']}}" data-name="{{$pr['no']}}" data-total="{{$pr['total_amount']}}" data-date="{{$pr['date']}}"><i class="fa fa-print"></i> Print ORS</button>
                           @endif
                          
                           <button type="button" class="btn btn-info view" title="Edit" data-type="view" data-id="{{$pr['id']}}" data-name="{{$pr['no']}}" data-total="{{$pr['total_amount']}}" data-date="{{$pr['date']}}" data-status="{{$pr['status']}}"><i class="fa fa-list"></i> View Items</button>
                           <button type="button" class="btn btn-secondary printpo" title="Edit" data-id="{{$pr['id']}}" data-name="{{$pr['no']}}" data-status="{{$pr['status']}}" data-total="{{$pr['total_amount']}}" data-date="{{$pr['date']}}"><i class="fa fa-print"></i> Print PO</button>
                           @if($pr['status'] == 'INSPECTED AND RECEIVED')
                           <button type="button" class="btn btn-success stockin" title="Edit" data-id="{{$pr['id']}}" data-name="{{$pr['no']}}" data-total="{{$pr['total_amount']}}" data-date="{{$pr['date']}}" data-master="{{$pr['master']}}" data-acc="{{$pr['acc']}}" data-prno="{{$pr['prno']}}" data-iarno="{{$pr['iarno']}}"><i class="fa fa-box"></i> 
                              StockIn Items</button>
                           <button type="button" class="btn btn-primary add" data-type="rfq"  title="Edit" data-id="{{$pr['id']}}" data-supplier="{{$pr['supplier']}}" data-name="{{$pr['no']}}" data-amount="{{$pr['total_amount']}}" ><i class="fa fa-edit"></i> Edit IAR</button>
                            @endif
                           
                           @if($pr['status'] == 'INSPECTED AND RECEIVED' || $pr['status'] == 'STOCKED IN')
                              <button type="button" class="btn btn-warning printiar" title="Edit" data-id="{{$pr['id']}}" data-name="{{$pr['no']}}" data-total="{{$pr['total_amount']}}" data-date="{{$pr['date']}}"><i class="fa fa-list"></i> Print IAR</button>
                              
                           @endif
                        </div>
                        </td>
                      </tr>
                     @endforeach
                   </tbody>
                 </table>

            </div>
  </div>
</div>
<div id="groupdemo" class="modal fade">
  <form action="{{route('setors')}}" method="POST" data-parsley-validate="">
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
              <hr/>
              <div class="row">
                <div class="col-md-12" id="orsform">
                    
                 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                  <input type="hidden" name="id" id="poid" value="{{ csrf_token() }}">
                  <div class="form-layout form-layout-2">
                      <div class="row no-gutters">
                          <div class="col-md-3 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label">Fund Cluster: <span class="tx-danger">*</span></label>
                                  <input class="form-control tx-16 sao" type="text" name="fund" placeholder="Fund Cluster" />
                                </div>
                              </div>
                              <div class="col-md-3 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label">Fund Cluster Type: <span class="tx-danger">*</span></label>
                                 <select class="form-control select2-show-search" name="fctype" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                                   <option value="MOOE">MOOE</option>
                                   <option value="CO">CO</option>
                                 </select>
                                </div>
                              </div>
                              <div class="col-md-6 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label">ORS/BURS No: <span class="tx-danger">*</span></label>
                                  <input type="text" class="form-control sao" name="orsno" placeholder="ORS/BURS No">
                                </div>
                              </div>
                              <div class="col-md-3 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label"> ORS/BURS Date: <span class="tx-danger">*</span></label>
                                  <input type="text" class="form-control date sao" name="orsdate"  placeholder="MM/DD/YYYY">
                                </div>
                              </div>
                              <div class="col-md-3 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label"> ORS/BURS Amount: <span class="tx-danger">*</span></label>
                                  <input type="text" class="form-control sao" name="orsamount"  placeholder="ORS/BURS Amount">
                                </div>
                              </div>

                              <div class="col-md-3 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label"> MFO/PAP: <span class="tx-danger">*</span></label>
                                  <input type="text" class="form-control sao" name="mfo"  placeholder="ORS/BURS Amount">
                                </div>
                              </div>
                              <div class="col-md-3 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label"> UACS Object Code: <span class="tx-danger">*</span></label>
                                  <input type="text" class="form-control sao" name="uacs"  placeholder="ORS/BURS Amount">
                                </div>
                              </div>
                              <div class="col-md-12 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label"> Select Master Account: <span class="tx-danger">*</span></label>
                                  <select class="form-control select2-show-search" name="master" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                                    @foreach($mas as $m)
                                      <option value="{{$m->id}}">{{$m->name}}</option>
                                    @endforeach
                                 </select>
                                </div>
                              </div>
                               <div class="col-md-12 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label"> Particulars: <span class="tx-danger">*</span></label>
                                 
                                   <input type="text" class="form-control sao" name="particulars"  placeholder="Particulars">
                                </div>
                              </div>
                      </div>
                  </div>
                
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" >Save Changes</button>
          <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </form>
   <!-- modal-dialog -->
  </div><!-- modal -->
 <div id="mySidenav2" class="sidenav2">

<form action="{{route('editpo')}}" method="POST">

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
<h3 class="tx-inverse" id="lbl">EDIT PURCHASE ORDER</h3>
<br>

<div class="row pd-x-55">
    <div class="col-md-4">
     <div class="form-layout form-layout-2">
        <div class="row no-gutters">
          <div class="col-md-6 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label" id="lbltxt">PO Ref No: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16 refno"  type="text" name="refno" id="refno" readonly="" placeholder="PHILGEPS Ref No" />
            </div>
          </div><!-- col-4 -->
          <div class="col-md-6 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">Date: <span class="tx-danger">*</span></label>
              <input type="text" class="form-control date" name="date" id="podate" placeholder="MM/DD/YYYY">
            </div>
          </div><!-- col-4 -->
        <div class="col-md-12 mg-t--1 mg-md-t-0 pno">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">Mode of Procurement: <span class="tx-danger">*</span></label>
              <select class="form-control select2-show-search " name="procmode" id="procmode" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
             @foreach($procmodes as $proc)
                  <option value="{{$proc->id}}" >{{$proc->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
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
            <input type="text" id="gtotal" class="form-control text-right" name="gtotal" tabindex="-1" value="0.00" readonly="readonly" />
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
              <input class="form-control tx-16" type="text" readonly="" name="amountwords" placeholder="Amount in Words" id="gamountwords" />
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

<div id="modaldemo1" class="modal fade">
    <div class="modal-dialog modal-dialog-vertical-center modal-lg" style="width: 100%" role="document">
      <div class="modal-content bd-0 tx-14">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold">Stock In Items</h6>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{route('stockin')}}" method="POST">
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <input type="hidden" name="prid" id="id" value="">
          <input type="hidden" name="iacid" id="iacid" value="">
        <div class="modal-body pd-25">
          <h5 class="lh-3 mg-b-20 name tx-uppercase tx-inverse tx-bold"></h5>
             <div class="row bg-gray-900 tx-white">
               <div class="col-lg-2 pd-y-10 wd-15p">Stock No.</div>
                <div class="col-lg-2 pd-y-10 wd-15p">Item</div>
                <div class="col-lg-2 pd-y-10 wd-15p">Quantity</div>
                <div class="col-lg-2 pd-y-10 wd-15p">Unit</div>
                <div class="col-lg-2 pd-y-10 wd-15p">Unit Cost</div>
                <div class="col-lg-2 pd-y-10 wd-15p">Total</div>
             </div>

             <div class="row bg-gray-100 tx-inverse" id="polines">
              </div>
              <div class="row bg-gray-100 tx-inverse" id="polines">
                <div class="col pd-y-10 wd-15p">Master Account: </div>
                <div class="col pd-y-10 wd-15p">
                  <input type="hidden" name="master" id="master" value="">
                   <input type="text" class="master form-control" readonly="" value="">
            </div>
              </div>
            </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Stock In</button>
          <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
        </div>
         </form>
      </div>
    </div>
   <!-- modal-dialog -->
  </div><!-- modal -->



   <div id="mySidenav" class="sidenav2">
<form action="{{route('submitacc')}}" method="POST">

 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <br>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55"><input type="hidden" id="pr_id" name="prid">PO No.</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="prid"></div>
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">PO Date</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="prdate"></div>
  </div>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">Supplier</div>
    <div class="col-md-10 tx-left pd-y-10 pd-x-55" id="supplier"></div>
  </div>

<hr>

<br>
<h3 class="tx-inverse" id="lbl">INSPECTION AND ACCEPTANCE REPORT</h3>
<br>

<div class="row pd-x-55">
    <div class="col-md-4">
     <div class="form-layout form-layout-2">
        <div class="row no-gutters">
          <div class="col-md-6 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label" id="lbltxt">IAR Ref No: <span class="tx-danger">*</span></label>
              <input type="hidden" name="type" id="iartype" value="save">
              <input class="form-control tx-16 refno" value="{{$iarno}}" type="text" name="refno" id="iarref" readonly="" placeholder="PHILGEPS Ref No" />
            </div>
          </div><!-- col-4 -->
          <div class="col-md-6 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">Date: <span class="tx-danger">*</span></label>
              <input type="text" class="form-control date" required="" name="date" id="iardate" placeholder="MM/DD/YYYY">
            </div>
          </div><!-- col-4 -->
          <div class="col-md-6 mg-t--1 mg-md-t-0" id="phil">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">Invoice No: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16 invoice" type="text" required="" name="invoice" id="invoice" placeholder="Invoice No" />
            </div>
          </div><!-- col-4 -->
          <div class="col-md-6 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">Invoice Date: <span class="tx-danger">*</span></label>
              <input type="text" class="form-control date" name="indate" required="" id="invoicedate" placeholder="MM/DD/YYYY">
            </div>
          </div><!-- col-4 -->

          
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
      <th class="wd-15p">Unit Cost</th>
      <th class="wd-15p">Total</th>
    </tr>
  </thead>
  <tbody id="prlines" class="tx-inverse"></tbody>
  <tfoot>
     <tr>
        <td class="tx-right" colspan="5"><b>Grand Total:</b></td>
        <td class="text-right">
            <input type="text" id="total" class="form-control text-right total" name="gtotal" tabindex="-1" value="0.00" readonly="readonly" />
        </td>
    </tr>
   </tfoot>
</table>
<div class="row delivery no-gutters">
  <div class="col-md-6">
     <div class="form-layout form-layout-2">
        <div class="row no-gutters">
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Date of Inspection: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16 date" type="text" readonly="" name="insdate" id="insdate" placeholder="MM/DD/YYYY"  />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Inspection Officer: <span class="tx-danger">*</span></label>
               <select class="form-control employees" name="inemployee" id="inemployee" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                @foreach($employees as $employee)
                  <option value="{{$employee->id}}">{{$employee->first_name.' '.$employee->last_name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <br>
          <!-- col-4 -->  
        </div>
         <div class="row no-gutters">
          <div class="col-md-12">
            <div class="form-group">
              <label class="ckbox">
                <input name="instatus" value="inspected" type="checkbox">
                <span>Inspected and verified</span>
              </label>
            </div>
        </div>
         </div>
      </div>
    </div>

    <div class="col-md-6">
     <div class="form-layout form-layout-2">
        <div class="row no-gutters">
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Received Date: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16 date" type="text" readonly="" name="rcdate" id="rcdate" placeholder="MM/DD/YYYY" />
              
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="form-control-label">Property Custodian: <span class="tx-danger">*</span></label>
              <select class="form-control employees" name="premployee" style="width: 100%" data-placeholder="Choose one (with searchbox)" id="premployee" tabindex="-1" aria-hidden="true">
                @foreach($employees as $employee)
                  <option value="{{$employee->id}}">{{$employee->first_name.' '.$employee->last_name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <br>
          <!-- col-4 -->  
        </div>
         <div class="row no-gutters">
          <div class="col-md-12">
            <div class="form-group">
                 <div class="row">
                  <div class="col-lg-5">
                    <label class="rdiobox">
                      <input name="status" value="complete" type="radio">
                      <span>Complete</span>
                    </label>
                  </div><!-- col-3 -->
                  <div class="col-lg-6 mg-t-20 mg-lg-t-0">
                    <label class="rdiobox">
                      <input name="status" value="partial" type="radio" checked>
                      <span>Partial</span>
                    </label>
                  </div><!-- col-3 -->
                </div>
            </div>

          </div>
            
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
 var array = [];       
    $('.edit').click(function(){
      window.location.href = '{{route ("edititem", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

    $(document).on("click", '.printpo', function(){
      window.location.href = '{{route ("posreport", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

    $(document).on("click", '.printors', function(){
      window.location.href = '{{route ("orsreport", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

    $(document).on("click", '.printiar', function(){
      window.location.href = '{{route ("iar", ["id" => ''] )}}'+'/'+$(this).data('id')
    })
$('.suppliers').on('change', function (e) {
    var optionSelected = $("option:selected", this).data('address');
    var valueSelected = this;
    $(".address").val(optionSelected);
    
});

var employees = {!! json_encode($employees->toArray()) !!};
var units = {!!json_encode($units)!!};
units.forEach(function(key){
               array.push(key.name);
            })
//console.log(array)
$('.date').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true,
  numberOfMonths: 2
});
    

    $(document).on("click", '.add', function(){
         $('#prid').text($(this).data('name'));
         $('#prpurpose').text($(this).data('purpose'));
         $('#prdate').text($(this).data('date'));
         $('#supplier').text($(this).data('supplier'));
         $('#pr_id').val($(this).data('id'));
         $('#total').val($(this).data('amount'));
        var txt = $(this).text();
        //if($(this).data(''))
        console.log(txt)
        $.get("{{route('getpolist')}}",
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
                tr +=  '<tr>'+
                       '<td class="wd-10p">'+key.no+'</td>'+
                       '<td class="wd-10p">'+key.name+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][qty]" value='+key.qty+'>'+key.qty+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][unit]" value='+key.unit+'>'+key.unit+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][unit_cost]" value='+key.unit_cost+'>'+key.unit_cost+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][total_cost]" value='+key.total_cost+'>'+key.total_cost+'</td></tr>';
               });
            
            table.innerHTML = tr;
            openNav();
            
           }
      });
        if(txt.includes("Edit IAR")){

          $.get("{{route('editiar')}}",
          {
            _token: document.getElementById('token').value,
             id: $(this).data('id')
          },function(data,status){
            
                $("#insdate").val(data['date_inspected']);
                $("#invoice").val(data['invoice_no']);
                $("#invoicedate").val(data['invoice_date']);
                $("#insdate").val(data['date_inspected']);
                $("#rcdate").val(data['date_received']);
                //$("#rcemployee").val(data['received_by']);
                //console.log(data['received_by'])
                //console.log("option[value="+data['received_by']+"]");
                $("#rcemployee option[value="+data['received_by']+"]").attr('selected','selected');
                $("#inemployee option[value="+data['inspected_by']+"]").attr('selected','selected');
                $('#iardate').val(data['date']);
                $("#iartype").val('edit');
                $("#iarref").val(data['ref_no']);
            
          });
        }
         

        //$('#modaldemo1').modal('show');
        openNav();

    })



    $(document).on("click", '.view', function(){
        //if($(this).data(''))
$('#tbpolines').empty();
$('.total').val($(this).data('total'));
$('#poid').val($(this).data('id'));

var status = $(this).data('status');
console.log(status)
if(status != 'FOR ORS/BURS'){
   $('#orsform').hide();
}



 var a=1;
        $.get("{{route('getpolist')}}",
        {
           _token: document.getElementById('token').value,
            id: $(this).data('id')
        },
         function(data,status){
          var tr='';
         
           if(status == 'success'){
             data.forEach(function(key){
                tr +=  '<tr>'+
                       '<td class="wd-10p">'+key.no+'</td>'+
                       '<td class="wd-10p">'+key.name+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][qty]" value='+key.qty+'>'+key.qty+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][unit]" value='+key.unit+'>'+key.unit+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][unit_cost]" value='+key.unit_cost+'>'+key.unit_cost+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][total_cost]" value='+key.total_cost+'>'+key.total_cost+'</td></tr>';
                 a++;
               });
             
            $('#tbpolines').append(tr);

            $('#groupdemo').modal('show');
           }
      });
    });



    $(document).on("click", '.stockin', function(){
      
      $('.name').text($(this).data('name'));
      $('#id').val($(this).data('prno'));
      $('#iacid').val($(this).data('iarno'))

      $('#master').val($(this).data('master'))
      $('.master').val($(this).data('acc'))
       $.get("{{route('getpolist')}}",
        {


           _token: document.getElementById('token').value,
            id: $(this).data('id')
        },
        function(data,status){
          if(status == 'success'){
            var tr = '';
            var a = 1;
            var table = document.getElementById('polines');
             data.forEach(function(k3){
                tr += 
                       '<div class="row pd-x-30"><div class="col-lg-2 pd-y-10 wd-15p"><input type="hidden" class name="items['+a+'][id]" value='+k3.no+'>'+k3.no+'</div>'+
                       '<div class="col-lg-2 pd-y-10 wd-15p">'+k3.name+'</div>'+
                       '<div class="col-lg-2 pd-y-10 wd-15p"><input type="text"  class="form-control qty" data-tc='+k3.total_cost+' data-uc='+k3.unit_cost+' name="items['+a+'][qty]" value='+k3.qty+'><h6 class="noshow">Enter Quantity as</h6></div>'+
                       '<div class="col-lg-2 pd-y-10 wd-15p"><input type="text" style="width: 100%" class="unit" data-unit="'+k3.unit+'" name="items['+a+'][unit]" value='+k3.unit+'></div>'+
                       '<div class="col-lg-2 pd-y-10 wd-15p"><input type="text" class="form-control cost" name="items['+a+'][unit_cost]" value='+k3.unit_cost+'></div>'+
                       '<div class="col-lg-2 pd-y-10 wd-15p"><input type="text" class=" form-control total" name="items['+a+'][total_cost]" value='+k3.total_cost+'></div></div>';
                        a++;
               });
            
            table.innerHTML = tr;

            $('#modaldemo1').modal('show');
          
          //console.log(array)
             $( ".unit" ).autocomplete({
                source: array,
                select: function (e, ui) {
                    var no = ui.item.value;
                    var type1 = '';
                    var type2 = '';
                    var td = $(this);
                    var unit = $(this).data('unit');
                    units.forEach(function(key){
                      if(no == key.name){
                        type1 = key.type;
                      }
                      if(unit == key.name){
                        type2 = key.type; 
                      }
                    });
                    console.log(type1+' '+type2)
                    if(type1 == 'piece' && type2 == 'bundle'){
                      console.log(no);
                      var cost = td.closest("div").next().find('.cost').val();
                      td.closest("div").prev().find('.qty').focus();
                      td.closest("div").prev().find('h6').toggleClass("noshow");
                      td.closest("div").prev().find('.qty').removeAttr("readonly");
                      td.closest("div").prev().find('.qty').attr('data-stat', 'piece');
                      td.closest("div").prev().find('h6').text("Enter Quantity as "+no);

                     
                    }
                    else{
                      td.closest("div").prev().find('h6').text("");
                      td.closest("div").prev().find('.qty').attr("readonly", "true");
                    }


                }
              });

              $( ".unit" ).autocomplete( "option", "appendTo", ".eventInsForm" );
          }
        });


        
        
    });

$(document).on("click", '.editpo', function(){
$('#prlines2').empty();
$('#poid').val($(this).data('id'));
$('#podate').val($(this).data('date'));
$('#refno').val($(this).data('name'));
$('#gtotal').val($(this).data('amount'));
$('.suppliers option[value='+$(this).data('supp')+']') .attr('selected','selected');
$('#procmode option[value='+$(this).data('procmode')+']') .attr('selected','selected');
$("#gamountwords").val(inWords(parseFloat($(this).data('amount')))+" pesos only")

        $.get("{{route('getpolist')}}",
        {
           _token: document.getElementById('token').value,
            id: $(this).data('id')
        },
         function(data,status){
          console.log(data)
          var tr='';
          var a=1;
           if(status == 'success'){
             data.forEach(function(key){
                tr +=  '<tr>'+
                       '<td class="wd-10p tx-center"><input type="hidden" name="items['+a+'][id]" value='+key.id+'>'+key.no+'</td>'+
                       '<td class="wd-10p tx-center">'+key.name+'</td>'+
                       '<td class="wd-10p tx-center"><input type="text" class="qtys" name="items['+a+'][qty]" value='+key.qty+'></td>'+
                       '<td class="wd-10p tx-center"><input type="hidden" class="unit" name="items['+a+'][unit]" value='+key.unit+'>'+key.unit+'</td>'+
                       '<td class="wd-10p tx-center"><input type="text" class="cost" name="items['+a+'][unit_cost]" value='+key.unit_cost+'></td>'+
                       '<td class="wd-10p tx-center"><input type="text" class="total" readonly name="items['+a+'][total_cost]" value='+key.total_cost+'></td></tr>';
                a++;
               });
           
            $('#prlines2').append(tr);

           
           }
      });

  openNav2();
})

    
$(document).on("change", '.itemchk', function(){
  gettotald();
})

$(document).on('keyup', '.qtys', function(){
  
    var cost = $(this).closest("td").next().next().find('.cost').val();
    var qty = $(this).val();
    var total = cost * qty;
    //console.log(total)
    $(this).closest("td").next().next().next().find('.total').val(total.toFixed(2))
    gettotal();
  
});
$(document).on('keyup', '.qty', function(){

  var td = $(this);
  var unitcost = $(this).data('tc');
    console.log($(this).data('stat'));
  if($(this).data('stat') ==  'piece'){
   
     var cost = td.closest("div").next().next().find('.cost').val();
     var qty = $(this).val();
     var uc = (unitcost/qty).toFixed(2);
     var td = $(this);
      td.closest("div").next().next().find('.cost').val(uc);
      td.closest("div").next().next().next().find('.total').val((uc * qty).toFixed(2));
  }
  else{
    var cost = td.closest("div").next().next().find('.cost').val();
     var qty = $(this).val();
     var uc = (cost/qty).toFixed(2);
     var td = $(this);
      td.closest("div").next().next().find('.cost').val(uc);
      td.closest("div").next().next().next().find('.total').val(uc * qty);
  }

});
function gettotald(){
  var total=0;
  $(".itemchk:checkbox:checked").each(function() {
      total += parseFloat($(this).data('amount'));
    });

    $('#total').val(total.toFixed(2));

    $("#gamountwords").val(inWords(total)+"pesos only")

}
function gettotal(){
  var total=0;
  $(".total").each(function() {
    console.log($(this).val())
      if($(this).val() != ''){

        total += parseFloat($(this).val());
      }
    });
    $('#total').val(total.toFixed(2));
$("#amountwords").val(inWords(total)+"pesos only")
}
});


</script>
@endsection