@extends('layouts.staff')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./index.html">Home</a>
          <span class="breadcrumb-item active">Settings</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Requisition and Issue Slip</h6>
          <hr/>

              <form action="{{route('submitrisstaff')}}" method="POST" data-parsley-validate="">
                 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                  <input type="hidden" name="id" id="id" value="{{$ris->id}}">
                  <input type="hidden" name="type" id="type" value="edit">
                  <div class="form-layout form-layout-2">
                      <div class="row no-gutters">
                          
                        <div class="col-md-3 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">RIS No: <span class="tx-danger">*</span></label>
                           <input type="text" name="no" class="form-control" value="{{$ris->ref_no}}" readonly="" id="prno" placeholder="Purchase Request Number">
                          </div>
                        </div>
                        <div class="col-md-3 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">Entity: <span class="tx-danger">*</span></label>
                            <input type="text" name="entity" class="form-control" value="NEDA XII" readonly="" id="entity" placeholder="Account Code">
                          </div>
                        </div>
                         <div class="col-md-3 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">Fund Cluster: <span class="tx-danger">*</span></label>
                           <input type="text" name="fc" class="form-control" value="{{$ris->fund_cluster}}" readonly="" id="entity" placeholder="Account Code">
                          </div>
                        </div>
                         <div class="col-md-3 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">Date: <span class="tx-danger">*</span></label>
                           <input type="text" class="form-control" required="" name="date" value="{{$ris->date}}" readonly="" placeholder="MM/DD/YYYY">
                          </div>
                        </div>                        
                        <div class="col-md-2 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">Request for: <span class="tx-danger">*</span></label>
                            <select class="form-control select2-show-search employees" name="master" id="master" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                             @foreach($accounts as $acc)
                              <option value="{{$acc->id}}">{{$acc->name}}</option>
                            @endforeach
                          </select>
                          </div>
                        </div>
                        <div class="col-md-10 mg-t--1 mg-md-t-0">
                          <div class="form-group mg-md-l--1">
                            <label class="form-control-label vlabel">Purpose: <span class="tx-danger">*</span></label>
                           <input type="text" name="purpose" class="form-control" required="" value="{{$ris->purpose}}"  id="prno" placeholder="Purpose of Requisition">
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
                  <th class="wd-10p">STOCK NO</th>
                  <th class="wd-15p">UNIT</th>
                  <th class="wd-15p">ITEM</th>
                  <th class="wd-10p">QUANTITY REQUESTED</th>
                  <th class="wd-10p">STOCK AVAILABLE</th>
                  <th class="wd-15p">ACTION</th>
                </tr>
              </thead>
              <tbody class="tbody">
                @foreach($rislines as $ris)
                  <tr>
                    <td>
                      <input type="hidden" class="form-control id" readonly="" value="{{$ris->id}}" name="items[{{$ris->id}}][id]">
                    <input type="text" class="form-control stock" readonly="" value="{{$ris->stock}}" name="items[{{$ris->id}}][stockno]">
                    </td>
                    <td>
                    <div class="autocomplete">
                      <input type="text" class="form-control units" value="{{$ris->unit}}"  name="items[{{$ris->id}}][unit]">
                    </div>
                  </td>
                  <td>
                    <div class="autocomplete">
                      <input class="form-control items" autofocus value="{{$ris->name}}" placeholder="Item Description">
                    </div>
                  </td>
                    <td>
                      <input type="text" class="form-control qty"  value="{{$ris->req_qty}}" name="items[{{$ris->id}}][qtyreq]">
                    </td>
                    <td>
                      <input type="text" class="form-control qtystock" value="{{$ris->available}}" onkeydown="isKeyPressed(event)"  name="items[{{$ris->id}}][stock]">
                    </td>
                   
                  </tr>
              @endforeach

              </tbody>
            </table>
          </div>
          <hr/>
      <button type="submit" class="btn btn-primary btn-lg submit" id="load">Submit Requisition Slip</button>
       
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
  console.log(items);
  var array = [];
  var unitsarr = [];
  var master = $("#master").val()
  items.forEach(function(key){
    if(key.master_id == master){
     array.push({
        'code': key.stockno,
        'name': key.stockno+'-'+key.name,
        'stock': key.unit_cost,
        'unit': key.unit,
        'qty': key.qty_instock, 
        'danger': key.danger_lvl
     })
   }
  })



