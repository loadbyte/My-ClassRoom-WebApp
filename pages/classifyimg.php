<?php
require_once('header.php');
$token_name = "saveclass_csrf";
$csrf = new CSRF_Protect($token_name);
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Image Classification</h1>
                </div>
                <!-- /.col-lg-12 -->
				<div class="row">
			<?php if(isset($_SESSION['success']) && isset($_SESSION['success_msg']) ){
			unset($_SESSION['success']);			?>
              <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $_SESSION['success_msg'];
								unset($_SESSION['success_msg']);
								?>
                            </div>
			<?php }?>
			
			<?php if(isset($_SESSION['error']) && isset($_SESSION['error_msg'])){
			unset($_SESSION['error']);			?>
              <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $_SESSION['error_msg'];
								unset($_SESSION['error_msg']);
								?>
                            </div>
			<?php }?>
           </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Course
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
								<div id="upload-wrapper">
                                  <form action="saveclass.php" method="post" enctype="multipart/form-data" id="upload_form">
                                        <?php echo $csrf->echoInputField(); ?>
                                           <?php
                                            $cp_info = getRandCpImg($db);
                                           ?>
                                      
                                         <div class="form-group" id="captcha_img_cl">
                                         <input type="hidden" name="cp_id" value="<?php echo $cp_info['cp_id'];?>">
											<img class="img-responsive" width="200" height="200" src="../messimages/captcha/<?php echo $cp_info['cp_img_uniq_id'].get_extension($cp_info['cp_img_mine']);?>">
                      <button type="button" onclick="nextCaptchaImg(<?php echo $cp_info['cp_id'];?>)" class="btn btn-primary pull-right">choose next</button>
                       <button type="button" onclick="prevCaptchaImg(<?php echo $cp_info['cp_id'];?>)" class="btn btn-primary pull-right">Prev</button>
                    </div>
                     
                                            
											<div class="form-group">
                                            <label>Image Category</label>
                                           
                                           <select name="ic_id"  class="form-control">
                                             <?php 
                                            
                                            $cat_arr = getCategoryList($db);
                                           

                                            foreach($cat_arr as $ic_id => $ic_info){
                                                ?>
                                              <option value="<?php echo $ic_id;?>"><?php echo $ic_info['ic_name'];?></option>
                                             <?php
                                             
                                            }
                                            ?>  
                                           
                                          </select> 
                                                                                
                                           </div>												   
										<button type="submit" class="btn btn-primary">Save</button>
                                    
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

<?php
require_once('footer.php');
?>
