<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<style>
    .PT_express_checkout {
        height: 860px !important;
    }

    .PT_express_checkout #PT_overlay{
        background: transparent !important  ;
    }

    .result {
        display: none;
    }

    .result.success {
        background-color: green;
    }

    .result.failed {
        background-color: red;
    }
    .PT_express_checkout .alert{
        text-align: center;
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
        font-weight: bold;
        font-size: 20px;
    }
</style>
<script>
    const credintials = {
        merchant_id: "10051111",
        secret_key: "xxx",
    };
</script>


<section class="main-cntctpg loginpage">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padd-0">
            <div>
                <link rel="stylesheet" href="https://www.paytabs.com/theme/express_checkout/css/express.css">
                <script src="https://www.paytabs.com/theme/express_checkout/js/jquery-1.11.1.min.js"></script>
                <script src="https://www.paytabs.com/express/express_checkout_v3.js"></script>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <!-- Button Code for PayTabs Express Checkout -->
                <div class="PT_express_checkout"></div>
                <script type="text/javascript">
                    Paytabs("#express_checkout").expresscheckout({
                        settings: {
                            merchant_id: "<?php echo PAYTAB_MERCHANT;?>",
                            secret_key: "<?php echo PAYTAB_SEC_KEY;?>",
                            amount: '<?php echo $info["pricing_amount"]?>',
                            currency: "USD",
                            title: '<?php echo $this->user_info['signup_firstname'] . " " . $this->user_info['signup_lastname']?>',
                            product_names: "Product1",
                            order_id: '<?php echo $info["pricing_id"]?>',
                            url_redirect: "<?php echo g('base_url')?>checkout/callback?t=redirect",
                            display_customer_info: 1,
                            display_billing_fields: 1,
                            display_shipping_fields: 0,
                            language: "en",
                            redirect_on_reject: 1,
                            is_iframe: {
                                load: "onbodyload",
                                show: 1
                            },
                            is_self: 1,
                            url_cancel: "<?php echo g('base_url')?>checkout/callback?t=cancel"
                        },
                        customer_info: {
                            first_name: '<?php echo $this->user_info["signup_firstname"]?>',
                            last_name: '<?php echo $this->user_info["signup_lastname"]?>',
                            //phone_number: "5486253",
                            email_address: '<?php echo $this->user_info["signup_email"]?>',
                            //country_code: "973"
                        },
                        /*billing_address: {
                            full_address: "Manama, Bahrain",
                            city: "Manama",
                            state: "Manama",
                            country: "BHR",
                            postal_code: "00973"
                        },
                        shipping_address: {
                            shipping_first_name: "Jane",
                            shipping_last_name: "Abdulla",
                            full_address_shipping: "Manama, Bahrain",
                            city_shipping: "Manama",
                            state_shipping: "Manama",
                            country_shipping: "BHR",
                            postal_code_shipping: "00973"
                        },*/
                    });
                </script>

                <!--<script>

                    let pt_checker = setInterval(start, 3000);

                    function start() {
                        $.get('<?php /*echo g('base_url')*/?>checkout/check', (data, status) => {
                            if (data != '0') {
                                let json = JSON.parse(data);
                                let success = json.response_code == 100;

                                alert('Payment status: ' + json.response_message);


                                if (success) {
                                    $('.success').show('fast');
                                } else {
                                    $('.failed').show('fast');
                                }

                                console.log(json);
                                clearInterval(pt_checker);
                            } else {
                                console.log('.');
                            }
                        });
                    }
                </script>-->
            </div>
        </div>
    </div>
</section>

