@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
  <nav class="breadcrumb pd-0 mg-0 tx-12">
    <a class="breadcrumb-item" href="{{route('dashboard')}}">Home</a>
    <span class="breadcrumb-item active">Properties</span>
  </nav>
</div>
 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"><!-- br-pageheader -->
<div class="bd-y bd-gray-500 bg-light" id="employeeoptions">
  <div class="ht-md-60 wd-200 wd-md-auto pd-y-20 pd-md-y-0 d-md-flex align-items-center justify-content-center tx-poppins" >
      <ul class="nav nav-effect nav-effect-5 tx-uppercase tx-bold tx-spacing-2 flex-column flex-md-row" role="tablist">
        <li class="nav-item">
          <a href="{{route('createics')}}">
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-plus-circle tx-20"></i>
            <span class="menu-item-label">Add new Property</span>
          </div><!-- menu-item -->
        </a>
        </li>

        <li class="nav-item">
          <a href="{{route('proplist', ['type' => 'list'])}}">
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-plus-circle tx-20"></i>
            <span class="menu-item-label">Print List</span>
          </div><!-- menu-item -->
        </a>
        </li>
        <li class="nav-item">
          <a href="{{route('proplist', ['type' => 'qr'])}}">
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-plus-circle tx-20"></i>
            <span class="menu-item-label">Print List with QR</span>
          </div><!-- menu-item -->
        </a>
        </li>
      </ul>
    </div>
  </div>
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="br-pagebody">
  <div class="br-section-wrapper">
     <div class="row">
          <div class="col-md-9 d-sm-flex">
            <div class=" pd-sm-l-20">
              <h4 class="tx-gray-800 mg-b-5">List of Properties</h4>
              <p class="mg-b-0">As of</p>
            </div>
          </div>
          <div class="col-md-3 tx-right ">
            <div class="row">
              
              <div class="col-sm-4">
                <h6>With Selected |</h6>
              </div>
              <div class="col-sm-5">
                 <select class="form-control form-layout-2" id="status">
                  <option value="SERVICEABLE">SERVICEABLE</option>
                  <option value="NOT SERVICEABLE">NOT SERVICEABLE</option>
                </select>
              </div>
              <div class="col-sm-3">
                <button type="button" class="btn btn-primary btn-sm update">Update</button>
              </div>
            </div> 
          </div>
        </div>
    <div class="row pd-t-40 align-items-center" id="comps">
            
            <div class="col-md-12">
              <table class="table table-bordered" id="products">
                  <thead class="thead-colored thead-dark tx-black">
                    <tr>
                      <th class="wd-15p">Property No</th>
                      <th class="wd-15p">Description</th>
                      <th class="wd-15p">Date Acquired</th>
                      <th class="wd-15p">Unit Cost</th>
                      <th class="wd-15p">Issued By</th>
                      <th class="wd-15p">Issued To</th>
                      <th class="wd-15p">Status</th>
                      <th class="wd-15p">Item Status</th>
                      <th class="wd-15p">Equipment Type</th>
                      <th class="wd-10p">Action</th>
                    </tr>
                  </thead>
                   <tbody class="tx-inverse">
                     @foreach($pars as $par)
                       <tr>
                        <td>{{$par['property_no']}}</td>
                        <td>{{$par['brand'].' '.$par['name']}}</td>
                        <td>{{$par['date_acquired']}}</td>
                        <td>{{$par['amount']}}</td>
                        <td>{{$par['issued_by'] == 54 ? $par['issued_by_others'] : $par['issuedby']}}</td>
                        <td>{{$par['issued_to'] == 54 ? $par['issued_to_others'] : $par['issuedto']}}</td>
                        <td>{{$par['status']}}</td>
                        <td>{{$par['item_status']}}</td>
                        <td>{{$par['ppe']}}</td>
                        <td><div class="btn-group" role="group" aria-label="Basic example">
                           <div class="dropdown">
                              <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">SE Card
                              <span class="caret"></span></button>
                             <div class="dropdown-menu pd-10 wd-300">
                                <nav class="nav nav-style-2 flex-column">
                                  <a href="#" class="nav-link updatecard" data-id="{{$par['id']}}"><i class="fa fa-money-check fa-xs"></i> Update Card</a>
                                  <a href="{{route('printcard', ['id' => $par['id'], 'type'=>'par'])}}" class="nav-link"><i class="fa fa-print fa-xs"></i>Print Card</a>
                                </nav>
                              </div><!-- dropdown-menu -->
                            </div>

                           <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-plus-square fa-xs"></i> Action
                              <span class="caret"></span></button>
                             <div class="dropdown-menu pd-10 wd-300 tx-14">
                              <nav class="nav nav-style-2 flex-column">
                              @if($par['par_type'] == 'par')                                  
                                   <a href="#" class="nav-link printpar" data-id="{{$par['par_id']}}" data-issuedto="{{$par['issued_to']}}"><i class="fa fa-print fa-xs"></i>Print PAR</a>
                              @else
                                <a href="#" class="nav-link printptr" data-id="{{$par['par_id']}}" data-issuedto="{{$par['issued_to']}}"><i class="fa fa-print fa-xs"></i>Print PTR</a>
                              @endif
                                </nav>
                                <nav class="nav nav-style-2 flex-column">                                  
                                   <a href="#" class="nav-link transferprop" data-id="{{$par['id']}}" data-issuedto="{{$par['issued_to']}}"><i class="fa fa-money-check fa-xs"></i>Transfer</a>
                                                            
                                </nav>
                              </div><!-- dropdown-menu -->
                            </div>
                        </div>
                        </td>
                      </tr>
                     @endforeach
                   </tbody>
                 </table>
            </div>
      </div>
  </div>
