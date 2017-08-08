<?php
require_once('../includes/configure.php');

$token_name = "grp_csrf";
$csrf = new CSRF_Protect($token_name);

$data_arr["g_status"] = 1;
$condition["g_id"] = $_POST['g_id'];
if(isTA_Lect($_SESSION['u_role'])){
	updateDataArrWithMsg($db, "groups", $data_arr,  $condition, "unable to approve group", "Group approved successfully!", true, true);

}

header("location: grouplist.php");