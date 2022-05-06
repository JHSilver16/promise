 <div class="br-sideright">
      <ul class="nav nav-tabs sidebar-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" role="tab" href="#contacts"><i class="fa fa-money-check tx-18"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#attachments"><i class="fa fa-shopping-cart tx-22"></i></a>
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
          <label class="tx-white pd-x-25 mg-t-25">PENDING PURCHASE REQUESTS<span class="badge badge-danger" id="prcount"></span></label>
          <a class="tx-white pd-x-25 mg-t-15 tx-14" href="{{route('kanbanboard')}}">View in Kanban Board</a>
         <div class="contact-list pd-x-10" id="prslist">
            
          </div>
        </div><!-- #contacts -->
         <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="attachments" role="tabpanel">
          <label class="tx-white pd-x-25 mg-t-25">PENDING PURCHASE ORDERS<span class="badge badge-danger" id="prcount"></span></label>
         <div class="contact-list pd-x-10" id="prslist">
            
          </div>
        </div><!-- #contacts -->
      </div>
    </div>

