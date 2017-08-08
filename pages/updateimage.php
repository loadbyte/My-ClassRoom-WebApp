<?php
require_once('../includes/configure.php');
   if(isset($_FILES['image'])){
$file_exts = array("jpg", "bmp", "jpeg", "gif", "png");
$upload_exts = end(explode(".", $_FILES["image"]["name"]));
if ((($_FILES["image"]["type"] == "image/gif")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "image/png")
|| ($_FILES["image"]["type"] == "image/pjpeg"))
&& ($_FILES["image"]["size"] < 2000000)
&& in_array($upload_exts, $file_exts))
{
if ($_FILES["image"]["error"] > 0)
{
	$_SESSION['error'] = true ;
	$_SESSION['error_msg'] = "Return Code: " . $_FILES["image"]["error"] . "<br>";
}
else
{
	$data['pic_name'] = $_FILES["image"]["name"];
	$data['pic_mime'] = $_FILES["image"]["type"];
	$id = $db->insert_array("mypic" , $data);
	if (!$id) {$db->print_last_error(false);
	$_SESSION['error'] = true ;
	$_SESSION['error_msg'] = "Unable to Update About Me!" ;
}else{
	$ext = get_extension($_FILES["image"]["type"]);
	if(move_uploaded_file($_FILES["image"]["tmp_name"],
"../aboutme/" . $id.$ext)){
	$_SESSION['success'] = true ;
	$_SESSION['success_msg'] = "Updated successfully!" ;
}
}

header("location:editaboutme.php");
	
}
}
   }