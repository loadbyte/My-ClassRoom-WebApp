
function selectcourse(c_id){
    var dataString = "c_id="+c_id;
    var url_str = "selectcourse.php";
        
      $.ajax({
       type: "POST",
       url: url_str,
       data: dataString,
       cache: false,
       success: function(result){
        
        $( ".modal-title" ).html( modal_title );
        $( ".modal-body" ).html( result );
         $('#myModal').modal('show') ; 
       }
       });
    }
function showModal(url,query, modal_title){
    var dataString = query;
    var url_str = url;
        
      $.ajax({
       type: "get",
       url: url_str,
       data: dataString,
       cache: false,
       success: function(result){
        
        $( ".modal-title" ).html( modal_title );
        $( ".modal-body" ).html( result );
         $('#myModal').modal('show') ; 
       }
       });
    }


function prevCaptchaImg($cp_id){
    var dataString = 'cp_id='+$cp_id;
    var url_str = "getPrevCaptchaImg.php";
        
      $.ajax({
       type: "POST",
       url: url_str,
       data: dataString,
       cache: false,
       success: function(result){
        
      
        $( "#captcha_img_cl" ).html( result );
          
       }
       });
    }


function nextCaptchaImg($cp_id){
    var dataString = 'cp_id='+$cp_id;
    var url_str = "getNextCaptchaImg.php";
        
      $.ajax({
       type: "POST",
       url: url_str,
       data: dataString,
       cache: false,
       success: function(result){
        
      
        $( "#captcha_img_cl" ).html( result );
          
       }
       });
    }

function formSubmitID(url1, form_id) {
    
    
     $("#captchaform").submit(function(e){
        e.preventDefault();
                $.ajax({

                    url: "verifycaptcha.php",
                    type: "POST",
                    data: $(this).serialize(),
                    cache: false,
                    success: function(data){
                      if(data == "valid"){
                       
                        $('#myModal').modal('hide');
    
            $('#captchaIcon').removeClass('glyphicon glyphicon-unchecked').addClass('glyphicon glyphicon-check');
            $('#captcha').removeClass('alert alert-danger').addClass('alert alert-success');
            $('#captcha_hd').prop('checked', true);
            $('#submitme').prop('type', 'submit');
            $('#submitme').prop('disabled', false);
            } else if(data == "negative"){
              $( "#captcha_msg" ).html( '<div class="alert alert-danger">Wrong image selected!</div>' );
            } else
            {
              $( "#captcha_msg" ).html( '<div class="alert alert-danger">Please select similar images below that match this one:</div>' );
            }
                    }


               });

         });
    $('#captchaform').submit();
    $('#captchaform').unbind("submit");
    
     

  }
  function imgcaptcha(url1, frm_id){
    var dataString = 'frm_id='+frm_id+'&url='+url1;
    var url_str = "imgcaptcha.php";
        
      $.ajax({
       type: "POST",
       url: url_str,
       data: dataString,
       cache: false,
       success: function(result){
        
        $( ".modal-title" ).html( "Image Captcha" );
        $( ".modal-body" ).html( result );
         $('#myModal').modal('show') ; 
         $(".image-checkbox").each(function () {
          if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
            $(this).addClass('image-checkbox-checked');
          }
          else {
            $(this).removeClass('image-checkbox-checked');
          }
        });

        // sync the state to the input
        $(".image-checkbox").on("click", function (e) {
          $(this).toggleClass('image-checkbox-checked');
          var $checkbox = $(this).find('input[type="checkbox"]');
          $checkbox.prop("checked",!$checkbox.prop("checked"))

          e.preventDefault();
        });
       }
       });
    }