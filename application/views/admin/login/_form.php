<?global $config;?>

<!-- BEGIN LOGIN -->
<div class="main-login col-sm-4 col-sm-offset-4">
    <div class="logo"><?php echo $config['admin_title'];?>
    </div>

    <!-- start: LOGIN BOX -->
    <div class="box-login">
        <h3>Sign in to your account</h3>
        <p>
            Please enter your email and password to log in.
        </p>
        <form class="form-login" action="<?=$config['base_url']?>admin/login/" method="post">
            <?if(isset($error)){?>
                <div class="errorHandler alert alert-danger no-display">
                    <i class="fa fa-remove-sign"></i> Invalid Credentials
                </div>
            <?php }?>
            <fieldset>
                <div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="user_email" placeholder="Email">
								<i class="fa fa-user"></i> </span>
                </div>
                <div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" class="form-control password" name="user_password" placeholder="Password">
								<i class="fa fa-lock"></i>
								</span>
                </div>
                <div class="form-actions">
                    <!--<label for="remember" class="checkbox-inline">
                        <input type="checkbox" class="grey remember" id="remember" name="remember">
                        Keep me signed in
                    </label>-->
                    <button type="submit" class="btn btn-bricky pull-right">
                        Login <i class="fa fa-arrow-circle-right"></i>
                    </button>
                </div>

            </fieldset>
            <input type="hidden" value="<?=(isset($_GET['redirect_url']))?$_GET['redirect_url']:''?>" name="redirect_url" />
        </form>
    </div>
    <!-- end: LOGIN BOX -->

</div>