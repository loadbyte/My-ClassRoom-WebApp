<?php

function isTA_Lect($u_role){
	if($u_role == 2 || $u_role == 3){
		return true;
	} else
		return false;
}

function isGrpApproved($db, $g_id){

	$db->where ("g_id", $g_id);
	$db->where ("g_status", 1);
	$row = $db->getOne ("groups");
	if($row){
			return true;
	}
	return false;
	
}
function getAssignSubInfo($db, $u_id, $as_id){
	$db->where ("ab_u_id", $u_id);
	$db->where ("ab_as_id", $as_id);
	$row = $db->getOne ("assign_submission");
	return $row;
}

function isAssignSubExists($db, $u_id, $as_id){

	$db->where ("ab_u_id", $u_id);
	$db->where ("ab_as_id", $as_id);
	$row = $db->getOne ("assign_submission");
	if($row){
			return true;
	}
	return false;
	
}
function getUserInfo($db, $u_id){
	$db->where ("u_id", $u_id);

	$row = $db->getOne ("users");
	return $row;
}

function getStudContribInfo($db, $u_id, $as_id){
	$db->where ("cn_u_id", $u_id);
	$db->where ("cn_as_id", $as_id);
	$row = $db->getOne ("contribution");
	return $row;
}

function isStudContribExists($db, $u_id, $as_id){

	$db->where ("cn_u_id", $u_id);
	$db->where ("cn_as_id", $as_id);
	$row = $db->getOne ("contribution");
	if($row){
			return true;
	}
	return false;
	
}

function getContribInfo($db, $u_id, $as_id){
	$db->where ("cn_u_id", $u_id);
	$db->where ("cn_as_id", $as_id);
	$row = $db->getOne ("contribution");
	return $row;
}

function isContribExists($db, $u_id, $as_id){

	$db->where ("cn_u_id", $u_id);
	$db->where ("cn_as_id", $as_id);
	$row = $db->getOne ("contribution");
	if($row){
			return true;
	}
	return false;
	
}

function getUserInfo_c_id_by_uid($db, $c_id, $u_idmin, $u_idmax){
	
	//subquery
	$ids = $db->subQuery ();
	$ids->where ("ce_c_id", $c_id, "=");
	$ids->get ("course_enrolled", null, "ce_u_id");
	$db->where ("u_id", $ids, 'in');
	$db->where ("u_id", $u_idmin, '>');
	$db->where ("u_id", $u_idmax, '<');
	$rows = $db->get ("users");

	$c_arr_info = array();
	foreach ($rows as $row) {
		$abt_arr = array();
		$abt_arr['u_id'] = $row['u_id'];
		$abt_arr['u_name'] = $row['u_name'];
		$abt_arr['u_email'] = $row['u_email'];
		
		$abt_arr['u_roll_num'] = $row['u_roll_num'];
		$abt_arr['u_role'] = $row['u_role'];
		$abt_arr['u_ts'] = $row['u_ts'];
		$c_arr_info[$abt_arr['u_id']] = $abt_arr;
	}
	return $c_arr_info;
}


function getUserInfo_c_id($db, $c_id){
	
	//subquery
	$ids = $db->subQuery ();
	$ids->where ("ce_c_id", $c_id, "=");
	$ids->get ("course_enrolled", null, "ce_u_id");
	$db->where ("u_id", $ids, 'in');
	$rows = $db->get ("users");

	$c_arr_info = array();
	foreach ($rows as $row) {
		$abt_arr = array();
		$abt_arr['u_id'] = $row['u_id'];
		$abt_arr['u_name'] = $row['u_name'];
		$abt_arr['u_email'] = $row['u_email'];
		
		$abt_arr['u_roll_num'] = $row['u_roll_num'];
		$abt_arr['u_role'] = $row['u_role'];
		$abt_arr['u_ts'] = $row['u_ts'];
		$c_arr_info[$abt_arr['u_id']] = $abt_arr;
	}
	return $c_arr_info;
}

