<?php
require_once('header.php');

$token_name = "creategrp_csrf";
$csrf = new CSRF_Protect($token_name);
$_SESSION['captcha_verified'] = false;
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Group Creating Form</h1>
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
                            Give Ur EmailId along with ur team members
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
								<div id="upload-wrapper">
                                
<div class="container">
       <form id="grgForm" method="post" action="creategroup_db.php"
 data-toggle="validator"
        >
        <div class="form-group">
                <label>Group Name</label>
                <input name="grp_name" required="true" class="form-control">
                
            </div>

            <div class="input-group  form-group">
          
          <input type="text" required="true" placeholder="Member1 Email Id" name="email1" id="memb_in1" data-error="Email Id is not Register" class="form-control" data-remote="validate_email.php">
           <div class="help-block with-errors"></div>
           <div class="input-group-btn"> 
            <input type="checkbox" id="memb1" disabled="true" checked data-toggle="toggle">
          </div>
        </div>

        <div class="input-group  form-group">
          
          <input type="text"  placeholder="Member2 Email Id" disabled="true" name="email2" id="memb_in2" data-error="Email Id is not Register" class="form-control" data-remote="validate_email.php">
           <div class="help-block with-errors"></div>
           <div class="input-group-btn"> 
            <input type="checkbox" id="memb2"  data-toggle="toggle">
          </div>
        </div>
       
<div class="input-group  form-group">
          
          <input type="text"  placeholder="Member3 Email Id" disabled="true" name="email3" id="memb_in3" data-error="Email Id is not Register" class="form-control" data-remote="validate_email.php">
           <div class="help-block with-errors"></div>
           <div class="input-group-btn"> 
            <input type="checkbox" id="memb3"  data-toggle="toggle">
          </div>
        </div>
        
        <div class="input-group  form-group">
          
          <input type="text"  placeholder="Member4 Email Id" disabled="true" name="email4" id="memb_in4" data-error="Email Id is not Register" class="form-control" data-remote="validate_email.php">
           <div class="help-block with-errors"></div>
           <div class="input-group-btn"> 
            <input type="checkbox" id="memb4"  data-toggle="toggle">
          </div>
        </div>
<?php echo $csrf->echoInputField(); ?>
        
</br>



 <div class="alert alert-danger" id="captcha"  role="alert"><span id = "captchaIcon" class="glyphicon glyphicon-unchecked"></span> I'm not a Robot!</div>
</br></br>
 <button type="button" id="submitme" disabled="disabled" class="btn btn-primary ">Create Group</button>

 </form>
</div>

<script type="text/javascript">
/*
$("form").submit(function (e) {
    e.preventDefault();
    //$('#hiddenInput').val(someVariable);
    imgcaptcha('creategroup_db.php','grgForm');
    //$(this).submit();
});
*/
$(function() {
    /*
    $('#captcha').change(function() {
        if($(this).prop('checked') ){
        imgcaptcha('creategroup_db.php','grgForm');
        //$('#captcha').bootstrapToggle('off'); 
        }
    });
    */
    $('#captcha').on('click', function() { 
    // From the other examples
    imgcaptcha('creategroup_db.php','grgForm');
});
  });
    $(function() {
    $('#memb3').change(function() {
        if($(this).prop('checked') ){
          $('#memb_in3').prop('disabled', false);
          $('#memb_in3').prop('required', true);
          $('#memb3').prop('disabled', true);
        }
        else
            $('#memb_in3').prop('disabled', true);
    });
    $('#memb4').change(function() {
        if($(this).prop('checked') ){
          $('#memb_in4').prop('disabled', false);
          $('#memb_in4').prop('required', true);
          $('#memb4').prop('disabled', true);
        }
        else
            $('#memb_in4').prop('disabled', true);
    });
    $('#memb2').change(function() {
        if($(this).prop('checked') ){
          $('#memb_in2').prop('disabled', false);
          $('#memb_in2').prop('required', true);
          $('#memb2').prop('disabled', true);
        }
        else
            $('#memb_in2').prop('disabled', true);
    });
  });

    $(document).ready(function() {

      $(".add-more").click(function(){ 
          
         // $(".after-add-more").after(html);
         getAddMore();
      });

      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });

      

    });

    function getAddMore(img_id){
        var dataString = '';
        var url_str = "getAddMore.php";
              
          $.ajax({
             type: "POST",
             url: url_str,
             data: dataString,
             cache: false,
             success: function(result){
              
               $(".after-add-more").after(result);; 
             }
           });
        }

// image gallery
// init the state from the input


</script>
<script src="../js/validator.js" type="text/javascript"></script>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>


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
  <script type="text/javascript">
      $('#datetimepicker').datetimepicker({
        format: 'dd/MM/yyyy hh:mm:ss',
        language: 'pt-BR'
      });
      $('#datetimepicker1').datetimepicker({
        format: 'dd/MM/yyyy hh:mm:ss',
        language: 'pt-BR'
      });
    </script>
<?php
require_once('footer.php');
?>
