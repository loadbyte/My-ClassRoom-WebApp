<?php
require_once('../includes/configure.php');

$token_name = "addcourse_csrf";
$csrf = new CSRF_Protect($token_name);
if($_SESSION['captcha_verified'] && $csrf->isTokenValid($_POST[$token_name])) {
	$data["c_title"] = $_REQUEST['cr_title'];
	$data["c_desc"] = $_REQUEST['cr_desc'];
	$data["c_from"] = $_REQUEST['cr_from'];
	$data["c_to"] = $_REQUEST['cr_to'];
	$data["c_u_id"] = $_SESSION['u_id'];




	
	$g_id = insertDataArrWithMsg($db, "course", $data,  "Unble to add New Course !"
						, "New Course Added successfully!", true, true);
	
}  else {
	$_SESSION['error'] = true ;
	$_SESSION['error_msg'] = "Captcha is wrong or Invalid form submit please try again!" ;
	$valid = false;
}
header("location: addcourse.php");