function getUserInfo_g_id($db, $g_id){
	//$rs = $db->select("SELECT * FROM `users` WHERE u_id in (SELECT ug_u_id from user_group where ug_g_id = $g_id)" );
	//subquery
	$ids = $db->subQuery ();
	$ids->where ("ug_g_id", $g_id, "=");
	$ids->get ("user_group", null, "ug_u_id");
	$db->where ("u_id", $ids, 'in');
	$rows = $db->get ("users");

	$c_arr_info = array();
	foreach ($rows as $row) {
		$abt_arr = array();
		$abt_arr['u_id'] = $row['u_id'];
		$abt_arr['u_name'] = $row['u_name'];
		$abt_arr['u_email'] = $row['u_email'];
		
		$abt_arr['u_roll_num'] = $row['u_roll_num'];
		$abt_arr['u_role'] = $row['u_role'];
		$abt_arr['u_ts'] = $row['u_ts'];
		$c_arr_info[$abt_arr['u_id']] = $abt_arr;
	}
	return $c_arr_info;
}

function getAssignInfo($db, $as_id){
	//$rs = $db->select("SELECT * FROM groups where g_id=$g_id" );
	
	$db->where ("as_id", $as_id);
	$row = $db->getOne ("assignments");
	return $row;
}

function getCourseInfo($db, $c_id){
	//$rs = $db->select("SELECT * FROM groups where g_id=$g_id" );
	
	$db->where ("c_id", $c_id);
	$row = $db->getOne ("course");
	return $row;
}

function getGroupInfo($db, $g_id){
	//$rs = $db->select("SELECT * FROM groups where g_id=$g_id" );
	
	$db->where ("g_id", $g_id);
	$row = $db->getOne ("groups");
	return $row;
}


function getCaptchaImages($db){
  $knwn = rand(2,6);
  $unknwn = 9-$knwn; // 9 images in captcha;
  $cp_arr = getRandCpImgWithLimit($db, $unknwn);
  $kwn_arr = getRandKownImgWithLimit($db, $knwn);
  $cp_imgs = array ();
  foreach ($cp_arr as $key => $value) {
    $cp_imgs[$value['cp_img_uniq_id'].get_extension($value['cp_img_mine'])] = 0;
  }
  foreach ($kwn_arr as $key => $value) {
    $cp_imgs[getCpImgNmExt($db, $value['cl_cp_id'])]=1;
  }
   return $cp_imgs; 
}

function getCpImgNmExt($db, $cp_id){
	//$rs = $db->select("SELECT * FROM captcha_img where cp_id=$cp_id" );
	
	$db->where ("cp_id", $cp_id);
	$abt_arr = $db->getOne ("captcha_img");
	
	
	$rtn = $abt_arr['cp_img_uniq_id'].get_extension($abt_arr['cp_img_mine']);
	return $rtn;
}

function getCpImgInfo($db, $cp_id){
	//$rs = $db->select("SELECT * FROM captcha_img where cp_id=$cp_id" );
	$db->where ("cp_id", $cp_id);
	$abt_arr = $db->getOne ("captcha_img");
	
	return $abt_arr;
}

function getRandCpImg($db){
	//$rs = $db->select("SELECT * FROM captcha_img where cp_known =0 ORDER BY RAND() LIMIT 1" );
	$params = Array(0);
	$row = $db->rawQueryOne ('select * from captcha_img  where cp_known =? order by rand() limit 1',$params) ;
	
	return $row;
}

