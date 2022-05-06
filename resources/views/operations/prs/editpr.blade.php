@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <span class="breadcrumb-item active">Settings</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Add Purchase Request</h6>
          <hr/>

              <form action="{{route('submitpr')}}" method="POST" data-parsley-validate="">
                 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                  <input type="hidden" name="id" id="id" value="{{$pr->id}}">
                   <input type="hidden" name="type" id="type" value="edit">
                  <div class="form-layout form-layout-2">
                      <div class="row no-gutters">
                          
                        <div class="col-md-3 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">PR No: <span class="tx-danger">*</span></label>
                           <input type="text" name="no" class="form-control" value="{{$pr->ref_no}}" readonly="" id="prno" placeholder="Purchase Request Number">
                          </div>
                        </div>
                        <div class="col-md-3 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">Entity: <span class="tx-danger">*</span></label>
                           <input type="text" name="entity" class="form-control" value="{{$pr->entity}}" readonly="" id="entity" placeholder="Account Code">
                          </div>
                        </div>
                         <div class="col-md-3 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">Fund Cluster: <span class="tx-danger">*</span></label>
                           <input type="text" name="fc" class="form-control" value="{{$pr->fund_cluster}}" readonly="" id="entity" placeholder="Account Code">
                          </div>
                        </div>
                         <div class="col-md-3 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">Date: <span class="tx-danger">*</span></label>
                           <input type="text" class="form-control date" name="date" required="" value="{{$pr->date}}" placeholder="MM/DD/YYYY">
                          </div>
                        </div>
                        <div class="col-md-10 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">Purpose: <span class="tx-danger">*</span></label>
                           <input type="text" name="purpose" class="form-control" value="{{$pr->purpose}}"   required=""  id="prno" placeholder="Purpose of purhcase request">
                          </div>
                        </div>
                        <div class="col-md-2 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">Within PPMP: <span class="tx-danger">*</span></label>
                           <label class="rdiobox">
                               <input name="rdio" type="radio" value="true" {{$pr->within_ppmp == true ? 'checked' : ''}}>
                              <span>Within {{Carbon\Carbon::now()->year.' PPMP'}}</span>
                            </label>
                            <label class="rdiobox">
                              <input name="rdio" type="radio" value="false" {{$pr->within_ppmp == false ? 'checked' : ''}}>
                              <span>Not Within {{Carbon\Carbon::now()->year.' PPMP'}}</span>
                            </label>
                          </div>
                        </div>
                      </div><!-- row -->
                    </div>
                 

        <br>
        <button class="btn btn-info btn-sm add" type="button">Add New Row</button>

        <div class="table-wrapper pd-t-20">
  
            <table id="lines" class="table display responsive table-bordered nowrap tx-inverse tx-semibold tx-uppercase" style="width: 100%">
              <thead class="thead-colored thead-dark">
                <tr>
                  <th class="wd-15p">STOCK NO</th>
                  <th class="wd-15p">UNIT</th>
                  <th class="wd-20p">ITEM</th>
                  <th class="wd-15p">QUANTITY</th>
                  <th class="wd-15p">UNIT COST</th>
                  <th class="wd-15p">TOTAL COST</th>
                  <th class="wd-15p">ACTION</th>
                </tr>
              </thead>
              <tbody>
                @foreach($prlines as $prl)
                <tr>
                  <td>
                    <input type="hidden" class="form-control id" readonly="" value="{{$prl->id}}" name="items[{{$prl->id}}][id]">
                    <input type="text" class="form-control stock" readonly="" value="{{$prl->stock}}" name="items[{{$prl->id}}][stock]">
                  </td>
                  <td>
                    <div class="autocomplete">
                      <input type="text" class="form-control units" value="{{$prl->unit}}"  name="items[{{$prl->id}}][unit]">
                    </div>
                  </td>
                  <td>
                    <div class="autocomplete">
                      <input class="form-control items" autofocus value="{{$prl->name}}" placeholder="Item Description">
                    </div>
                  </td>
                  <td>
                    <input type="text" class="form-control qty" value="{{$prl->qty}}"  name="items[{{$prl->id}}][qty]">
                  </td>
                  <td>
                    <input type="number" step=".01" class="form-control cost" value="{{$prl->unit_cost}}"  name="items[{{$prl->id}}][cost]">
                  </td>
                  <td>
                    <input type="number" step=".01" class="form-control total" value="{{$prl->total_cost}}" onkeydown="isKeyPressed(event)"  name="items[{{$prl->id}}][total]">
                  </td>
                   <td>
                    <button type="button" class="btn btn-danger btn-sm delete">Remove</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4"></td>
                  <td>Total</td>
                  <td><input type="text" class="form-control" readonly="" value="{{$pr->total_amount}}" name="total" id="total"></input><br/>
                   <span class="tx-danger danger pd-l-20 tx-bold">Not Balance!</span></td>
                 
                </tr>
              </tfoot>
            </table>
          </div>
          <hr/>
      <button type="submit" class="btn btn-primary btn-lg submit" id="load">Submit Purchase Request</button>
       
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
  var items = {!!json_encode($items)!!};
  var units = {!!json_encode($units)!!};
  console.log(items);
  var array = [];
  var unitsarr = [];
  items.forEach(function(key){
     array.push({
        'code': key.id,
        'name': key.id+'-'+key.name,
        'cost': key.unit_cost,
        'unit': key.unit
     })
  })

  units.forEach(function(key){
     unitsarr.push({
        'id': key.id,
        'name': key.name,
     })
  })
  //console.log(array)
  $(document).ready(function() {
    autocomplete(".items", array);
     //autocomplete(".units", unitsarr);
    $('.danger').hide();
});
$('.date').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true,
  numberOfMonths: 2
});
$('body').on('DOMNodeInserted', 'select', function () {
    $(this).select2();
   
});
var row = document.getElementById("lines").rows.length;
  function isKeyPressed(event) {  
     autocomplete(".items", array);
  var x = document.getElementById("demo");
  if (event.keyCode == 9) {
//console.log(row);
     var html =  '<tr>'+
                  '<td>'+
                    '<input type="text" class="form-control stock" readonly="" name="items['+row+'][stock]">'+
                  '</td>'+
                  '<td>'+
                  ' <div class="autocomplete">'+
                    '<input type="text" class="form-control units" name="items['+row+'][unit]">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                   ' <div class="autocomplete">'+
                          '<input class="form-control items" autofocus placeholder="Item Description">'+
                        '</div>'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" class="form-control qty" name="items['+row+'][qty]">'+
                  '</td>'+
                  '<td>'+
                    '<input type="number" step=".01" class="form-control cost" name="items['+row+'][cost]">'+
                  '</td>'+
                  '<td>'+
                    '<input type="number" step=".01" class="form-control total" onkeydown="isKeyPressed(event)" name="items['+row+'][total]">'+
                  '</td>'+
                  '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm delete">Remove</button>'+
                  '</td>'+
                '</tr>';
      
    $('.table').append(html);
    row++;
   autocomplete(".items", array);

  } else {
   
  }
}


   var sites = {!! json_encode($items->toArray()) !!};
   //console.log(vouchers);
