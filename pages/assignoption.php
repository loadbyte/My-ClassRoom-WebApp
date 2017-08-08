<?php
require_once('../includes/configure.php');
$as_id = $_REQUEST['as_id'];
?>


<a href="assignsub.php?as_id=<?php echo $as_id?>"><button type="button" class="btn btn-primary">Submit Assignment</button> </a>| 
 <?php
if(!isContribExists($db, $_SESSION['u_id'], $as_id)){ 
?>
<button  type="button" onclick="location.href = 'contrib.php?as_id=<?php echo $as_id?>'" class="btn btn-danger">Click to Submit Contributon</button>
<?php } else { ?>
<button  type="button" onclick="location.href = 'contrib.php?as_id=<?php echo $as_id?>'" class="btn btn-success">Update Contributon</button>
<?php } ?>