</div>
<div id="modaldemo1" class="modal fade">
  
    <div class="modal-dialog modal-dialog-vertical-center modal-lg" style="width: 100%" role="document">
      <div class="modal-content bd-0 tx-14">
     <form action="{{route('updatepar')}}" method="POST">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold">Update Card <div id="refno"></div></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" id="id" value="">
          <div class="modal-body pd-25">
            <div class="form-layout form-layout-2">
              <div class="row no-gutters">
                <div class="col-md-4 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Brand Name: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 brand"  type="text" name="brand" id="brand"  placeholder="Brand Name" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-4 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Estimated Useful Life (Years): <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 life"  type="text" name="life" id="life"  placeholder="Estimated Useful Life (Years)" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-4 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Depreciation Rate: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 deprate"  type="text" name="deprate" id="deprate"  placeholder="Depreciation Rate" />
                  </div>
                </div><!-- col-4 -->
                 <div class="col-md-3 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Serial No: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 serial"  type="text" name="serial" id="serial"  placeholder="Serial No" />
                  </div>
                </div><!-- col-4 -->
                 <div class="col-md-3 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Model: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 model"  type="text" name="model" id="model"  placeholder="Model" />
                  </div>
                </div><!-- col-4 -->
                 <div class="col-md-3 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Color: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 color"  type="text" name="color" id="color"  placeholder="Color" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-3 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Size: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 size"  type="text" name="size" id="size"  placeholder="Size" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-4 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Date Acquired: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 date"  type="text" name="date" id="date"  placeholder="Item Status" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-4 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Status: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 status"  type="text" name="status" id="status"  placeholder="Item Status" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-4 mg-t--1 mg-md-t-0 pno">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label">PPE Type: <span class="tx-danger">*</span></label>
                    <select class="form-control select2-show-search " name="ppe" id="ppe" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                   @foreach($ppes as $ppe)
                        <option value="{{$ppe->id}}" >{{$ppe->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                  <div class="col-md-6 mg-t--1 mg-md-t-0 pno">
                    <div class="form-group mg-md-l--1">
                      <label class="form-control-label">Issued To: <span class="tx-danger">*</span></label>
                      <select class="form-control " name="issuedto" id="issuedto" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                     @foreach($employees as $emp)
                          <option value="{{$emp->id}}" >{{$emp->first_name.' '.$emp->last_name}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-md-6 mg-t--1 mg-md-t-0 pno">
                    <div class="form-group mg-md-l--1">
                      <label class="form-control-label">Issued By: <span class="tx-danger">*</span></label>
                      <select class="form-control " name="issuedby" id="issuedby" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                     @foreach($employees as $emp)
                          <option value="{{$emp->id}}" >{{$emp->first_name.' '.$emp->last_name}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
              </div>
            </div>
            </div>
         
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save Changes</button>
          <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
        </div>
        </form>
         </div>
      </div>
    </div>

    <div id="modaldemo2" class="modal fade">
  
    <div class="modal-dialog modal-dialog-vertical-center modal-lg" style="width: 100%" role="document">
      <div class="modal-content bd-0 tx-14">
     <form action="{{route('transfer')}}" method="POST">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold">TRANSFER PROPERTY <div id="refno"></div></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" id="propid" value="">
          <input type="hidden" name="type" id="type" value="par">
          <div class="modal-body pd-25">
            <div class="form-layout form-layout-2">
              <div class="row no-gutters">
                 <div class="col-md-3 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">PTR No: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 ptrno" value="{{$ref}}" readonly  type="text" name="ptrno" id="ptrno" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-3 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Date: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 date"  type="text" name="date" id="datetrans"  placeholder="Date" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-3 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Entity Name: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 entity"  type="text" name="entity" id="entity"  placeholder="Entity Name" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-3 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Fund Cluster: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 fc"  type="text" name="fc" id="fc"  placeholder="Fund Cluster" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-3 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">From Accountable Officer: <span class="tx-danger">*</span></label>
                    <select class="form-control" name="from" id="from" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
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
                <div class="col-md-3 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">To Accountable Officer: <span class="tx-danger">*</span></label>
                    <select class="form-control" name="to" id="to" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
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
              
                <div class="col-md-3 mg-t--1 mg-md-t-0 pno">
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
                <div class="col-md-3 mg-t--1 mg-md-t-0 pno">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label">Depreciated Amount: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 depamount"  type="text" name="depamount" id="depamount"  placeholder="Agency/Fund Cluster" />
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
                    <select class="form-control" name="approved" id="approved" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                        @foreach($employees as $emp)
                           <option value="{{$emp->id}}" >{{$emp->first_name.' '.$emp->last_name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-6 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Issued By: <span class="tx-danger">*</span></label>
                    <select class="form-control" name="issued" id="issued" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                        @foreach($employees as $emp)
                           <option value="{{$emp->id}}" >{{$emp->first_name.' '.$emp->last_name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div><!-- col-4 -->
              
            </div>
            </div>
         
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save Changes</button>
          <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
        </div>
        </form>
         </div>
      </div>
    </div>

<script type="text/javascript">
  $(function(){
    $('#others').hide();
    $('#transentity').hide();
    $('#fromentity').hide();
    $('.date').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      numberOfMonths: 1
    });
        'use strict';
$(document).on('click', '.printpar', function(){
      window.location.href = '{{route ("printpar", ["id" => ''] )}}'+'/'+$(this).data('id')
    })
$(document).on('click', '.printptr', function(){
      window.location.href = '{{route ("printptr", ["id" => ''] )}}'+'/'+$(this).data('id')
    })
        $('#products').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
          }
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
        $('#from').on('change', function(){
            var id = $(this).val();
            if(id == 54){
              $('#fromentity').show();
            }
            else{
              $('#fromentity').hide();
            }
        });
        $(document).on('click', '.updatecard', function(){
        
            $('#modaldemo1').modal('show');

            $.get("{{route('getpar')}}",
            {
               _token: document.getElementById('token').value,
                id: $(this).data('id')
            },
             function(data,status){
              //console.log(data);
                $('#id').val(data.id);
                $('.brand').val(data.brand);
                $('.life').val(data.life);
                $('.status').val(data.item_status);
                $('.deprate').val(data.deprate);
                $('.color').val(data.color);
                $('.size').val(data.size);
                $('.model').val(data.model);
                $('.serial').val(data.serial);
                $('#issuedto').val(data.issued_to);
                $('#issuedby').val(data.issued_by);
                $('.date').val(data.date_acquired);
                $('.ppe').val(data.ppe);

             })
        });

        $(document).on('click', '.transferprop', function(){
        
              $('#modaldemo2').modal('show');

              $('#propid').val($(this).data('id'));
              $('#from').val($(this).data('issuedto'));
        });
    });


</script>
@endsection