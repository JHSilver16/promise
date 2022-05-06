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
    <div class="progress">
      <div class="progress-bar progress-bar-xs bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
  <div class="alert alert-success toast" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <div class="d-flex align-items-center justify-content-start">
    <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
    <span><strong>Success!</strong> Record Updated.</span>
  </div><!-- d-flex -->
</div><!-- alert -->
 <div class="ht-50 bg-primary d-flex align-items-center justify-content-center shadow-base ">
        <ul class="nav nav-outline  align-items-center flex-row" role="tablist">
          <li class="nav-item"><a class="nav-link active tx-white tx-16 tx-bold" data-toggle="tab" href="#search" role="tab">Search by PR Number</a></li>
          <li class="nav-item"><a class="nav-link tx-white tx-16 tx-bold" data-toggle="tab" href="#view" role="tab">View all RFQS</a></li>
        </ul>
      </div>
      <hr>
       <div class="tab-content br-profile-body pd-x-20 ">
     <div class="tab-pane fade show active" id="search">
      <div class="row bd-b tx-14 tx-inverse tx-left">
        <div class="col-md-2 tx-left bg-primary tx-16 tx-bold tx-white pd-y-10 pd-x-55"><i class="fa fa-search"></i><input class="prnos" type="hidden" id="pr_id" name="prid"> Search PR No.</div>
        <div class="col-md-7 tx-left pd-y-10 pd-x-55 form-layout-2"><input type="text"  id="prid" name="" class="form-control"></div>
        <div class="col-md-1 tx-right pd-y-10 form-layout-2"><button type="button" class="btn btn-info btn-sm refresh">Refresh</button><input type="text"  id="prid" name="" class="form-control"></div>
        <div class="col-md-2 tx-right pd-y-10 form-layout-2">With Selected | <button type="button" class="btn btn-primary btn-sm createab">Create Abstract</button></div>
      </div>

        <div class="row row-sm mg-t-20" id="prlist">
          
        </div>
     </div>
          <div class="tab-pane fade show" id="view">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">List of Quotations</h6>
    <div class="row pd-t-40 align-items-center" id="comps">
            
            <div class="col-md-12">
              <table class="table table-bordered" id="products">
                  <thead class="thead-colored thead-dark tx-black">
                    <tr>
                      <th class="wd-15p">RFQ No</th>
                      <th class="wd-15p">PR No</th>
                      <th class="wd-15p">Purpose</th>
                      <th class="wd-15p">Total No. of Items</th>
                      <th class="wd-15p">With Abstract</th>
                      <th class="wd-15p">Date</th>
                      <th class="wd-15p">PR Total</th>
                      <th class="wd-15p">Supplier</th>
                      <th class="wd-15p">Canvass Total</th>
                      <th class="wd-15p">Status</th>
                      <th class="wd-15p">Action</th>
                    </tr>
                  </thead>
                   <tbody class="tx-inverse">
                     @foreach($rfqs as $pr)
                       <tr>
                        <td>{{$pr['no']}}</td>
                        <td>{{$pr['prno']}}</td>
                        <td>{{$pr['purpose']}}</td>
                        <td>{{$pr['items']}}</td>
                        <td>{{$pr['abstracts']}}</td>
                        <td>{{$pr['date']}}</td>
                        <td>{{$pr['total_amount']}}</td>
                        <td>{{$pr['supplier']}}</td>
                        <td>{{$pr['canvass_amount']}}</td>
                        <td>{{$pr['status']}}</td>
                        <td><div class="btn-group" role="group" aria-label="Basic example">
                          @if($pr['status'] == 'FOR CANVASS')
                           <button type="button" class="btn btn-success edit" data-prid="{{$pr['prid']}}" data-id="{{$pr['id']}}"><i class="fa fa-edit"></i> Edit RFQ</button>
                           @endif
                           
                           <button type="button" class="btn btn-info group" title="Edit" data-id="{{$pr['id']}}" data-name="{{$pr['no']}}" data-total="{{$pr['total_amount']}}" data-date="{{$pr['date']}}"><i class="fa fa-box"></i> View Items</button>
                           <button type="button" class="btn btn-primary print" title="Edit" data-id="{{$pr['id']}}" data-name="{{$pr['no']}}" data-total="{{$pr['total_amount']}}" data-date="{{$pr['date']}}"><i class="fa fa-box"></i> Print RFQ</button>
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
</div>

