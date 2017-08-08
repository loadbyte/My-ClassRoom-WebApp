<?php
require_once('../includes/configure.php');

$token_name = "captcha_csrf";
$csrf = new CSRF_Protect($token_name);
$valid = false;
if(isset($_SESSION['u_id']))
	$u_id = $_SESSION['u_id'];
else
	$u_id = 0; // for forgot password
if (!$csrf->isTokenValid($_POST[$token_name]))
{
    // do stuff when token not valid
    echo 'Invalid token';
}
else
{
   
$cp_imgs = $_SESSION['captcha_arr'];


//print_r($cp_imgs);



$cp_imgs_post = array( );
if(isset($_POST['captcha_images'])){
	$checked = $_POST['captcha_images'];
	
	for($i=0; $i < count($checked); $i++){
	  // echo "Selected " . $checked[$i] . "<br/>";
		$cp_imgs_post[$checked[$i]]  = 0;
		
	}
	$valid = true;
	$wrong = false;
	$ic_id =0;
	foreach ($cp_imgs as $key => $value) {
		//echo "map: " . $key . "<br/>";
		if($value['knwn'] == -1  && array_key_exists($key, $cp_imgs_post) ){ // negative class
			$valid =false;
			$wrong = true;
			break;
		} else if($value['knwn'] == 1 && array_key_exists($key, $cp_imgs_post)){ //known and selected
			$cp_imgs_post[$key] = 1;

		} else if($value['knwn'] == 1){ // known but not selected
			$valid =false;
			
			break;
		} else if($value['knwn'] == 2 ){ // sample known
			$ic_id = $value['cl_ic_id'];
		} 
	}

} else {
	$valid = false;
}

}

//echo "===>>".$_SESSION['captcha_verified']." ";
if($valid && !$_SESSION['captcha_verified']){
	
	foreach ($cp_imgs as $key => $value) {
		//echo "map: " . $key . "<br/>";
		if($value['knwn'] == 0 && array_key_exists($key, $cp_imgs_post)){
			
			$data_arr["cpt_ic_id"] = $ic_id ;
			$data_arr["cpt_positive"] = 1; // 1 : cp_id belongs to given ic_id	
			$data_arr["cpt_cp_id"] = $value['cp_id'];
			$data_arr["cpt_u_id"] = $u_id;
			$id = insertDataArrWithMsg($db, "cp_img_tag", $data_arr
				,  "Unable to insert tag in db", "Success in insert of tag class in db", false, false);

		} else if ( $value['knwn'] == 0){
			$data_arr["cpt_ic_id"] = $ic_id ;
			$data_arr["cpt_positive"] = -1; // -1 : cp_id doesnot belongs to given ic_id	
			$data_arr["cpt_cp_id"] = $value['cp_id'];
			$data_arr["cpt_u_id"] = $u_id;
			$id = insertDataArrWithMsg($db, "cp_img_tag", $data_arr
				,  "Unable to insert tag in db", "Success in insert of tag class in db", false, false);
		} 
	}
	$_SESSION['captcha_verified'] = true;
	echo "valid";
}	
else if($wrong)
	echo "negative";
	else
	echo "invalid";


