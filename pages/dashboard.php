<?php 
require_once('header.php');
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Enrolled Courses</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
            <div class="row">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-hand-down"></i>Click to Select Course
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="timeline">
                            <?php 
                            $alter = true;
                            $c_arr =  getEnrolledCourse($db, $_SESSION['u_id']) ;
                                foreach( $c_arr as $c_info){
                            ?>
                                
                                
                                <li
                                <?php 
                                if(!$alter) {
                                    
                                ?> 
                                class="timeline-inverted"
                                <?php }
                                $alter = !$alter;
                                 ?>
                                >
                                    <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <a href="selectcourse.php?c_id=<?php echo $c_info['c_id']?>" >
                                  
                                            <h4 class="timeline-title"><?php echo $c_info['c_title']?></h4>
                                            </a>
                                        </div>
                                        <div class="timeline-body">
                                            <p><?php echo $c_info['c_desc']?></p>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                                ?>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
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
