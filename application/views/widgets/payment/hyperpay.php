<div class="row">

    <?php
    if($this->session->flashdata('error_message')!= null){?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="alert alert-danger">
                <strong><?php echo $this->session->flashdata('error_message');?></strong>
            </div>
        </div>
    <?php } ?>

    <div class="col-md-12">
        <div class="panel panel-info">
            <!--<div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure
                Payment
            </div>-->
            <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Pay with Card</div>
            <div class="panel-body">
                <div class="col-md-12 ">
                    <script src="<?php echo HYPER_PAY_HTML_JS;?>?checkoutId=<?php echo $hper_pay_response['id'];?>"></script>
                    <br>
                    <br>

                    <div id="paypal-button-container">
                        <form action="<?php echo g('base_url');?>checkout/hyperpay_response/<?php echo $custom;?>/" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>