<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card mb-4 mx-4">
              <div class="card-body p-4">


                <form method="post" action="<?php echo g('base_url');?>user/save" id="signupForm">
                <h1>Register</h1>
                <p class="text-medium-emphasis">Create your account</p>
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>

                    </svg></span>
                  <input class="form-control" name="signup[signup_company]" type="text" placeholder="Company Name">
                </div>

                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>

                    </svg></span>
                  <input class="form-control" name="signup[signup_phone]" type="text" placeholder="Phone">
                </div>

                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>

                    </svg></span>
                  <input class="form-control" name="signup[signup_service_for]" type="text" placeholder="Service For">
                </div>


                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                    </svg></span>
                  <input class="form-control" type="text" name="signup[signup_email]" placeholder="Email">
                </div>
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                    </svg></span>
                  <input class="form-control" name="signup[signup_password]" type="password" placeholder="Password">
                </div>
                <!-- <div class="input-group mb-4"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                    </svg></span>
                  <input class="form-control" type="password" placeholder="Repeat password">

                </div> -->

                <span style="float: right;"><a href="<?=g('base_url')?>user/login"> Already have an account</a></span>
                <br><br>
                  <button type="submit" id="btn-signup" class="btn btn-block btn-success">Create Account</button>
                </form>
              </div>



            </div>
          </div>
        </div>
      </div>
    </div>

    
<!--
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
          <div class="loginseclist">
            <h4>LOGIN</h4>


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
<input type="password" class="form-control" name="signup[signup_password]" id="password" placeholder="Password">
</div>
</div>
</div>
<div class="row">
<div class="col-12 col-sm-12 col-md-12 col-lg-12">
<div class="signuplist">
<button type="button" id="btn-login" value="login" style="padding: 10px;">Login</button>
</div>
</div>
</div>
<div class="row">
<div class="col-12 col-sm-12 col-md-12 col-lg-12">
<div class="signuplist1">
<a href="#" data-toggle="modal" data-target="#forgot-password"> <span> Forget Password? </span> </a>
</div>
<div class="clearfix"></div> 
</div>
</div>
</form>
          </div>
        </div>
    </div>
  </div>
</section> -->



