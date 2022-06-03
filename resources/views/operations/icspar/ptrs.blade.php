@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
  <nav class="breadcrumb pd-0 mg-0 tx-12">
    <a class="breadcrumb-item" href="{{route('dashboard')}}">Home</a>
    <span class="breadcrumb-item active">Semi Expendable Equipments</span>
  </nav>
</div>
<div class="bd-y bd-gray-500 bg-light" id="employeeoptions">
  <div class="ht-md-60 wd-200 wd-md-auto pd-y-20 pd-md-y-0 d-md-flex align-items-center justify-content-center tx-poppins" >
      <ul class="nav nav-effect nav-effect-5 tx-uppercase tx-bold tx-spacing-2 flex-column flex-md-row" role="tablist">
        <li class="nav-item">
          <a href="{{route('createptr')}}">
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-plus-circle tx-20"></i>
            <span class="menu-item-label">Create Property Transfer Report</span>
          </div><!-- menu-item -->
        </a>
        </li>
      </ul>
    </div>
  </div>
 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"><!-- br-pageheader -->
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="br-pagebody">
  <div class="br-section-wrapper">
     <div class="row">
          <div class="col-md-9 d-sm-flex">
            <div class="">
              <h4 class="tx-gray-800 mg-b-5">List of Property Transfer Reports</h4>
            </div>
          </div>
        </div>
    <div class="row pd-t-40 align-items-center" id="comps">
            
            <div class="col-md-12">
              <table class="table table-bordered" id="products">
                  <thead class="thead-colored thead-dark tx-black">
                    <tr>
                      <th class="wd-15p">PTR No.</th>
                      <th class="wd-15p">Date</th>
                      <th class="wd-15p">Property No.</th>
                      <th class="wd-15p">From Acc. Officer</th>
                      <th class="wd-15p">To Acc. Officer</th>
                      <th class="wd-15p">Item</th>
                      <th class="wd-15p">Reason</th>
                      <th class="wd-15p">Approved By</th>
                      <th class="wd-10p">Action</th>
                    </tr>
                  </thead>
                   <tbody class="tx-inverse">
                     @foreach($ptrs as $ptr)
                       <tr>
                        <td>{{$ptr['no']}}</td>
                        <td>{{$ptr['date']}}</td>
                        <td>{{$ptr['property_no']}}</td>
                        <td>{{$ptr['from']}}</td>
                        <td>{{$ptr['to']}}</td>
                        <td>{{$ptr['items']}}</td>
                        <td>{{$ptr['reason']}}</td>
                        <td>{{$ptr['approve']}}</td>
                        <td><div class="btn-group" role="group" aria-label="Basic example">
                           <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cogs fa-xs"></i> Action
                              <span class="caret"></span></button>
                             <div class="dropdown-menu pd-10 wd-180 tx-14">
                                <nav class="nav nav-style-2 flex-column">                                  
                                  <a class="nav-link add" data-type="rfq"  title="Edit" data-date="{{$ptr['date']}}" data-id="{{$ptr['id']}}"><i class="fa fa-edit fa-xs"></i>Edit Form</a>
                                  <a class="nav-link printptr" data-id="{{$ptr['id']}}"><i class="fa fa-print fa-xs"></i> Print Form</a>                             
                                </nav>
                              </div><!-- dropdown-menu -->
                            </div>
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

<script type="text/javascript">
  $(function(){

    $('.date').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      numberOfMonths: 1
    });


    $(document).on('click', '.printptr', function(){
      window.location.href = '{{route ("printptr", ["id" => ''] )}}'+'/'+$(this).data('id')
    })

        'use strict';

        $('#products').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
          }
        });

        $(document).on('click', '.updatecard', function(){
        
            $('#modaldemo1').modal('show');

            $.get("{{route('getics')}}",
            {
               _token: document.getElementById('token').value,
                id: $(this).data('id')
            },
             function(data,status){
              //console.log(data);
                $('#id').val(data.id);
                $('.brand').val(data.brand);
                $('.life').val(data.life);
                $('.status').val(data.item_status);
                $('.deprate').val(data.deprate);
                $('#issuedto').val(data.issued_to);
                $('#issuedby').val(data.issued_by);
                $('.date').val(data.date_acquired);
                $('.eptype').val(data.type);

             })
        });
    });


</script>
@endsection