function getRandCpImgWithLimit($db, $limit){
	//$rs = $db->select("SELECT * FROM captcha_img where cp_known =0 ORDER BY RAND() LIMIT $limit" );
	$params = Array(0,$limit);
	$rows = $db->rawQuery ('select * from captcha_img  where cp_known =? order by rand() limit ?',$params);
	
	$c_arr_info = array();
	foreach ($rows as $row){
		$abt_arr = array();
		$abt_arr['cp_id'] = $row['cp_id'];
		$abt_arr['cp_m_id'] = $row['cp_m_id'];
		$abt_arr['cp_pos_id'] = $row['cp_pos_id'];
		$abt_arr['cp_img_mine'] = $row['cp_img_mine'];
		$abt_arr['cp_img_uniq_id'] = $row['cp_img_uniq_id'];
		$abt_arr['cp_known'] = $row['cp_known'];
		$abt_arr['cp_ts'] = $row['cp_ts'];
		$c_arr_info[$abt_arr['cp_id']] = $abt_arr;
	}
	return $c_arr_info;
}

function getRandkownNegImgWithLimit($db, $limit, $ic_id){
	//$rs = $db->select("SELECT ic_id from img_category ORDER BY RAND() LIMIT 1" );
	$params = Array($ic_id);
	$rows = $db->rawQuery ('SELECT ic_id from img_category where ic_id != ? ORDER BY RAND() LIMIT 1 ',$params);
	
	$cl_ic_id = 0;
	foreach($rows as $row){
			$cl_ic_id = $row['ic_id'];
	}

	//$rs = $db->select("SELECT * FROM verified_classified_images where cl_ic_id = $cl_ic_id ORDER BY RAND() LIMIT $limit" );
	$params = Array($cl_ic_id,$limit);
	$rows = $db->rawQuery ('SELECT * FROM verified_classified_images where cl_ic_id = ? ORDER BY RAND() LIMIT ?',$params);
	
	$c_arr_info = array();
	foreach ($rows as $row){
		$abt_arr = array();
		$abt_arr['cl_id'] = $row['cl_id'];
		$abt_arr['cl_cp_id'] = $row['cl_cp_id'];
		$abt_arr['cl_ic_id'] = $row['cl_ic_id'];
		$abt_arr['cl_view_cnt'] = $row['cl_view_cnt'];
		$abt_arr['cl_ts'] = $row['cl_ts'];
		$c_arr_info[$abt_arr['cl_id']] = $abt_arr;
	}
	return $c_arr_info;
}

function getRandKownImgWithLimit($db, $limit){
	//$rs = $db->select("SELECT ic_id from img_category ORDER BY RAND() LIMIT 1" );
	
	$row = $db->rawQueryOne ('SELECT ic_id from img_category ORDER BY RAND() LIMIT 1 ');
	
	$cl_ic_id = 0;
	if($row){
			$cl_ic_id = $row['ic_id'];
	}

	//$rs = $db->select("SELECT * FROM verified_classified_images where cl_ic_id = $cl_ic_id ORDER BY RAND() LIMIT $limit" );
	$params = Array($cl_ic_id,$limit);
	$rows = $db->rawQuery ('SELECT * FROM verified_classified_images where cl_ic_id = ? ORDER BY RAND() LIMIT ?',$params);
	
	$c_arr_info = array();
	foreach ($rows as $row){
		$abt_arr = array();
		$abt_arr['cl_id'] = $row['cl_id'];
		$abt_arr['cl_cp_id'] = $row['cl_cp_id'];
		$abt_arr['cl_ic_id'] = $row['cl_ic_id'];
		$abt_arr['cl_view_cnt'] = $row['cl_view_cnt'];
		$abt_arr['cl_ts'] = $row['cl_ts'];
		$c_arr_info[$abt_arr['cl_id']] = $abt_arr;
	}
	return $c_arr_info;
}

function getDTarr($db){
	$rows = $db->get("Day_time");
	return $rows;
}

function getMfdarr($db){
	$rows = $db->get("mess_food_day_menu");
	return $rows;
}
function getCategoryList($db){
	//$rs = $db->select("SELECT * FROM  img_category " );
	
	$rows = $db->get("img_category");
	
	$c_arr_info = array();
	foreach ($rows as $row){
		$c_arr = array();
		$c_arr['ic_id'] = $row['ic_id'];
		$c_arr['ic_name'] = $row['ic_name'];
		$c_arr['ic_ts'] = $row['ic_ts'];
		$c_arr_info[$c_arr['ic_id']] = $c_arr;
	}
		return $c_arr_info;
	
}

