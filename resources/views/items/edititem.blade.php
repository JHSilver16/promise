@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <a class="breadcrumb-item" href="">Products</a>
          <span class="breadcrumb-item active">Add New Item</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Edit Item</h6>
       
           <form action="{{route('submititem')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="">
               <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
               <input type="hidden" name="id" id="daysleft" value="{{$item->id}}">
               <input type="hidden" name="type" id="type" value="edit">
              <div class="row">
            <div class="col-md-3">
               <div class="form-layout form-layout-2">
                <div class="form-group mg-md-l--1">
                    <div class="row no-gutters">
                      <div class="col-md-12">
                   <svg class="barcode wd-100p"
                      jsbarcode-value="{{$item->id}}"
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
                    <div class="row no-gutters bd">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group mg-md-l--1">
                          <label class="form-control-label">Stock No: <span class="tx-danger">*</span></label>
                            <input type="text" class="form-control" name="code" required readonly="" id="stock" value="{{$item->id}}">
                        </div>
                      </div>
                     
                      <div class="col-md-6 mg-t--1 mg-md-t-0">
                        <div class="form-group mg-md-l--1">
                          <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                             <input type="text" class="form-control" name="name" required value="{{$item->name}}">
                        </div>
                      </div><!-- col-4 -->
                     <div class="col-md-6 mg-t--1 mg-md-t-0">
                        <div class="form-group mg-md-l--1">
                          <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                           <input type="text" class="form-control" name="desc" required value="{{$item->description}}">
                        </div>
                      </div>
                      <div class="col-md-3 mg-t--1 mg-md-t-0">
                        <div class="form-group mg-md-l--1">
                          <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="typeid">
                                @foreach($category as $pt)
                                  <option value="{{$pt->id}}" {{ ( $pt->id == $item->category_id) ? 'selected' : '' }}>{{$pt->name}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="col-md-3 mg-t--1 mg-md-t-0">
                        <div class="form-group mg-md-l--1">
                          <label class="form-control-label">Cost: <span class="tx-danger">*</span></label>
                             <input type="number" step=".01" value="{{$item->unit_cost}}" required class="form-control" name="cost" id="cost">
                        </div>
                      </div>

                      <div class="col-md-3 mg-t--1 mg-md-t-0">
                        <div class="form-group mg-md-l--1">
                          <label class="form-control-label">Purchase Unit: <span class="tx-danger">*</span></label>
                             <select class="form-control select2" style="width: 100%;" name="unittype">
                                @foreach($units as $pt)
                                  <option value="{{$pt->id}}" {{$pt->id == $item->purchase_unit ? 'selected': ''}}>{{$pt->name}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                      
                      @if(count((array)$inv) > 0)
                       <div class="col-md-3 mg-t--1 mg-md-t-0">
                        <div class="form-group mg-md-l--1">
                          <label class="form-control-label"><span class="tx-danger">*</span></label>
                             <label class="ckbox">
                              <input type="checkbox" id="addinv" name="inv" onchange="showinv(this)">
                              <span>Add to inventory?</span>
                            </label>
                        </div>
                      </div>
                      @endif
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
                                <td>{{$m['name']}}<input type="hidden" step=".01" class="form-control" value="{{$m['id']}}" placeholder="Quantity" name="invs[{{$m['id']}}][id]" id="cost"></td>
                                <td><input type="number" step=".01" class="form-control" placeholder="Quantity" name="invs[{{$m['id']}}][qty]" id="cost"></td>
                                <td><input type="number" step=".01" class="form-control" placeholder="Unit Cost" name="invs[{{$m['id']}}][cost]" id="cost"></td>
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
                   
                 </div>
                  <div class="form-layout-footer bd pd-20 bd-t-0 ">
                      <button type="submit" class="btn btn-info">Submit</button>
                       <a class="btn btn-secondary" href="">Cancel</a>
                    </div><!-- form-group -->
               </div>

              
                </div>
            </form>
      </div>
  </div>

   <script type="text/javascript">
    JsBarcode(".barcode").init();
    $(document).ready(function(){
    
       $('#expirydate').datepicker({
              showOtherMonths: true,
              selectOtherMonths: true,
              changeYear: true,
               yearRange: "-1: +10",
            
            });
            
            $('#manudate').datepicker({
              showOtherMonths: true,
              selectOtherMonths: true,
              changeYear: true,
               yearRange: "-1: +10",
            
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
   </script>
  <!-- /.box-header -->
            <!-- form start -->
            
<script>
 $(document).ready(function(){
    $(document).on({
    ajaxStart: function() { $('#modaldemo4').modal('show') },
     ajaxStop: function() { $('#modaldemo4').modal('hide') }    
});
     $('#prodgroups').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
          }
        });

$('#data tr').css( 'cursor', 'pointer' );
    $('#data tr').click(function(){
      console.log($(this).data('price'))
      var id = this.cells[0];  // the first <td>
      var qty = this.cells[1];
      var unit = this.cells[2];
      var price = this.cells[3];
      $('#name').val($(name).text());
      $('#pg_id').val($(id).text());
      $('#qty').val($(qty).text());
      $('#qty').attr('data-price', $(this).data('price'));
      $('#unit').val($(unit).text());
      $('#prodprice').val($(price).text());
      $('.submit').text('Edit');
      $('.submit').removeClass('btn-info');
      $('.submit').addClass('btn-success');
    })
  })

 $('#generate').click(function(){
  JsBarcode("#barcode", $('#stock').val(), {
    lineColor: "#000",
    width: 4,
    height: 40,
    displayValue: false
  });
 })

$(document).on('keyup', '#qty', function(){
      var qty = parseFloat($(this).val());
      var price = parseFloat($('#price').val());
      $('#prodprice').val(qty*price);
    })

  $('.cancel').click(function(){
     $('.submit').text('Submit');
     $('.submit').removeClass('btn-success');
     $('.submit').addClass('btn-info');

      $('input').val("");
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
@endsection

