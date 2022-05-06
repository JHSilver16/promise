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
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{asset('js/jquery.table2excel.js')}}"></script>

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
    width:70px;
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
        width:70px;
        margin-left: -5px;
        padding-right: 5px;
         margin-top:5px; 
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

<input type="hidden" name="type" id="type" value="{{$type}}">
<div class="br-mainpanel"> 
 <div class="br-pagebody tx-roboto">
    <div class="br-section-wrapper">
      <div class="row">
        <div class="col-md-12 tx-center">
          <h4 class="tx-bold tx-black tx-uppercase">National Economic and Development Authority XII</h4>
            <p class="tx-12 lh-xs-1">Brgy. Carpenter Hill, Koronadal City</p>
        </div>
        <h4 class="tx-bold">List of RFQs</h4>
        <hr/>

        <table class="table table-bordered" id="table2excel">
          <thead>
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
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   if(document.getElementById('type').value == 'csv'){
        $("#table2excel").table2excel({
          // exclude CSS class
          exclude: ".noExl",
          name: "Worksheet Name",
          filename: "RFQS", //do not include extension
          fileext: ".xls" // file extension
        });
    } 
  JsBarcode(".barcode").init();
</script>
</body>
</html>