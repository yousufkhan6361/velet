<!-- Login Popup Begin -->
<div class="modal fade login-popup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="login_bg">
                    <div class="row flexRow">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="login_form">
                                <h3>Sign Up</h3>
                                <form method="post" action="<?php echo g('base_url');?>user/save" id="signupForm">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="signup[signup_username]" placeholder="Username">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="signup[signup_email]" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="signup[signup_password]" placeholder="*****">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="signup_password_confirm" placeholder="*****">
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="btnStyle1" id="btn-signup">SIGN ME UP</a>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 flexCol">
                           <!-- <div class="login_social">
                                <h3>Sign in with social network</h3>
                                <a href="javascript:void(0)">Log in With Facebook  </a>
                                <a href="javascript:void(0)" class="twitter">Log in With twitter  </a>
                            </div>-->
                            <div class="login_social">
                                <h3>Sign in</h3>

                                <div class="login_form">
                                    <form action="<?php echo g('base_url');?>user/login-process" method="post" id="login-form" class="loginForm">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="signup[signup_email]" id="email" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="password" class="form-control" name="signup[signup_password]" id="password" placeholder="Password">
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="col-md-6">
                                            <div class="checkbox" align="left">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    Remember me </label>
                                            </div>
                                        </div>-->

                                        <div class="col-md-12">
                                            <div class="forget-pass">  <a href="javascript:void(0)" id="btn-login"> <span> Login </span> </a></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="forget-pass">  <a href="#" data-toggle="modal" data-target="#forgot-password"> <span> Forgot Password? </span> </a></div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Popup End -->

<?php
// Load modal
$this->load->view('user/modal_forgot_password');
?>

<!-- Content -->

<!-- Login and forgot pass ajax start-->
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