function updateDataArrWithMsg($db, $table, $data_arr,  $condition, $err_msg, $succ_msg, $err_set, $succ_set){
			//$id = $db->update_array($table , $data_arr, $condition);
			foreach ($condition as $key => $value) {
				$db->where ($key, $value);
			}
			//$db->where ("g_id", 25);
			if (!$db->update ($table, $data_arr)){
					$_SESSION['error'] = ($err_set)?true:false;
					$_SESSION['error_msg'] = $err_msg ;
					return NULL;
			}else{
					$_SESSION['success'] = ($succ_set)?true:false ;
					$_SESSION['success_msg'] = $succ_msg;
					
					return true;
					
			}
}


function insertDataArrWithMsg($db, $table, $data_arr, $err_msg, $succ_msg, $err_set, $succ_set){
			$id = $db->insert($table , $data_arr);
			if (!$id) {
					$_SESSION['error'] = ($err_set)?true:false;
					$_SESSION['error_msg'] = $err_msg ;
					return NULL;
			}else{
					$_SESSION['success'] = ($succ_set)?true:false ;
					$_SESSION['success_msg'] = $succ_msg;
					
					return $id;
					
			}
}

function isEmailExists($db, $email){

	//$rs = $db->select("SELECT * FROM users where u_email = '$email'" );
	$db->where ("u_email", $email);
	$row = $db->getOne ("users");
	if($row){
			return true;
	}
	return false;
	
}

function getUID_Email($db, $email){

	//$rs = $db->select("SELECT * FROM users where u_email = '$email'" );
	$db->where ("u_email", $email);
	$row = $db->getOne ("users");
	if($row){
			return $row['u_id'];;
	}
	return "";
	
}

function getAssignCounts($db, $c_id){

	//$rs = $db->select("SELECT * FROM groups" );
	$db->where ("as_c_id", $c_id);
	$count = $db->getValue ("assignments", "count(*)");

	return $count;
	
}

function getAssignInfoPage($db, $c_id, $offset, $itemsPerPage){
	//$rs = $db->select("SELECT * FROM  groups order by g_id desc limit $offset, $itemsPerPage " );
	$params = Array($c_id, $offset, $itemsPerPage);
	$rows = $db->rawQuery ('SELECT * FROM  assignments where as_c_id = ? order by as_c_id desc limit ?, ?',$params);
	
	$c_arr_info = array();
	foreach ($rows as $row){
		$c_arr = array();
		$c_arr['as_id'] = $row['as_id'];
		$c_arr['as_name'] = $row['as_name'];
		$c_arr['as_u_id'] = $row['as_u_id'];
		$c_arr['as_c_id'] = $row['as_c_id'];
		$c_arr['as_desc'] = $row['as_desc'];
		$c_arr['as_dead'] = $row['as_dead'];
		
		$c_arr['as_ts'] = $row['as_ts'];
		$c_arr_info[$c_arr['as_id']] = $c_arr;
	}
		return $c_arr_info;
	
}




function getGroupCounts($db, $c_id){

	//$rs = $db->select("SELECT * FROM groups" );
	$db->where ("g_c_id", $c_id);
	$count = $db->getValue ("groups", "count(*)");

	return $count;
	
}

function getGroupInfoPage($db, $c_id, $offset, $itemsPerPage){
	//$rs = $db->select("SELECT * FROM  groups order by g_id desc limit $offset, $itemsPerPage " );
	$params = Array($c_id, $offset, $itemsPerPage);
	$rows = $db->rawQuery ('SELECT * FROM  groups where g_c_id = ? order by g_id desc limit ?, ?',$params);
	
	$c_arr_info = array();
	foreach ($rows as $row){
		$c_arr = array();
		$c_arr['g_id'] = $row['g_id'];
		$c_arr['g_name'] = $row['g_name'];
		$c_arr['g_u_id'] = $row['g_u_id'];
		$c_arr['g_status'] = $row['g_status'];
		$c_arr['g_ts'] = $row['g_ts'];
		$c_arr_info[$c_arr['g_id']] = $c_arr;
	}
		return $c_arr_info;
	
}

