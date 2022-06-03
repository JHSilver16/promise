@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <a class="breadcrumb-item" href="">Products</a>
          <span class="breadcrumb-item active">Add New Product</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Add New Item</h6>
       
    <form action="{{route('submitprop')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="">
       <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
       <input type="hidden" name="id" id="id">
       <input type="hidden" name="type" id="type" value="save">
         <div class="row">
            <div class="col-md-12"></div>
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
                <div class="col-md-2 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Item No: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 itemno"  type="text" name="itemno" id="itemno"  placeholder="Item No" />
                  </div>
                </div><!-- col-4 -->
                 <div class="col-md-2 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Item Type: <span class="tx-danger">*</span></label>
                    <select class="form-control select2-show-search " name="itemtype" id="itemtype" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                      <option value="prop">Property</option>
                      <option value="equip">Equipment</option>
                    </select>
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-2 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">ICS/PAR No: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 refno"  type="text" name="refno" id="refno"  placeholder="Item No" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-2 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">ICS/PAR Date: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 date"  type="text" name="dateform" id="dateform"  placeholder="Item No" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-2 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Entity: <span class="tx-danger">*</span></label>
                     <select class="form-control" name="entity" style="width: 100%"  tabindex="-1" aria-hidden="true">
                        @foreach($mas as $cl)
                          <option value="{{$cl->name}}">{{$cl->name}}</option>
                        @endforeach
                      </select>
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-2 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Fund Cluster: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 fc"  type="text" name="fc" id="fc"  placeholder="Item No" />
                  </div>
                </div><!-- col-4 -->
                 <div class="col-md-12 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Item Description: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 item"  type="text" name="item" id="item"  placeholder="Item Description" />
                  </div>
                </div><!-- col-4 -->
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
                 <div class="col-md-2 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Serial No: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 serial"  type="text" name="serial" id="serial"  placeholder="Serial No" />
                  </div>
                </div><!-- col-4 -->
                 <div class="col-md-2 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Model: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 model"  type="text" name="model" id="model"  placeholder="Model" />
                  </div>
                </div><!-- col-4 -->
                 <div class="col-md-2 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Color: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 color"  type="text" name="color" id="color"  placeholder="Color" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-2 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Size: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 size"  type="text" name="size" id="size"  placeholder="Size" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-2 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Amount: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16"  type="text" name="amount" id="amount"  placeholder="Amount" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-2 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Unit: <span class="tx-danger">*</span></label>
                    <select class="form-control select2-show-search " name="unit" id="unit" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                   @foreach($units as $unit)
                        <option value="{{$unit->id}}" >{{$unit->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-3 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Date Acquired: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 date"  type="text" name="date" id="date"  placeholder="Date Acquired" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-3 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label" id="lbltxt">Status: <span class="tx-danger">*</span></label>
                    <input class="form-control tx-16 status"  type="text" name="status" id="status"  placeholder="Item Status" />
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-3 mg-t--1 mg-md-t-0 pno">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label">Item Category: <span class="tx-danger">*</span></label>
                    <select class="form-control select2-show-search " name="category" id="category" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                   @foreach($categories as $cat)
                        <option value="{{$cat->id}}" >{{$cat->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3 mg-t--1 mg-md-t-0 pno">
                  <div class="form-group mg-md-l--1">
                    <label class="form-control-label">Equipment/PPE Type: <span class="tx-danger">*</span></label>
                    <select class="form-control" name="eqtype" id="eqtype" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                   @foreach($types as $type)
                        <option value="{{$type->id}}" >{{$type->name}}</option>
                      @endforeach
                    </select>
                    <select class="form-control" name="ppe" id="ppe" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
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
            <div class="form-layout-footer bd pd-20 bd-t-0 ">
              <button type="submit" class="btn btn-info">Submit</button>
               <a class="btn btn-secondary" href="{{route('categories')}}">Cancel</a>
            </div><!-- form-group -->
          </div>
        
        </form>
      </div>
  </div>

   <script type="text/javascript">
    $(document).ready(function(){
      $('#eqtype').hide()
      $('#refno').val({!!json_encode($parref)!!})
  
       $('.date').datepicker({
              showOtherMonths: true,
              selectOtherMonths: true,
              changeYear: true,
               yearRange: "-4: +20",
            
            });
        $('#cost').keyup(function(){
          var price = $('#price').val();
          var cost = $('#cost').val();
          var dif =price-cost;
          var per = (dif/cost)*100;
          $('#markup').val(per);
        })
        $('#price').keyup(function(){
           var price = $('#price').val();
          var cost = $('#cost').val();
          var dif =price-cost;
          var per = (dif/cost)*100;
          $('#markup').val(per);
        })
     })

    $('#itemtype').change(function(){
      var val = $(this).val();
      if(val == 'prop'){
        $('#eqtype').hide();
        $('#ppe').show();
        $('#refno').val({!!json_encode($parref)!!})
      }
      else{
        $('#eqtype').show();
        $('#ppe').hide();
        $('#refno').val({!!json_encode($icsref)!!})
      }
    })
     
     function showinv(chk){
      if(chk.checked){
        document.querySelectorAll('.inventory').forEach(function(el) {
           el.style.display = 'block';
        });
      }
      else{
        document.querySelectorAll('.inventory').forEach(function(el) {
           el.style.display = 'none';
        });
      }
    }
   </script>
  <!-- /.box-header -->
            <!-- form start -->
            
<script>


</script>
@endsection

