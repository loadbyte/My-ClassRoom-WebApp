<?php
require_once('../includes/configure.php');

$token_name = "contrib_csrf";
$csrf = new CSRF_Protect($token_name);
if($_SESSION['captcha_verified'] && $csrf->isTokenValid($_POST[$token_name])) {
	
	$data["cn_desc"] = $_REQUEST['as_contrib'];
	
	

	if(!isContribExists($db, $_SESSION['u_id'], $_REQUEST["as_id"])){
		$data["cn_u_id"] = $_SESSION['u_id'];
		$data["cn_as_id"] = $_REQUEST['as_id'];
		$g_id = insertDataArrWithMsg($db, "contribution", $data,  "Unble to add assignment contribution!"
						, "Contribution Added successfully!", true, true);
	} else {
		$condition["cn_u_id"] = $_SESSION['u_id'];
		$condition["cn_as_id"] = $_REQUEST['as_id'];
		updateDataArrWithMsg($db, "contribution", $data,  $condition, "Unble to add assignment contribution!"
						, "Contribution Added successfully!", true, true);

	}
	
}  else {
	$_SESSION['error'] = true ;
	$_SESSION['error_msg'] = "Captcha is wrong or Invalid form submit please try again!" ;
	$valid = false;
}
header("location: assignlist.php");
