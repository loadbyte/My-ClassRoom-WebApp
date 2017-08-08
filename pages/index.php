<?php 
require_once('header.php');
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gallery</h1>
                </div>
				
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                       
                   <div class="panel panel-default">
                        <div class="panel-heading">
						<?php 
							//$img_arr = getImagesInfo($db);
							$totalRecords =  getImagesCounts($db);
							$paginator = new Paginator();
							$paginator->total = $totalRecords;
							$paginator->paginate();
							$offset = ($paginator->currentPage-1)*$paginator->itemsPerPage;
							$itemsPerPage = $paginator->itemsPerPage;
							$img_arr = getImagesInfoPage($db, $offset, $itemsPerPage);?>
							
                            <i class="fa fa-camera-retro fa-fw"></i> Images
							 <div class="pull-right">
                                <div class="btn-group">
                                    <?php echo $paginator->itemsPerPage(); ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
                            <ul class="chat">
							<?php
							foreach( $img_arr as $img_info){
							?>
                                <li class="left clearfix">
								
                                    <span class="chat-img pull-left">
									<a href="javascript:editImages(<?php echo $img_info['gal_id']?>)">
                                        <img class ="img-thumbnail" width="200" height="400"
										src="../ajax-image-upload/uploads/<?php echo $img_info['gal_uniq_id'].get_extension($img_info['img_mine'])?>" 
										alt="User Avatar" />
										</a>
                                    </span>
								
							
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font"> <?php echo $img_info['img_title']?></strong>
                                            <small class="pull-right text-muted">
                                                <a href="javascript:editImages(<?php echo $img_info['gal_id']?>)"><i class="fa fa-edit fa-fw"></i> Edit</a>
                                            </small>
                                        </div>
                                        <p>
                                            <?php echo $img_info['img_disc']?>
                                        </p>
                               
                                </li>
                               <?php 
							   }
							   ?>
                            </ul>
							
                     
						<?php
							echo $paginator->pageNumbers();
							
					?>
                        <!-- /.panel-body -->
                       
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php 
require_once('footer.php');
?>