function getEnrolledCourse($db, $u_id){
	//$rs = $db->select("SELECT * FROM  course order by c_id desc limit $offset, $itemsPerPage " );
	$ids = $db->subQuery ();
	$ids->where ("ce_u_id", $u_id, "=");
	$ids->get ("course_enrolled", null, "ce_c_id");
	$db->where ("c_id", $ids, 'in');
	$rows = $db->get ("course");

	$c_arr_info = array();
	foreach ($rows as $row){
		$c_arr = array();
		$c_arr['c_id'] = $row['c_id'];
		$c_arr['c_u_id'] = $row['c_u_id'];
		$c_arr['c_from'] = $row['c_from'];
		$c_arr['c_to'] = $row['c_to'];
		$c_arr['c_title'] = $row['c_title'];
		$c_arr['c_desc'] = $row['c_desc'];
		$c_arr['c_ts'] = $row['c_ts'];
		$c_arr_info[$c_arr['c_id']] = $c_arr;
	}
		return $c_arr_info;
	
}

function getCourseCounts($db){

	//$rs = $db->select("SELECT * FROM course" );
	$count = $db->getValue ("course", "count(*)");

	return $count;
}


function getCourseInfoPage($db, $offset, $itemsPerPage){
	//$rs = $db->select("SELECT * FROM  course order by c_id desc limit $offset, $itemsPerPage " );
	$params = Array($offset, $itemsPerPage);
	$rows = $db->rawQuery ('SELECT * FROM  course order by c_id desc limit ?, ?',$params);
	
	$c_arr_info = array();
	foreach ($rows as $row){
		$c_arr = array();
		$c_arr['c_id'] = $row['c_id'];
		$c_arr['c_u_id'] = $row['c_u_id'];
		$c_arr['c_from'] = $row['c_from'];
		$c_arr['c_to'] = $row['c_to'];
		$c_arr['c_title'] = $row['c_title'];
		$c_arr['c_desc'] = $row['c_desc'];
		$c_arr['c_ts'] = $row['c_ts'];
		$c_arr_info[$c_arr['c_id']] = $c_arr;
	}
		return $c_arr_info;
	
}


function get_extension($imagetype)
   {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/cis-cod': return '.cod';
           case 'image/gif': return '.gif';
           case 'image/ief': return '.ief';
           case 'image/jpeg': return '.jpg';
           case 'image/pipeg': return '.jfif';
           case 'image/tiff': return '.tif';
           case 'image/x-cmu-raster': return '.ras';
           case 'image/x-cmx': return '.cmx';
           case 'image/x-icon': return '.ico';
           case 'image/x-portable-anymap': return '.pnm';
           case 'image/x-portable-bitmap': return '.pbm';
           case 'image/x-portable-graymap': return '.pgm';
           case 'image/x-portable-pixmap': return '.ppm';
           case 'image/x-rgb': return '.rgb';
           case 'image/x-xbitmap': return '.xbm';
           case 'image/x-xpixmap': return '.xpm';
           case 'image/x-xwindowdump': return '.xwd';
           case 'image/png': return '.png';
           case 'image/x-jps': return '.jps';
           case 'image/x-freehand': return '.fh';
           default: return false;
       }
   }




