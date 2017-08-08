<?php
require_once('../includes/configure.php');
$error = false;
if(isset($_SESSION['error']))
	$error = $_SESSION['error'];

$token_name = "login_csrf";
$csrf = new CSRF_Protect($token_name);
$_SESSION['captcha_verified'] = false;

?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title> My ClassRoom</title>
  

    
     <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style type='text/css'>
    .form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.account-wall
{
    margin-top: 20px;
    padding: 40px 0px 20px 0px;
    background-color: #f7f7f7;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.login-title
{
    color: #555;
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
  </style>
  

 <script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<link href="../css/style.css" rel="stylesheet">
 <script src="../js/myclass.js"></script>
<script type='text/javascript'>//<![CDATA[ 
window.onload=function(){

}//]]>  

</script>
<script type='text/javascript'>
$(document).ready(function() {
});

  $(function() {
     $('#captcha').on('click', function() { 
    // From the other examples
    imgcaptcha('','');
}); });
</script>
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Image information</h4>
                                        </div>
                                        <div class="modal-body">
                                          modal message
                                        </div>
                                       
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

</head>
<body>
  <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
		<?php if(!$error)
					echo '<h1 class="text-center login-title">Sign in to continue to My ClassRoom</h1>';

				else {
					echo '<h1 class="text-center login-title">Email/Password is wrong</h1>';
                    if(isset( $_SESSION['error_msg']))echo  $_SESSION['error_msg'];
                    unset($_SESSION['error_msg']);
                    unset($_SESSION['error']);
                }
            ?>
            <div class="account-wall">
                
                <form  action="CheckLogin.php" method="post" class="form-signin">
                <?php echo $csrf->echoInputField(); ?>
                <input type="text" class="form-control" name="email" placeholder="Email" required autofocus>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <div class="form-group">
 <div class="alert alert-danger" id="captcha"  role="alert"><span id = "captchaIcon" class="glyphicon glyphicon-unchecked"></span> I'm not a Robot!</div>
 </div>

<div class="form-group">
<button type="button" id="submitme" disabled class="btn btn-primary ">Sign in</button>
</div>
                
                <label class="checkbox pull-left">
                    
                </label>
                <a href="forgotpassword.php" class="pull-right need-help">Forgot Password?</a><span class="clearfix"></span>
                </form>
            </div>
            <!--<a href="#" class="text-center new-account">Create an account </a>-->
        </div>
    </div>
</div>
  
</body>


</html>