<div id="modaldemo1" class="modal fade">
    <div class="modal-dialog modal-dialog-vertical-center modal-lg" style="width: 150%" role="document">
      <div class="modal-content bd-0 tx-14">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold">Edit RFQ</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" id="id" value="">
        <div class="modal-body pd-25">
          <div class="row">
              <div class="col-md-4">
               <div class="form-layout form-layout-2">
                  <div class="row no-gutters">
                    <div class="col-md-6 mg-t--1 mg-md-t-0">
                      <div class="form-group mg-md-l--1">
                        <label class="form-control-label" id="lbltxt">RFQ Ref No: <span class="tx-danger">*</span></label>
                        <input class="form-control tx-16 refno" value="" type="text" name="refno" readonly="" placeholder="PHILGEPS Ref No" />
                      </div>
                    </div><!-- col-4 -->
                    <div class="col-md-6 mg-t--1 mg-md-t-0">
                      <div class="form-group mg-md-l--1">
                        <label class="form-control-label">Date: <span class="tx-danger">*</span></label>
                        <input type="text" class="form-control date" name="date" placeholder="MM/DD/YYYY">
                      </div>
                    </div><!-- col-4 -->
                    <div class="col-md-12 mg-t--1 mg-md-t-0" id="phil">
                      <div class="form-group mg-md-l--1">
                        <label class="form-control-label">PHILGEPS Ref No: <span class="tx-danger">*</span></label>
                        <input class="form-control tx-16 phgpsno" type="text" name="phgpsno" placeholder="PHILGEPS Ref No" />
                      </div>
                    </div><!-- col-4 -->
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label">Supplier: <span class="tx-danger">*</span></label>
                        <select class="form-control select2-show-search suppliers" name="supplier" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                          @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}" data-address="{{$supplier->address}}">{{$supplier->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div><!-- col-4 -->
                    <div class="col-md-12 mg-t--1 mg-md-t-0">
                      <div class="form-group mg-md-l--1">
                        <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                        <input class="form-control tx-16 address" type="text" name="amountpaid" readonly="" placeholder="Address" />
                      </div>
                    </div>
                    
                  </div>

                  <div class="form-layout-footer bd pd-20 bd-t-0 paydiv">
                       
                      </div><!-- form-group -->
              </div>
              <hr>
            </div>
            <div class="col-md-8">
              <table class="table">
            <thead class="thead-colored thead-dark">
              <tr>
                <th class="wd-15p"></th>
                <th class="wd-15p">Stock No.</th>
                <th class="wd-15p">Item</th>
                <th class="wd-15p">Quantity</th>
                <th class="wd-15p">Unit</th>
                <th class="wd-15p">ABC Cost</th>
                <th class="wd-15p">Total</th>
              </tr>
            </thead>
            <tbody id="prlines2" class="tx-inverse"></tbody>
            <tfoot>
               <tr>
                  <td class="tx-right" colspan="6"><b>Grand Total:</b></td>
                  <td class="text-right">
                      <input type="text" id="total" class="form-control text-right total" name="gtotal" tabindex="-1" value="0.00" readonly="readonly" />
                  </td>
              </tr>
             </tfoot>
          </table>
          <div class="row delivery">
            <div class="col-md-12">
               <div class="form-layout form-layout-2">
                  <div class="row no-gutters tx-center">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label">Amount in Words: <span class="tx-danger">*</span></label>
                        <input class="form-control tx-16" type="text" readonly="" name="amountwords" placeholder="Amount in Words" id="amountwords" />
                      </div>
                    </div>
                    <br>
                    <!-- col-4 -->  
                  </div>
                </div>
              </div>
            </div>
            <div class="row return">
              <div class="col-md-12 tx-left">
              </div>
            </div>
          </div>

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
    <div class="modal-dialog modal-dialog-vertical-center modal-lg" role="document">
      <div class="modal-content bd-0 tx-14">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold">List of Items</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
     
        <div class="modal-body pd-25 wd-1000p">
          <table class="table table-bordered tx-12 wd-100p">
          <thead class="bd bd-2">

            <tr>
              <th rowspan="2">Item No</th>             
              <th rowspan="2">Qty</th>            
              <th rowspan="2">Unit</th>
              <th rowspan="2" class="wd-20p">Item Description</th>
              <th colspan="2">Approved Budget for the Contract</th>
              <th rowspan="2">Unit Price</th>
              <th rowspan="2">Total Price</th>
            </tr>
            <tr>          
              <th>Unit Cost</th>
              <th>Total Cost</th>
            </tr>
          </thead>
          <tbody class="tbd">
          </tbody>
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

   <div id="mySidenav" class="sidenav2">