function time_passed($timestamp){
    //type cast, current time, difference in timestamps
    $timestamp      = (int) $timestamp;
    $current_time   = time();
    $diff           = $current_time - $timestamp;
    
    //intervals in seconds
    $intervals      = array (
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
    );
    
    //now we just find the difference
    if ($diff == 0)
    {
        return 'just now';
    }    

    if ($diff < 60)
    {
        return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
    }        

    if ($diff >= 60 && $diff < $intervals['hour'])
    {
        $diff = floor($diff/$intervals['minute']);
        return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
    }        

    if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
    {
        $diff = floor($diff/$intervals['hour']);
        return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
    }    

    if ($diff >= $intervals['day'] && $diff < $intervals['week'])
    {
        $diff = floor($diff/$intervals['day']);
        return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
    }    

    if ($diff >= $intervals['week'] && $diff < $intervals['month'])
    {
        $diff = floor($diff/$intervals['week']);
        return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
    }    

    if ($diff >= $intervals['month'] && $diff < $intervals['year'])
    {
        $diff = floor($diff/$intervals['month']);
        return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
    }    

    if ($diff >= $intervals['year'])
    {
        $diff = floor($diff/$intervals['year']);
        return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
    }
}

function shuffle_assoc($array)
{
    // Initialize
        $shuffled_array = array();


    // Get array's keys and shuffle them.
        $shuffled_keys = array_keys($array);
        shuffle($shuffled_keys);


    // Create same array, but in shuffled order.
        foreach ( $shuffled_keys AS $shuffled_key ) {

            $shuffled_array[  $shuffled_key  ] = $array[  $shuffled_key  ];

        } // foreach


    // Return
        return $shuffled_array;
}

function check_cookie($db){
	if(isset($_COOKIE['myclasscookue']) && isset($_COOKIE['myclasscookp'])){
		$_SESSION['u_email'] = $_COOKIE['myclasscookue'];
		$_SESSION['u_pass'] = $_COOKIE['myclasscookp'];
		$email=$_SESSION['u_email'];
		$password= $_SESSION['u_pass'];
		$db->where ("u_email", $email);
		$row = $db->getOne ("users");

		if($row) {
	
			if(($row["u_email"]==$email)&&($row["u_pass"]==$password)){
				$_SESSION['login'] = true;
				$_SESSION['u_id'] = $row['u_id'];
				$_SESSION['u_role']=$row["u_role"];
				
			}
		}
	}	 
}
 function mailInvitelink($message,$to_email,$subject,$from_email,$host_stmp,$host_port){
	$subject = "Invitaion from My ClassRoom for Registration";

	$mail = new PHPMailer();

	$mail->IsSMTP();  // telling the class to use SMTP
	$mail->Host     = $host_stmp; // SMTP server

	$mail->SetFrom( $from_email, 'My class Room');
	$mail->Port = $host_port;
	$mail->AddAddress($to_email);

		
	$mail->IsHTML(true);
	$mail->Subject  = $subject;


	$mail->Body = $message;

	$mail->WordWrap = 50;

	if(!$mail->Send()) {
	  return false;
	  //echo 'Mailer error: ' . $mail->ErrorInfo;
	} else {
	 return true;
	}
	

}
 function mailresetlink($uri,$html_tmpl,$token,$to_email,$subject,$from_email,$host_stmp,$host_port){
	$subject = "Reset Password link for My ClassRoom";
	
	

	$message = "
	Link for Password reset for My ClassRoom:
	
	$uri/reset.php?token=$token

	";
	$mail = new PHPMailer();

	$mail->IsSMTP();  // telling the class to use SMTP
	$mail->Host     = $host_stmp; // SMTP server

	$mail->SetFrom( $from_email, 'My class Room');
	$mail->Port = $host_port;
	$mail->AddAddress($to_email);

		
	$mail->IsHTML(true);
	$mail->Subject  = $subject;


	$mail->Body = $message;

	$mail->WordWrap = 50;

	if(!$mail->Send()) {
	  return false;
	  //echo 'Mailer error: ' . $mail->ErrorInfo;
	} else {
	 return true;
	}
	

}

function getRandomString($length) {
    $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
    $validCharNumber = strlen($validCharacters);
    $result = "";

    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
	return $result;
}