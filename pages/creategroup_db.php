<?php
require_once('../includes/configure.php');
//echo $_REQUEST['grp_name']."</br>";


$token_name = "creategrp_csrf";
$csrf = new CSRF_Protect($token_name);

$valid = true;
if($_SESSION['captcha_verified']) {
$UIDs= array();
for($i=1;$i<=4;$i++){
	if(isset($_REQUEST["email$i"]) )
		if(isEmailExists($db, $_REQUEST["email$i"])){
			$UIDs[$i] = getUID_Email($db, $_REQUEST["email$i"]);
			//echo $UIDs[$i]."</br>";
		}
		else {
			$valid = false;
			break;
		}

}

if($valid && $csrf->isTokenValid($_POST[$token_name])) {
	
	$data["g_name"] = $_REQUEST['grp_name'];
	$data["g_u_id"] = $_SESSION['u_id'];
	$data["g_c_id"] = $_SESSION['c_id'];

	//$g_id = $db->insert_array("groups" , $data);
	$g_id = insertDataArrWithMsg($db, "groups", $data,  "Unable to insert group"
						, "", true, false);
	if (!$g_id) {
		$valid =false;
	}
	for($i=1;$valid && $i<=4;$i++){
		if(isset($_REQUEST["email$i"]) ){
			
			$data_g["ug_u_id"] = $UIDs[$i];
			$data_g["ug_g_id"] = $g_id;
			$ug_id = insertDataArrWithMsg($db, "user_group", $data_g,  "Unable to insert user_group"
						, "", true, false);
			if (!$ug_id) {
			
				$valid = false;
				break;
			}else{
				
			}
		}
	}
	
} else {
	$_SESSION['error'] = true ;
	$_SESSION['error_msg'] = "Given member email id is wrong please try again!" ;
	$valid = false;
}
if($valid){
	$_SESSION['success'] = true ;
	$_SESSION['success_msg'] = "New Group created successfully!!" ;
}
$csrf->deleteToken();
} else {
	$_SESSION['error'] = true ;
	$_SESSION['error_msg'] = "Captcha is invalid please try again!" ;
	$valid = false;
}
header("location: creategroup.php");
/*
$data["c_title"] = $_REQUEST['cr_title'];
$data["c_desc"] = $_REQUEST['cr_desc'];
$data["c_from"] = $_REQUEST['cr_from'];
$data["c_to"] = $_REQUEST['cr_to'];
$data["c_u_id"] = $_SESSION['u_id'];




$id = $db->insert_array("course" , $data);
if (!$id) {$db->print_last_error(false);
	$_SESSION['error'] = true ;
	$_SESSION['error_msg'] = "Unble to add New Event type!" ;
}else{
	$_SESSION['success'] = true ;
	$_SESSION['success_msg'] = "New Event Added successfully!" ;
}

header("location: addcourse.php");

*/