$('.add').click(function(){
  autocomplete(".items", array);
     var html =  '<tr>'+
                  '<td>'+
                    '<input type="text" class="form-control stock" readonly="" name="items['+row+'][stock]">'+
                  '</td>'+
                  '<td>'+
                  ' <div class="autocomplete">'+
                    '<input type="text" class="form-control units" name="items['+row+'][unit]">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                   ' <div class="autocomplete">'+
                          '<input class="form-control items" autofocus placeholder="Item Description">'+
                        '</div>'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" class="form-control qty" name="items['+row+'][qty]">'+
                  '</td>'+
                  '<td>'+
                    '<input type="number" step=".01" class="form-control cost" name="items['+row+'][cost]">'+
                  '</td>'+
                  '<td>'+
                    '<input type="number" step=".01" class="form-control total" onkeydown="isKeyPressed(event)" name="items['+row+'][total]">'+
                  '</td>'+
                  '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm delete">Remove</button>'+
                  '</td>'+
                '</tr>';
      
    $('.table').append(html);
    row++;
   autocomplete(".items", array);
})
  $(document).on('click', '.delete', function () { // <-- changes
             $(this).closest('tr').remove();
             
             gettotald();
             return false;
         });  
function getLastDigits(s) {
    return s.replace(/\b0+/g, "");
}
 $('form').submit(function(){
    $('.submit').html('<i class="fas fa-spinner fa-spin"></i> Processing');
    $('.submit').prop('disabled', true);
 });


$(document).on('change', '.account', function(){
  //console.log($(this).data('code'));
  $(this).closest("td").prev().prev().find('.glcode').val($(this).val());
});

$(document).on('keyup', '.qty', function(){
  var cost = $(this).closest("td").next().find('.cost').val();
  var qty = $(this).val();
  var total = cost * qty;
  console.log(total)
  $(this).closest("td").next().next().find('.total').val(total.toFixed(2))
  gettotald();
  
  
});

function gettotald(){
  var total=0;
  $(".total").each(function() {
      if($(this).val() != ''){

        total += parseFloat($(this).val());
      }
    });
    $('#total').val(total.toFixed(2));
    
}

function gettotalc(){
  var total=0;
  $(".credit").each(function() {
       if($(this).val() != ''){
        total += parseFloat($(this).val());
      }
    });
    $('#credit').text(total.toFixed(2));
    var deb = parseFloat( $('#debit').text());
    var cred = parseFloat( $('#credit').text());
    if(deb != cred){
      $('.danger').show();
      $('.submit').prop('disabled', true);
    }
    else if(deb == cred){
       $('.danger').hide();
      $('.submit').prop('disabled', false);
    }
}

$(document).on('keyup', '.debit', function(){
  gettotald();
})

$(document).on('keyup', '.credit', function(){
  gettotalc();
})


</script>
@endsection

