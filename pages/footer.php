
	<script type="text/javascript">

	

	
		function editFrImages(img_id){
		var dataString = 'fr_img_id='+img_id;
		var url_str = "frimageoption.php";
				
		  $.ajax({
			 type: "POST",
			 url: url_str,
			 data: dataString,
			 cache: false,
			 success: function(result){
			  
			  $( ".modal-title" ).html( "Image Editing Options" );
			  $( ".modal-body" ).html( result );
			   $('#myModal').modal('show') ; 
			 }
		   });
		}
		function uploadMyImage(){
		var dataString = '';
		var url_str = "uploadimage.php";
				
		  $.ajax({
			 type: "POST",
			 url: url_str,
			 data: dataString,
			 cache: false,
			 success: function(result){
			  
			  $( ".modal-title" ).html( "Update Your Image" );
			  $( ".modal-body" ).html( result );
			   $('#myModal').modal('show') ; 
			 }
		   });
		}
	

</script>
  <link href="../css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" media="screen"
     href="../css/bootstrap-datetimepicker.min.css">
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Image information</h4>
                                        </div>
                                        <div class="modal-body">
                                          modal message
                                        </div>
                                       
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>


</body>

</html>
