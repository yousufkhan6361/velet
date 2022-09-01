<section class="bannerSec">
        <img src="<?php echo get_image($banner['inner_banner_image_path'],$banner['inner_banner_image']);?>" class="img-responsive" alt="Banner">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h1>LOGIN / SIGN UP</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="loginSec">
        <div class="container">
            <div class="row flexRow">
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 flexCol">
                    <div class="signinlogin-div">
                        <h2>Login</h2>
                        <form action="<?php echo g('base_url'); ?>user/login_process" method="post" id="login-form">
                            <div class="login-text">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <input type="text" id="email" name="signup[signup_email]" placeholder="Email Address">
                            </div>
                            <div class="login-text">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <input type="password" name="signup[signup_password]" id="password" placeholder="Password">
                            </div>
                            <input type="button" name="" class="buttons" value="Login" id="btn-login">
                            
                            <div class="register-check">
                                <a href="#" data-toggle="modal" data-target="#forgot-password" class="forgot-password cre">Forgot password?</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-lg-offset-1 col-md-offset-1 col-sm-6 col-xs-12">
                    <div class="signinlogin-div sign_up">
                        <h2>Sign up</h2>
                        <form method="post" action="" id="signupForm">
                            <div class="login-text"><input type="text" name="signup[signup_email]" placeholder="Email Address"></div>
                            <div class="login-text"><input type="password" class="password" name="signup[signup_password]" placeholder="Password"></div>
                            <div class="login-text"><input type="password" class="re_password" placeholder="Re-enter Password"></div>
                            <div class="login-text"><input type="text" name="signup[signup_firstname]" placeholder="First Name"></div>
                            <div class="login-text"><input type="text" name="signup[signup_lastname]" placeholder="Last Name"></div>
                            <div class="login-text"><input type="text" name="signup[signup_localisation]" placeholder="Localisation"></div>
                            <div class="register-check">
                                <span><input type="checkbox" name="" class="terms"> By registering you agree to our <a href="#">Terms of Use</a></span>
                            </div>
                            <input type="button" name="" class="buttons" value="Create" id="btn-signup">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
// Load modal
$this->load->view('user/modal_forgot_password');
?>


    <script type="text/javascript">
    $(document).ready(function () {
        var $form = $('#login-form');
        // On submit login action start
        //$form.submit(function(event) {
        $('#btn-login').click(function (event) {
            // Get input data
            var email = $('#email').val();
            var password = $('#password').val();

            /*console.log(password);
            console.log(email);*/
            
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
            } else if (!regex.test(email)) {
                AdminToastr.error('<span for="%s" style="color:#fff" class="has-error help-block">Invalid email address</span>');
            }
            // Password validation
            else if (password == '') {
                AdminToastr.error('<span for="%s" style="color:#fff" class="has-error help-block">Password field is required.</span>');
            } else {
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
                        //window.location.href = response.refer;
                        location.reload();

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

            // Submit action
            var response = AjaxRequest.fire(url, data);
            // Register success
            if (response.status) {
                // Reset form
                $form[0].reset();
                // Close Dialog box
                $('#forgot-password').modal('toggle');
                location.reload();

            }

            return false;
        });
        // Submit Form Modal End

        // Register start
        //Submit Button Clicked
        $("#btn-signup").click(function(){

            var password = $(".password").val();

            var re_password = $(".re_password").val();

            var terms = $(".terms").val();

            if (password == re_password && $(".terms").prop("checked") == true) {
            var data = new FormData(document.getElementById('signupForm'));
            var url = "<?=g('base_url')?>user/save";
            var response = FileUploadScript.fire(url, data, 'json',true);    
            }

            else{
                alert("Incorrect Details");
            }

            

            //AdminToastr.success(response.txt,'Success');

            return false;
        });
        // Register end
    });
</script>