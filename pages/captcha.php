<?php
require_once('header.php');
?>
<style>

</style>

        <div id="page-wrapper">
            <div class="row">
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
                        
                            <div class="alert alert-info">
                               <h4>Captcha Form (2 image verification)</h4>
                            </div>
                       
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-8">
								<div id="upload-wrapper">
                                  <form action="addcourse_db.php" method="post" enctype="multipart/form-data" id="upload_form">
                                   
                                   <div class="well">
                      <a href="#" class="list-group-item active">Select Images Contents </a>
                        <div class="row show-grid">
                                <div class="col-md-4">
                                <img class ="cap_img" width="250" height="220"
										src="../cap_img/1_pic_026.jpg" 
										alt="captcha image 1" />
                                </div>
                                <div class="col-md-6">
                            
          <div class="list-group" id="list1">
          
          <a href="#" class="list-group-item">Second item <input type="checkbox" class="pull-right"></a>
          <a href="#" class="list-group-item danger">Third item <input type="checkbox" class="pull-right"></a>
          <a href="#" class="list-group-item">More item <input type="checkbox" class="pull-right"></a>
          <a href="#" class="list-group-item">Another <input type="checkbox" class="pull-right"></a>
          
          </div>
                                
                               
                            </div>
                    </div>     
                                   
                                    <div class="well">
                      
                        <div class="row show-grid">
                                <div class="col-md-4">
                                <img class ="cap_img" width="250" height="220"
										src="../cap_img/1_pic_026.jpg" 
										alt="captcha image 1" />
                                </div>
                                <div class="col-md-6">
                            
          <div class="list-group" id="list1">
          
          <a href="#" class="list-group-item">Second item <input type="checkbox" class="pull-right"></a>
          <a href="#" class="list-group-item danger">Third item <input type="checkbox" class="pull-right"></a>
          <a href="#" class="list-group-item">More item <input type="checkbox" class="pull-right"></a>
          <a href="#" class="list-group-item">Another <input type="checkbox" class="pull-right"></a>
          
          </div>
                                
                               
                            </div>
                    </div>     
                            
                     													   
										<button type="submit" class="btn btn-primary">Submit for Verification</button>
                                    
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
  <script type="text/javascript">
$('.add').click(function(){
    $('.all').prop("checked",false);
    var items = $("#list1 input:checked:not('.all')");
    var n = items.length;
  	if (n > 0) {
      items.each(function(idx,item){
        var choice = $(item);
        choice.prop("checked",false);
        choice.parent().appendTo("#list2");
      });
  	}
    else {
  		alert("Choose an item from list 1");
    }
});

$('.remove').click(function(){
    $('.all').prop("checked",false);
    var items = $("#list2 input:checked:not('.all')");
	items.each(function(idx,item){
      var choice = $(item);
      choice.prop("checked",false);
      choice.parent().appendTo("#list1");
    });
});

/* toggle all checkboxes in group */
$('.all').click(function(e){
	e.stopPropagation();
	var $this = $(this);
    if($this.is(":checked")) {
    	$this.parents('.list-group').find("[type=checkbox]").prop("checked",true);
    }
    else {
    	$this.parents('.list-group').find("[type=checkbox]").prop("checked",false);
        $this.prop("checked",false);
    }
});

$('[type=checkbox]').click(function(e){
  e.stopPropagation();
});

/* toggle checkbox when list group item is clicked */
$('.list-group a').click(function(e){
  
    e.stopPropagation();
  
  	var $this = $(this).find("[type=checkbox]");
    if($this.is(":checked")) {
    	$this.prop("checked",false);
    }
    else {
    	$this.prop("checked",true);
    }
  
    if ($this.hasClass("all")) {
    	$this.trigger('click');
    }
});
 
      
    </script>
<?php
require_once('footer.php');
?>
