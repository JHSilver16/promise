
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Twitter -->
<title>NEDA XII Inventory Management System</title>

    <!-- vendor css -->
     <script src="{{asset('js/jquery.min.js')}}"></script>


 <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
-->


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
      
.se-pre-con {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url("{{asset('Preloader_3.gif')}}") center no-repeat #fff;
}
.tooltip {
  display: inline;
  position: relative;
}
.tooltip:hover:after{
  display: -webkit-flex;
  display: flex;
  -webkit-justify-content: center;
  justify-content: center;
  background: #444;
  border-radius: 8px;
  color: #fff;
  content: attr(title);
  margin: -82px auto 0;
  font-size: 16px;
  padding: 13px;
  width: 220px;
}
.tooltip:hover:before{
  border: solid;
  border-width: 12px 6px 0 6px;
  content: "";
  left: 45%;
  bottom: 30px;
  position: absolute;
}
.ui-autocomplete-input {
  border: none; 
  font-size: 14px;
  height: 24px;
  margin-bottom: 5px;
  padding-top: 2px;
  border: 1px solid #DDD !important;
  padding-top: 0px !important;
  z-index: 9999;
  position: relative;
}
.ui-menu .ui-menu-item a {
  font-size: 12px;
}
.ui-autocomplete {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 9999 !important;
  float: left;
  display: none;
  min-width: 160px;
  width: 160px;
  padding: 4px 0;
  margin: 2px 0 0 0;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
}
.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}
.ui-state-hover, .ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
}
td.details-control {
    background: url('{{asset('images/details_open.png')}}') no-repeat center center;
    background-size: 60px 30px;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('{{asset('images/dt-close.png')}}') no-repeat center center;
     background-size: 60px 30px;
}
#loader {
  z-index: 1;
  position: absolute;
    height: 100%;
    width: 100%;
    top:60px;
    background: url("{{asset('images/loader.gif')}}") center no-repeat #fff;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}
.fullname {
  min-width: 120px;
  display: inline-block;
}
.avatar {
    vertical-align: middle;
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.testimonial-group > .row {
  overflow-x: auto;
  white-space: nowrap;
}
.testimonial-group > .row > .col-xs-4 {
  display: inline-block;
  float: none;
}

.sortable { list-style-type: none; margin:0; padding:2px; min-height:30px;}
@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
   transition: margin-left .5s;
  
}
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #fff;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 0px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

.main {
   
}
.sidenav2 {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    background-color: #fff;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
    text-align:center;
}

.sidenav2 a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;

}

.sidenav2 a:hover{
    color: #f1f1f1;
}

.sidenav2 .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav2 {padding-top: 15px;}
  .sidenav2 a {font-size: 18px;}
}

.autocomplete {
  position: relative;
  width: 100%;
  display: inline-block;
}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

.show1 {
  display: block;
}
.noshow{
  display: none;
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
  </style>

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('bracket/css/bracket.css')}}" />

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo tx-35"><a href="./blank.html"><span>[</span>NRO12 <i>SPMIS</i><span>]</span></a></div>
    
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="br-header bg-white">
      <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="./blank.html"><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="./blank.html"><i class="icon ion-navicon-round"></i></a></div>
        <div class="input-group hidden-xs-down wd-170 transition">
          <input id="searchbox" type="text" class="form-control" placeholder="Search" />
          <span class="input-group-btn">
          <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
          </span>
        </div><!-- input-group -->
      </div><!-- br-header-left -->
      <div class="br-header-right">
      <nav class="nav pd-r-20">
        <div class="dropdown">
            <a href="./carousel.html" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name hidden-md-down tx-primary tx-bold">{{auth::user()->name}}</span>
              <img src="{{asset('images/1.png')}}" class="wd-35 rounded-circle" alt="" />
              <span class="square-10 bg-success"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-250">
              <div class="tx-center">
                <a href="#"><img src="{{asset('images/1.png')}}" class="wd-80 rounded-circle" alt="" /></a>
                <h6 class="mg-t-15 mg-b-5 tx-gray-800">{{auth::user()->name}}</h6>
                <p class="tx-12 tx-gray-600">{{auth::user()->email}}</p>
              </div>
              <hr />
              <ul class="list-unstyled user-profile-nav">
                <li><a href="{{route('logout')}}"><i class="icon ion-power"></i> Sign Out</a></li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
      </nav>
      <div class="navicon-right">
          <a id="btnRightMenu" href="" class="pos-relative">
            <i class="icon ion-ios-chatboxes-outline"></i>
            <!-- start: if statement -->
            <span class="square-8 bg-danger pos-absolute t-10 r--5 rounded-circle"></span>
            <!-- end: if statement -->
          </a>
        </div><!-- navicon-right -->
    </div><!-- br-header -->
  </div>
    @include('inc.sidebars')
    @include('inc.rightsidebars')
    <div class="br-mainpanel">

      <div class="br-pagebody">
        @include('inc.messages')
       @yield('content')

      </div><!-- br-pagebody -->

    </div><!-- br-mainpanel -->
   
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="{{asset('bracket/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('bracket/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('bracket/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
    <script src="{{asset('kanban/jkanban.min.js')}}"></script>
    <script src="{{asset('kanban2/js/kanban.js')}}"></script>
    <script src="{{asset('js/flyto.js')}}"></script>
    <script src="{{asset('bracket/lib/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('bracket/lib/moment/moment.js')}}"></script>
    <script src="{{asset('bracket/lib/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('bracket/lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>
    <script src="{{asset('bracket/lib/peity/jquery.peity.js')}}"></script>
    <script src="{{asset('bracket/lib/highlightjs/highlight.pack.js')}}"></script>
    <script src="{{asset('bracket/lib/select2/js/select2.min.js')}}"></script> 
    <script src="{{asset('bracket/lib/jquery-toggles/toggles.min.js')}}"></script>
    <script src="{{asset('bracket/lib/jt.timepicker/jquery.timepicker.js')}}"></script>
    <script src="{{asset('bracket/lib/spectrum/spectrum.js')}}"></script>
    <script src="{{asset('bracket/lib/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <script src="{{asset('bracket/lib/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('bracket/lib/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('bracket/lib/jquery.steps/jquery.steps.js')}}"></script>
   <script src="{{asset('bracket/lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('bracket/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
     <script src="{{asset('bracket/lib/parsleyjs/parsley.js')}}"></script>
     <script src="{{asset('bracket/js/bracket.js')}}"></script>
     
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
 <script src="{{asset('toggles/js/jquery.mswitch.js')}}" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

  </body>
</html>
