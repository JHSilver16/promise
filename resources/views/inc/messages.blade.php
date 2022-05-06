@if(session('success'))
<div class="alert alert-success" role="alert" style="display: none ">
  <button type="button" class="close" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <div class="d-flex align-items-center justify-content-start">
    <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
    <span><strong>Success!</strong> {{session('success')}}</span>
  </div><!-- d-flex -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".alert").fadeIn("slow");
	});	
	$(".alert button.close").click(function (e) {
    $(this).parent().slideUp("slow");
});
</script>
@elseif(session('error'))
<div class="alert alert-danger" role="alert" style="display: none ">
  <button type="button" class="close" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <div class="d-flex align-items-center justify-content-start">
    <i class="icon ion-ios-close alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
    <span><strong>Error!</strong> {{session('error')}}</span>
  </div><!-- d-flex -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".alert").fadeIn("slow");
  }); 
  $(".alert button.close").click(function (e) {
    $(this).parent().slideUp("slow");
});
</script>
@endif

