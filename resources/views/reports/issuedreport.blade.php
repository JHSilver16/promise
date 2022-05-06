
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard." />
    <meta name="author" content="ThemePixels" />

       <title>NEDA XII Inventory Management System</title>

    <!-- vendor css -->
       <!-- vendor css -->
     <script src="{{asset('js/jquery.min.js')}}"></script>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     
      <script src="{{asset('js/amountwords.js')}}"></script>
      <script src="{{asset('js/auto.js')}}"></script>
      <script src="{{asset('js/jsbarcode.min.js')}}"></script>
    <link href="{{asset('bracket/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{asset('bracket/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet" />
    <link href="{{asset('bracket/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />

     <link href="{{asset('bracket/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet" />
    <link href="{{asset('bracket/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet" />
     <link href="{{asset('bracket/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet" />
    <link href="{{asset('bracket/lib/jquery.steps/jquery.steps.css')}}" rel="stylesheet" />
    <link href="{{asset('bracket/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet" />
    
      <link href="{{asset('bracket/lib/highlightjs/github.css')}}" rel="stylesheet" />
    <!-- Bracket CSS -->
    <link href="{{asset('bracket/lib/SpinKit/spinkit.css')}}" rel="stylesheet" />
   
    <link href="{{asset('bracket/lib/summernote/summernote-bs4.css')}}" rel="stylesheet" />
    <link href="{{asset('bracket/lib/select2/css/select2.min.css')}}" rel="stylesheet" />
      <link href="{{asset('bracket/lib/jquery-toggles/toggles-full.css')}}" rel="stylesheet" />
   <link rel="stylesheet" href="{{asset('kanban/jkanban.min.css')}}">
   <link rel="stylesheet" href="{{asset('css/table.css')}}">
      <link rel="stylesheet" href="{{asset('kanban2/css/kanban.css')}}">
    <link rel="stylesheet" href="{{asset('bracket/css/bracket.css')}}" />
      <link href="{{asset('toggles/css/jquery.mswitch.css')}}" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>
  <script src=" https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


   <style type="text/css">
     .hidden { display: none; }
        .no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url("{{asset('Preloader_3.gif')}}") center no-repeat #fff;
}
td.details-control {
    background: url('{{asset('images/details_open.png')}}') no-repeat center center;
    background-size: 60px 30px;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('{{asset('images/details_close.png')}}') no-repeat center center;
     background-size: 40px 40px;
}
.poweredbyLogo{
    width:40px;
}
.pagebreak { page-break-before: always; } 
.pb{page-break-inside: avoid;}
 #logoframe{
        height:0px;
        margin-top:5px;
    }
    .page-break { display: block; page-break-before: always; }
    @media print {
    .test {
      page-break-after: always;
    }

    .poweredbyLogo{
        width:40px;
    }
    .thead-colored{
      -webkit-print-color-adjust: exact;
    }
    .br-pagebody{
      margin-top:-20px;
    }
    #logoframe{
        height:80px;
        margin-top:6px;
    }
    .tx-white {
    color: #fff !important;
    -webkit-print-color-adjust: exact;
    /*put your styles here*/
  }
.pagebreak { page-break-before: always; } 
.pb{page-break-inside: avoid;}
  .spc{
    margin-top: -5px
  }
  
  }

   </style>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

  <body class="collapsed-menu with-subleft">

<div class="br-mainpanel"> 
 <div class="br-pagebody tx-roboto tx-inverse">
    <div class="br-section-wrapper">
      <div class="row pd-t-25">
        <div class="col-sm-12 pd-l-15 tx-right float-center">
          Appendix 58
        </div>
      </div>
       <div class="row pd-t-15">
        <div class="col-sm-12 tx-center">
      <h6 class="tx-bold tx-center">REPORTS OF SUPPLIES AND MATERIALS ISSUED</h6>
    </div>
       </div>
       <div class="row pd-t-5">
         <div class="col-sm-4 pd-r-5">Entity Name: {{$master->name}}</div>          
         
         <div class="col-sm-4"></div>
         <div class="col-sm-2">Serial Number: </div>

         <div class="col-sm-2 pd-r-5">Fund Cluster: </div>          
         
         <div class="col-sm">Date: As of {{$date}}</div>  
       </div>
      

       <div class="row bd bd-gray-900 bd-2">
        <div class="wd-100p">
         <table class="table-bordered tx-12 wd-100p">
          <thead class="bd bd-2">

            <tr>
              <th>RIS No.</th>           
              <th>RCC</th>
              <th>Stock No.</th>
              <th>Item</th>
              <th>Unit</th>           
              <th>Quantity Issued</th>
              <th>Unit Cost</th>
              <th>Amount</th>    
            </tr>
          </thead>
          <tbody class="bd">
            @foreach($inventory as $inv)
              <tr>
                <td>{{$inv['refno']}}</td>
                <td>{{$inv['refno']}}</td>
                <td>{{$inv['stock']}}</td>
                <td>{{$inv['item']}}</td>
                <td>{{$inv['unit']}}</td>
                <td>{{$inv['isqty']}}</td>
                <td>{{$inv['isuc']}}</td>
                <td>{{$inv['istc']}}</td>
                <td></td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td>Ending Balance: </td>
              <td colspan="5"></td>
            </tr>
          </tfoot>
         </table>

         </div>
       </div>
          <div class="row tx-12 pd-t-5 pd-b-5 bd bd-gray-900 bd-2">


        </div>
    </div>
</div>
<script type="text/javascript">
  JsBarcode(".barcode").init();
</script>
</body>
</html>