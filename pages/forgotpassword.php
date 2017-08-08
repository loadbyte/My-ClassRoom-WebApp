<?php
require_once('../includes/configure.php');
$token_name = "forgot_csrf";
$csrf = new CSRF_Protect($token_name);
$_SESSION['captcha_verified'] = false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>My ClassRoom</title>
<meta name="generator" content="Bootply" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="shortcut icon" href="../bootstrap/img/favicon.ico">
<link rel="apple-touch-icon" href="../bootstrap/img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="../bootstrap/img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="../bootstrap/img/apple-touch-icon-114x114.png">

<link href="../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">








<!-- CSS code from Bootply.com editor -->
<style type="text/css">
/* CSS used here will be applied after bootstrap.css */
</style>
</head>
<!-- HTML code from Bootply.com editor -->
<body >
<hr>
<div class="container">
<div class="row">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="panel panel-default">
<div class="panel-body">
<div class="text-center">
<h3><i class="fa fa-lock fa-4x"></i></h3>
<h2 class="text-center">Forgot Password?</h2>
 <form  action="sendpasswordlink.php" method="post" class="form" role="form">
  <?php echo $csrf->echoInputField(); ?>
<?php if(isset($_SESSION['successmsg'])){
			echo $_SESSION['successmsg'];
			unset($_SESSION['successmsg']);
		}  else {
	  ?>
        <p>
		<?php
		 if(isset($_SESSION['error'])){
			if($_SESSION['error']){
				echo $_SESSION['error'];
				unset($_SESSION['error']);
				}
			else
				echo "You can reset your password here";
		}else
			echo "You can reset your password here";
		?>
		</p>
<div class="panel-body">

<fieldset>
<div class="form-group">
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
<input id="emailInput" placeholder="email address" class="form-control" name="email" type="email" oninvalid="setCustomValidity('Please enter a valid email address!')" onchange="try{setCustomValidity('')}catch(e){}" required="">
</div>
</div>
<div class="form-group">
 <div class="alert alert-danger" id="captcha"  role="alert"><span id = "captchaIcon" class="glyphicon glyphicon-unchecked"></span> I'm not a Robot!</div>
 </div>

<div class="form-group">
<button type="button" id="submitme" disabled class="btn btn-primary ">Send Link to Reset!</button>
</div>
</fieldset>

</div>
<?php }?>
      </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
 <script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<link href="../css/style.css" rel="stylesheet">
 <script src="../js/myclass.js"></script>




<!-- JavaScript jQuery code from Bootply.com editor -->
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
</body>
</html>

