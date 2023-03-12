<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    .login_image{
        background-repeat: no-repeat;
        background-size: cover;
        opacity: 0.7;
        height: 700px;
        width: 100%;
    }
    .container{
        top: 0;
        left: 0;
        margin-top: 150px;
        margin-left: 230px;
        position: absolute;
        z-index: 1;
    }

@media only screen and (max-width: 600px) {
  .login_image{
        background-repeat: no-repeat;
        background-size: cover;
        opacity: 0.7;
        height: 100%;
        width: 100%;
    }
    .container{
        top: 0;
        left: 0;
        margin-top: 100px;
        margin-left: 40px;
        position: absolute;
        z-index: 1;
    }
}    
</style>
<body>
    <img src="{{asset('/../public/images/school_erp2.png')}}" class="login_image" alt="School Management Software">
    <div class="container">
        @if(session()->has('msg'))
            
            <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{session('msg')}}</h3>
</div>
      @endif    
        <h1 class="text-center">Login Here!</h1>
        <div class="col-sm-4">
              
        </div>
        <form action="admin/checklogin" method="POST">
          {{csrf_field()}}
        <div class="col-sm-4 well frm">
            
            <div class="form-group">
                <label>User Name</label>
                <input type="text" name="uName" id="uName" class="form-control" onkeyup="this.value=this.value.toUpperCase()"/>
            </div>
            <div class="form-group">
                <label>User Password</label>
                <input type="password" name="uPass" id="uPass" class="form-control"/>
            </div>
            <div class="form-group">
                <input type="reset" name="reset" id="rest" class="btn btn-danger"/>
                <input type="submit" name="login" id="login" class="btn btn-success" value="Login Here" style="margin-left: 100px"/>
                </div>
            
        </div>
        </form>
        <div class="col-sm-4">
            
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $("#uName").focus();
    })
</script>