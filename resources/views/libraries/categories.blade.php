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
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-18 mg-b-10">Item Categories</h6>
       
    <form action="{{route('addcategory')}}" method="POST" data-parsley-validate="">
       <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" id="id" value="{{ csrf_token() }}">
         <input type="hidden" name="type" id="type" value="save">
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-5 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                 <input type="text" name="name" class="form-control" id="name" placeholder="Description" required="">
                </div>
              </div>
             
             <div class="col-md-5 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Classification: <span class="tx-danger">*</span></label>
                   <select class="form-control" id="classification" name="classification" style="width: 100%"  tabindex="-1" aria-hidden="true">
                    @foreach($classifications as $cl)
                      <option value="{{$cl->id}}">{{$cl->name}}</option>
                    @endforeach
                </select>
                </div>
              </div>
               
               <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <button type="submit" class="btn btn-info submit">Submit</button>
               <button type="button" class="btn btn-secondary cancel">Cancel</button>
                </div>
              </div>
            </div><!-- row -->
          </div>
        </form>
        
        <div class="table-wrapper pd-t-20">
            <table id="datatable1" class="table display table-hoverable responsive nowrap">
              <thead class="thead-colored thead-dark">
                <tr>
                  <th class="wd-15p">ID No</th>
                  <th class="wd-15p">Name</th>
                  <th class="wd-15p">Classification</th>
                </tr>
              </thead>
              <tbody id="data" class="tx-black">
                @foreach($categories as $f)
                  <tr data-id="{{$f->id}}" data-type="{{$f->classification_id}}">
                    <td>{{$f->id}}</td>
                    <td>{{$f->name}}</td>
                    <td>{{$f->class}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

      </div>
  </div>
<div id="modaldemo4" class="modal fade">
    <div class="modal-dialog" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-body tx-center pd-y-20 pd-x-20">
            <div class="col-md-6 col-xl-4 mg-t-30">
              <div class="ht-100 pos-relative l-20 align-items-center">
                <div class="sk-cube-grid">
                  <div class="sk-cube sk-cube1"></div>
                  <div class="sk-cube sk-cube2"></div>
                  <div class="sk-cube sk-cube3"></div>
                  <div class="sk-cube sk-cube4"></div>
                  <div class="sk-cube sk-cube5"></div>
                  <div class="sk-cube sk-cube6"></div>
                  <div class="sk-cube sk-cube7"></div>
                  <div class="sk-cube sk-cube8"></div>
                  <div class="sk-cube sk-cube9"></div>
                </div>
              </div><!-- d-flex -->
            </div>
          <h4 class="tx-info tx-semibold mg-b-20">Submitting Data</h4>
          </div><!-- modal-body -->
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div>
<script>
  $(document).ready(function(){
    $(document).on({
    ajaxStart: function() { $('#modaldemo4').modal('show') },
     ajaxStop: function() { $('#modaldemo4').modal('hide') }    
});
     $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
          }
        });
 
$('#data tr').css( 'cursor', 'pointer' );
    $(document).on('click', '#data tr', function(){
      var id = this.cells[0];  // the first <td>
      var name = this.cells[1];
      var amount = this.cells[2];
      $('#name').val($(name).text());
      $('#amount').val($(amount).text());
      $('#id').val($(id).text());
      $('#type').val('edit');
      console.log($(this).data('type'))
      $("#classification").val($(this).data('type'));
      $('.submit').text('Edit');
      $('.submit').removeClass('btn-info');
      $('.submit').addClass('btn-success');
    })
  })
  $('.cancel').click(function(){
     $('.submit').text('Submit');
     $('.submit').removeClass('btn-success');
     $('.submit').addClass('btn-info');

      $('input[type=text]').val("");
  })
</script>
@endsection

