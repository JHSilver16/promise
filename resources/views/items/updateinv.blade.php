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

   <div class="ht-50 tx-primary d-flex align-items-center justify-content-center shadow-base ">
        <ul class="nav nav-outline  align-items-center flex-row" role="tablist">
          <li class="nav-item"><a class="nav-link active tx-primary tx-16 tx-bold" data-toggle="tab" href="#search" role="tab">Inventoriable Items</a></li>
          <li class="nav-item"><a class="nav-link tx-primary tx-16 tx-bold" data-toggle="tab" href="#view" role="tab">Noninventoriable Items</a></li>
        </ul>
      </div>
<div class="tab-content br-profile-body pd-x-20 pd-t-20">
   <div class="tab-pane fade show active " id="search">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">List of Items</h6>
    <div class="row pd-t-40 align-items-center" id="comps">
            
            <div class="col-md-12">
              <table class="table table-bordered" id="products">
                  <thead class="thead-colored thead-dark tx-black">
                    <tr>
                      <th class="wd-15p">Stock No</th>
                      <th class="wd-15p">Name</th>
                      <th class="wd-15p">Category</th>
                      <th class="wd-15p">Master Account</th>
                      <th class="wd-15p">Cost</th>
                      <th class="wd-15p">Purchase Unit</th>
                      <th class="wd-15p">Current Price</th>
                      <th class="wd-15p">Inventory Unit</th>
                      <th class="wd-15p">Quantity Left</th>
                      <th class="wd-15p">Action</th>
                    </tr>
                  </thead>
                   <tbody class="tx-inverse">
                     @foreach($itemss as $item)
                      @if($item['cl_id'] != 4)
                       <tr>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['type']}}</td>
                        <td>{{$item['master']}}</td>
                        <td contenteditable="true" class="cost" data-id="{{$item['inv_id']}}">{{$item['cost']}}</td>
                        <td>{{$item['prunit']}}</td>
                        <td>{{$item['price']}}</td>
                        <td>{{$item['punit']}}</td>
                        <td contenteditable="true" class="qty" data-id="{{$item['inv_id']}}">{{$item['qty']}}
                       
                        </td>
                        <td><div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-success edit" data-id="{{$item['id']}}"><i class="fa fa-edit"></i>Edit Item</button>
                          <button type="button" class="btn btn-primary add" data-toggle="tooltip" title="Edit" data-id="{{$item['inv_id']}}" data-name="{{$item['name'].' '.$item['description']}}"><i class="fa fa-list"></i> View Inventory</button>
                         
                          <button type="button" class="btn btn-info stockcard" data-toggle="tooltip" title="Edit" data-id="{{$item['inv_id']}}" data-name="{{$item['name'].' '.$item['description']}}"><i class="fa fa-list"></i> Print Stock Card</button>
                        </div>
                        </td>
                      </tr>
                      @endif
                     @endforeach
                   </tbody>
                 </table>
            </div>
        </div>
      </div>
      <div class="tab-pane fade show" id="view">

            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">List of Items</h6>
    <div class="row pd-t-40 align-items-center" id="comps">
            
            <div class="col-md-12">
              <table class="table table-bordered" id="products">
                  <thead class="thead-colored thead-dark tx-black">
                    <tr>
                      <th class="wd-15p">Stock No</th>
                      <th class="wd-15p">Name</th>
                      <th class="wd-15p">Category</th>
                      <th class="wd-15p">Cost</th>
                      <th class="wd-15p">Purchase Unit</th>
                      <th class="wd-15p">Current Price</th>
                      <th class="wd-15p">Action</th>
                    </tr>
                  </thead>
                   <tbody class="tx-inverse">
                     @foreach($itemss as $item)
                      @if($item['cl_id'] == 4)
                       <tr>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['type']}}</td>
                        <td>{{$item['cost']}}</td>
                        <td>{{$item['prunit']}}</td>
                        <td>{{$item['price']}}</td>

                        <td><div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-success edit" data-id="{{$item['id']}}"><i class="fa fa-edit"></i>Edit Item</button>
                        </div>
                        </td>
                      </tr>
                      @endif
                     @endforeach
                   </tbody>
                 </table>
            </div>
        </div>
      </div>
    </div>
      </div>
  </div>

