<?php
if(!isset($_GET['as_id']))
    header("location: assignlist.php");

$as_id = $_GET['as_id'];

require_once('header.php');

$token_name = "assignsub_csrf";
$csrf = new CSRF_Protect($token_name);
$_SESSION['captcha_verified'] = false;

?>
<link type="text/css" rel="stylesheet" href="../css/jquery-te-1.4.0.css">

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Assignment Submit Form</h1>
                </div>
                 </div>
                <!-- /.col-lg-12 -->
				  <div class="row">
            <?php if(isset($_SESSION['success']) && $_SESSION['success'] && isset($_SESSION['success_msg']) ){
            unset($_SESSION['success']);            ?>
              <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $_SESSION['success_msg'];
                                unset($_SESSION['success_msg']);
                                ?>
                            </div>
            <?php }?>
            
            <?php if(isset($_SESSION['error']) && $_SESSION['error'] && isset($_SESSION['error_msg'])){
            unset($_SESSION['error']);          ?>
              <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $_SESSION['error_msg'];
                                unset($_SESSION['error_msg']);
                                ?>
                            </div>
            <?php }?>
           </div>
            
           
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Submit Assignment
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
								<div id="upload-wrapper">
                                  <form action="assignsub_db.php" id="Coursefrm" method="post" enctype="multipart/form-data" id="upload_form">
                                   <input type="hidden" name="as_id" value="<?php echo $as_id?>">
                                  <?php echo $csrf->echoInputField(); ?>
                                        <div class="form-group">
                                            <label>Assignment title</label></br>
                                            <?php echo getAssignInfo($db, $as_id)['as_name'] ?>
                                            
                                        </div>
                                      
                                        <div class="form-group">
                                            <label>Shared Assignment in Drive or Dropbox URL </label>
                                            <input name="as_url" value="<?php 
                                            $cn_info = getAssignSubInfo($db, $_SESSION['u_id'], $as_id);
                                            if($cn_info)
                                                echo $cn_info['ab_sub_url'];
                                            ?>" required="true" class="form-control">
                                            
                                        </div>													   
										 <div class="alert alert-danger" id="captcha"  role="alert"><span id = "captchaIcon" class="glyphicon glyphicon-unchecked"></span> I'm not a Robot!</div>
</br></br>
 <button type="button" id="submitme" disabled="disabled" class="btn btn-primary ">Submit Assignment</button>

                                    </form>
									
                                </div>
                                </div>
                               
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <script src="../js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="../js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
     <script>
    $('.jqte-test').jqte();
    
    // settings of status
    var jqteStatus = true;
    $(".status").click(function()
    {
        jqteStatus = jqteStatus ? false : true;
        $('.jqte-test').jqte({"status" : jqteStatus})
    });
</script>
  <script type="text/javascript">
  $(function() {
     $('#captcha').on('click', function() { 
    // From the other examples
    imgcaptcha('','');
}); });
      $('#datetimepicker_frm').datetimepicker({
        format: 'dd/MM/yyyy hh:mm:ss',
        language: 'pt-BR'
      });
      $('#datetimepicker_to').datetimepicker({
        format: 'dd/MM/yyyy hh:mm:ss',
        language: 'pt-BR'
      });
</script>
<?php
require_once('footer.php');
?>
