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
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">List of Abstracts</h6>
    <div class="row pd-t-40 align-items-center" id="comps">
            
            <div class="col-md-12">
              <table class="table table-bordered" id="products">
                  <thead class="thead-colored thead-dark tx-black">
                    <tr>
                      <th class="wd-15p">Abstract No</th>
                      <th class="wd-15p">PR No</th>
                      <th class="wd-15p">PR Total Amount</th>
                      <th class="wd-15p">PR Date</th>
                      <th class="wd-15p">Canvass Amount</th>
                      <th class="wd-15p">Date</th>
                      <th class="wd-15p">Suppliers</th>
                      <th class="wd-15p">Status</th>
                      <th class="wd-15p">RFQ Nos</th>
                      <th class="wd-15p">Action</th>
                    </tr>
                  </thead>
                   <tbody class="tx-inverse">
                     @foreach($prs as $pr)
                       <tr>
                        <td>{{$pr['no']}}</td>
                        <td>{{$pr['prno']}}</td>
                        <td>{{$pr['pramount']}}</td>
                        <td>{{$pr['prdate']}}</td>
                        <td>{{$pr['cvamount']}}</td>
                        <td>{{$pr['date']}}</td>
                        <td>{{$pr['suppliers']}}</td>
                        <td>{{$pr['status']}}</td>
                        <td>{{$pr['rfqs']}}</td>
                        <td><div class="btn-group" role="group" aria-label="Basic example">
                          @if($pr['status'] != "PURCHASED" && $pr['status'] != "IN THE INVENTORY")
                          <button type="button" class="btn btn-success edit" data-id="{{$pr['id']}}"><i class="fa fa-edit"></i> Edit Abstract</button>
                          <button type="button" class="btn btn-primary add" data-purpose="{{$pr['purpose']}}" data-date="{{$pr['date']}}" title="Edit" data-num="{{$pr['rfqscount']}}" data-id="{{$pr['id']}}" data-prno="{{$pr['prno']}}"  data-name="{{$pr['no']}}"><i class="fa fa-plus-square"></i> Create PO</button>
                          @endif
                          <button type="button" class="btn btn-secondary print" data-id="{{$pr['id']}}"><i class="fa fa-print"></i> Print Abstract</button>
                           
                           
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
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold">Create RFQ</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" id="id" value="">
        <div class="modal-body pd-25 wd-500">
          <h4 class="lh-3 mg-b-20 name tx-uppercase tx-b tx-bold"></h4>
          <div class="row">
            <div class="col-md-3">Set Quantity</div>
            <div class="col-md-6"><input type="number" name="qty" class="form-control" required></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save changes</button>
          <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
        </div>
         </form>
      </div>
    </div>
   <!-- modal-dialog -->
  </div><!-- modal -->

<div id="groupdemo" class="modal fade">
    <div class="modal-dialog modal-dialog-vertical-center" role="document">
      <div class="modal-content bd-0 tx-14">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold">Bundle Pricing</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" id="prodid" value="">
        <div class="modal-body pd-25 wd-500">
          <h4 class="lh-3 mg-b-20 name tx-uppercase tx-b tx-bold"></h4>
          <div class="row">
            <div class="col-md-3">Set Quantity</div>
            <div class="col-md-6"><input type="number" name="qty" class="form-control qty" required></div>
          </div>
          <div class="row">
            <div class="col-md-3">Unit</div>
            <div class="col-md-6"><input type="text" name="unit" class="form-control" required></div>
          </div>
          <div class="row">
            <div class="col-md-3">Price</div>
            <div class="col-md-6"><input type="text" readonly="" id="price" name="price" class="form-control" required></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save changes</button>
          <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
        </div>
         </form>
      </div>
    </div>
   <!-- modal-dialog -->
  </div><!-- modal -->
   <div id="mySidenav2" class="sidenav2">
   </div>
   <div id="mySidenav" class="sidenav2">


 
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <br>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55"><input type="hidden" id="pr_id" name="prid">PR No.</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="prid"></div>
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">PR Date</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="prdate"></div>
  </div>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">Purpose</div>
    <div class="col-md-10 tx-left pd-y-10 pd-x-55" id="prpurpose"></div>
  </div>

<hr>
<h3 class="tx-inverse pd-y-10">PURCHASE ORDER</h3>
<form action="{{route('submitpo')}}" method="POST">
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<ul class="nav nav-tabs tx-16 mg-b-10" id="list">
    
  </ul>
<div class="tab-contents">
 
  </div>
