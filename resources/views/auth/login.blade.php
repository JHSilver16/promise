<!DOCTYPE html>
<html>
<head>
     <title>NEDA XII Inventory Management System</title>
     <meta name="csrf_token" content="{{ csrf_token() }}">
</head>
 <script src="{{asset('js/jquery.min.js')}}"></script>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     
      <script src="{{asset('js/amountwords.js')}}"></script>
      <script src="{{asset('js/auto.js')}}"></script>
    <link href="{{asset('css/login.css')}}" rel="stylesheet" />
    <style type="text/css">
        
    </style>
<body>
<div class="flex">
<div><h2>NEDA XII Property and Supply Management Information System | </h2></div>
<br/>

<link href='https://fonts.googleapis.com/css?family=Raleway:400,500,300' rel='stylesheet' type='text/css'>

<div id="mainButton">

    <div class="btn-text" onclick="openForm()">Sign In</div>
    <div class="modal">
        <form  method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
        <div class="close-button" onclick="closeForm()">x</div>
        <div class="form-title">Sign In</div>
        <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="text" id="email" name="email" required="" onblur="checkInput(this)" />
            <label for="name">Username</label>
            
        </div>
        <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" id="password" name="password" required="" onblur="checkInput(this)" />
            <label for="password">Password</label>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <button class="form-button" type="submit">Go</button>
        <div class="codepen-by">DGRV 2020</div>
    </form>
    </div>
</div>
<br>
<div>
    @if ($errors->has('email'))
    <span class="help-block">
        <strong>{{ $errors->first('email') }}</strong>
    </span>
    @endif
    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>
<div class="codepen-by">DGRV 2020</div>
</div>




</body>
<script type="text/javascript">
    var button = document.getElementById('mainButton');

var openForm = function() {
    button.className = 'active';
};

var checkInput = function(input) {
    if (input.value.length > 0) {
        input.className = 'active';
    } else {
        input.className = '';
    }
};

var closeForm = function() {
    button.className = '';
};

document.addEventListener("keyup", function(e) {
    if (e.keyCode == 27 || e.keyCode == 13) {
        closeForm();
    }
});
</script>
</html>