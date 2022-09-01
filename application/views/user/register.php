<?
// Banner heading
//$this->load->view('widgets/inner_banner');
// Banner section
?>

<!-- Breadcrumbs -->
<?php
$data['breadcrumb_title'] = '';
$this->load->view('widgets/breadcrumb',$data);?>

<!-- Content -->
<section class="inpage featurePro">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                <div class="account_frm create_acount">
                    <h2> Create Account </h2>
                    <form method="post" action="" id="signupForm">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label> First name </label>
                                    <input type="text" class="form-control" name="signup[signup_firstname]" placeholder="John">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label> Last name </label>
                                    <input type="text" class="form-control" name="signup[signup_lastname]" placeholder="Smith">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label> Email </label>
                                    <input type="email" class="form-control" name="signup[signup_email]" id="email" placeholder="johns@mail.com">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label> Password </label>
                                    <input type="password" class="form-control" name="signup[signup_password]" placeholder="*****">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label> Confirm Password </label>
                                    <input type="password" class="form-control" name="signup_password_confirm" placeholder="*****">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <a href="javascript:void(0)" class="btn btn1 " id="btn-signup"> Create my Account </a> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!--end Content -->

<!-- Sign up ajax start-->
<!-- <script type="text/javascript">
    $(document).ready(function(){
        // Get form object
        var $form = $('#signup-form');
        // On submit action start
        //$form.submit(function(event) {
        $('#btn-signup').click(function(event) {

            // Disable the submit button to prevent repeated clicks:
            $form.find('#btn-signup').prop('disabled', true);
            // Get form
            var form = $(this).closest('form');
            // Get action url
            var url = form.attr('action');
            // Get form data
            var data = form.serialize();
            // Submit action
            var response = AjaxRequest.fire(url, data);
            // Register success
            if (response.status) {
                $form.find('#btn-signup').prop('disabled', false);
                // Reset form
                $form[0].reset();
                setTimeout(function(){
                    location.href = '<?=g('base_url')?>';
                },2000);

            }
            // Register fail
            else {
                // Enable form
                $form.find('#btn-signup').prop('disabled', false);
            }

            event.preventDefault();
            return false;
        });
        // On submit action end
    });
</script> -->



<script type="text/javascript">

$(document).ready(function(){
    
  var file_type = ['png', 'jpg', 'jpeg'];

  // On change file (single image)
    $('#file1').on('change',function(){

      var anyWindow = window.URL || window.webkitURL;

        var fileList = this.files;
        var result = check_file_extension(fileList);
        if(result!=''){
            $('#file1').val('');
            AdminToastr.error(result, 'Error');
        }
        else
        {
          var objectUrl = anyWindow.createObjectURL(fileList[0]);
          $('#profileImg').attr('src', objectUrl);
          $('#profileImg').show();
        }
    });

    function check_file_extension(fileList)
    {
        var error = '';
        // Check each file type extension
        for (var x = 0; x < fileList.length; x++) {
            // Define allow extension
            var ext = fileList[x]['name'].split('.').pop().toLowerCase();

            // Check ext empty or not (empty means no file selected)
            if (ext != '') {
                // Other extension
                if ($.inArray(ext, file_type) == -1) {
                    // Set error message
                    error += "Invalid file type <br/>" + fileList[x]['name'] + '<br/>';
                }
            }
        }   // end loop
        return error;
    }

  //Submit Button Clicked
  $("#btn-signup").click(function(){

      // Check Password Length
      var pass = $('input[name="signup[signup_password]"]').val();
      var cpass = $('input[name="signup_password_confirm"]').val();

      if(pass.length<6 || cpass.length<6 ){
          AdminToastr.error('Minimum Password length is 6 characters','Error');
      }
      else{
          var data = new FormData(document.getElementById('signupForm'));
          var url = "<?=g('base_url')?>user/save";
          var response = FileUploadScript.fire(url, data, 'json',true);

          //AdminToastr.success(response.txt,'Success');
      }

  return false;
  });
});
</script>