@extends('layouts.staff')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
  <nav class="breadcrumb pd-0 mg-0 tx-12">
    <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
    <span class="breadcrumb-item active">Products</span>
  </nav>
</div>
 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"><!-- br-pageheader -->
<div class="bd-y bd-gray-500 bg-light" id="employeeoptions">
  <div class="ht-md-60 wd-200 wd-md-auto pd-y-20 pd-md-y-0 d-md-flex align-items-center justify-content-center tx-poppins" >
      <ul class="nav nav-effect nav-effect-5 tx-uppercase tx-bold tx-spacing-2 flex-column flex-md-row" role="tablist">
        <li class="nav-item">
          <a href="{{route('addrisstaff')}}">
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-plus-circle tx-20"></i>
            <span class="menu-item-label">Create Requisition and Issue Slip</span>
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
          <h4 class="tx-gray-800 mg-b-5">List of Requisition and Issue Slips</h4>
          <p class="mg-b-0">As of</p>
        </div>
      </div><!-- d-flex -->
    <div class="row pd-t-40 align-items-center" id="comps">
            
            <div class="col-md-12">
              <table class="table table-bordered" id="products">
                  <thead class="thead-colored thead-dark tx-black">
                    <tr>
                      <th class="wd-15p">PR No</th>
                      <th class="wd-15p">Requesting Employee</th>
                      <th class="wd-15p">Purpose</th>
                      <th class="wd-15p">Total No. of Items</th>
                      <th class="wd-15p">Date</th>
                      <th class="wd-15p">Status</th>
                      <th class="wd-15p">Requested From</th>
                      <th class="wd-15p">Issued By</th>
                      <th class="wd-15p">Received By</th>
                      <th class="wd-10p">Action</th>
                    </tr>
                  </thead>
                   <tbody class="tx-inverse">
                     @foreach($ris as $pr)
                       <tr>
                        <td>{{$pr['no']}}</td>
                        <td>{{$pr['employee']}}</td>
                        <td>{{$pr['purpose']}}</td>
                        <td>{{$pr['items']}}</td>
                        <td>{{$pr['date']}}</td>
                        <td>{{$pr['status']}}</td>
                        <td>{{$pr['master']}}</td>
                        <td>{{$pr['issued_by']}}</td>
                        <td>{{$pr['received_by']}}</td>
                        <td><div class="btn-group" role="group" aria-label="Basic example">
                          @if($pr['status'] == 'PENDING')
                           <button type="button" class="btn btn-success edit" data-id="{{$pr['id']}}"><i class="fa fa-edit"></i> Edit RIS</button>
                           <button type="button" class="btn btn-primary print" data-id="{{$pr['id']}}"><i class="fa fa-edit"></i> Print RIS</button>
                           <button type="button" class="btn btn-info group" title="Edit" data-emp="{{$pr['employee']}}" data-id="{{$pr['id']}}" data-name="{{$pr['no']}}"  data-date="{{$pr['date']}}"><i class="fa fa-box"></i> View Items</button>
                           @else
                            <button type="button" class="btn btn-primary print" data-id="{{$pr['id']}}"><i class="fa fa-edit"></i> Print RIS</button>
                           <button type="button" class="btn btn-info group" title="Edit" data-emp="{{$pr['employee']}}" data-id="{{$pr['id']}}" data-name="{{$pr['no']}}"  data-date="{{$pr['date']}}"><i class="fa fa-box"></i> View Items</button>
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
              </table>
        </div>
      </div>
    </div>
   <!-- modal-dialog -->
  </div><!-- modal -->


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
    $('.edit').click(function(){
      window.location.href = '{{route ("editrisstaff", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

 $('.print').click(function(){
      window.location.href = '{{route ("risreport", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

$('.date').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true,
  numberOfMonths: 2
});
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
                       '<td class="wd-10p"><input type="checkbox" class="itemchk" data-amount="'+key.total_cost+'" name="items['+a+'][prline_id]" value='+key.id+'></td>'+
                       '<td class="wd-10p">'+key.id+'</td>'+
                       '<td class="wd-10p">'+key.name+'</td>'+
                       '<td class="wd-10p">'+key.req_qty+'</td>'+
                       '<td class="wd-10p">'+key.unit+'</td>'+
                       '<td class="wd-10p">'+key.issued_qty+'</td>'+
                       '<td class="wd-10p">'+key.remarks+'</td></tr>';
                        a++;
               });
            
            table.innerHTML = tr;
            openNav2();
            
           }
      });
  
})

$('.submitpo').click(function(){
         
     
});



    $('.group').click(function(){
        $.get("{{route('getrislines')}}",
        {
           _token: document.getElementById('token').value,
            id: $(this).data('id')
        },
         function(data,status){
          var tr='';
          var a=1;
           if(status == 'success'){
            console.log(data)
            var table = document.getElementById('rislines');
             data.forEach(function(key){
              //console.log(key.issued_qty.length);
              if(key.issued_qty != null ){
               tr += "<tr>"+
                      '<td class="wd-10p">'+key.stock+'</td>'+
                       '<td class="wd-10p">'+key.name+'</td>'+
                       '<td class="wd-10p">'+key.req_qty+'</td>'+
                       '<td class="wd-10p">'+key.unit+'</td>'+
                       '<td class="wd-10p">'+key.issued_qty+'</td>'+
                       '<td class="wd-10p">'+key.remarks+'</td></tr>';
                        a++;
              }
              else{
                  tr += "<tr>"+
                      '<td class="wd-10p">'+key.stock+'</td>'+
                       '<td class="wd-10p">'+key.name+'</td>'+
                       '<td class="wd-10p">'+key.req_qty+'</td>'+
                       '<td class="wd-10p">'+key.unit+'</td>'+
                       '<td class="wd-10p">'+(key.issued_qty == null ? '' : key.issued_qty)+'</td>'+
                       '<td class="wd-10p">'+(key.remarks == null ? '' : key.remarks)+'</td></tr>';
                        a++;
                }
               });
            
            table.innerHTML = tr;
            
            
           }
          });
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
  var stock = $(this).closest("td").prev().prev().find('.qtystock').text();
  var qty = $(this).val();
 
  var total = 0;

 
  
  if(qty > stock){
    $(this).val(stock);
  }
  else if(qty < 0){
    $(this).val(0);
  }
  
  
});
function gettotald(){
  var total=0;
  $(".itemchk:checkbox:checked").each(function() {
      total += parseFloat($(this).data('amount'));
    });

    $('#total').val(total.toFixed(2));

    $("#amountwords").val(inWords(total)+"pesos only")

}
});
</script>
@endsection