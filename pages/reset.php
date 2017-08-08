<?php
require_once('../includes/configure.php');
$notvalid = false;

$token=null;
if(isset($_REQUEST['token']))
	$token=$_REQUEST['token'];
$email ='';
if(!isset($_POST['password'])){

$db->where ("tk_used", 0);
$db->where ("tk_token", $token);
$row = $db->getOne ("tokens");
if ($row){
	$email=$row['tk_email'];
}
	If ($email!=''){
		$notvalid = false;
	}
	else{
		$notvalid = true;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>My ClassRoom</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../css/bootstrap-combined.min.css" rel="stylesheet">
        <!-- Bootstrap core CSS -->
   
	  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="../form-validator/jquery.form-validator.js"></script>
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="../bootstrap/img/favicon.ico">
        <link rel="apple-touch-icon" href="../bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../bootstrap/img/apple-touch-icon-114x114.png">


        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
            
        </style>
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
    <body  >
        
        <div class="modal" id ="password_modal">
    <div class="modal-header">
        <h3>Change Password <span class="extra-title muted"></span></h3>
		<?php
	if($notvalid){
		echo "Invalid link or Password already changed";
	}
	?>

    </div>
	<?php if(!isset($_POST['password']) && !$notvalid) {?>
	<form  action="reset.php" method="post" class="form-signin" role="form">
    <div class="modal-body form-horizontal">
       <input type="hidden" name="token" value="<?php echo $token?>">
       <input type="hidden" name="email" value="<?php echo $email?>">
        <div class="control-group">
            <label for="new_password" class="control-label">New Password</label>
            <div class="controls">
                 <input name="password_confirmation" placeholder="Password" type="password" id="pass_confirmation" class="form-control" data-validation="strength" data-validation-strength="3" data-validation-help="Please provide strong Password."  /> 
            </div>
        </div>
        <div class="control-group">
            <label for="confirm_password" class="control-label">Confirm Password</label>
            <div class="controls">
                <input name="password" type="password" placeholder="Confirm Password" id="pass" class="form-control" data-validation="confirmation" data-validation-error-msg="Confirm password is not same." />
            </div>
        </div>      
    </div>
	
    <div class="modal-footer">
        <button href="#" type="submit" class="btn btn-primary" id="password_modal_save">Reset My Password</button>
    </div>
	</form>
	<?php }
if(isset($_POST['password'])&&isset($_POST['email']))
{
	$pass = $_POST['password'];
	$email = $_POST['email'];
	$data_arr["u_pass"] = md5($pass);
    $condition["u_email"] = $email;

    $r= updateDataArrWithMsg($db, "users", $data_arr,  $condition, "unable to save new password", "Password updated successfully!", true, true);
  
	if($r){
    $data_t["tk_used"] = 1;
    $condition_t["tk_token"] = $token;
    $row= updateDataArrWithMsg($db, "tokens", $data_t,  $condition_t, "unable to update token", "token updated successfully!", false, false);
  
	if($row){
		echo "Your password is changed successfully!";
		echo '</br>';
		echo '</br>';
		echo '<a href="login.php">Login to My ClassRoom</a>';
		}
	}
	if(!$r)echo "An error occurred";
}
?>
</div>
  






        
        <!-- JavaScript jQuery code from Bootply.com editor  -->
        
        <script type='text/javascript'>
        
        $(document).ready(function() {
        
            
        
        });
        
        </script>
        
      <script>
/* important to locate this script AFTER the closing form element, so form object is loaded in DOM before setup is called */
    $.validate({
        modules : 'security',
    onModulesLoaded : function() {
      var optionalConfig = {
      fontSize: '12pt',
      padding: '4px',
      bad : 'Very bad',
      weak : 'Weak',
      good : 'Good',
      strong : 'Strong'
    };

    $('input[name="password_confirmation"]').displayPasswordStrength(optionalConfig);
    }
    });
	</script>
        
    </body>
</html>