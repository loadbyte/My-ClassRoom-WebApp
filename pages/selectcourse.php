<?php
require_once('../includes/configure.php');

$_SESSION['c_id'] = $_GET['c_id'];
$_SESSION['c_title']  = getCourseInfo($db, $_SESSION['c_id'])['c_title'];
if($_SESSION['c_title']){
	$data_arr["u_default_c_id"] = $_SESSION['c_id'];
	$condition["u_id"] = $_SESSION['u_id'];
	updateDataArrWithMsg($db, "users", $data_arr,  $condition, "Unable to select course!", "Course Selected successfully!", false, false);

	header("location: assignlist.php");
} else {
	header("location: dashboard.php");
}

//echo $_SESSION['c_title'];
