<?php
require_once('../includes/configure.php');
$g_id = $_REQUEST['g_id'];
$grp_info = getGroupInfo($db, $g_id);

$token_name = "grp_csrf";
$csrf = new CSRF_Protect($token_name);

if(true){
?>

<form action="approvegroup.php" method="post" >
 <?php echo $csrf->echoInputField(); ?>
   <input type="hidden" name="g_id" value="<?php echo $g_id?>">
  <div class="form-group">
    <label for="grp_name">Group Name</label>
    <input type="text" disabled class="form-control" value="<?php echo $grp_info['g_name']?>" id="grp_name">
  </div>
  <?php 
  $usr_info = getUserInfo_g_id($db, $g_id);
  $i =0;
  foreach ($usr_info as $key => $value) {
  	$i++;
  
  ?>
  <div class="form-group">
    <label for="email<?php echo $i;?>">Member <?php echo $i;?></label>
    <input type="email" disabled class="form-control" value="<?php echo $value['u_email']?>" id="email<?php echo $i;?>">
  </div>
  <?php } ?>

  <?php if(isTA_Lect($_SESSION['u_role'])) {?>
              <button type="submit" class="btn btn-success">Approve</button>                                    
                                                <?php } ?>
  
</form>
<?php } else { ?> 
Student Contribution:
<?php 
  $usr_info = getUserInfo_g_id($db, $g_id);
  $i =0;
  foreach ($usr_info as $key => $value) {
    $i++;
  
  ?>
  <div class="form-group">
    <label for="email<?php echo $i;?>">Member <?php echo $i;?></label></br>
    <a href="studcontrib.php?u_id=<?php echo $value['u_id']?>"> Name: <?php echo $value['u_name']?>, Rollno:<?php echo $value['u_roll_num']?> </a>
  </div>
  <?php } ?>

<?php } ?>

