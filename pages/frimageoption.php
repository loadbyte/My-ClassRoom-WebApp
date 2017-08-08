<?php
require_once('../includes/configure.php');
$img_id = $_POST['fr_img_id'];
?>

<button onclick="deletefrimg(<?php echo $img_id?>)" type="button" class="btn btn-danger">Delete</button>