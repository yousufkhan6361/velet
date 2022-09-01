    <div class="popup login_popup" style="display:none;">
        <div class="popup_bg">
            <h1>Sign In <a href="javascript:void(0)"><i style="color:#FFF;float:right;" class="fa fa-times toggleElement" data-target=".popup"></i></a></h1>
            <div class="registered_customers">
                <form id="loginForm" class="validatableForm" method="POST" action="<?=l('home/login')?>">
                    <h2>Registered Customers <span>* Required fields</span></h2>
                    <label class="error_div error form_errors" style="display: none;">Invalid Email/Password.</label>
                    <div class="form_row">
                        <label>Email *</label>
                        <input id="user_email"  name="user_email" class="required email" required type="email"/>

                    </div>
                    <div class="form_row">
                        <label>Password *</label>
                        <input id="user_password" name="user_password" class="required" required type="password"/>
                    </div>

                    <div class="form_row">
                        <label class="for">
                            <a href="javascript:void(0)">Forgot Password?</a>
                        </label>
                    </div>
                    <div class="form_row">
                        <input type='button' href="javascript:void(0)" class="register_continue dologin formSubmitter" value="Login" />
                    </div>

                </form>
            </div>
            <div class="new_customers">

                <h2>New Customers</h2>
                <p>You are welcome to register a new customer account in our shop!
                </p>
                <div class="form_row">
                    <a href="<?=l('register')?>/?redirect_url=<?=current_url()?>" class="register_continue cont">Continue</a>
                </div>
            </div>
        </div>

    </div>
<script>
<?if($dologin){?>
    $(document).ready(function () {
        $('#msg').html("Please login to proceed");
        $(".popup").show();
    });
<?}?>
</script>   