<form action="{{route('submitabstract')}}" method="POST">

 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
 <input type="hidden" name="rfqs" id="rfqs" value="{{ csrf_token() }}">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <br>
<h3 class="tx-inverse ">Abstract of Canvass</h3>
<br>

  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55"><input type="hidden" class="absno" id="" name="absno">Abstract No.</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55 absno" id=""></div>
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">PR No.</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="priddiv"></div>
  </div>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55"><input type="hidden" id="prno" name="prid">Date</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" ><input type="text" class="form-control date" name="date" placeholder="MM/DD/YYYY">
            </div>
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">RFQ Nos.</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="rfqno"></div>
 
</div>
<hr>



<div class="row pd-x-55">
 
  <div class="col-md-12 bd-b">
    <table class="table table-striped table-bordered">
  <thead class="tx-bold">
    <tr class="tx-16">
      <th class="wd-5p">Stock No.</th>
      <th class="wd-5p">Quantity</th>
      <th class="wd-5p">Unit</th>
      <th class="wd-10p">Item</th>
      <th class="wd-5p">ABC Cost</th>
      <th class="wd-15p tx-center" id="cols" colspan="">Names of Dealers/Stores and Prices Quoted<br> Click the cell below to select the awarded bidder/s.</th>
    </tr>
    <tr id="suppliers">
      <th class="wd-5p"></th>
      <th class="wd-5p"></th>
      <th class="wd-5p"></th>
      <th class="wd-10p"></th>
      <th class="wd-5p"></th>
    </tr>
  </thead>
  <tbody id="prlines" class="tx-inverse"></tbody>

</table>
</div>

<br/>
 <hr>
  <div class="col-md-12 pd-t-10">
     <h6 class="tx-black">Justification:</h6>

     <input class="form-control tx-14 remarks" type="text" name="remarks"  placeholder="Address" />
    </div>

  <hr>


 
<div class="row delivery mg-t-20 pd-t-10">
  <div class="col-md-12">
     <h6>Based on the above abstract of canvass, it is recommended that the awards be made to:</h6>

     <ul class="list-group tx-left" id="list">
      </ul>
    </div>
  </div>
  <hr>
  <div class="row return pd-t-10">
    <div class="col-md-12 tx-left">
      <button type="submit" class="btn btn-primary returnbtn">Submit Abstract</button>
    </div>
  </div>

</div>
  </form>
  </div>

     <div id="mySidenav2" class="sidenav2">

  </div>
