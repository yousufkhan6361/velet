<!-- Forgot Password Start Modal-->

<div class="modal fade" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog custom-modal-dialog" role="document">

        <div class="modal-content custom-modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>

            </div>

            <form method="post" action="<?=g('base_url')?>account/ForgotPasswordEmail" id="forgot-form">

                <div class="modal-body form-group">

                    <p><label>Email</label></p>

                    <p><input class="form-control" name="signup[signup_email]" type="email" placeholder="Email"></p>

                    <!-- <p><?$this->load->view('widgets/google_captcha')?></p> -->

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary user-pass-rec-btn">Send</button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- Forgot Password End Modal-->