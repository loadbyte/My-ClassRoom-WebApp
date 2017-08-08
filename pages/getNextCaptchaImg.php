<?php
require_once('../includes/configure.php');

$cp_id = $_REQUEST['cp_id'];

?>
<?php
    $cp_info = getRandCpImg($db);
   ?>

 
 <input type="hidden" name="cp_id" value="<?php echo $cp_info['cp_id'];?>">
	<img class="img-responsive" width="200" height="200" src="../messimages/captcha/<?php echo $cp_info['cp_img_uniq_id'].get_extension($cp_info['cp_img_mine']);?>">
	<button type="button" onclick="nextCaptchaImg(<?php echo $cp_info['cp_id'];?>)" class="btn btn-primary pull-right">choose next</button>
	<button type="button" onclick="prevCaptchaImg(<?php echo $cp_id ;?>)" class="btn btn-primary pull-right">Prev</button>
    
