<?php
require_once('../includes/configure.php');
require_once('../includes/img_upload_resize_crop.php');




$token_name = "mess_img_csrf";
$csrf = new CSRF_Protect($token_name);


//Accept HTTP POST comming as Ajax request
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' 
	&& $csrf->isTokenValid($_POST[$token_name])){
	
	//Check empty file field
    if(!isset($_FILES['image_file_a']) || !is_uploaded_file($_FILES['image_file_a']['tmp_name'])){
       die('Image file is Missing!');
    }

	 	
	$b_m_id = uploadImg($_FILES['image_file_b'],$db);
	$a_m_id = uploadImg($_FILES['image_file_a'],$db);
	$data_m["mba_b_m_id"]  = $b_m_id;
	$data_m["mba_a_m_id"]  = $a_m_id;
	$id = insertDataArrWithMsg($db, "mess_before_after", $data_m,  "Unable to insert Mess Image in db!!"
						, "New Image ADD successfully!!", true, true);
	
}
function uploadImg($file, $db){
	//To Crop
$m_width = "250";
$m_height = "250";
$fromX = "50";
$fromY = "0";
$stride = 120;
	############ Configuration ##############
$img_info["image_max_size_width"] 				= 1250; //Maximum image size (height and width)
$img_info["image_max_size_height"] 				= 832; //Maximum image size (height and width)
$img_info["thumbnail_size"]  				= 500; //Thumbnails will be cropped and resized to 200x200 pixels
$img_info["thumbnail_prefix"]				= "thumb_"; //thumb Prefix
$img_info["destination_folder"]				= 'uploads/'; //Image directory ends with / (slash)
$img_info["thumbnail_destination_folder"]	= 'uploads/thumbs/'; //Thumbnail directory ends with / (slash)
$img_info["quality"] 						= 350; //jpeg quality
$img_info["random_file_name"]				= true; //randomize each file name
##########################################
	$img_info["image_data"] = $file;
	$img_info["unique_id"] 	= uniqid(); //unique id for random filename
	//Check destination dir
	if(!file_exists($img_info["destination_folder"])){ 
		die( $img_info["destination_folder"]. " - (Folder doesn't exist!)");
	}

	

	//Get image size info from a valid image file	
	$im_info = getimagesize($img_info["image_data"]["tmp_name"]); 
	if($im_info){
        $img_info["image_width"]	= $im_info[0]; //image width
        $img_info["image_height"]	= $im_info[1]; //image height
        $img_info["image_type"]		= $im_info['mime']; //image type
    }else{
        die("Make sure image file is valid!");
    }

	$img_info["img_res"] = get_image_resource($img_info);
	
	//Resize image file
	if($img_info["img_res"] ){
		
	 	$resize_image = resize_image($img_info); //call image resize function
		
		if($resize_image ){

			$data["m_u_id"]  = $_SESSION['u_id'];
				$data["m_mfd_id"]  = $_POST['m_mfd_id'];
				$data["m_dt_id"]  = $_POST['m_dt_id'];

				$_SESSION["m_mfd_id"]  = $_POST['m_mfd_id'];
				$_SESSION["m_dt_id"]  = $_POST['m_dt_id'];
							
				$data["m_uniq_id"] = $img_info["unique_id"];
				$data["m_img_mine"] = $im_info['mime'];
				
				
				$id = insertDataArrWithMsg($db, "mess_images", $data,  "Unable to insert Mess Image in db"
						, "New Image ADD successfully!", true, true);
				if (!$id) {
					echo $_SESSION['error_msg'] ;
				}else{
					echo $_SESSION['success_msg'].' '.$data["m_uniq_id"].'<br />';
					
					
				}
				createCaptcha($db, $im_info, $id,"uploads/".$img_info["unique_id"].get_extention($img_info),$m_width,$m_height,$fromX,$fromY, $stride);
			return $id;
		}
	}else{
		die("Error creating image resource!");
	}
}



//$csrf->deleteToken();


function createCaptcha($db, $im_info, $m_id, $src_file,$width,$height,$fromX,$fromY,$stride){
	$mess_image = new _image;
	$mess_image->newPath = 'captcha/';
	
	$srcwidth = $mess_image->get_image_width($src_file);
	$srcheight = $mess_image->get_image_height($src_file);

	//$cropped = $mess_image->cropFromFile($src_file, $width,$height,$fromX,$fromY);

	for($i=0,$pos = 1;$i<=$srcwidth-$width; $i+=$stride){
		for($j=0; $j<=$srcheight-$height; $j+=$stride) {
			//$cropped = $your_image->crop($width,$height,(string)$i,(string)$j);
			$mess_image->newName = uniqid();
			$data_arr["cp_m_id"] =  $m_id;
			$data_arr["cp_pos_id"] =  $pos++;
			$data_arr["cp_img_uniq_id"] = $mess_image->newName;
			$data_arr["cp_img_mine"] = $im_info['mime'];
			$cropped = $mess_image->cropFromFile($src_file, $width,$height,(string)$i,(string)$j);
			insertDataArrWithMsg($db, "captcha_img", $data_arr,  "Unable to insert captcha in db", "Success in insert captcha in db", true, true);
		}
		
	}

	echo "Captcha Image was successfully uploaded.</br>";
}

