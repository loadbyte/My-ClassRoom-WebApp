<?php
require_once('../includes/configure.php');
$_SESSION['url'] = $_SERVER['REQUEST_URI'];

if(isset($_SESSION['login'])){
    if(!$_SESSION['login'])
        header("location:login.php");
}else{
    header("location:login.php");
}

require_once('../Paginator-Class-master/paginator.php');
// Boot
$user_info = getUserInfo($db, $_SESSION['u_id']);
$d_c_id = $user_info['u_default_c_id'];
if(!isset( $_SESSION['c_title'])){
    if($d_c_id  != 0){
      
        header("location:selectcourse.php?c_id=$d_c_id");
    }
}

$_SESSION['captcha_verified'] = true;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My ClassRoom</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

 
    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" media="screen"
     href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/myclass.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

<?php if (isset($_SESSION['captcha_verified']) && $_SESSION['captcha_verified'] ) {?>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">My ClassRoom :  <?php if(isset( $_SESSION['c_title'])) echo $_SESSION['c_title']; ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
              
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a> 
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><?php echo $user_info['u_name']?></a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                  <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    <li>
                            <a href="dashboard.php"><i class="glyphicon glyphicon-pushpin "></i> Dashboard</a>
                        </li>
                <?php if(isset($_SESSION['c_id'])) {?>
                        <li>
                            <a href="creategroup.php"><i class="fa fa-plus-circle fa-fw"></i> Create Group</a>
                        </li>
                        <li>
                            <a href="grouplist.php"><i class="fa  fa-list-ul fa-fw"></i> List Groups</a>
                        </li>
                    
                        <li>
                            <a href="assignlist.php"><i class="fa fa-list-ul fa-fw"></i> List Assignment</a>
                        </li>
					
						
                        <?php if(isTA_Lect($_SESSION['u_role'])) {?>
                            <li>
                            <a href="courselist.php"><i class="fa  fa-list-ul fa-fw"></i> List Courses</a>
                        </li>
                         
                        <li>
                            <a href="addcourse.php"><i class="fa fa-plus-circle fa-fw"></i> Add Course</a>
                        </li>
                        <li>
                            <a href="addassignment.php"><i class="fa fa-plus-circle fa-fw"></i> Add Assignment</a>
                        </li>
                        <li>
                            <a href="addimgfr.php"><i class="fa fa-plus-circle fa-fw"></i> Add Image</a>
                        </li>
						 <li>
                            <a href="classifyimg.php"><i class="fa fa-plus-circle fa-fw"></i> Classify Image</a>
                        </li>
                        <?php } ?>
                        
                <?php } ?>
                       
                    </ul>
                </div>
            </div>
            <!-- /.navbar-static-side -->
        </nav>
<?php } ?>