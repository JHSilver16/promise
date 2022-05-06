@extends('layouts.staff')

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

     <div class="d-sm-flex align-items-center pd-t-10">
        <i class="fas fa-credit-card tx-50 lh-0 tx-gray-800"></i>
        <div class="pd-sm-l-20">
          <h4 class="tx-gray-800 mg-b-5">List of Item Requests</h4>
          <p class="mg-b-0">As of</p>
        </div>
      </div><!-- d-flex -->

<hr>
      <form action="{{route('requestitem')}}" method="POST" data-parsley-validate="">
       <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" id="id" value="{{ csrf_token() }}">
         <input type="hidden" name="type" id="type" value="save">
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Item Name: <span class="tx-danger">*</span></label>
                  <div class="autocomplete">
                    <input type="text" name="items[1][name]" class="form-control" id="itemsforsearch" placeholder="Description" required="">
                 </div>
                </div>
              </div>
             <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                 <input type="text" name="items[1][qty]" class="form-control" id="qty" placeholder="Quantity" required="">
                </div>
              </div>
               <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Purpose: <span class="tx-danger">*</span></label>
                 <input type="text" name="reason" class="form-control" id="agv" placeholder="Purpose" required="">
                </div>
              </div>
              
               <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <button type="submit" class="btn btn-info submit">Submit</button>
               <button type="button" class="btn btn-secondary cancel">Cancel</button>
                </div>
              </div>
            </div><!-- row -->
          </div>
        </form>

    <div class="row pd-t-40 align-items-center" id="comps">
            
            <div class="col-md-12">
              <table class="table table-bordered" id="products">
                  <thead>
                  <tr class="tx-10">
                    <th class="pd-y-5">Item</th>
                    <th class="pd-y-5">Qty</th>
                    <th class="pd-y-5">Reason</th>
                    <th class="pd-y-5">Date</th>
                    <th class="pd-y-5">Status</th>
                  </tr>
                </thead>
                   <tbody class="tx-inverse">
                     @foreach($reqs as $pr)
                       <tr>
                        <td>{{$pr['item']}}</td>
                        <td>{{$pr['qty']}}</td>
                        <td>{{$pr['reason']}}</td>
                        <td>{{$pr['created_at']}}</td>
                        <td>{{$pr['status']}}</td>
                      
                      </tr>
                     @endforeach
                   </tbody>
                 </table>
            </div>
  </div>
</div>

<div id="modaldemo1" class="modal fade">
    <div class="modal-dialog modal-dialog-vertical-center modal-lg" style="width: 100%" role="document">
      <div class="modal-content bd-0 tx-14">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold">Create PO</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" id="id" value="">
        <div class="modal-body pd-25 wd-500">
          <h4 class="lh-3 mg-b-20 name tx-uppercase tx-b tx-bold"></h4>
          <div class="row">
            <div class="col-md-3">Set Number of POs</div>
            <div class="col-md-6"><input type="number" name="qty" id="poqty" class="form-control" required></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary submitpo tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save changes</button>
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
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold">List of Items</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pd-25">
          <h4 class="lh-3 mg-b-20 name tx-uppercase tx-b tx-bold"></h4>
          <table class="table">
                <thead class="thead-colored thead-dark">
                  <tr>
                    <th class="wd-15p">Stock No.</th>
                    <th class="wd-15p">Item</th>
                    <th class="wd-15p">Requested Quantity</th>
                    <th class="wd-15p">Unit</th>
                    <th class="wd-15p">Issued Quantity</th>
                    <th class="wd-15p">Remarks</th>
                  </tr>
                </thead>
                <tbody id="rislines" class="tx-inverse"></tbody>
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
          <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save changes</button>
          <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
   <!-- modal-dialog -->
  </div><!-- modal -->


<script type="text/javascript">

  var items = {!!json_encode($items)!!};
  
  var array = [];
  var unitsarr = [];

  items.forEach(function(key){

  
         array.push({
            'code': key.id,
            'name': key.id+'-'+key.name,
            'cost': key.unit_cost,
            'unit': key.unit
         })
    
  });
//console.log(array);
  $(document).ready(function() {
    autocomplete("#itemsforsearch", array);
     //autocomplete(".units", unitsarr);
    //$('.danger').hide();
});
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
      window.location.href = '{{route ("editpr", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

 $(document).on('click', '.print', function(){
      window.location.href = '{{route ("ris", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

$('.date').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true,
  numberOfMonths: 2
});
});
</script>
@endsection