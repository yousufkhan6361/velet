<style>
.payment-accepts img {
    width: 100px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <!--<div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure
                Payment
            </div>-->
            <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Pay with Paypal</div>
            <div class="panel-body">
                <div class="col-md-12 ">
                    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                    <!--<div class="modal-header">
                        <h2 class="modal-title" id="myModalLabel">Pay with Paypal</h2>
                    </div>-->
                    <br>
                    <br>

                    <div id="paypal-button-container"></div>
                </div>
                <div class="col-md-12 payment-accepts">
                    <? //$this->load->view('checkout/_payment');?>
                    <!-- <img src="<?php echo g('images_root');?>paypal-logo.png" alt="Payment"> -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$discount = $this->session->userdata['coupon']['coupon']['coupon_value'];
//debug($discount,1);
// debug($custom,1);
?>
<!-- Paypal script start -->
<script>


    var getAmount = '<?=$amount?>';

      var getcurrency = '<?=$this->symbol?>';

        paypal.Button.render({

            env: '<?=PAYPAL_ENVIRONMENT?>', // sandbox | production
            style: {
            label: 'checkout',
            size: 'responsive', // small | medium | large | responsive
            shape: 'rect',  // pill | rect
            color: 'gold'    // gold | blue | silver | black
        },

            client: {
                   // sandbox:  
                <?=PAYPAL_ENVIRONMENT?>: '<?=PAYPAL_CLIENTID?>'

            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '<?=$amount?>', currency: 'USD' } 
                            }
                        ]
                    }
                });
            },

        onAuthorize: function (data, actions) {
            return actions.payment.execute().then(function () {
                AdminToastr.success('Your Payment has been Charged Successfully', 'Payment Success');
                console.log(data);
                console.log(actions);

                // return false;

                var EXECUTE_URL = '<?=$notify_url?>';

                var params = {
                    payment_status: 'Completed',
                    custom: '<?=$custom; // ORDER ID?>',
                    paymentID: data.paymentID,
                    payerID: data.payerID
                };

                if (paypal.request.post(EXECUTE_URL, params)) {
                    // return false;
                    if (params.payment_status == 'Completed') {
                        // console.log(data);
                        setInterval(function () {
                            window.location = '<?=g('base_url')?>checkout/success?oid=<?=$custom?>';
                        }, 2000);
                    } else {
                        console.log(params.payment_status);
                        AdminToastr.error('Error', 'Payment Failed');
                    }
                }
            }).catch(function (error) {
                console.log(error);
                AdminToastr.error('Error', 'Payment Failed');
            });
        },

        validate: function (actions) {},

        onCancel: function (data, actions) {
            AdminToastr.error('Some Error occured', 'Ops');
            var EXECUTE_URL = '<?=$notify_url?>';
            var params = {
                payment_status: 'Failed',
                custom: '<?=$custom; // ORDER ID?>',
                paymentID: data.paymentID
            };
            if (paypal.request.post(EXECUTE_URL, params)) {}
        },

        onError: function (data) {
            AdminToastr.error('Error', 'Payment Failed');
            console.debug(data);
        }
    }, '#paypal-button-container');

</script>
<!-- Paypal script end -->