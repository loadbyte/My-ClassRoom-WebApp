<?php 
require_once('header.php');
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Groups</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <?php if(isset($_SESSION['success']) && isset($_SESSION['success_msg']) ){
            unset($_SESSION['success']);            ?>
              <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $_SESSION['success_msg'];
                                unset($_SESSION['success_msg']);
                                ?>
                            </div>
            <?php }?>
            
            <?php if(isset($_SESSION['error']) && isset($_SESSION['error_msg'])){
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
						<?php 
							//$img_arr = getImagesInfo($db);
							$totalRecords =  getGroupCounts($db, $_SESSION['c_id']);
							$paginator = new Paginator();
							$paginator->total = $totalRecords/$perpage+1;
							$paginator->paginate();
							$offset = ($paginator->currentPage-1)*$paginator->itemsPerPage;
							$itemsPerPage = $paginator->itemsPerPage;
							$c_arr = getGroupInfoPage($db, $_SESSION['c_id'],$offset, $itemsPerPage);?>
							
                            <i class="fa fa-book fa-fw"></i> Group List
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
							foreach( $c_arr as $c_info){
							?>
                                <li class="right clearfix">
								<a href="javascript:showModal('groupview.php','<?php echo 'g_id='.$c_info['g_id']?>', 'Group details')" >
                                  		
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font"><?php echo $c_info['g_name']?></strong>
                                            <small class="pull-right text-muted">
                                            <?php 
                                            
                                            if($c_info['g_status'] == 0 ){
                                                ?>
                                                <button 
                                                
                                                type="button" class="btn btn-danger">Not Approved</button>
                                                <?php
                                            } else {
                                                ?>
                                                <button  type="button" class="btn btn-success">Approved</button>
                                                <?php
                                            }
                                            ?>
                                              
                                            </small>
                                        </div>
                                        <p>
                                            
                                        </p>
                               </a>
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
