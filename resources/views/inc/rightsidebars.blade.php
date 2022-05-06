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
          <label class="sidebar-label pd-x-25 mg-t-25">Items for Request</label>
          <form action="{{route('requestitem')}}" method="POST">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="contact-list pd-x-10" id="itemlist">

            </div><!-- contact-list -->
            <div class=" pd-x-25 mg-t-25">Reason: <input type="text" name="reason"></div>
           <div class=" pd-x-25 mg-t-25"><button class="btn btn-sm btn-primary reqbtn">REQUEST</button></div>
         
           </form>
        </div><!-- #contacts -->
      </div>
    </div>