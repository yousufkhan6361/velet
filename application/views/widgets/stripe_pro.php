<?php
    $oid = $_GET['oid'];
    $order_details = $this->model_order->find_by_pk($oid);
    // debug($order_details,1);
    $custom = number_format((float)$order_details['order_amount'], 2, '.', '');
    // debug($oid,1);
	// $custom = $custom + ($custom * 0.065);
?>
<style>
    .StripeElement {
        background-color: white;
        height: 40px;
        padding: 10px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
    .payment-accepts img {
        width: 100px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Pay with Credit Card</div>
            <div class="panel-body">
                <form action="<?php echo g('base_url');?>checkout/stripe-payment" method="post" id="payment-form">
                    <div class="form-row">

                        <label for="card-element">
                            Credit or debit card
                        </label>
                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>

                    <br>
                    <br>
                    <input type="hidden" name="amount" value="<?php echo $custom;?>"/>
                    <input type="hidden" name="oid" value="<?php echo $oid;?>"/>

                    <div class="col-md-6">
                        <button class="btn btn-warning">Submit Payment</button>
                    </div>
                        <div class="col-md-6 payment-accepts">
<!--                             <img src="<?php echo g('images_root');?>image-payment.png" alt="Payment">
                            <img src="<?php echo g('images_root');?>stripe-icon.png" alt="Payment"> -->
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
    // Create a Stripe client.
    var stripe = Stripe('<?php echo STRIPE_PUBLIC_KEY;?>');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Createtoke  = for simple payment
        stripe.createToken(card).then(function(result) {

        // Createresource  = for 3d
        //stripe.createSource(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.

                // FOR SIMPLE PAYMENT
                stripeTokenHandler(result.token);

                // FOR 3D PAYMENT
                // stripeSourceHandler(result.source);
            }
        });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }

    // FOR SOURCE HANDLER
    function stripeSourceHandler(source) {
        // Insert the source ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeSource');
        hiddenInput.setAttribute('value', source.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>