<script type="text/javascript">
  var prs = {!!json_encode($prs)!!};
  var array = [];
  var rfid = [];
 
  prs.forEach(function(key){
     array.push(key.no+' | '+key.purpose+' | '+key.date);
  })

  $(document).on('change', '.suppliers', function() {
    var optionSelected = $("option:selected", this).data('address');
    var valueSelected = this;
    console.log('asdasd');
    $(".address").val(optionSelected);
    
});
  $(document).on('click', '.edit', function() {
    $("#mySidenav2").empty();
    
      $.get('{{route ("editrfq", ["id" => ''] )}}'+'/'+$(this).data('id'),
        {
           _token: document.getElementById('token').value,
            rfqs: rfid,
        },
        function(data,status){
          $("#mySidenav2").append(data);
        });
      openNav2();
      });

  $(document).on('click', '.createab', function() {
       var rfnos = '';
       if($('.chk:checked').length == 0){
        swal("Warning!", "Please check at least one RFQ.", "warning");
       }
       else{
          $(".chk:checkbox:checked").each(function() {
          rfid.push($(this).val())
          rfnos += $(this).data('ref')+', ';
       })
          $('#rfqs').val(rfid);
       $("#suppliers").find("th.supp").remove();
       $("#prlines").empty();
       $.get("{{route('getsuppliers')}}",
        {
           _token: document.getElementById('token').value,
            rfqs: rfid,
        },
        function(data,status){
          //console.log(data);
          $(".absno").val(data[0]);
          $(".absno").text(data[0]);
          document.getElementById("cols").colSpan = data[1].length;

          data[1].forEach(function(key){
            var tr = '<th class="wd-15p supp">'+key.supplier+'</th>';
            $('#suppliers').append(tr);
            key.items.forEach(function(keys){
               console.log(keys.items)
               var trs = '';
               console.log(key.id+' '+keys.rfq_id)
              if(key.id == keys.rfq_id && $('#tr'+keys.prlid).length == 0){

                trs = '<tr id="tr'+keys.prlid+'">'+
                           '<td class="wd-10p">'+keys.prlid+'</td>'+
                           '<td class="wd-10p">'+keys.qty+'</td>'+
                           '<td class="wd-10p">'+keys.unit+'</td>'+
                           '<td class="wd-10p">'+keys.name+'</td>'+
                           '<td class="wd-10p">'+keys.total_cost+'</td>';
                         }
                var trsd = '';
               
                var str = (key.id == keys.rfq_id ? '<td class="wd-10p tdclick" data-stock="'+keys.prlid+'" data-item="'+keys.name+'" data-supp="'+key.supplier+'" data-id='+keys.id+' data-rfq='+keys.rfq_id+' onclick="tdclick();">'+keys.total_price+'</td>' : '<td class="wd-10p"></td>')
                 trsd += str;
                        
                console.log(trs);
              $('#prlines').append(trs);
              $('#tr'+keys.prlid).append(trsd);       
                         

            });

          })
        });

       $('#rfqno').text(rfnos);

      openNav();
       }

       
       
    })
  var no = '';
   $(function(){

    

    $('.progress').hide();
    $('.alert').hide();

    $( "#prid" ).autocomplete({
      source: array,
      select: function (e, ui) {
         no = ui.item.value.split('|')
        $("#priddiv").text(no[0]);
        $('#prlist').empty();
        $("#prno").val(no[0]);
        $.get("{{route('getrfqs')}}",
        {
           _token: document.getElementById('token').value,
            id: no[0]
        },
        function(data,status){
          var tr='';
          var trs='';
          var a=1;
           if(status == 'success'){
            //console.log(data)
            var table = document.getElementById('prlist');
            var absht = '';
             data[0].forEach(function(key){
              data[2].forEach(function(i){
                if(key.id == i.rfq_id){
                  absht = '<span class="badge badge-info tx-16">'+i.ref_no+'</span>';
                }
              });
               trs =   '<div class="col-sm-6 col-lg-6 pd-t-5">'+
                        '<div class="card shadow-base bd-0">'+
                          '<div class="card-header bg-transparent d-flex justify-content-between align-items-center">'+
                            '<h6 class="card-title tx-uppercase tx-12 mg-b-0"><input type="checkbox" class="chk" name="rfqs[]" data-ref='+key.ref_no+' value='+key.id+'> '+key.ref_no+'</h6>'+
                            '<span class="tx-12 tx-uppercase tx-inverse">Date: '+key.date+'</span>'+
                          '</div>'+
                          '<div class="card-body">'+
                           '<div class="row">'+
                            '<div class="col-sm-10">'+
                            '<p class="tx-sm tx-inverse tx-medium mg-b-0">Supplier: '+key.name+'</p>'+
                            '<p class="tx-12">PHILGEPS No:'+key.philgeps_no+'</p>'+
                            '</div>'+
                            '<div class="col-sm-2">'+
                            '<span class="badge badge-'+(key.status == 'FOR CANVASS' ? "primary" : "success")+' tx-12">'+key.status+'</span>'+
                            absht+
                             '</div>'+
                            '</div>'+
                            '<div class="row align-items-center">'+
                             ' <table class="table table-responsive mg-b-0 tx-12 table-bordered">'+
                                '<thead>'+
                                  '<tr class="tx-10">'+
                                    '<th class="wd-10p pd-y-5">Stock</th>'+
                                    '<th class="pd-y-5">Description</th>'+
                                    '<th class="pd-y-5">QTY</th>'+
                                    '<th class="pd-y-5 wd-15p tx-center" colspan="2">ABC</th>'+
                                    '<th class="pd-y-5">Unit</th>'+
                                    '<th class="pd-y-5">Unit Price</th>'+
                                    '<th class="pd-y-5 tx-center">Total Price</th>'+
                                  '</tr>'+
                                  '<tr class="tx-10">'+
                                    '<th class="wd-10p pd-y-5"></th>'+
                                    '<th class="pd-y-5"></th>'+
                                    '<th class="pd-y-5"></th>'+
                                    '<th class="pd-y-5">Unit Cost</th>'+
                                    '<th class="pd-y-5">Total Cost</th>'+
                                    '<th class="pd-y-5"></th>'+
                                    '<th class="pd-y-5 tx-center"></th>'+
                                    '<th class="pd-y-5 tx-center"></th>'+
                                  '</tr>'+
                                '</thead>'+
                                 ' <tbody id="rfq'+key.id+'" class="tx-inverse">'+
                                    
                                  '</tbody>'+
                             '</table>'+
                            '</div>'+
                            '<hr>'+
                            '<p class="tx-12 tx-inverse mg-b-0 mg-t-15">Purpose: '+key.purpose+'</p>'+
                          '</div>'+
                        '</div>'+
                      '</div>';
                      $('#prlist').append(trs);
              data[1].forEach(function(keys){
                if(key.id == keys.rfq_id){
                  //console.log(keys.rfq_id);
                    tr = "<tr>"+
                           '<td class="wd-10p">'+keys.stockno+'</td>'+
                           '<td class="wd-10p">'+keys.name+'</td>'+
                           '<td class="wd-10p">'+keys.qty+'</td>'+
                           '<td class="wd-10p">'+keys.unit_cost+'</td>'+
                           '<td class="wd-10p">'+keys.total_cost+'</td>'+
                           '<td class="wd-10p">'+keys.unit+'</td>'+
                           '<td class="wd-10p rfunitp" data-rfq='+keys.rfq_id+' data-id='+keys.id+' data-qty='+keys.qty+' contenteditable="true">'+keys.unit_price+'</td>'+
                           '<td class="wd-10p" contenteditable="true">'+keys.total_price+'</td></tr>';
                            a++;

                        $('#rfq'+keys.rfq_id).append(tr);
                    }
                    
                    
                 });


               });
             
           
            //openNav();
            
           }
      });
    },

    change: function (e, ui) {

        //alert("changed!");
    }
    });


        $('#products').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
          }
        });


    $('.refresh').click(function(){
$('#prlist').empty();
      $.get("{{route('getrfqs')}}",
        {
           _token: document.getElementById('token').value,
            id: no[0]
        },
        function(data,status){
          var tr='';
          var trs='';
          var a=1;
           if(status == 'success'){
            console.log(data)
            var table = document.getElementById('prlist');

             data[0].forEach(function(key){
              var absht = '';
              data[2].forEach(function(i){
                if(key.id == i.rfq_id){
                  absht = '<span class="badge badge-info tx-16">'+i.ref_no+'</span>';
                }
                

              });
               trs =   '<div class="col-sm-6 col-lg-6 pd-t-5">'+
                        '<div class="card shadow-base bd-0">'+
                          '<div class="card-header bg-transparent d-flex justify-content-between align-items-center">'+
                            '<h6 class="card-title tx-uppercase tx-12 mg-b-0"><input type="checkbox" class="chk" name="rfqs[]" data-ref='+key.ref_no+' value='+key.id+'> '+key.ref_no+'</h6>'+
                            '<span class="tx-12 tx-uppercase tx-inverse">Date: '+key.date+'</span>'+
                          '</div>'+
                          '<div class="card-body">'+
                           '<div class="row">'+
                            '<div class="col-sm-10">'+
                            '<p class="tx-sm tx-inverse tx-medium mg-b-0">Supplier: '+key.name+'</p>'+
                            '<p class="tx-12">PHILGEPS No:'+key.philgeps_no+'</p>'+
                            '</div>'+
                            '<div class="col-sm-2">'+
                            '<span class="badge badge-'+(key.status == 'FOR CANVASS' ? "primary" : "success")+' tx-12">'+key.status+'</span>'+
                            absht+
                             '</div>'+
                            '</div>'+
                            '<div class="row align-items-center">'+
                             ' <table class="table table-responsive mg-b-0 tx-12 table-bordered">'+
                                '<thead>'+
                                  '<tr class="tx-10">'+
                                    '<th class="wd-10p pd-y-5">Stock</th>'+
                                    '<th class="pd-y-5">Description</th>'+
                                    '<th class="pd-y-5">QTY</th>'+
                                    '<th class="pd-y-5 wd-15p tx-center" colspan="2">ABC</th>'+
                                    '<th class="pd-y-5">Unit</th>'+
                                    '<th class="pd-y-5">Unit Price</th>'+
                                    '<th class="pd-y-5 tx-center">Total Price</th>'+
                                  '</tr>'+
                                  '<tr class="tx-10">'+
                                    '<th class="wd-10p pd-y-5"></th>'+
                                    '<th class="pd-y-5"></th>'+
                                    '<th class="pd-y-5"></th>'+
                                    '<th class="pd-y-5">Unit Cost</th>'+
                                    '<th class="pd-y-5">Total Cost</th>'+
                                    '<th class="pd-y-5"></th>'+
                                    '<th class="pd-y-5 tx-center"></th>'+
                                    '<th class="pd-y-5 tx-center"></th>'+
                                  '</tr>'+
                                '</thead>'+
                                 ' <tbody id="rfq'+key.id+'" class="tx-inverse">'+
                                    
                                  '</tbody>'+
                             '</table>'+
                            '</div>'+
                            '<hr>'+
                            '<p class="tx-12 tx-inverse mg-b-0 mg-t-15">Purpose: '+key.purpose+'</p>'+
                          '</div>'+
                        '</div>'+
                      '</div>';
                      $('#prlist').append(trs);
              data[1].forEach(function(keys){
                if(key.id == keys.rfq_id){
                  //console.log(keys.rfq_id);
                    tr = "<tr>"+
                           '<td class="wd-10p">'+keys.stockno+'</td>'+
                           '<td class="wd-10p">'+keys.name+'</td>'+
                           '<td class="wd-10p">'+keys.qty+'</td>'+
                           '<td class="wd-10p">'+keys.unit_cost+'</td>'+
                           '<td class="wd-10p">'+keys.total_cost+'</td>'+
                           '<td class="wd-10p">'+keys.unit+'</td>'+
                           '<td class="wd-10p rfunitp" data-rfq='+keys.rfq_id+' data-id='+keys.id+' data-qty='+keys.qty+' contenteditable="true">'+keys.unit_price+'</td>'+
                           '<td class="wd-10p" contenteditable="true">'+keys.total_price+'</td></tr>';
                            a++;

                        $('#rfq'+keys.rfq_id).append(tr);
                    }
                    
                    
                 });


               });
             
           
            //openNav();
            
           }
      });
    })
    $(document).on('click', '.print', function() {
      window.location.href = '{{route ("rfq", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

    $(document).on('keyup', '.rfunitp', function() {
      //console.log('edit')
      var id = $(this).data('id');
      var rfq = $(this).data('rfq');
      //console.log(id);
      var qty = $(this).data('qty');
      var tp = $(this).closest("td").next().text();
      var up = $(this).text();
      var total = parseFloat(qty) * parseFloat(up);
      console.log(up);
      console.log(qty);
      $(this).closest("td").next().text(total);
      clearTimeout($.data(this, 'timer'));
      var wait = setTimeout(saveData(id,up,total, rfq), 1000); // delay after user types
      $(this).data('timer', wait);
    });
    var newp = 0;
function saveData(id, unitp, totalp, rfq) {
  $('.progress').slideDown( "fast");
  $(".progress-bar").animate({
    width: "100%"
}, 500);
    $.post("{{route('updaterfqline')}}",
        {
           _token: document.getElementById('token').value,
            id: id,
            rfq: rfq,
            unitp: unitp,
            totalp, totalp
        },
        function(data,status){
          //console.log(data)
          if(data == 'success'){
            $('.progress').slideUp( "fast");
          }
        });


}
$('.suppliers').on('change', function (e) {
    var optionSelected = $("option:selected", this).data('address');
    var valueSelected = this;
    $(".address").val(optionSelected);
    
});

$('.date').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true,
  numberOfMonths: 2
});
$(document).on('click', '.tdclick', function(){
  if($('#tr'+$(this).data('stock')+':has(td.clicked)')){
    $('#tr'+$(this).data('stock')+' td.tdclick').removeClass('clicked')
    $(this).addClass('clicked');
  }
  else{
    $(this).addClass('clicked');
  }
  addlist();
})

    $('.add').click(function(){
        $('#prno').text($(this).data('name'));
         $('#prpurpose').text($(this).data('purpose'));
         $('#prdate').text($(this).data('date'));
         $('#prpurpose').text($(this).data('purpose'));
       

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
             data.forEach(function(key){
                tr += "<tr>"+
                       '<td class="wd-10p"><input type="checkbox" class="itemchk" data-amount="'+key.total_cost+'" name="items['+a+'][prline_id]" value='+key.id+'></td>'+
                       '<td class="wd-10p">'+key.id+'</td>'+
                       '<td class="wd-10p">'+key.name+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][qty]" value='+key.qty+'>'+key.qty+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][unit]" value='+key.unit+'>'+key.unit+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][unit_cost]" value='+key.unit_cost+'>'+key.unit_cost+'</td>'+
                       '<td class="wd-10p"><input type="hidden" name="items['+a+'][total_cost]" value='+key.total_cost+'>'+key.total_cost+'</td></tr>';
                        a++;
               });
            
            table.innerHTML = tr;
            openNav();
            
           }
      });
        //$('#modaldemo1').modal('show');
        openNav();

    })

    $(document).on('click', '.group', function() {
        $('.name').text($(this).data('name'));
        $('#prodid').val($(this).data('id'));
        $('#price').val($(this).data('price'))
        $('.qty').attr('data-price', $(this).data('price'));
        $('#groupdemo').modal('show');

            $('.tbd').empty();
        $.get("{{route('getrfqlines')}}",
        {
           _token: document.getElementById('token').value,
            id: $(this).data('id')
        },
         function(data,status){
          var tr='';
          var a=1;
           if(status == 'success'){
            console.log(data)
            var table = document.getElementById('prlines');
             data.forEach(function(key){
                tr += "<tr>"+
                       '<td class="wd-10p">'+key.stockno+'</td>'+
                       '<td class="wd-10p">'+key.name+'</td>'+
                       '<td class="wd-10p">'+key.qty+'</td>'+
                       '<td class="wd-10p">'+key.unit+'</td>'+
                       '<td class="wd-10p">'+key.unit_cost+'</td>'+
                       '<td class="wd-10p">'+key.total_cost+'</td>'+
                       '<td class="wd-10p">'+key.unit_price+'</td>'+
                       '<td class="wd-10p">'+key.total_price+'</td></tr>';
                        a++;
               });

            
           }
            $('.tbd').append(tr);
    });
      });

    $(document).on('keyup', '.qty', function(){
      var qty = parseFloat($(this).val());
      var price = $(this).data('price');
      $('#price').val(qty*price);
    })
$(document).on("change", '.itemchk', function(){
  gettotald();
})

function gettotald(){
  var total=0;
  $(".itemchk:checkbox:checked").each(function() {
      total += parseFloat($(this).data('amount'));
    });

    $('#total').val(total.toFixed(2));

    $("#amountwords").val(inWords(total)+"pesos only")

}
});

function addlist(){
  var str = '';
  var a = 1;
  $('#list').empty();
  var total
  $("td.clicked").each(function(){
    var supp = $(this).data('supp');
    var item = $(this).data('item');
    var rfq = $(this).data('rfq');
    var id = $(this).data('id');
    console.log(id);
      str += '<li class="tx-14 tx-inverse bd-b">'+supp+' for items '+item+'</li><input type="hidden" name="abs['+a+'][rfq_id]" value="'+rfq+'"><input type="hidden" name="abs['+a+'][amount]" value="'+$(this).html()+'"><input type="hidden" name="abs['+a+'][id]" value="'+id+'">';
      a++;
      
  })
  $('#list').append(str);
  
}
</script>
@endsection