<hr>
  <div class="row return pd-r-20">
    <div class="col-md-12 tx-right ">
      <button type="submit" class="btn btn-primary btn-lg returnbtn">Submit Form</button>
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

    $(document).on('click', '.print', function(){
      window.location.href = '{{route ("abstract", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

   $(document).on('click', '.edit', function(){
      $.get('{{route ("editabstract", ["id" => ''] )}}'+'/'+$(this).data('id'),
        {
           _token: document.getElementById('token').value,
            
        },
        function(data,status){
          $('#mySidenav2').empty();
          $('#mySidenav2').append(data)
        });
      openNav2();
    })

    $("#list a").click(function(e){
            e.preventDefault();
            $(this).tab('show');
        });
$('.suppliers').on('change', function (e) {
    var optionSelected = $("option:selected", this).data('address');
    var valueSelected = this;
    $(".address").val(optionSelected);
    
});


    var suppliers = {!! json_encode($suppliers->toArray()) !!};
  var units = {!!json_encode($units)!!};
var procmodes = {!!json_encode($procmodes)!!};
  var array = [];
  var rfid = [];
 
$('.date').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true,
  numberOfMonths: 2
});
    $(document).on('click', '.add', function(){

      var sel = '';
      procmodes.forEach(function(pr){
        sel += '<option value="'+pr.id+'">'+pr.name+'</option>';

        console.log(sel);
      })
        
        
                                  

         $('#prpurpose').text($(this).data('purpose'));
         $('#prdate').text($(this).data('date'));
        $('#pr_id').val($(this).data('prno'));
        $('#prid').text($(this).data('prno'));
          var li = '';
          $('#list').empty();
          $('.tbody').empty();
          var ad = 1;
        $.get("{{route('getpolines')}}",
        {
           _token: document.getElementById('token').value,
            id: $(this).data('id'),
            num: $(this).data('num')
        },
         function(data,status){
          console.log(data);
          
          data[0].forEach(function(key){
            li += '<li class="nav-item">'+
                    '<a class="nav-link" data-toggle="tab" href="#tab'+ad+'" data-id="'+ad+'">'+key+'</a>'+
                  '</li>';
                  ad++;
          });
          var b = 1;
              data[1][1].forEach(function(k2){
                var div ='';
                div = '<div id="tabs'+b+'" class="tab-pane noshow">'+
                      '<div class="row mg-t-10 pd-x-55">'+
                        '<div class="col-md-5">'+
                         '<div class="form-layout form-layout-2">'+
                            '<div class="row no-gutters">'+
                              '<div class="col-md-6 mg-t--1 mg-md-t-0">'+
                                '<div class="form-group mg-md-l--1">'+
                                  '<label class="form-control-label">RFQ No: <span class="tx-danger">*</span></label>'+
                                  '<input class="form-control tx-16 refno" value="'+k2.ref_no+'" type="text" name="refno" readonly="" placeholder="RFQ No" /><input type="hidden" readonly class="form-control" name="rfq['+b+'][id]" value="'+k2.rfq_id+'">'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-6 mg-t--1 mg-md-t-0">'+
                                '<div class="form-group mg-md-l--1">'+
                                  '<label class="form-control-label">PO Ref No: <span class="tx-danger">*</span></label>'+
                                  '<input class="form-control tx-16 refno" value="'+data[0][b-1]+'" type="text" name="rfq['+b+'][poref]" readonly="" placeholder="PHILGEPS Ref No" />'+
                                '</div>'+
                              '</div>'+
                              '<div class="col-md-6 mg-t--1 mg-md-t-0">'+
                                '<div class="form-group mg-md-l--1">'+
                                  '<label class="form-control-label">Date: <span class="tx-danger">*</span></label>'+
                                  '<input type="text" class="form-control date" name="rfq['+b+'][date]" placeholder="MM/DD/YYYY">'+
                                '</div>'+
                              '</div>'+

                              '<div class="col-md-6 mg-t--1 mg-md-t-0">'+
                                '<div class="form-group mg-md-l--1">'+
                                  '<label class="form-control-label">Mode of Procurement: <span class="tx-danger">*</span></label>'+'<select class="form-control select2-show-search " name="rfq['+b+'][procmode]" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">'+sel
                                 +
                                '</select></div>'+
                              '</div>'+

                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<label class="form-control-label">Supplier: <span class="tx-danger">*</span></label>'+
                                    '<input type="text" readonly class="form-control" name="supplier" value="'+k2.name+'"><input type="hidden" readonly class="form-control" name="rfq['+b+'][supplier]" value="'+k2.supplier_id+'">'+
                                '</div>'+
                              '</div>'+

                              '<div class="col-md-12 mg-t--1 mg-md-t-0">'+
                                '<div class="form-group mg-md-l--1">'+
                                  '<label class="form-control-label">Address: <span class="tx-danger">*</span></label>'+
                                  '<input class="form-control tx-16 address" type="text" value="'+k2.address+'" name="rfq['+b+'][address]" placeholder="Address" />'+
                                '</div>'+
                              '</div>'+

                             
                             
                            '</div>'+
                        '</div>'+
                      '</div>'+
                      '<div class="col-md-7">'+
                        '<table class="table">'+
                      '<thead class="thead-colored thead-dark">'+
                        '<tr>'+
                          '<th class="wd-15p">Stock No.</th>'+
                          '<th class="wd-15p">Item</th>'+
                          '<th class="wd-15p">Quantity</th>'+
                          '<th class="wd-15p">Unit</th>'+
                          '<th class="wd-15p">Unit Cost</th>'+
                          '<th class="wd-15p">Total</th>'+
                        '</tr>'+
                      '</thead>'+
                      '<tbody id="prlines'+k2.rfq_id+'" class="tx-inverse tx-center tbody"></tbody>'+
                      '<tfoot>'+
                         '<tr>'+
                            '<td class="tx-right" colspan="5"><b>Grand Total:</b></td>'+
                            '<td class="text-right">'+
                                '<input type="text" id="total'+k2.rfq_id+'" class="form-control text-right total" name="rfq['+b+'][gtotal]" tabindex="-1" value='+k2.awarded_amount+' readonly="readonly" />'+
                            '</td>'+
                        '</tr>'+
                       '</tfoot>'+
                    '</table>'+
                    '<div class="row delivery">'+
                      '<div class="col-md-12">'+
                         '<div class="form-layout form-layout-2">'+
                            '<div class="row no-gutters tx-center">'+
                              '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                  '<label class="form-control-label">Amount in Words: <span class="tx-danger">*</span></label>'+
                                  '<input class="form-control tx-16" value="'+inWords(parseFloat(k2.awarded_amount))+' only'+'" type="text" readonly="" name="rfq['+b+'][amountwords]" placeholder="Amount in Words" id="amountwords'+k2.rfq_id+'" />'+
                                '</div>'+
                              '</div>'+
                              '<br>'+
                            '</div>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                      '<hr>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>';

                    console.log(div)
                    b++;

                    $(".tab-contents").append(div);
            
      })

          $('.sao').attr('disabled', 'disabled');
          $('#list').append(li);

  $('.date').datepicker({
          showOtherMonths: true,
          selectOtherMonths: true,
          numberOfMonths: 2
        });

          var tr='';
          
          var a=1;
           if(status == 'success'){
            //console.log(data)
            
              data[1][0].forEach(function(k3){
                data[1][1].forEach(function(k2){
              console.log(k2.rfq_id +' - '+ k3.rfq_id)
                if(k2.rfq_id == k3.rfq_id){
                tr = "<tr>"+
                       '<td class="wd-10p"><input type="hidden" class name="items['+a+'][id]" value='+k3.id+'><input type="hidden" class name="items['+a+'][rfq_id]" value='+k3.rfq_id+'>'+k3.stockno+'</td>'+
                       '<td class="wd-10p">'+k3.name+'</td>'+
                       '<td class="wd-10p"><input type="text" class="qty" data-id="'+k3.rfq_id+'" name="items['+a+'][qty]" value='+k3.qty+'></td>'+
                       '<td class="wd-10p"><input type="text" class="unit" name="items['+a+'][unit]" value='+k3.unit+'></td>'+
                       '<td class="wd-10p"><input type="text" class="cost'+k3.rfq_id+'" name="items['+a+'][unit_cost]" value='+k3.unit_price+'></td>'+
                       '<td class="wd-10p"><input type="text" class="total'+k3.rfq_id+'" name="items['+a+'][total_cost]" value='+k3.total_price+'></td></tr>';
                        a++;
                         $('#prlines'+k2.rfq_id).append(tr);
                    }
                   
                  });
               });
            
            
            openNav();

             units.forEach(function(key){
             array.push(key.name);
          })
          //console.log(units);
        $( ".unit" ).autocomplete({
              source: array
            });
            
           }
      });
        //$('#modaldemo1').modal('show');
        openNav();

      

    })

    $('.group').click(function(){
        $('.name').text($(this).data('name'));
        $('#prodid').val($(this).data('id'));
        $('#price').val($(this).data('price'))
        $('.qty').attr('data-price', $(this).data('price'));
        $('#groupdemo').modal('show');
    });

    $(document).on('keyup', '.qty', function(){
      var qty = parseFloat($(this).val());
      var price = $(this).data('price');
      $('#price').val(qty*price);
    })
