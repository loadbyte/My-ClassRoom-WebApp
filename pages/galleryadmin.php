<?php
require_once('../includes/configure.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blink Eye Studio  Gallery Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Blink Eye Studio  Gallery Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                            <a href="../../admin.php"><i class="fa fa-edit fa-fw"></i> Blog</a>
                        </li>
						<li>
                            <a href="listfrimages.php"><i class="fa  fa-list-ul fa-fw"></i> List (Front)Images</a>
                        </li>
                         <li>
                            <a href="addimgfr.php"><i class="fa fa-plus-circle fa-fw"></i> Add Image(Front)</a>
                        </li>
                        <li>
                            <a href="index.php"><i class="fa  fa-list-ul fa-fw"></i> List Image</a>
                        </li>
						<li>
                            <a href="galleryadmin.php"><i class="fa fa-plus-circle fa-fw"></i> Add Image</a>
                        </li>
						<li>
                            <a href="candidlist.php"><i class="fa  fa-list-ul fa-fw"></i> List Candid</a>
                        </li>
						<li>
                            <a href="candidadmin.php"><i class="fa fa-plus-circle fa-fw"></i> Add Candid</a>
                        </li>
						
						<li>
                            <a href="addevent.php"><i class="fa fa-plus-circle fa-fw"></i> Add Event</a>
                        </li>
						
                        
                       <li>
                            <a href="editaboutme.php"><i class="fa fa-edit fa-fw"></i>Edit Aboutme</a>
                        </li>
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Forms</h1>
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
                            Blink Eye Studio  Image Uploader
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
								<div id="upload-wrapper">
                                  <form action="../ajax-image-upload/process.php" method="post" enctype="multipart/form-data" id="upload_form">
                                        <div class="form-group">
                                            <label>Image Title</label>
                                            <input name="title" required="true" class="form-control">
                                            
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Image Description</label></br>
                                            <textarea class="form-control" required="true" name="disc" id="descid" ></textarea>
                                        </div>
										 <div class="form-group">
                                            <label>Choose Image</label>
                                            <input name="image_file" type="file" required="true" />
                                        </div>
                                         <img src="../ajax-image-upload/images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
                                        <button type="submit" class="btn btn-primary">Save Image</button>
                                    
                                    </form>
									<div id="output"></div>
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

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	<script type="text/javascript" src="../js/jquery.form.min.js"></script>
	
<script type="text/javascript">
//customize values to suit your needs.
var max_file_size 		= 8048576; //maximum allowed file size
var allowed_file_types 	= ['image/png', 'image/gif', 'image/jpeg', 'image/pjpeg']; //allowed file types
var message_output_el 	= 'output'; //ID of an element for response output
var loadin_image_el 	= 'loading-img'; //ID of an loading Image element

//You may edit below this line but not necessarily
var options = { 
	//dataType:  'json', //expected content type
	target: '#' + message_output_el,   // target element(s) to be updated with server response 
	beforeSubmit: before_submit,  // pre-submit callback 
	success: after_success,  // post-submit callback 
	resetForm: true        // reset the form after successful submit 
}; 

$('#upload_form').submit(function(){
	$(this).ajaxSubmit(options); //trigger ajax submit
	return false; //return false to prevent standard browser submit
}); 

function before_submit(formData, jqForm, options){
	var proceed = true;
	var error = [];	
	/* validation ##iterate though each input field
	if you add extra text or email fields just add "required=true" attribute for validation. */
	$(formData).each(function(){ 
		
		//check any empty required file input
		if(this.type == "file" && this.required == true && !$.trim(this.value)){ //check empty text fields if available
			error.push( this.name + " is empty!");
			proceed = false;
		}
		
		//check any empty required text input
		if(this.type == "text" && this.required == true && !$.trim(this.value)){ //check empty text fields if available
			error.push( this.name + " is empty!");
			proceed = false;
		}
		
		//check any invalid email field
		var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
		if(this.type == "email" && !email_reg.test($.trim(this.value))){ 
			error.push( this.name + " contains invalid email!");
			proceed = false;          
		}
		
		//check invalid file types and maximum size of a file
		if(this.type == "file"){
			if(window.File && window.FileReader && window.FileList && window.Blob){
				if(this.value !== ""){
					if(allowed_file_types.indexOf(this.value.type) === -1){
						error.push( "<b>"+ this.value.type + "</b> is unsupported file type!");
						proceed = false;
					}
	
					//allowed file size. (1 MB = 1048576)
					if(this.value.size > max_file_size){ 
						error.push( "<b>"+ bytes_to_size(this.value.size) + "</b> is too big! Allowed size is " + bytes_to_size(max_file_size));
						proceed = false;
					}
				}
			}else{
				error.push( "Please upgrade your browser, because your current browser lacks some new features we need!");
				proceed = false;
			}
		}
		
	});	
	
	$(error).each(function(i){ //output any error to element
		$('#' + message_output_el).html('<div class="error">'+error[i]+"</div>");
	});	
	
	if(!proceed){
		return false;
	}
	
	$('#' + loadin_image_el).show();
}

//Callback function after success
function after_success(data){
	$('#' + message_output_el).html(data);
	$('#' + loadin_image_el).hide();
}

//Callback function to format bites bit.ly/19yoIPO
function bytes_to_size(bytes){
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}
</script>

</body>

</html>
