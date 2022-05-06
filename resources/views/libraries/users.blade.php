@extends('layouts.app')

@section('content')

 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"><!-- br-pageheader -->
<div class="bd-y bd-gray-500 bg-light" id="employeeoptions">
  <div class="ht-md-60 wd-200 wd-md-auto pd-y-20 pd-md-y-0 d-md-flex align-items-center justify-content-center tx-poppins" >
      <ul class="nav nav-effect nav-effect-5 tx-uppercase tx-bold tx-spacing-2 flex-column flex-md-row" role="tablist">
        <li class="nav-item">
          <a href="{{route('getemployees')}}">
          <div class="br-menu-item nav-link">
            <i class="menu-item-icon fas fa-user-plus tx-20"></i>
            <span class="menu-item-label">Update Employee List (IPMS)</span>
          </div><!-- menu-item -->
        </a>
        </li>
      </ul>
    </div>
  </div>
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="br-pagebody">
  <div class="br-section-wrapper">
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">List of Users</h6>
   
 <div class="row pd-20">
     <div class="col-md-12">
       <table class="table table-bordered" id="emps">
        <thead class="thead-colored thead-dark tx-black">
          <tr>
            <th class="wd-15p">ID No.</th>
            <th class="wd-15p">First Name</th>
            <th class="wd-15p">Middle Name</th>
            <th class="wd-15p">Last Name</th>
            <th class="wd-15p">User Type</th>
            <th class="wd-15p">Username</th>
            <th class="wd-15p">Position</th>
            <th class="wd-15p">Division</th>
            <th class="wd-15p">Action</th>
          </tr>
        </thead>
         <tbody class="tx-black">
           @foreach($employees as $emp)
            <tr>
              <td>{{$emp['id']}}</td>
              <td>{{$emp['fname']}}</td>
              <td>{{$emp['mname']}}</td>
              <td>{{$emp['lname']}}</td>
              <td>{{$emp['type']}}</td>
              <td>{{$emp['username']}}</td>
              <td>{{$emp['position']}}</td>
              <td>{{$emp['division']}}</td>
              <td><div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-success edit" data-uname="{{$emp['username']}}"  data-fname="{{$emp['fname'].' '.$emp['lname']}}" data-id="{{$emp['id']}}"><i class="fa fa-edit"></i></button>
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
<div id="modaldemo1" class="modal fade">
    <div class="modal-dialog modal-dialog-vertical-center" style="width: 100%" role="document">
      <div class="modal-content bd-0 tx-14">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-b tx-bold details">Update User Details</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('setuser')}}" method="POST">
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" id="id" value="">
        <div class="modal-body pd-25 wd-500">
          <h4 class="lh-3 mg-b-20 name tx-uppercase tx-b tx-bold"></h4>
          <div class="row mg-b-10">
            <div class="col-md-3">Username: </div>
            <div class="col-md-6"><input type="text" id="uname" name="username" class="form-control" required></div>
          </div>
          <div class="row mg-b-10">
            <div class="col-md-3">Password: </div>
            <div class="col-md-6"><input type="password" id="uname" name="password" class="form-control" required></div>
          </div>
          <div class="row mg-b-10">
            <div class="col-md-3">Usertype: </div>
            <div class="col-md-6"><select class="form-control" name="type">
              @foreach($usertypes as $us)
                <option value="{{$us->id}}">{{$us->name}}</option>
              @endforeach
            </select></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save changes</button>
          <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
        </div>
         </form>
      </div>
    </div>
   <!-- modal-dialog -->
  </div><!-- modal -->
<script type="text/javascript">
  $(function(){
        'use strict';

        $('table').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
          }
        });
    $(document).on('click','.edit', function(){
      $("#id").val($(this).data('id'));
      $("#uname").val($(this).data('uname'));
      $(".details").text("Update User Details | "+$(this).data('fname'));
      $("#modaldemo1").modal('show')
    })
  })
</script>
@endsection