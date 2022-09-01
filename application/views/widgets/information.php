<section class="requestFor">
    <div class="container">
        <form method="post" action="<?php echo g('base_url');?>quote/store" id="form-quote">
            <div class="col-md-3 col-xs-12 col-sm-3">
                <h2><span>Request For</span> Information</h2>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-3">
                <input type="text" name="quote[quote_fullname]" placeholder="Name:" id="quote-fullname">
            </div>
            <div class="col-md-3 col-xs-12 col-sm-3">
                <input type="text" name="quote[quote_email]" placeholder="Email" id="quote-email">
            </div>
            <div class="col-md-3 col-xs-12 col-sm-3">
                <input type="submit" value="Submit Now">
            </div>
        </form>
    </div>
</section>