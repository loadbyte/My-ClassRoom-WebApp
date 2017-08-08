<?php
require_once('../includes/configure.php');
$frm_id = $_REQUEST['frm_id'];
$url = $_REQUEST['url'];

$token_name = "captcha_csrf";
$csrf = new CSRF_Protect($token_name);
$valid = true;
//known list
//$cp_imgs = getCaptchaImages($db);
// 9 images in captcha;
$knwn = rand(2,4); // rand image in range 2,4
  $unknwn = 5; // unkown image
  $negclass = 5-$knwn; // negative class 
  $kwn_arr = getRandKownImgWithLimit($db, $knwn); 

  $cp_arr = getRandCpImgWithLimit($db, $unknwn);
  //echo $knwn." ".$unknwn;
  //print_r($cp_arr);
  $size = 0;
  if(empty($kwn_arr)){

    $valid = false;

  } else {
    $ic_id = array_values($kwn_arr)[0]['cl_ic_id']; // ic_id from known class
    $neg_arr = getRandkownNegImgWithLimit($db, $negclass, $ic_id); //get img not eq to ic_id
  }
  if($valid ) {
  $cp_imgs = array ();
  
 
   foreach ($neg_arr as $key => $value) {
       $cp_imgs[getCpImgNmExt($db, $value['cl_cp_id'])]
         =array('cp_id' => $value['cl_cp_id'], 'cl_ic_id' => $value['cl_ic_id'], 'knwn' => -1);
   }

  foreach ($cp_arr as $key => $value) {
       $cp_imgs[$value['cp_img_uniq_id'].get_extension($value['cp_img_mine'])] 
       = array('cp_id' => $value['cp_id'], 'cl_ic_id' => 0 , 'knwn' => 0);
  }

    $sample_flag = true;
  foreach ($kwn_arr as $key => $value) {
    
     if($sample_flag ){
       $sample_flag = false;
       $cp_imgs[getCpImgNmExt($db, $value['cl_cp_id'])]
       =array('cp_id' => $value['cl_cp_id'], 'cl_ic_id' => $value['cl_ic_id'], 'knwn' => 2);
    } else
         $cp_imgs[getCpImgNmExt($db, $value['cl_cp_id'])]
         =array('cp_id' => $value['cl_cp_id'], 'cl_ic_id' => $value['cl_ic_id'], 'knwn' => 1);
  }

  $cp_imgs = shuffle_assoc($cp_imgs);
   
//print_r($cp_imgs);

$_SESSION['captcha_arr']  = $cp_imgs;

$size = sizeof($cp_imgs);

}


//if captcha is not verified 
if($size == 10 && $valid ) {
?>

<form id="captchaform" method="post" action="verifycaptcha.php">
<?php echo $csrf->echoInputField(); ?>
<div class="container">
 <div class="row">
 <div class="col-md-6">
<div class="panel-body">
    <ul class="chat">
      
        <li class="right clearfix">
            <span class="chat-img pull-right">
     <?php

  foreach ($cp_imgs as $img_name => $status_arr) {
    if($status_arr['knwn'] == 2){
    ?>
             
                <img width="120" height="120" src="../messimages/captcha/<?php echo $img_name?>" alt="User Avatar" >
                <?php
                break;
              }
            }
                ?>
            </span>
            <div class="chat-body clearfix">
                
              <h3 id="captcha_msg">Select all images below that match this one:</h3>
            </div>
        </li>
        </ul>
      </div>
      </div>
      </div>
  
  <?php
  $i=0;
  foreach ($cp_imgs as $img_name => $status_arr) {
    if($status_arr['knwn'] != 2){
    if($i++%3 == 0) { ?>
      <div class="row">
      <div class="col-md-8">
 <?php   }
  ?>
  
  <div class="col-xs-4 col-sm-3 col-md-2 nopad text-center">
    <label class="image-checkbox">
   
      <img class="img-responsive" width="150" height="150" src="../messimages/captcha/<?php echo $img_name?>">
      <input type="checkbox" name="captcha_images[]" value="<?php echo $img_name?>" />
      <i class="fa fa-check hidden"></i>
    </label>
  </div>
  

<?php 
if($i%3 == 0)
 echo  '</div></div>'; 
}
}
?>
</div>

 <div class="modal-footer">

  <button type="button"  onclick="formSubmitID('<?php echo $url?>', '<?php echo $frm_id?>')" class="btn btn-primary pull-right">Verify</button>
    </div>
 

</form>

<?php } else {
  ?>
Oops something went wrong. Please close and open again!
  <?php
}
?>