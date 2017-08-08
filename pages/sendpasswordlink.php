<?php
require_once('../includes/configure.php');
require("../PHPMailer-master/PHPMailerAutoload.php");

$token_name = "forgot_csrf";
$csrf = new CSRF_Protect($token_name);
if( $_SESSION['captcha_verified'] && $csrf->isTokenValid($_POST[$token_name])) {
	
	if(isset($_POST['email'])){
		                
		$email=$_POST['email'];
		$db->where ("u_email", $email);
		$row = $db->getOne ("users");

		if(!$row) {
			$_SESSION['error'] = true ;
			$_SESSION['error'] = "Email id is not registered";die();
		}

		$token=getRandomString(10);
		
		$data['tk_token'] = $token;
		$data['tk_email'] = $email;
		
		$tk_id = insertDataArrWithMsg($db, "tokens", $data,  "Unble to send link !"
						, "Added Token successfully!", true, false);
		if(isset($_POST['email'])){
		$uri = 'http://'. $_SERVER['HTTP_HOST'].'/myclass/pages';

			$chkbool = mailresetlink($uri,'',$token,$email,'',$from_email,$host_stmp,$host_port);
			if($chkbool){
				$_SESSION['successmsg'] =  "We have sent the password reset link to your  email id <b> ".$email." </b>"; 
			} else {
				$_SESSION['error'] = "Unable to send  password reset link (Technical problem)";
			}
		}
	} else {
		$_SESSION['error'] = true ;
		$_SESSION['error'] = "Email doesn't exist in My ClassRoom!";
	}
		

	
	
	
}  else {
	$_SESSION['error'] = true ;
	$_SESSION['error_msg'] = "Captcha is wrong or Invalid form submit please try again!" ;
	$valid = false;
}

//header("location: forgotpassword.php");