#####  Function to proportionally resize images ##### 
function resize_image($img_info){
	if($img_info["image_width"] <= 0 || $img_info["image_height"] <= 0){
		return false; //return false if nothing to resize
	}

	//Path for saving resized images
	if($img_info["random_file_name"]){
		$new_image_name = $img_info["unique_id"] . get_extention($img_info);
	}else{
		$new_image_name = $img_info["image_data"]["name"];
	}

	$img_info["save_dir"] = $img_info["destination_folder"] . $new_image_name;

    //Do not resize if image is smaller than max size
    if($img_info["image_width"] <= $img_info["image_max_size_width"] && $img_info["image_height"] <= $img_info["image_max_size_height"]){
		//Create a new true color image
		$img_info["canvas"]  = imagecreatetruecolor($img_info["image_width"], $img_info["image_height"]); 
 
       //Copy and resize part of an image with resampling
    if(imagecopyresampled($img_info["canvas"], $img_info["img_res"], 0, 0, 0, 0, $img_info["image_width"],  $img_info["image_height"], $img_info["image_width"], $img_info["image_height"])){
       if(save_image($img_info)){
		   return $new_image_name;
	   }
	}
    }

    //Construct a proportional size of new image
     $image_scale    = min($img_info["image_max_size_width"]/$img_info["image_width"], $img_info["image_max_size_height"]/$img_info["image_height"]);
    $new_width      = ceil($image_scale * $img_info["image_width"]);
    $new_height     = ceil($image_scale * $img_info["image_height"]);
    
	//Create a new true color image
	$img_info["canvas"]  = imagecreatetruecolor($new_width, $new_height); 
 
    //Copy and resize part of an image with resampling
    if(imagecopyresampled($img_info["canvas"], $img_info["img_res"], 0, 0, 0, 0, $new_width, $new_height, $img_info["image_width"], $img_info["image_height"])){
       if(save_image($img_info)){
		   return $new_image_name;
	   }
	}
}


##### Function to create thumbnails! images will be cropped and exact size ######
function gen_thumbnail($img_info){
	if($img_info["image_width"] <= 0 || $img_info["image_height"] <= 0){
		return false; //return false if nothing to resize
	} 
 
 	//Path for saving resized images
	if($img_info["random_file_name"]){
		$new_image_name = $img_info["thumbnail_prefix"].$img_info["unique_id"] . get_extention($img_info);
	}else{
		$new_image_name = $img_info["thumbnail_prefix"] . $img_info["image_data"]["name"];
	}
	
	$img_info["save_dir"] = $img_info["thumbnail_destination_folder"] . $new_image_name;

   //Offsets 
    if( $img_info["image_width"] > $img_info["image_height"]){
        $y_offset = 0;
        $x_offset = ($img_info["image_width"] - $img_info["image_height"]) / 2;
        $s_size     = $img_info["image_width"] - ($x_offset * 2);
    }else{
        $x_offset = 0;
        $y_offset = ($img_info["image_height"] - $img_info["image_width"]) / 2;
        $s_size = $img_info["image_height"] - ($y_offset * 2);
    }
	
	//Create a new true color image
    $img_info["canvas"] = imagecreatetruecolor($img_info["thumbnail_size"], $img_info["thumbnail_size"]); 
    
    //Copy and resize part of an image with resampling
    if(imagecopyresampled($img_info["canvas"], $img_info["img_res"], 0, 0, $x_offset, $y_offset, $img_info["thumbnail_size"], $img_info["thumbnail_size"], $s_size, $s_size)){
       if(save_image($img_info)){
		   return $new_image_name;
	   }
    }
}

##### Saves images to destination directory ######
function save_image($img_info){
    switch(strtolower($img_info["image_type"])){
        case 'image/png': 
            imagepng($img_info["canvas"], $img_info["save_dir"]); //save png file
			break;
        
		case 'image/gif': 
            imagegif($img_info["canvas"], $img_info["save_dir"]); //save gif file
			break;
			       
        case 'image/jpeg': case 'image/pjpeg': 
            imagejpeg($img_info["canvas"], $img_info["save_dir"], $img_info["quality"]);  //save jpeg file
			break;

        default: 
			return false;
    }
	
	imagedestroy($img_info["canvas"]); //free-up memory
	return true;
}

##### Create a new image resource from file #####
function get_image_resource($img_info){
    
    switch($img_info["image_type"]){
        case 'image/png':
            return imagecreatefrompng($img_info["image_data"]["tmp_name"]);
        case 'image/gif':
           return imagecreatefromgif($img_info["image_data"]["tmp_name"]);     
        case 'image/jpeg': 
		case 'image/pjpeg':
            return imagecreatefromjpeg($img_info["image_data"]["tmp_name"]);
        default:
			return false;
		}
}

##### Returns file extension from given image type ######
function get_extention($img_info){
   switch($img_info["image_type"]){
	   case 'image/gif': 
	   		return ".gif";
	   case 'image/jpeg': 
	   case 'image/pjpeg':
	   		return ".jpg";
	   case 'image/png': 
	   		return ".png";
   }
}
function get_exten($imagetype)
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
