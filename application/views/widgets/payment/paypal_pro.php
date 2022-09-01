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
                <div class="col-md-6" style="background-color: rgba(207, 207, 207, 0.22);">
                    <? //$this->load->view('checkout/_payment');?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Paypal script start -->
<script>


    paypal.Button.render({
        env: '<?php echo PAYPAL_ENV;?>', // sandbox | production
        style: {
            label: 'checkout',
            size: 'responsive', // small | medium | large | responsive
            shape: 'rect',  // pill | rect
            color: 'blue'    // gold | blue | silver | black
        },

        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create

        client: {
            sandbox: '<?php echo PAYPAL_CLIENT_ID;?>',
            production: '<?php echo PAYPAL_CLIENT_ID;?>'
        },

        payment: function (data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: '<?=$amount + $tax;?>',
                        currency: 'USD',
                        //currency: 'GBP',
                        details: {
                            subtotal: '<?=$amount?>',
                            //tax: '<?php echo $tax;?>',
                            shipping: '0.00',
                            handling_fee: '0.00',
                            shipping_discount: '0.00',
                            insurance: '0.00'
                        }
                    },

                    description: 'The payment transaction description.',
                    custom: '<?php echo $custom;?>',
                    //invoice_number: '12345', Insert a unique invoice number

                    payment_options: {
                        allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
                    },

                    soft_descriptor: '<?php echo g("site_name")?>',
                    item_list: {
                        items: <?php echo json_encode($itemsss); ?>,
                        // shipping_address: {
                        //   recipient_name: '<?=$orderDetail['order_firstname']?>',
                        //   line1: '',
                        //   line2: '',
                        //   city: '',
                        //   country_code: 'US',
                        //   postal_code: '',
                        //   phone: '',
                        //   state: '',
                        //   email: '<?=$orderDetail['order_email']?>'
                        // }
                    }

                }],

                note_to_payer: 'Contact us for any questions on your order.'

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
                            window.location = '<?=g('base_url')?>checkout/success';
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
            AdminToastr.error('Some Error occured', 'Error');
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