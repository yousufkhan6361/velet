<!--<section class="bannerSec">
    <img src="<?php /*echo get_image($banner['inner_banner_image_path'],$banner['inner_banner_image']);*/?>" class="img-responsive" alt="Banner">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h1>Forgot Password</h1>
                </div>
            </div>
        </div>
    </div>
</section>-->

<!-- Breadcrumbs -->
<?php
$this->load->view('widgets/inner_banner');
//$this->load->view('widgets/breadcrumb', $data);
?>
<section class="login inpage">
    <div class="container">
        <div class="row">
            <div id="goTo">
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-center">
                        <div class="content-page">
                            <h3>Change Password</h3>
                            <div class="row">

                                <form method="post" action="<?=g('base_url')?>user/reset-password" id="update-pa">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center" >
                                        <input type="password" name="password" class="form-control text-center" placeholder="New Password" style="text-align: center;display: block;width: auto;margin: 0 auto;">
                                        <br>
                                        <input type="hidden" name="token" value="<?=$token_user?>">
                                        <input type="hidden" name="user_id" value="<?=$user_id?>">
                                        <div class="white-space-15"></div>
                                        <!--<button value="Update Now" id="submitInfo" class="mtop10 btn-reset-password">Submit</button>-->
                                        <!--<input type="submit" value="Submit" class="btn btn-reset-password">-->
                                        <button type="submit" value="Submit" id="submitInfo" class="mtop10 btn btn-reset-password">Update Now</button>
                                        <br>
                                    </div>
                                </form>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
<!-- body-content -->

<!--end body-content -->
<script>
    // On submit action start (all tabs form)
    $('.btn-reset-password').click(function(event) {
        var pass = $('input[name="password"]').val();

        if(pass.length<6){
            AdminToastr.error('Minimum Password length is 6 characters','Error');
        }
        else{
            // Get button obj
            var btn = $(this);
            // Get form
            var form = $(this).closest('form');
            // Get form id
            var $form = form.attr('id');
            // Disable the submit button to prevent repeated clicks:
            btn.prop('disabled', true);

            // Get action url
            var url = form.attr('action');
            // Get form data
            var data = form.serialize();
            // Submit action
            var response = AjaxRequest.fire(url, data);
            // Register success
            if (response.status) {
                btn.prop('disabled', false);
                window.location.href = '<?=g("base_url")?>'
            }
            // Fail
            else {
                // Enable form
                btn.prop('disabled', false);
            }
        }


        event.preventDefault();
        return false;
    });
    // On submit action end
</script>
