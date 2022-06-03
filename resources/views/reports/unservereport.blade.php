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

<div class="br-mainpanel"> 
 <div class="br-pagebody tx-roboto tx-black ">
    <div class="br-section-wrapper">
      <div class="row">
        <div class="col-md-12 tx-center tx-black ">
          <h6 class="tx-bold tx-uppercase">Report on the Physical Count of Property, Plant and Equipment</h6>
            
            <p class="tx-12 lh-xs-1">As at</p>
        </div>
        </div>
        <div class="row tx-black ">
          <div class="col-md-4 tx-bold">Entity Name: <u></u></div>
          <div class="col-md-4 tx-bold"></div>
          <div class="col-md-4 tx-bold">Fund Cluster: <u></u></div>
          <div class="col-sm-3 tx-12">
          <div class="row">
            <div class="col-sm-12 bd-b tx-center">Rosario F. Bautista</div>
            <div class="col-sm-12 tx-center"><i>(Name of Accountable Officer)</i></div>
          </div>
        </div>
        <div class="col-sm-1 tx-12">
        </div>
        <div class="col-sm-3 tx-12">
          <div class="row">
            <div class="col-sm-12 bd-b tx-center">Rosario F. Bautista</div>
            <div class="col-sm-12 tx-center"><i>(Designation)</i></div>
          </div>
        </div>
        <div class="col-sm-1 tx-12">
        </div>
        <div class="col-sm-3 tx-12">
          <div class="row">
            <div class="col-sm-12 bd-b tx-center">Rosario F. Bautista</div>
            <div class="col-sm-12 tx-center"><i>(Station)</i></div>
          </div>
        </div>
        </div>
      <div class="row bd bd-gray-900 bd-2">
        <div class="wd-100p">
        <table class="table table-bordered tx-black ">
          <thead>
            <tr>
              <th colspan="10 " class="tx-center">INVENTORY</th>
              <th colspan="8 " class="tx-center">INSPECTION AND DISPOSAL</th>
            </tr>
            <tr>
              <th rowspan="2" class="wd-15p">Date Acquired</th>
              <th rowspan="2" class="wd-15p">Particulars/Articles</th>
              <th rowspan="2" class="wd-15p">Property No</th>
              <th rowspan="2" class="wd-15p">Qty</th>
              <th rowspan="2" class="wd-15p">Unit Cost</th>
              <th rowspan="2" class="wd-15p">Total Cost</th>
              <th rowspan="2" class="wd-15p">Accumulated Depreciation</th>
              <th rowspan="2" class="wd-15p">Accumulated Impairment Losses</th>
              <th rowspan="2" class="wd-15p">Carrying Amount</th>
              <th rowspan="2" class="wd-15p">Remarks</th>
              <th colspan="5">DISPOSAL</th>
              <th rowspan="2" class="wd-15p">Appraised Value</th>
              <th colspan="2">RECORD OF SALES</th>
            </tr>
            <tr>
              <th rowspan="2" class="wd-15p">Sale</th>
              <th rowspan="2" class="wd-15p">Transfer</th>
              <th rowspan="2" class="wd-15p">Destruction</th>
              <th rowspan="2" class="wd-15p">Others(Specify)</th>
              <th rowspan="2" class="wd-15p">Total.</th>
              <th rowspan="2" class="wd-15p">OR No.</th>
              <th rowspan="2" class="wd-15p">Amount</th>

            </tr>
            
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <tr class="tx-11">
              <td colspan="10">
                <div class="row">
                  <div class="col-sm-12 pd-b-10">I HEREBY request inspection and disposition, pursuant to Section 79 of PD 1445, of the property enumerated above</div>
                  <div class="col-sm-5 tx-12">
                    <div class="row">
                      <div class="col-sm-12 pd-b-20">Requested By: </div>
                      <div class="col-sm-12 bd-b tx-center bd-b">Rosario F. Bautista</div>
                      <div class="col-sm-12 tx-center">(Signature over Printed Name of Accountable Officer)</div>
                      <div class="col-sm-12 tx-center bd-b"></div>
                      <div class="col-sm-12 tx-center">(Designation of Accountable Officer)</div>
                    </div>
                  </div>
                  <div class="col-sm-1 tx-12">
                  </div>
                  <div class="col-sm-5 tx-12 ">
                    <div class="row">
                       <div class="col-sm-12 pd-b-20">Approved By: </div>
                      <div class="col-sm-12 bd-b tx-center">Teresita Socorro C. Ramos</div>
                      <div class="col-sm-12 tx-center">(Signature over Printed Name of Authorized Official)</div>
                      <div class="col-sm-12 tx-center bd-b"></div>
                      <div class="col-sm-12 tx-center">(Designation of Authorized Official)</div>
                    </div>
                  </div>
                </div>
              </td>
              <td colspan="8">
                <div class="row">
                  <div class="col-sm-5 tx-12">
                    <div class="row">
                      <div class="col-sm-12 pd-b-20">I CERTIFY that I have inspectd each and every article enumerated in this report, and that the disposition made thereof was, in my judgment, the best for the public interest.</div>
                      <div class="col-sm-12 bd-b tx-center bd-b">Rosario F. Bautista</div>
                      <div class="col-sm-12 tx-center">(Signature over Printed Name of Inspection Officer)</div>
                    </div>
                  </div>
                  <div class="col-sm-1 tx-12">
                  </div>
                  <div class="col-sm-5 tx-12 ">
                    <div class="row">
                      <div class="col-sm-12 pd-b-20">I CERTIFY that I have witnessed the disposition of the articles enumerated on this report <u></u> day of <u></u>, <u></u>.</div>
                      <div class="col-sm-12 bd-b tx-center tx-white">name</div>
                      <div class="col-sm-12 tx-center">(Signature over Printed Name of Witness)</div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    </div>
  </div>
</div>
<script type="text/javascript">
  JsBarcode(".barcode").init();
</script>
</body>
</html>