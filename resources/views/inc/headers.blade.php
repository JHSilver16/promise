 
<!--   <div class="br-header d-flex align-items-center mg-t-0">
<h4 class="mg-b-0 tx-uppercase tx-bold tx-20 pd-r-20 tx-inverse tx-poppins mg-r-0">Neocash Lending Inc.</h4>
<ul class="nav nav-effect nav-effect-7 tx-uppercase tx-bold tx-spacing-2 flex-column flex-sm-row " role="tablist">
  <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#" role="tab">Home</a></li>
  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#" role="tab">Employees</a></li>
  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#" role="tab">Services</a></li>
  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#" role="tab">Blog</a></li>
  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#" role="tab">Contact</a></li>
</ul>
 -->
<div class="br-header bg-primary">
      <div class="br-header-left navbar">
        <a class="navbar-brand tx-bold tx-uppercase tx-white" href="#">NEDA XII Property and Supply Management Information System</a>
      </div><!-- br-header-left -->
       <div class="br-header-right">
      <nav class="nav pd-r-20">

        <div class="dropdown">
            <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name hidden-md-down tx-white tx-bold">{{auth::user()->name}}</span>
              <img src="{{asset('images/'.auth::user()->usertype_id.'.png')}}" class="wd-35 rounded-circle" alt="" />
              <span class="square-10 bg-success"></span>
              <span class="square-10 bg-success"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-250">
              <div class="tx-center">
                <a href="#"><img src="{{asset('images/'.auth::user()->usertype_id.'.png')}}" class="wd-80 rounded-circle" alt="" /></a>
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
            <i class="icon ion-ios-bell-outline tx-24 tx-white"></i>
            <!-- start: if statement -->
            <span class="bg-danger pos-absolute badge tx-10" id="notif"></span>
            <!-- end: if statement -->
          </a>
        </div><!-- navicon-right -->
</div>
    </div><!-- br-header -->
<nav class="navbar navbar-expand-lg navbar-light bg-white ">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse align-items-center justify-content-center" id="navbarNavAltMarkup">
    <div class="navbar-nav">
     <ul class="nav nav-effect nav-effect-7 tx-uppercase tx-light tx-spacing-2 flex-column flex-md-row" role="tablist">
      <li class="nav-item"><a class="nav-link"  href="{{route('dashboard')}}" role="tab">Dashboard</a></li>
      <li class="nav-item"><a class="nav-link"  href="{{route('items')}}" role="tab">Items and Inventory</a>
      </li>
<div class="dropdown">
  <a href="" class="tx-gray-800 d-inline-block nav-link" data-toggle="dropdown">
    Forms
  </a>
  <div class="dropdown-menu pd-10 wd-300">
    <nav class="nav nav-style-1 flex-column">
      <a href="{{route('prs')}}" class="nav-link"><i class="fa fa-money-check fa-xs"></i> Purchases Requests</a>
      <a href="{{route('rfqs')}}" class="nav-link"><i class="fa fa-clipboard-list fa-xs"></i>Request for Quotations</a>
      <a href="{{route('abstracts')}}" class="nav-link"><i class="fa fa-th-list fa-xs"></i> Abstracts</a>
      <a href="{{route('pos')}}" class="nav-link"><i class="fa fa-shopping-cart fa-xs"></i> Purchases Orders with IAR </a>
      <a href="{{route('ris')}}" class="nav-link"><i class="icon ion-ios-download"></i>Requisition and Issue</a>
    </nav>
  </div><!-- dropdown-menu -->
</div>
<li>
</li>



<li class="nav-item"><a class="nav-link"  href="{{route('reportview')}}" role="tab">Reports</a>
      </li>
@if(auth::user()->usertype_id == 3)
<li class="nav-item"><a class="nav-link"  href="{{route('users')}}" role="tab">Users</a>
      </li>
@endif
<li class="nav-item">

<div class="dropdown">
  <a href="" class="tx-gray-800 d-inline-block nav-link" data-toggle="dropdown">
    Maintenance
  </a>
  <div class="dropdown-menu pd-10 wd-300">
    <nav class="nav nav-style-1 flex-column">
      <a href="{{route('categories')}}" class="nav-link"><i class="icon ion-ios-person"></i>Item Categories</a>
      <a href="{{route('units')}}" class="nav-link"><i class="fa fa-pencil-ruler fa-xs"></i> Units</a>
      <a href="{{route('suppliers')}}" class="nav-link"><i class="fa fa-truck fa-xs"></i>Suppliers</a>
      <a href="" class="nav-link"><i class="icon ion-ios-person"></i>User Types</a>
    </nav>
  </div><!-- dropdown-menu -->
</div>
</li>

    </ul>
    </div>
  </div>