<div id="modaldemo1" class="modal fade">
    <div class="modal-dialog modal-dialog-vertical-center modal-lg" style="width: 150%" role="document">
      <div class="modal-content bd-0 tx-14">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold">Inventory Operations</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" id="id" value="">
        <div class="modal-body pd-25">
          <h4 class="lh-3 mg-b-20 name tx-uppercase tx-b tx-bold"></h4>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered pd-t-15" id="returnstbl" >
              <thead class="thead-colored thead-dark">
                <tr>
                  <th class="wd-5p">#</th>
                  <th class="wd-20p">Reference</th>
                  <th class="wd-10p">Date</th>
                  <th class="wd-10p">Operation</th>
                  <th class="wd-10p">Description</th>
                  <th class="wd-10p">Quantity</th>
                  <th class="wd-10p">Unit Cost</th>
                  <th class="wd-10p">Total Cost</th>
                  <th class="wd-10p">Balance</th>
                </tr>
              </thead>
              <tbody id="oplines" class="tx-inverse">
              </tbody>
            </table>
            </div>
          </div>
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
   $(function(){
        'use strict';

        $('.table').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
          }
        });
   $(document).on('click', '.edit', function(){
      window.location.href = '{{route ("edititem", ["id" => ''] )}}'+'/'+$(this).data('id')
    })
    $(document).on('click', '.stockcard', function(){
      window.location.href = '{{route ("stockcard", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

    $(document).on('keyup', '.qty', function() {
      var id = $(this).data('id');
      var qty = $(this).text();
      $.post("{{route('setinv')}}",
        {
           _token: document.getElementById('token').value,
            id: id,
            qty: qty,
            type:'qty'

        },
        function(data,status){
          //console.log(data)
          if(data == 'success'){
          }
        });

    });

    $(document).on('keyup', '.cost', function() {
      var id = $(this).data('id');
      var qty = $(this).text();

      $.post("{{route('setinv')}}",
        {
           _token: document.getElementById('token').value,
            id: id,
            cost: qty,
            type:'cost'
        },
        function(data,status){
          //console.log(data)
          if(data == 'success'){
          }
        });

    });


    $(document).on('click', '.add', function(){
        $('.name').text($(this).data('name'));
        $('#oplines').empty();
        $('#id').val($(this).data('id'));
        var id = $(this).data('id');
        var tr = '';
        $.get("{{route('inventoryview')}}",
                    {
                      _token: document.getElementById('token').value,
                      id: id
                    },
                    function(data,status){
                      data.forEach(function(key){
                        tr += "<tr>"+
                               '<td class="wd-10p">'+key.id+'</td>'+
                               '<td class="wd-10p">'+(key.pr_no != null ? key.pr_no+' ,' : '')+(key.iac_id != null ? key.iac_id+' ,' : '')+(key.ris_id != null ? key.ris_id+'' : '')+'</td>'+
                               '<td class="wd-10p">'+key.date+'</td>'+
                               '<td class="wd-10p">'+key.operation+'</td>'+
                               '<td class="wd-10p">'+key.reason+'</td>'+
                               '<td class="wd-10p">'+key.qty+'</td>'+
                               '<td class="wd-10p">'+key.unit_cost+'</td>'+
                               '<td class="wd-10p">'+key.total_cost+'</td>'+
                               '<td class="wd-10p">'+key.balance+'</td></tr>';
                       });
                      
                      $('#oplines').append(tr);
                      $('#returnstbl').dataTable(); 
                  })
        $('#modaldemo1').modal('show');
         if(tr != null){
          //$('#returnstbl').dataTable();   
         }     
        

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
});
</script>
@endsection