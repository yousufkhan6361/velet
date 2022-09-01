<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<!-- Content -->
<div class="login-area pt-150 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-left">
                <div class="login">
                    <div class="login-form-container digi-form">
                        <div class="login-text">
                            <div class="col-md-12">
                                <h2>Sign Up</h2>
                                <span>Please Sign Up For Creating  account.</span> </div>
                        </div>
                        <div class="login-form">
                            <form action="<?php echo g('base_url');?>user/save" method="post" id="signup-form">


                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label> First Name </label>
                                        <input type="text" placeholder="" name="signup[signup_firstname]">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label> Last Name </label>
                                        <input type="text" placeholder="" name="signup[signup_lastname]">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label> Email Address </label>
                                        <input type="email" placeholder="" name="signup[signup_email]">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label> Password </label>
                                        <input type="password" placeholder="" name="signup[signup_password]">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label> Address </label>
                                        <input type="text" placeholder="" name="signup[signup_address]">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label> Zip </label>
                                        <input type="number" placeholder="" name="signup[signup_zip]">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label> Country </label>
                                        <select name="signup[signup_country]" id="">
                                            <?php
                                            foreach($countries as $key=>$value):?>
                                                <option value="<?php echo $value['country'];?>" <?php echo ($value['country']=='USA')?'selected':''?>><?php echo $value['country'];?></option>
                                            <? endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-inPut-Btn">
                                        <a href="javascript:void(0)" id="btn-signup">Submit Now</a>
                                    </div>
                                </div>

                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <a href="<?php echo g('base_url')?>user/login" class="cre">Already have an account?</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end Content -->

<!-- Sign up ajax start-->
<script type="text/javascript">
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
</script>