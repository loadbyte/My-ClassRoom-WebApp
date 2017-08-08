<?php
require_once('../includes/configure.php');

$token_name = "assignsub_csrf";
$csrf = new CSRF_Protect($token_name);
if($_SESSION['captcha_verified'] && $csrf->isTokenValid($_POST[$token_name])) {
	
	$data["ab_sub_url"] = $_REQUEST['as_url'];
	
	

	if(!isAssignSubExists($db, $_SESSION['u_id'], $_REQUEST["as_id"])){
		$data["ab_u_id"] = $_SESSION['u_id'];
		$data["ab_as_id"] = $_REQUEST['as_id'];
		$g_id = insertDataArrWithMsg($db, "assign_submission", $data,  "Unble to submit assignment"
						, "Assignment Submited  successfully", true, true);
	} else {
		$condition["ab_u_id"] = $_SESSION['u_id'];
		$condition["ab_as_id"] = $_REQUEST['as_id'];
		updateDataArrWithMsg($db, "assign_submission", $data,  $condition, "Unble to submit assignment !"
						, "Assignment Submited successfully!", true, true);

	}
	
}  else {
	$_SESSION['error'] = true ;
	$_SESSION['error_msg'] = "Captcha is wrong or Invalid form submit please try again!" ;
	$valid = false;
}
header("location: assignlist.php");