</nav>


    <div class="br-sideright">
      <ul class="nav nav-tabs sidebar-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" role="tab" href="#contacts"><i class="icon ion-ios-contact-outline tx-24"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#attachments"><i class="icon ion-ios-folder-outline tx-22"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#calendar"><i class="icon ion-ios-calendar-outline tx-24"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#settings"><i class="icon ion-ios-gear-outline tx-24"></i></a>
        </li>
      </ul><!-- sidebar-tabs -->

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto active" id="contacts" role="tabpanel">
          <label class="sidebar-label pd-x-25 mg-t-25">Online Contacts</label>
          <div class="contact-list pd-x-10">
            <a href="./cards.html" class="contact-list-link new">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img2.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-success"></div>
                </div>
                <div class="contact-person">
                  <p class="mg-b-0">Marilyn Tarter</p>
                  <span class="tx-12 op-5 d-inline-block">Clemson, CA</span>
                </div>
                <span class="tx-info tx-12"><span class="square-8 bg-info rounded-circle"></span> 1 new</span>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
            <a href="./cards.html" class="contact-list-link">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img3.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-success"></div>
                </div>
                <div class="mg-l-10">
                  <p class="mg-b-0 ">Belinda Connor</p>
                  <span class="tx-12 op-5 d-inline-block">Fort Kent, ME</span>
                </div>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
            <a href="./cards.html" class="contact-list-link new">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img4.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-success"></div>
                </div>
                <div class="contact-person">
                  <p class="mg-b-0">Britanny Cevallos</p>
                  <span class="tx-12 op-5 d-inline-block">Shiboygan Falls, WI</span>
                </div>
                <span class="tx-info tx-12"><span class="square-8 bg-info rounded-circle"></span> 3 new</span>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
            <a href="./cards.html" class="contact-list-link new">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img5.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-success"></div>
                </div>
                <div class="contact-person">
                  <p class="mg-b-0">Brandon Lawrence</p>
                  <span class="tx-12 op-5 d-inline-block">Snohomish, WA</span>
                </div>
                <span class="tx-info tx-12"><span class="square-8 bg-info rounded-circle"></span> 1 new</span>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
            <a href="./cards.html" class="contact-list-link">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img6.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-success"></div>
                </div>
                <div class="contact-person">
                  <p class="mg-b-0">Andrew Wiggins</p>
                  <span class="tx-12 op-5 d-inline-block">Springfield, MA</span>
                </div>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
            <a href="./cards.html" class="contact-list-link">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img7.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-success"></div>
                </div>
                <div class="contact-person">
                  <p class="mg-b-0">Theodore Gristen</p>
                  <span class="tx-12 op-5 d-inline-block">Nashville, TN</span>
                </div>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
            <a href="./cards.html" class="contact-list-link">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img8.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-success"></div>
                </div>
                <div class="contact-person">
                  <p class="mg-b-0">Deborah Miner</p>
                  <span class="tx-12 op-5 d-inline-block">North Shore, CA</span>
                </div>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
          </div><!-- contact-list -->


          <label class="sidebar-label pd-x-25 mg-t-25">Offline Contacts</label>
          <div class="contact-list pd-x-10">
            <a href="./cards.html" class="contact-list-link">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img2.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-gray-500"></div>
                </div>
                <div class="contact-person">
                  <p class="mg-b-0">Marilyn Tarter</p>
                  <span class="tx-12 op-5 d-inline-block">Clemson, CA</span>
                </div>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
            <a href="./cards.html" class="contact-list-link">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img3.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-gray-500"></div>
                </div>
                <div class="mg-l-10">
                  <p class="mg-b-0">Belinda Connor</p>
                  <span class="tx-12 op-5 d-inline-block">Fort Kent, ME</span>
                </div>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
            <a href="./cards.html" class="contact-list-link">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img4.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-gray-500"></div>
                </div>
                <div class="contact-person">
                  <p class="mg-b-0">Britanny Cevallos</p>
                  <span class="tx-12 op-5 d-inline-block">Shiboygan Falls, WI</span>
                </div>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
            <a href="./cards.html" class="contact-list-link">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img5.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-gray-500"></div>
                </div>
                <div class="contact-person">
                  <p class="mg-b-0">Brandon Lawrence</p>
                  <span class="tx-12 op-5 d-inline-block">Snohomish, WA</span>
                </div>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
            <a href="./cards.html" class="contact-list-link">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img6.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-gray-500"></div>
                </div>
                <div class="contact-person">
                  <p class="mg-b-0">Andrew Wiggins</p>
                  <span class="tx-12 op-5 d-inline-block">Springfield, MA</span>
                </div>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
            <a href="./cards.html" class="contact-list-link">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img7.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-gray-500"></div>
                </div>
                <div class="contact-person">
                  <p class="mg-b-0">Theodore Gristen</p>
                  <span class="tx-12 op-5 d-inline-block">Nashville, TN</span>
                </div>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
            <a href="./cards.html" class="contact-list-link">
              <div class="d-flex">
                <div class="pos-relative">
                  <img src="../img/img8.jpg" class="wd-40 rounded-circle" alt="" />
                  <div class="contact-status-indicator bg-gray-500"></div>
                </div>
                <div class="contact-person">
                  <p class="mg-b-0">Deborah Miner</p>
                  <span class="tx-12 op-5 d-inline-block">North Shore, CA</span>
                </div>
              </div><!-- d-flex -->
            </a><!-- contact-list-link -->
          </div><!-- contact-list -->

        </div><!-- #contacts -->


        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="attachments" role="tabpanel">
          <label class="sidebar-label pd-x-25 mg-t-25">Recent Attachments</label>
          <div class="media-file-list">
            <div class="media">
              <div class="pd-10 bg-gray-500 bg-mojito wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
                <i class="fa fa-file-image-o tx-28 tx-white"></i>
              </div>
              <div class="media-body">
                <p class="mg-b-0 tx-13">IMG_43445</p>
                <p class="mg-b-0 tx-12 op-5">JPG Image</p>
                <p class="mg-b-0 tx-12 op-5">1.2mb</p>
              </div><!-- media-body -->
              <a href="./cards.html" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
            </div><!-- media -->
            <div class="media mg-t-20">
              <div class="pd-10 bg-gray-500 bg-purple wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
                <i class="fa fa-file-video-o tx-28 tx-white"></i>
              </div>
              <div class="media-body">
                <p class="mg-b-0 tx-13">VID_6543</p>
                <p class="mg-b-0 tx-12 op-5">MP4 Video</p>
                <p class="mg-b-0 tx-12 op-5">24.8mb</p>
              </div><!-- media-body -->
              <a href="./cards.html" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
            </div><!-- media -->
            <div class="media mg-t-20">
              <div class="pd-10 bg-gray-500 bg-reef wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
                <i class="fa fa-file-word-o tx-28 tx-white"></i>
              </div>
              <div class="media-body">
                <p class="mg-b-0 tx-13">Tax_Form</p>
                <p class="mg-b-0 tx-12 op-5">Word Document</p>
                <p class="mg-b-0 tx-12 op-5">5.5mb</p>
              </div><!-- media-body -->
              <a href="./cards.html" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
            </div><!-- media -->
            <div class="media mg-t-20">
              <div class="pd-10 bg-gray-500 bg-firewatch wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
                <i class="fa fa-file-pdf-o tx-28 tx-white"></i>
              </div>
              <div class="media-body">
                <p class="mg-b-0 tx-13">Getting_Started</p>
                <p class="mg-b-0 tx-12 op-5">PDF Document</p>
                <p class="mg-b-0 tx-12 op-5">12.7mb</p>
              </div><!-- media-body -->
              <a href="./cards.html" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
            </div><!-- media -->
            <div class="media mg-t-20">
              <div class="pd-10 bg-gray-500 bg-firewatch wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
                <i class="fa fa-file-pdf-o tx-28 tx-white"></i>
              </div>
              <div class="media-body">
                <p class="mg-b-0 tx-13">Introduction</p>
                <p class="mg-b-0 tx-12 op-5">PDF Document</p>
                <p class="mg-b-0 tx-12 op-5">7.7mb</p>
              </div><!-- media-body -->
              <a href="./cards.html" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
            </div><!-- media -->
            <div class="media mg-t-20">
              <div class="pd-10 bg-gray-500 bg-mojito wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
                <i class="fa fa-file-image-o tx-28 tx-white"></i>
              </div>
              <div class="media-body">
                <p class="mg-b-0 tx-13">IMG_43420</p>
                <p class="mg-b-0 tx-12 op-5">JPG Image</p>
                <p class="mg-b-0 tx-12 op-5">2.2mb</p>
              </div><!-- media-body -->
              <a href="./cards.html" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
            </div><!-- media -->
            <div class="media mg-t-20">
              <div class="pd-10 bg-gray-500 bg-mojito wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
                <i class="fa fa-file-image-o tx-28 tx-white"></i>
              </div>
              <div class="media-body">
                <p class="mg-b-0 tx-13">IMG_43447</p>
                <p class="mg-b-0 tx-12 op-5">JPG Image</p>
                <p class="mg-b-0 tx-12 op-5">3.2mb</p>
              </div><!-- media-body -->
              <a href="./cards.html" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
            </div><!-- media -->
            <div class="media mg-t-20">
              <div class="pd-10 bg-gray-500 bg-purple wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
                <i class="fa fa-file-video-o tx-28 tx-white"></i>
              </div>
              <div class="media-body">
                <p class="mg-b-0 tx-13">VID_6545</p>
                <p class="mg-b-0 tx-12 op-5">AVI Video</p>
                <p class="mg-b-0 tx-12 op-5">14.8mb</p>
              </div><!-- media-body -->
              <a href="./cards.html" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
            </div><!-- media -->
            <div class="media mg-t-20">
              <div class="pd-10 bg-gray-500 bg-reef wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
                <i class="fa fa-file-word-o tx-28 tx-white"></i>
              </div>
              <div class="media-body">
                <p class="mg-b-0 tx-13">Secret_Document</p>
                <p class="mg-b-0 tx-12 op-5">Word Document</p>
                <p class="mg-b-0 tx-12 op-5">4.5mb</p>
              </div><!-- media-body -->
              <a href="./cards.html" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
            </div><!-- media -->
          </div><!-- media-list -->
        </div><!-- #history -->
        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="calendar" role="tabpanel">
          <label class="pd-x-25 mg-t-25 tx-gray-300">Time &amp; Date</label>
          <div class="pd-x-25">
            <h2 id="brTime" class="br-time"></h2>
            <h6 id="brDate" class="br-date tx-gray-300"></h6>
          </div>

          <label class="sidebar-label pd-x-25 mg-t-25">Events Calendar</label>
          <div class="datepicker sidebar-datepicker"></div>


          <label class="sidebar-label pd-x-25 mg-t-25">Event Today</label>
          <div class="pd-x-25">
            <div class="list-group sidebar-event-list mg-b-20">
              <div class="list-group-item">
                <div>
                  <h6>Roven's 32th Birthday</h6>
                  <p>2:30PM</p>
                </div>
                <a href="./cards.html" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
              </div><!-- list-group-item -->
              <div class="list-group-item">
                <div>
                  <h6>Regular Workout Schedule</h6>
                  <p>7:30PM</p>
                </div>
                <a href="./cards.html" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
              </div><!-- list-group-item -->
            </div><!-- list-group -->

            <a href="./cards.html" class="btn btn-block btn-outline-secondary tx-uppercase tx-12 tx-spacing-2">+ Add Event</a>
            <br />
          </div>

        </div>
        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="settings" role="tabpanel">
          <label class="sidebar-label pd-x-25 mg-t-25">Quick Settings</label>

          <div class="sidebar-settings-item">
            <h6 class="tx-13 tx-normal">Sound Notification</h6>
            <p class="op-5 tx-13">Play an alert sound everytime there is a new notification.</p>
            <div class="pos-relative">
              <input type="checkbox" name="checkbox" class="switch-button" checked="" />
            </div>
          </div>

          <div class="sidebar-settings-item">
            <h6 class="tx-13 tx-normal">2 Steps Verification</h6>
            <p class="op-5 tx-13">Sign in using a two step verification by sending a verification code to your phone.</p>
            <div class="pos-relative">
              <input type="checkbox" name="checkbox2" class="switch-button" />
            </div>
          </div>

          <div class="sidebar-settings-item">
            <h6 class="tx-13 tx-normal">Location Services</h6>
            <p class="op-5 tx-13">Allowing us to access your location</p>
            <div class="pos-relative">
              <input type="checkbox" name="checkbox3" class="switch-button" />
            </div>
          </div>

          <div class="sidebar-settings-item">
            <h6 class="tx-13 tx-normal">Newsletter Subscription</h6>
            <p class="op-5 tx-13">Enables you to send us news and updates send straight to your email.</p>
            <div class="pos-relative">
              <input type="checkbox" name="checkbox4" class="switch-button" checked="" />
            </div>
          </div>

          <div class="sidebar-settings-item">
            <h6 class="tx-13 tx-normal">Your email</h6>
            <div class="pos-relative">
              <input type="email" name="email" class="form-control" value="janedoe@domain.com" />
            </div>
          </div>

          <div class="pd-y-20 pd-x-25">
            <h6 class="tx-13 tx-normal tx-white mg-b-20">More Settings</h6>
            <a href="./cards.html" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">Account Settings</a>
            <a href="./cards.html" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">Privacy Settings</a>
          </div>

        </div>
      </div><!-- tab-content -->

    </div><!-- br-sideright -->

    

    
      <!-- <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a></div>input-group
      </div> --><!-- br-header-left -->

      <!-- br-header-right -->
    </div><!-- br-header -->

    <script type="text/javascript">
       $(document).ready(function(){
       $('#employeroptions').hide();
     });

      function show(){
        $( "#employeroptions" ).slideDown( "slow", function() {
            });
      }
     $(document).on('click', ".close", function(){
         $( "#employeroptions" ).slideUp( "slow", function() {
            });
   });

    </script>