$(document).on('change', '#master', function(){
  //console.log($(this).data('code'));
  array = [];
  $('.tbody').empty();
   var master = $("#master").val()
  items.forEach(function(key){
    if(key.master_id == master){
     array.push({
        'code': key.stockno,
        'name': key.stockno+'-'+key.name,
        'stock': key.unit_cost,
        'unit': key.unit,
        'qty': key.qty_instock, 
        'danger': key.danger_lvl
     })
   }
  })
});
  //console.log(array)
  $(document).ready(function() {

    autocomplete(".items", array);
     //autocomplete(".units", unitsarr);
    $('.danger').hide();
var inx = 0;
   $(document).on('click', '.addto', function(){
            var cart = $('#btnRightMenu');
            var imgtodrag = $(this).parent('div .request').eq(0);
            var div = $(this).parent('div').prev().find('.items');
            console.log(div.prevObject.val())
            if (imgtodrag) {
                var imgclone = imgtodrag.clone()
                    .offset({
                    top: imgtodrag.offset().top, 
                    left: imgtodrag.offset().left
                })
                    .css({
                    'opacity': '0.5',
                        'position': 'absolute',
                        'height': '150px',
                        'width': '150px',
                        'z-index': '100'
                })
                    .appendTo($('body'))
                    .animate({
                    'top': cart.offset().top + 10,
                        'left': cart.offset().left + 10,
                        'width': 75,
                        'height': 75
                }, 1000, 'easeInOutExpo');
                
                setTimeout(function () {
                    cart.effect("shake", {
                        times: 2
                    }, 200);
                }, 1500);

                imgclone.animate({
                    'width': 0,
                        'height': 0
                }, function () {
                    $(this).detach()
                });

                var html = '<a href="#" class="contact-list-link new">'+
                            '<div class="d-flex">'+
                              '<div class="contact-person">'+
                                '<p class="mg-b-0 tx-uppercase"><input type="hidden" value="'+div.prevObject.val()+'" name="items['+inx+'][name]"/>'+div.prevObject.val()+'</p>'+
                                '<span class="tx-12 op-5 d-inline-block">Qty: <input type="number" name="items['+inx+'][qty]"/></span>'+
                              '</div>'+
                              '<span class="tx-info tx-12"><span class="square-8 bg-info rounded-circle"></span> remove</span>'+
                            '</div>'+
                          '</a>';
                  inx++;
                $('#itemlist').append(html);
            }
          });
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
                    '<input type="text" class="form-control stock" readonly="" name="items['+row+'][stockno]">'+
                  '</td>'+
                  '<td>'+
                  ' <div class="autocomplete">'+
                    '<input type="text" class="form-control units" name="items['+row+'][unit]">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                   ' <div class="autocomplete">'+
                          '<input class="form-control items" placeholder="Item Description">'+
                        '</div>'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" class="form-control qty" name="items['+row+'][qtyreq]">'+
                  '</td>'+
                   '<td>'+
                    '<input type="text" class="form-control qtystock" onkeydown="isKeyPressed(event)" name="items['+row+'][stock]">'+
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
                    '<input type="text" class="form-control stock" readonly="" name="items['+row+'][stockno]">'+
                  '</td>'+
                  '<td>'+
                  ' <div class="autocomplete">'+
                    '<input type="text" class="form-control units" name="items['+row+'][unit]">'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                   ' <div class="autocomplete">'+
                          '<input class="form-control items" placeholder="Item Description">'+
                        '</div>'+
                  '</td>'+
                  '<td>'+
                    '<input type="text" class="form-control qty" name="items['+row+'][qtyreq]">'+
                  '</td>'+
                   '<td>'+
                    '<input type="text" class="form-control qtystock" onkeydown="isKeyPressed(event)" name="items['+row+'][stock]">'+
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
  var stock = $(this).closest("td").next().find('.qtystock').val();
  var qty = $(this).val();
 
  var total = 0;

  console.log(stock)

  var danger = parseFloat($(this).data('danger'));
  
  if((stock - qty) < 0){
    $(this).val(stock-danger);
  }
  
  
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

