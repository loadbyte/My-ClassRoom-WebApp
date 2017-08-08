<?php
require_once('../includes/configure.php');

$token_name = "addassign_csrf";
$csrf = new CSRF_Protect($token_name);
if($_SESSION['captcha_verified'] && $csrf->isTokenValid($_POST[$token_name])) {
	$data["as_name"] = $_REQUEST['as_title'];
	$data["as_desc"] = $_REQUEST['as_desc'];
	$data["as_dead"] = $_REQUEST['as_dead'];
	$data["as_u_id"] = $_SESSION['u_id'];
	$data["as_c_id"] = $_SESSION['c_id'];
	

	
	$g_id = insertDataArrWithMsg($db, "assignments", $data,  "Unble to add assignment !"
						, "New Assignment Added successfully!", true, true);
	
}  else {
	$_SESSION['error'] = true ;
	$_SESSION['error_msg'] = "Captcha is wrong or Invalid form submit please try again!" ;
	$valid = false;
}
header("location: addassignment.php");
