<?
// Banner heading
$this->load->view('widgets/inner_banner');
$this->load->view('user/modal_forgot_password');
// Banner section
?>

<div class=" sign_sec_main">
        
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="sign_form sign_item border_left">
                <h5>LOG IN</h5>
                <form action="<?php echo g('base_url');?>user/login-process" method="post" id="login-form">
                  <label>Email</label>
                  <input type="email" placeholder="nepdud@gmail.com" name="signup[signup_email]" id="email">
                  <label>password</label>
                  <input type="password" placeholder="*******" name="signup[signup_password]" id="password">
                  <!-- <ul>
                    <li class="sign_google"><a href="#"><i class="fa fa-google" aria-hidden="true"></i>sign in Google</a></li>
                    <li class="sign_fb"><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i>log in with Facebook</a></li>
                    <li class="sign_tw"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i>login with twitter</a></li>
                  </ul> -->
                  <a href="javascript:void(0)" data-toggle="modal" data-target="#forgot-password">Forget Password</a>
                  <input type="button" id="btn-login" value="login" >
                </form>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="sign_form sign_item ">
                <h5>sign up</h5>
                <form method="post" action="<?php echo g('base_url');?>user/save" id="signupFormz" class="formStyle">
                  <label>First Name</label>
                  <input type="text" placeholder="Enter your First Name" name="signup[signup_firstname]">
                  <label>Last Name</label>
                  <input type="text" placeholder="Enter your Last Name" name="signup[signup_lastname]">
                  <label>email</label>
                  <input type="email" placeholder="Enter your email" name="signup[signup_email]">
                  <label>Password</label>
                  <input type="password" placeholder="*******" name="signup[signup_password]">
                  <div class="clearfix"></div>
                  <br><br>
                  <input type="button" id="btn-signupz" value="Sign up" class="signup">
                </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>



<script type="text/javascript">
    $(document).ready(function () {
        var $form = $('#login-form');
        // On submit login action start
        //$form.submit(function(event) {
        $('#btn-login').click(function (event) {
            // Get input data
            var email = $('#email').val();
            var password = $('#password').val();
            // Define regular expression
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            // Checking fields (both fields empty)
            if ((email == '') && (password == '')) {
                AdminToastr.error('<span for="%s" style="color:#fff" class="has-error help-block">Email field is required.</span>' +
                    '<span for="%s" style="color:#fff" class="has-error help-block">Password field is required.</span>', 'Error');
            }
            // Email validation
            else if (email == '') {
                AdminToastr.error('<span for="%s" style="color:#fff" class="has-error help-block">Email field is required.</span>');
            }
            else if (!regex.test(email)) {
                AdminToastr.error('<span for="%s" style="color:#fff" class="has-error help-block">Invalid email address</span>');
            }
            // Password validation
            else if (password == '') {
                AdminToastr.error('<span for="%s" style="color:#fff" class="has-error help-block">Password field is required.</span>');
            }
            else {
                // Disable the submit button to prevent repeated clicks:
                $form.find('#btn-login').prop('disabled', true);
                // Get form
                var form = $(this).closest('form');
                // Get action url
                var url = form.attr('action');
                // Get form data
                var data = form.serialize();
                Loader.show();
                setTimeout(function () {
                    // Submit action
                    var response = AjaxRequest.fire(url, data);
                    // Register success
                    if (response.status) {
                        $form.find('#btn-login').prop('disabled', false);
                        // Reset form
                        $form[0].reset();
                        // Redirect to Time line page
                        window.location.href = "<?=g('base_url')?>";
                        // location.reload();

                    }
                    // Register fail
                    else {
                        // Enable form
                        $form.find('#btn-login').prop('disabled', false);

                    }
                },1000);

            }

            return false;
        });
        // On submit login action end

        // Submit Form Modal Start
        $('.user-pass-rec-btn').on('click', function () {
            // Get form obj
            var $form = $('#forgot-form');
            // Get form
            var form = $(this).closest('form');
            // Get action and form data
            var data = form.serialize();
            var url = form.attr('action');

            Loader.show();
            setTimeout(function () {
                // Submit action
                var response = AjaxRequest.fire(url, data);
                // Register success
                if (response.status) {
                    // Reset form
                    $form[0].reset();
                    // Close Dialog box
                    $('#forgot-password').modal('toggle');
                    // Reset captcha
                    grecaptcha.reset();

                }
            },1000);

            return false;
        });
        // Submit Form Modal End
    });
</script>
<script type="text/javascript">

    $(document).ready(function(){

        // Get form object

        var $formm = $('#signupFormz');

        // On submit action start

        //$formm.submit(function(event) {

        $('#btn-signupz').click(function(event) {



            // Disable the submit button to prevent repeated clicks:

            $formm.find('#btn-signupz').prop('disabled', true);

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

                $formm.find('#btn-signupz').prop('disabled', false);

                // Reset form

                // $formm[0].reset();

                setTimeout(function(){

                    window.location.href = "<?=g('base_url')?>";

                },2000);



            }

            // Register fail

            else {

                // Enable form

                $formm.find('#btn-signupz').prop('disabled', false);

            }



            event.preventDefault();

            return false;

        });

        // On submit action end

    });

</script>