@extends('layouts.app')

@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
  <nav class="breadcrumb pd-0 mg-0 tx-12">
    <a class="breadcrumb-item" href="{{route('dashboard')}}">Home</a>
    <span class="breadcrumb-item active">Semi Expendable Equipments</span>
  </nav>
</div>
 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"><!-- br-pageheader -->
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  <div class="bd-y bd-gray-500 bg-light" id="employeeoptions">
  <div class="ht-md-60 wd-200 wd-md-auto pd-y-20 pd-md-y-0 d-md-flex align-items-center justify-content-center tx-poppins" >
      <ul class="nav nav-effect nav-effect-5 tx-uppercase tx-bold tx-spacing-2 flex-column flex-md-row" role="tablist">
        <li class="nav-item">
          <a href="{{route('createics')}}">
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-plus-circle tx-20"></i>
            <span class="menu-item-label">Create Inventory Custodian Slip</span>
          </div><!-- menu-item -->
        </a>
        </li>
      </ul>
    </div>
  </div>
<div class="br-pagebody">
  <div class="br-section-wrapper">
     <div class="row">
          <div class="col-md-9 d-sm-flex">
            <div class="">
              <h4 class="tx-gray-800 mg-b-5">List of Inventory Custodian Slips</h4>
            </div>
          </div>
        </div>
    <div class="row pd-t-40 align-items-center" id="comps">
            
            <div class="col-md-12">
              <table class="table table-bordered" id="products">
                  <thead class="thead-colored thead-dark tx-black">
                    <tr>
                      <th class="wd-15p">ICS No.</th>
                      <th class="wd-15p">Date</th>
                      <th class="wd-15p">IAR No.</th>
                      <th class="wd-15p">Inventory Item No.</th>
                      <th class="wd-15p">Items</th>
                      <th class="wd-15p">Issued by</th>
                      <th class="wd-15p">Issued to</th>
                      <th class="wd-10p">Action</th>
                    </tr>
                  </thead>
                   <tbody class="tx-inverse">
                     @foreach($ics as $ic)
                       <tr>
                        <td>{{$ic['no']}}</td>
                        <td>{{$ic['date']}}</td>
                        <td>{{$ic['iar']}}</td>
                        <td>{{$ic['itemnos']}}</td>
                        <td>{{$ic['items']}}</td>
                        <td>{{$ic['issued_to']}}</td>
                        <td>{{$ic['issued_by']}}</td>
                        <td><div class="btn-group" role="group" aria-label="Basic example">
                           <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cogs fa-xs"></i> Action
                              <span class="caret"></span></button>
                             <div class="dropdown-menu pd-10 wd-180 tx-14">
                                <nav class="nav nav-style-2 flex-column">                                  
                                  <a class="nav-link add" data-type="rfq"  title="Edit" data-date="{{$ic['date']}}" data-id="{{$ic['id']}}"><i class="fa fa-edit fa-xs"></i>Edit Form</a>
                                  <a class="nav-link printics" data-id="{{$ic['id']}}"><i class="fa fa-print fa-xs"></i> Print Form</a>                             
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


    $(document).on('click', '.printics', function(){
      window.location.href = '{{route ("printics", ["id" => ''] )}}'+'/'+$(this).data('id')
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