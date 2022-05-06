@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('home')}}">Home</a>
          <span class="breadcrumb-item active">Settings</span>
        </nav>
      </div><!-- br-pageheader -->


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Dashboard</h6>

        <div class="row row-sm">
          <div class="col-sm-6 col-xl-3">
            <div class="bg-teal rounded overflow-hidden">
              <div class="pd-25 d-flex align-items-center">
                <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Items in the Inventory</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$count[0]}}</p>
                  <span class="tx-11 tx-roboto tx-white-6"></span>
                </div>
              </div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="bg-danger rounded overflow-hidden">
              <div class="pd-25 d-flex align-items-center">
                <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Depleted Items</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$count[1]}}</p>
                  <span class="tx-11 tx-roboto tx-white-6"></span>
                </div>
              </div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-primary rounded overflow-hidden">
              <div class="pd-25 d-flex align-items-center">
                <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Items not yet in the Inventory</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$count[2]}}</p>
                  <span class="tx-11 tx-roboto tx-white-6"></span>
                </div>
              </div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-br-primary rounded overflow-hidden">
              <div class="pd-25 d-flex align-items-center">
                <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Pending PRS</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{count($prs)}}</p>
                  <span class="tx-11 tx-roboto tx-white-6"></span>
                </div>
              </div>
            </div>
          </div><!-- col-3 -->
        </div><!-- row -->

         <div class="row row-sm mg-t-20">
          <div class="col-lg-2">
            <div class="card bd-0 shadow-base pd-30">
              <h6 class="tx-16 tx-uppercase tx-inverse tx-semibold tx-spacing-1">ITEMS AT DANGER LEVEL</h6>
              <hr/>
              @foreach($items as $item)
                <label class="tx-12 tx-gray-900 mg-b-10">{{$item->name.' '.$item->qty_instock.'/'.$item->danger_lvl}}</label>
                <div class="progress ht-5 mg-b-10">
                  <div class="progress-bar wd-25p" role="progressbar" aria-valuenow="{{$item->qty_instock}}" aria-valuemin="0" aria-valuemax="{{$item->danger_lvl}}"></div>
                </div>
              @endforeach
              
            </div><!-- card -->
          </div>
          <div class="col-lg-10">
            <div class="card shadow-base bd-0">
              <div class="card-header bg-transparent pd-20 d-flex align-items-center justify-content-between">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Item Requests from Employees</h6>
                <button  class="btn btn-sm btn-info tx-uppercase add">Add to item list</button>
              </div><!-- d-flex -->
              <form action="{{route('submititem')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                 <input type="hidden" name="id" id="id">
                 <input type="hidden" name="type" id="type" value="bulk">
              <table class="table table-responsive mg-b-0 tx-12">
                <thead>
                  <tr class="tx-10">
                    <th class="pd-y-5"></th>
                    <th class="pd-y-5">Item</th>
                    <th class="pd-y-5">Requesting Employee</th>
                    <th class="pd-y-5">Qty</th>
                    <th class="pd-y-5">Reason</th>
                    <th class="pd-y-5">Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($reqs as $req)
                  <tr>
                   <td><input type="checkbox" class="chk" name="items[{{$req->id}}][id]" value="{{$req->id}}"></td>
                    <td>
                      <a href="#" class="tx-inverse tx-14 tx-medium d-block">{{$req->item}}</a>
                    </td>
                    <td class="hide">
                      <a href="#" class="tx-inverse tx-14 tx-medium d-block">{{$req->last_name.' '.$req->first_name}}</a>
                    </td>
                    <td class="hide">
                      <a href="#" class="tx-inverse tx-14 tx-medium d-block">{{$req->qty}}</a>
                    </td>
                    <td class="hide">
                      <a href="#" class="tx-inverse tx-14 tx-medium d-block">{{$req->reason}}</a>
                    </td>
                    <td class="hide">
                      <a href="#" class="tx-inverse tx-14 tx-medium d-block">{{$req->created_at}}</a>
                    </td>
                    <td class="showtd">
                      <input type="text" name="items[{{$req->id}}][desc]" class="form-control" placeholder="Enter Description">
                    </td>
                    <td class="showtd">
                      <select class="form-control select2" name="items[{{$req->id}}][typeid]" style="width: 100%;" name="typeid">
                        @foreach($categories as $pt)
                            <option value="{{$pt->id}}">{{$pt->name}}</option>
                          @endforeach
                      </select>
                      
                    </td>
                    <td class="showtd">
                       <select class="form-control select2" style="width: 100%;" name="items[{{$req->id}}][unittype]">
                        @foreach($units as $pt)
                          <option value="{{$pt->id}}">{{$pt->name}}</option>
                        @endforeach
                    </select>
                     
                    </td>
                    <td class="showtd">
                      <input type="text" class="form-control" name="items[{{$req->id}}][cost]" placeholder="Enter Unit Cost">
                    </td>
                    
                  </tr>
                 @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td class="showtd" colspan="4"><button class="btn btn-sm btn-success">Submit</button></td>
                  </tr>
                </tfoot>
              </table>
              </form>
              <div class="card-footer tx-12 pd-y-15 bg-transparent">
                <a href="#"><i class="fa fa-angle-down mg-r-5"></i></a>
              </div><!-- card-footer -->
            </div><!-- card -->
          </div><!-- col-6 -->

          
      </div>
      <div class="row mg-t-20">
                  <div class="col-lg-12">
            <div class="card shadow-base bd-0">
              <div class="card-header bg-transparent pd-20">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">PENDING PRS</h6>
              </div><!-- card-header -->
              <table class="table table-responsive mg-b-0 tx-12">
                <thead>
                  <tr class="tx-10">
                    <th class="pd-y-5">PR NO</th>
                    <th class="pd-y-5">Purpose</th>
                    <th class="pd-y-5">Requesting Employee</th>
                    <th class="pd-y-5">Date</th>
                  </tr>
                </thead>
                <tbody>
                   @foreach($prs as $pr)
                  <tr>
                   
                    <td>
                      <a href="#" class="tx-inverse tx-14 tx-medium d-block">{{$pr->ref_no}}</a>
                    </td>
                    <td>
                      <a href="#" class="tx-inverse tx-14 tx-medium d-block">{{$pr->purpose}}</a>
                    </td>
                    <td>
                      <a href="#" class="tx-inverse tx-14 tx-medium d-block">{{$pr->last_name.' '.$pr->first_name}}</a>
                    </td>
                    
                    <td>
                      <a href="#" class="tx-inverse tx-14 tx-medium d-block">{{$pr->date}}</a>
                    </td>
                    
                    
                  </tr>
                 @endforeach
                </tbody>
              </table>
              <div class="card-footer tx-12 pd-y-15 bg-transparent">
                <a href="{{route('prs')}}"><i class="fa fa-angle-down mg-r-5"></i>View All PRS</a>
              </div><!-- card-footer -->
            </div><!-- card -->
          </div><!-- col-6 -->
      </div>
      </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.showtd').hide();

      $('.add').click(function(){
        if($(this).text() == 'Cancel'){
          $('.hide').show();
        $('.showtd').hide();
        $(this).text('Add to item list');
        }
        else{
          $('.hide').hide();
          $('.showtd').show();
          $(this).text('Cancel');
        }
        

      })
    })
  </script>
 @endsection