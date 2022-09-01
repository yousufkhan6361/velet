<?php $userIdd = $_GET['userid']; ?>
<!-- footer sec start -->
<style>
    .myFooterData li a:hover{
        color:#1369b0;
        text-decoration: underline !important;
    }
</style>
<?php if(!isset($userIdd)){ ?>

  <section class="supportsec">
    <div class="container">
      <div class="row" style="text-align:center;">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
          <!--<div class="supporticon" data-aos="zoom-in" data-aos-delay="800" data-aos-easing="linear">-->
          <div class="supporticon">
            <a style="color: white;"><i class="fas fa-paper-plane"></i>SUPPORT 24/7</a>
          </div>
        </div>
         <div class="col-12 col-sm-12 col-md-6 col-lg-6">
          <!--<div class="supporticon" data-aos="zoom-in" data-aos-delay="800" data-aos-easing="linear">-->
          <div class="supporticon">
            <a style="color: white;"><i class="fas fa-paper-plane"></i>100% SAFE & SECURE</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
          <div class="footerlist">
            <h4>ABOUT US</h4>
            <ul class="myFooterData">
              <li><a href="<?=g('base_url')?>about-us">About The Northern Ireland Connection</a></li>
              <li><a href="<?=g('base_url')?>advertise">Why Advertise with The Northern Ireland Connection </a></li>
              <li><a href="<?=g('base_url')?>why-choose-us">Why Choose Us</a></li>
              <!-- <li><a href="#">Affiliate</a></li> -->
            </ul>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
          <div class="footerlist">
            <h4>ACCOUNT</h4>
            <ul class="myFooterData">
                <?php
                  if ($this->userid > 0) {
                ?>
              <li><a href="<?=g('base_url')?>user/logout">Log out</a></li>
              <? } ?>
              <!-- <li><a href="#">Upgrade</a></li> -->
              <li><a href="<?=g('base_url')?>account">Manage my account</a></li>
              <li><a href="<?=g('base_url')?>privacy-policy">Privacy Policy and Cookie Policy</a></li>
              <li><a href="<?=g('base_url')?>terms-conditions">Terms and Conditions</a></li>
            </ul>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
          <div class="footerlist">
            <h4>HELP & CONTACT</h4>
            <ul class="myFooterData">
              <li><a href="<?=g('base_url')?>contact_us">Contact us</a></li>
            </ul>
          </div>
          <div class="footericon">
            <h4>Join Us Now</h4>
              <ul >
              <li><a href="https://www.facebook.com/TheNIConnection/" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                 <li><a href="https://twitter.com/theNorthernIre2" class="twitter"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/thenorthernirelandconnection/" class="instrgram"><i class="fab fa-instagram"></i></a></li>
                       <li><a href="https://www.youtube.com/channel/UCY1RtdHHZhNzm0-NV72F7rQ" class="youtube"><i class="fab fa-youtube"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer sec end -->
<?php } ?>

  <!-- copyright sec strat -->
  <section class="copysec">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
          <div class="copytext">
           <p class="text-center">COPYRIGHT © 2021. ALL RIGHT RESERVED</p>
          </div>
        </div>
      </div>
    </div>
    <a href="#" class="scrollToTop button-show"></a>
  </section>

  <div id="fixed-social">
  <div>
    <a href="https://www.facebook.com/TheNIConnection/" class="fixed-facebook" target="_blank"><i class="fab fa-facebook-f"></i> <span>Facebook</span></a>
  </div>
  <div>
    <a href="https://twitter.com/theNorthernIre2" class="fixed-twitter" target="_blank"><i class="fab fa-twitter"></i> <span>Twitter</span></a>
  </div>
  <div>
    <a href="https://www.instagram.com/thenorthernirelandconnection" class="fixed-gplus" target="_blank"><i class="fab fa-instagram"></i> <span>Instgram</span></a>
  </div>
  <div>
    <a href="https://www.youtube.com/channel/UCY1RtdHHZhNzm0-NV72F7rQ" class="fixed-linkedin" target="_blank"><i class="fab fa-youtube"></i> <span>Youtube</span></a>
  </div>
 
 
</div>
  <!-- copyright sec end -->


  <!-- Modal -->
  <div class="cart">
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-slideout modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SIGN IN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">close×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo g('base_url');?>user/login-process" method="post" id="login-form" class="loginForm">
<div class="row">
<div class="col-12 col-sm-12 col-md-12 col-lg-12">
<div class="signuplist">
<label>Email <span>*</span></label>
 <input type="text" class="form-control" name="signup[signup_email]" id="email" placeholder="Email">
</div>
</div>
</div>
<div class="row">
<div class="col-12 col-sm-12 col-md-12 col-lg-12">
<div class="signuplist">
<label>Password  <span>*</span></label>
<input type="password" autocomplete="on" class="form-control" name="signup[signup_password]" id="password" placeholder="Password">
</div>
</div>
</div>
<div class="row">
<div class="col-12 col-sm-12 col-md-12 col-lg-12">
<div class="signuplist">

<input type="button" id="btn-login" value="login" style="padding: 10px;">

<!-- <button type="submit" id="btn-login" class="submitbtn" style="cursor: pointer;">Login</button> -->
</div>
</div>
</div>
<div class="row">
<div class="col-12 col-sm-12 col-md-12 col-lg-12">
<div class="signuplist1">
<!-- <label class="pull-left">
<input type="checkbox" name="">
Remember me
</label> -->
<!-- <a href="my-account.html" class="pull-right">Forgot password?</a> -->
<a href="#" data-toggle="modal" data-target="#forgot-password"> <span> Forget Password? </span> </a>
</div>
<div class="clearfix"></div> 
</div>
</div>
</form>

      </div>
      <div class="modal-footer">
        <i class="fal fa-user"></i>
        <h5>No account yet?</h5>
        <a href="<?=g('base_url')?>user/signup">CREATE AN ACCOUNT</a>
      
      </div>
    </div>
  </div>
</div>
</div>

<?php
// Load modal
$this->load->view('user/modal_forgot_password');
?>



<!-- Modal ends-->

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

                }else{
                  //console.log(response);
                }
            },1000);

            return false;
        });
        // Submit Form Modal End
    });
</script>
<script>
      const toggleBtn = document.querySelector(".sidebar-toggle");

const sidebar = document.querySelector(".sidebar ");

const closeBtn = document.querySelector(".close-btn");

toggleBtn.addEventListener("click", function () {
  sidebar.classList.toggle("show-sidebar");
});

closeBtn.addEventListener("click", function () {
  sidebar.classList.remove("show-sidebar");
});

    </script>
