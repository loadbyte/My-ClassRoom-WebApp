<?php
require_once('../includes/configure.php');

$token_name = "saveclass_csrf";
$csrf = new CSRF_Protect($token_name);
if($csrf->isTokenValid($_POST[$token_name])) {
	$data_arr["cl_cp_id"] = $_POST["cp_id"];
	$data_arr["cl_ic_id"] = $_POST["ic_id"];
	$id = insertDataArrWithMsg($db, "verified_classified_images", $data_arr
		,  "Unable to insert class in db", "Success in insert image class in db", true, true);
	$data_cp["cp_known"] = 1;
	
	$condition["cp_id"] = $_POST['cp_id'];
	 updateDataArrWithMsg($db, "captcha_img", $data_cp,$condition
		,  "Unable to insert class in db!", "Success in insert image class in db!", true, true);
} 
header("location: classifyimg.php");