$(document).on("change", '.itemchk', function(){
  gettotald();
})

$(document).on('keyup', '.qty', function(){
  var id = $(this).data('id');
    var cost = $(this).closest("td").next().next().find('.cost'+id).val();
    var qty = $(this).val();
    var total = cost * qty;
    console.log(total)
    $(this).closest("td").next().next().next().find('.total'+id).val(total.toFixed(2))
    gettotald(id);
  
});
$(document).on("click", '.nav-link', function(){

  if($("#tabs"+$(this).data('id')).hasClass('noshow')){
    //
    $('.tab-pane').addClass('noshow');
    $("#tabs"+$(this).data('id')).removeClass('noshow');
    $("#tabs"+$(this).data('id')).addClass('show');

  }
  else{
    
    $('.tab-pane').removeClass('show');
    $("#tabs"+$(this).data('id')).removeClass('show');
    $("#tabs"+$(this).data('id')).addClass('noshow');
  }
  
  
  //console.log($("#tabs"+$(this).data('id')).attr('class'))
})
function gettotald(id){
  var total=0;
  $(".total"+id).each(function() {
      if($(this).val() != ''){

        total += parseFloat($(this).val());
      }
    });
    $('#total'+id).val(total.toFixed(2));
$("#amountwords"+id).val(inWords(total)+"only")
}
});
</script>
@endsection

