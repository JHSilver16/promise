@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
  <nav class="breadcrumb pd-0 mg-0 tx-12">
    <a class="breadcrumb-item" href="{{route('dashboard')}}">Home</a>
    <span class="breadcrumb-item active">Kanban Board</span>
  </nav>
</div>

<div class="br-pagebody">
  <div class="br-section-wrapper">
     <div class="d-sm-flex align-items-center pd-t-10">
        <i class="fas fa-credit-card tx-50 lh-0 tx-gray-800"></i>
        <div class="pd-sm-l-20">
          <h4 class="tx-gray-800 mg-b-5">Kanban Board</h4>
          <p class="mg-b-0 tx-black">As of {{$date}}</p>
        </div>
      </div><!-- d-flex -->
    <div class="row pd-t-40 align-items-center">
        
        <div class="col-md-3">
            <form method="POST"  action="{{route('searchkanban')}}">
                 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="tx-16"> Filter by date: </div>

            <div class="input-group">
             
              <input type="text" class="form-control" name="daterange" placeholder="Username">
               <button type="submit" class="btn btn-primary"><i class="fa fa-search tx-16 lh-0 op-6"></i></button>
            </div>
            </form>
        </div>
        
        <div class="col-md-3">
        </div>
        <div class="col-md-3">
        </div>
        <div class="col-sm-3 tx-right">
            <input class="form-control searchpending" placeholder="Search.." type="text" onKeyPress="edValueKeyPress()" onKeyUp="edValueKeyPress()">
        </div>
    </div>    
    <div class="row pd-t-40 " id="comps">
        <div class="col-lg-3">
            <div class="card" >
                <div class="card-header tx-medium tx-white bg-warning pd-r-10">
                    <div class="row">
                        <div class="col-sm-4">
                        PENDING
                        </div>
                        
                    </div>
                    
                </div><!-- card-header -->
                <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                @foreach($prs as $pr)
                    @if($pr['status'] == 'PENDING')
                    <div class="card {{$pr['ref_no']}} {{$pr['date']}} {{$pr['purpose']}} pcards">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-9 tx-black tx-14">
                                         {{$pr['ref_no']}}
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="badge badge-primary">{{$pr['date']}}</span>
                                    </div>
                                </div>
                        </div><!-- card-header -->
                        <div class="card-body">
                            <div>
                                <span class="tx-12">Purpose: </span>
                                <div class="tx-inverse tx-11">{{$pr['purpose']}}</div>
                                <div class="tx-11">Prepared by: </div>
                                <span class="tx-inverse tx-11">{{$pr['first_name'].' '.$pr['last_name']}}</span>
                            </div>
                        </div><!-- card-body -->
                        <div class="card-footer">
                        
                        
                        </div><!-- card-footer -->
                    </div><!-- card -->
                    @endif
                @endforeach
                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col -->

        <div class="col-lg-3">
            <div class="card">
            <div class="card-header tx-medium tx-white bg-primary">
                    <div class="row">
                        <div class="col-sm-4">
                        WITH RFQ
                        </div>
                        
                    </div>
            </div><!-- card-header -->
            <div class="card-body" style="max-height: 600px; overflow-y: auto;">
            @foreach($prs as $pr)
                    @if($pr['status'] == 'With RFQ')
                    <div class="card {{$pr['ref_no']}} {{$pr['date']}} {{$pr['purpose']}} pcards">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-9 tx-black tx-14">
                                         {{$pr['ref_no']}}
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="badge badge-primary">{{$pr['date']}}</span>
                                    </div>
                                </div>
                        </div><!-- card-header -->
                        <div class="card-body">
                            <div>
                                <span class="tx-12">Purpose: </span>
                                <div class="tx-inverse tx-11">{{$pr['purpose']}}</div>
                                <div class="tx-11">Prepared by: </div>
                                <span class="tx-inverse tx-11">{{$pr['first_name'].' '.$pr['last_name']}}</span>
                            </div>
                        </div><!-- card-body -->
                        <div class="card-footer">
                        <span class="tx-12 tx-inverse">Attached Docs: 
                        @foreach($array[0] as $rfq)
                                    @if($rfq['id'] == $pr->id)
                                        @foreach($rfq['refs'] as $r)
                                            <span class="badge badge-primary">{{ $r}}</span>
                                        @endforeach
                                    @endif
                        @endforeach
                       
                        </span>
                        </div><!-- card-footer -->
                    </div><!-- card -->
                    @endif
                @endforeach
            </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col -->

        <div class="col-lg-3">
            <div class="card">
            <div class="card-header tx-medium tx-white bg-danger">
            <div class="row">
                        <div class="col-sm-6">
                        CANVASSED AND AWARDED
                        </div>
                       
                    </div>
            </div><!-- card-header -->
            <div class="card-body" style="max-height: 600px; overflow-y: auto;">
            @foreach($prs as $pr)
                    @if($pr['status'] == 'CANVASSED AND AWARDED')
                    <div class="card {{$pr['ref_no']}} {{$pr['date']}} {{$pr['purpose']}} pcards">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-9 tx-black tx-14">
                                         {{$pr['ref_no']}}
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="badge badge-primary">{{$pr['date']}}</span>
                                    </div>
                                </div>
                        </div><!-- card-header -->
                        <div class="card-body">
                            <div>
                                <span class="tx-12">Purpose: </span>
                                <div class="tx-inverse tx-11">{{$pr['purpose']}}</div>
                                <div class="tx-11">Prepared by: </div>
                                <span class="tx-inverse tx-11">{{$pr['first_name'].' '.$pr['last_name']}}</span>
                            </div>
                        </div><!-- card-body -->
                        <div class="card-footer">
                        <span class="tx-12 tx-inverse">Attached Docs: 
                          
                        @foreach($array[0] as $rfq)
                                    @if($rfq['id'] == $pr->id)
                                        @foreach($rfq['refs'] as $r)
                                            <span class="badge badge-primary">{{ $r}}</span>
                                        @endforeach
                                    @endif
                        @endforeach
                        @foreach($array[1] as $rfq)
                                    @if($rfq['id'] == $pr->id)
                                        @foreach($rfq['refs'] as $r)
                                            <span class="badge badge-danger">{{ $r}}</span>
                                        @endforeach
                                    @endif
                        @endforeach
                        @foreach($array[2] as $rfq)
                                    @if($rfq['id'] == $pr->id)
                                        @foreach($rfq['refs'] as $r)
                                            <span class="badge badge-success">{{ $r}}</span>
                                        @endforeach
                                    @endif
                        @endforeach
                        </span>
                        </div><!-- card-footer -->
                    </div><!-- card -->
                    @endif
                @endforeach
                        </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col -->

        <div class="col-lg-3">
            <div class="card">
            <div class="card-header tx-medium tx-white bg-success">
            <div class="row">
                <div class="col-sm-4">
                PURCHASED
                </div>
               
            </div>
            </div><!-- card-header -->
            <div class="card-body" style="max-height: 600px; overflow-y: auto;">
            @foreach($prs as $pr)
                    @if($pr['status'] == 'PURCHASED')
                    <div class="card {{$pr['ref_no']}} {{$pr['date']}} {{$pr['purpose']}} pcards">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-9 tx-black tx-14">
                                         {{$pr['ref_no']}}
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="badge badge-primary">{{$pr['date']}}</span>
                                    </div>
                                </div>
                        </div><!-- card-header -->
                        <div class="card-body">
                            <div>
                                <span class="tx-12">Purpose: </span>
                                <div class="tx-inverse tx-11">{{$pr['purpose']}}</div>
                                <div class="tx-11">Prepared by: </div>
                                <span class="tx-inverse tx-11">{{$pr['first_name'].' '.$pr['last_name']}}</span>
                            </div>
                        </div><!-- card-body -->
                        <div class="card-footer">
                        <span class="tx-12 tx-inverse">Attached Docs: 
                          
                        @foreach($array[0] as $rfq)
                                    @if($rfq['id'] == $pr->id)
                                        @foreach($rfq['refs'] as $r)
                                            <span class="badge badge-primary">{{ $r}}</span>
                                        @endforeach
                                    @endif
                        @endforeach
                        @foreach($array[1] as $rfq)
                                    @if($rfq['id'] == $pr->id)
                                        @foreach($rfq['refs'] as $r)
                                            <span class="badge badge-danger">{{ $r}}</span>
                                        @endforeach
                                    @endif
                        @endforeach
                        @foreach($array[2] as $rfq)
                                    @if($rfq['id'] == $pr->id)
                                        @foreach($rfq['refs'] as $r)
                                            <span class="badge badge-success">{{ $r}}</span>
                                        @endforeach
                                    @endif
                        @endforeach
                        </span>
                        </div><!-- card-footer -->
                    </div><!-- card -->
                    @endif
                @endforeach
            </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col -->
    </div>
</div>
<script>
    setInterval(function(){ 
    refreshkanban();
}, 5000);
function refreshkanban(){
       const url = '{{route("kanbanboard")}}';
        fetch(url, {
        'headers': {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        'method':'GET',
    })
   .then((response) => response.text())
   .then((responseText)=>{
        //console.log(responseText)
   })
}

$(function() {

    $('input[name="daterange"]').daterangepicker({
    opens: 'left'
    }, function(start, end, label) {
            var s = start.format('YYYY-MM-DD') 
            var e =  end.format('YYYY-MM-DD');
    });
});

function edValueKeyPress()
    {
        const searchpending = document.querySelector('.searchpending');
        var s = searchpending.value;

        const div = document.getElementsByClassName('pcards');
        for (i = 0; i < div.length; i++) {
            if((' ' + div[i].className + ' ').includes(s)){
                div[i].style.display = "block";
                console.log('a - '+s)
            }
            else{
                div[i].style.display = "none";
            }
            

        }
        
        
    }

</script>
@endsection