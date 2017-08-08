<?php
require_once('header.php');

$token_name = "addassign_csrf";
$csrf = new CSRF_Protect($token_name);
$_SESSION['captcha_verified'] = false;

?>
<link type="text/css" rel="stylesheet" href="../css/jquery-te-1.4.0.css">

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Assignment Form</h1>
                </div>
                <!-- /.col-lg-12 -->
				
            </div>
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
                            Add Assignment
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
								<div id="upload-wrapper">
                                  <form action="addassignment_db.php" id="Coursefrm" method="post" enctype="multipart/form-data" id="upload_form">
                                  <?php echo $csrf->echoInputField(); ?>
                                        <div class="form-group">
                                            <label>Assignment title</label>
                                            <input name="as_title" required="true" class="form-control">
                                            
                                        </div>
                                       <div class="form-group">
                                            <label>Assignment Description</label></br>
                                            <textarea class="form-control jqte-test" required="true" name="as_desc" id="descid" ></textarea>
                                        </div>
                                        
										<div class="form-group">
                                            <label>Assignment Deadline</label>
											<div class="input-group input-append date" id="datetimepicker_to">
                                            <input required="true" type="text" class="form-control" name="as_dead" />
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                            			</div>
											
                                        </div>														   
										 <div class="alert alert-danger" id="captcha"  role="alert"><span id = "captchaIcon" class="glyphicon glyphicon-unchecked"></span> I'm not a Robot!</div>
</br></br>
 <button type="button" id="submitme" disabled="disabled" class="btn btn-primary ">Add Assignment</button>

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
