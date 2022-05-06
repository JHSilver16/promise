@extends('layouts.app')

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
          <a href="{{route('additem')}}">
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-user-plus tx-20"></i>
            <span class="menu-item-label">Add New Item</span>
          </div><!-- menu-item -->
        </a>
        </li>
        <li class="nav-item">
          <a href="{{route('barcodelist')}}">
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-user-plus tx-20"></i>
            <span class="menu-item-label">Print Barcodes</span>
          </div><!-- menu-item -->
        </a>
        </li>

        <li class="nav-item">
          <a href="{{route('itemlist')}}">
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-user-plus tx-20"></i>
            <span class="menu-item-label">Print Masterlist</span>
          </div><!-- menu-item -->
        </a>
        </li>
        
        <li class="nav-item">
          <a href="{{route('updateinv')}}">
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-user-plus tx-20"></i>
            <span class="menu-item-label">Update Inventory</span>
          </div><!-- menu-item -->
        </a>
        </li>

      </ul>
    </div>
  </div>

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
   <div class="row">
          <div class="col-md-9 d-sm-flex">
            <div class=" pd-sm-l-20">
              <h4 class="tx-gray-800 mg-b-5">List of Items</h4>
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
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
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
                     <th></th>
                      <th class="wd-15p">Stock No</th>
                      <th class="wd-15p">Name</th>
                      <th class="wd-15p">Category</th>
                      <th class="wd-15p">Master Account</th>
                      <th class="wd-15p">Cost</th>
                      <th class="wd-15p">Purchase Unit</th>
                      <th class="wd-15p">Current Price</th>
                      <th class="wd-15p">Inventory Unit</th>
                      <th class="wd-15p">Status</th>
                      <th class="wd-15p">Quantity Left</th>
                      <th class="wd-15p">Action</th>
                    </tr>
                  </thead>
                   <tbody class="tx-inverse">
                     @foreach($items as $item)
                      @if($item['cl_id'] != 4)
                       <tr>
                       <td><input type="checkbox" value="{{$item['id']}}" class="chk"></td>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['type']}}</td>
                        <td>{{$item['master']}}</td>
                        <td>{{$item['cost']}}</td>
                        <td>{{$item['prunit']}}</td>
                        <td>{{$item['price']}}</td>
                        <td>{{$item['punit']}}</td>
                        
                        <td>{{$item['status']}}</td>
                        <td>{{$item['qty']}}
                        @if($item['qty'] == $item['dangerlvl'])
                         <span class="badge badge-warning mg-l-5"><i class="fa fa-exclamation"></i> At danger level</span>
                        @elseif($item['qty'] < $item['dangerlvl'])
                         <span class="badge badge-danger mg-l-5"> <i class="fa fa-exclamation"></i> QUANTITY DEPLETING</span>
                         @elseif($item['qty'] == 0)
                         <span class="badge badge-black mg-l-5"> <i class="fa fa-exclamation"></i> QUANTITY DEEPLETED</span>
                        @else
                          
                        @endif
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

            <div class="row">
          <div class="col-md-9 d-sm-flex">
            <div class=" pd-sm-l-20">
              <h4 class="tx-gray-800 mg-b-5">List of Items</h4>
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
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
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
                      <th class="wd-15p">Stock No</th>
                      <th class="wd-15p">Name</th>
                      <th class="wd-15p">Category</th>
                      <th class="wd-15p">Cost</th>
                      <th class="wd-15p">Purchase Unit</th>
                      <th class="wd-15p">Current Price</th>
                      <th class="wd-15p">Status</th>
                      <th class="wd-15p">Action</th>
                    </tr>
                  </thead>
                   <tbody class="tx-inverse">
                     @foreach($items as $item)
                      @if($item['cl_id'] == 4)
                       <tr>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['type']}}</td>
                        <td>{{$item['cost']}}</td>
                        <td>{{$item['prunit']}}</td>
                        <td>{{$item['price']}}</td>
			<td>{{$item['status']}}</td>
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
                  <th class="wd-10p">Status</th>
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
    var itemid = [];
    $(document).on('click', '.update', function() {
       var rfnos = '';
       if($('.chk:checked').length == 0){
        swal("Warning!", "Please check at least one item.", "warning");
       }
       else{
        $(".chk:checkbox:checked").each(function() {
          itemid.push($(this).val())
        })
       $.post("{{route('updateitems')}}",
        {
           _token: document.getElementById('token').value,
            items: itemid,
            status: document.getElementById('status').value
        },
        function(data,status){
            if(data == 'ok'){
              swal("Success!", "Items have been updated", "success");
              window.location.reload();
            }
        })

        }
      });

    $(document).on('keyup', '.qty', function(){
      var qty = parseFloat($(this).val());
      var price = $(this).data('price');
      $('#price').val(qty*price);
    })
});
</script>
@endsection
