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
       
    <form action="{{route('submititem')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="">
       <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
       <input type="hidden" name="id" id="id">
       <input type="hidden" name="type" id="type" value="save">
         <div class="row">
            <div class="col-md-3">
              <div class="form-layout form-layout-2">
                <div class="form-group mg-md-l--1">
                    <div class="row no-gutters">
                      <div class="col-md-12">
                   <svg class="barcode wd-100p"
                      jsbarcode-format="CODE39"
                      jsbarcode-value="{{$po}}"
                      jsbarcode-textmargin="10"
                      jsbarcode-fontoptions="bold">
                    </svg>

                 </div>
                 </div>
               </div>
               </div>
            </div>
            <div class="col-md-9">
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-12 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Stock No: <span class="tx-danger">*</span></label>
                    <input type="text" class="form-control" name="code" required="" readonly="" value="{{$po}}">
                </div>
              </div>
             
              <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                     <input type="text" class="form-control" placeholder="Name" required="" name="name">
                </div>
              </div><!-- col-4 -->
             <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                   <input type="text" class="form-control" required="" placeholder="Description" name="desc">
                </div>
              </div>
              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" style="width: 100%;" name="typeid">
                        @foreach($categories as $pt)
                          <option value="{{$pt->id}}">{{$pt->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Unit Cost: <span class="tx-danger">*</span></label>
                     <input type="number" step=".01" class="form-control" required="" placeholder="Unit Cost" name="cost" id="cost">
                </div>
              </div>
               <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Purchase Unit: <span class="tx-danger">*</span></label>
                     <select class="form-control select2" style="width: 100%;" name="unittype">
                        @foreach($units as $pt)
                          <option value="{{$pt->id}}">{{$pt->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              
              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label"><span class="tx-danger">*</span></label>
                     <label class="ckbox">
                      <input type="checkbox" id="addinv" name="inv" onchange="showinv(this)">
                      <span>Add to inventory?</span>
                    </label>
                </div>
              </div>
              <div class="col-md-12 inventory mg-t--1 mg-md-t-0" style="display: none;">
                <div class="form-group mg-md-l--1">
                  <table class="table table-bordered">
                    <thead>
                      <th>Account</th>
                      <th>Quantity</th>
                      <th>Unit Cost</th>
                      <th>Inventory Unit</th>
                    </thead>
                    <tbody>
                      @foreach($master as $m)
                        <tr>
                          <td>{{$m['name']}}<input type="hidden" step=".01" class="form-control"  value="{{$m['id']}}" placeholder="Quantity" name="invs[{{$m['id']}}][id]" id="cost"></td>
                          <td><input type="number" step=".01" class="form-control"  placeholder="Quantity" name="invs[{{$m['id']}}][qty]" id="cost"></td>
                          <td><input type="number" step=".01" class="form-control"  placeholder="Unit Cost" name="invs[{{$m['id']}}][cost]" id="cost"></td>
                          <td>
                            <select class="form-control select2" style="width: 100%;" name="invs[{{$m['id']}}][unittype]">
                                @foreach($units as $pt)
                                  <option value="{{$pt->name}}">{{$pt->name}}</option>
                                @endforeach
                            </select>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0 ">
              <button type="submit" class="btn btn-info">Submit</button>
               <a class="btn btn-secondary" href="{{route('categories')}}">Cancel</a>
            </div><!-- form-group -->
          </div>
        </div>
        </form>
      </div>
  </div>

   <script type="text/javascript">
    $(document).ready(function(){
     JsBarcode(".barcode").init();
       $('.fc-datepicker').datepicker({
              showOtherMonths: true,
              selectOtherMonths: true,
              changeYear: true,
               yearRange: "-0: +20",
            
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

