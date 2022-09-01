<?
// Banner heading
//$this->load->view('widgets/inner_banner');
// Banner section
?>

<?php
$data['breadcrumb_title'] = 'Dashnoard';
$this->load->view('widgets/breadcrumb',$data);
?>

<!-- begin-section Our Process-->
<section class="accountSec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-3 col-sm-3 col-xs-12 ">
                    <div class="inner_box  wow bounceIn" data-wow-duration="1.2s">
                        <div class="box">
                            <!--<img src="<?php /*echo g('images_root');*/?>icon1.png" alt="" class="hvr_none" alt="Our Process">
                            <img src="<?php /*echo g('images_root');*/?>icon11.png" alt="" class="hide" alt="Our Process">-->
                            <i class="fa fa-bandcamp" aria-hidden="true"></i>
                        </div>
                        <div class="style_div">
                            <h4><a href="<?php echo g('base_url');?>account/info">My Account</a> </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 ">
                    <div class="inner_box  wow bounceIn" data-wow-duration="1.2s">
                        <div class="box">
                            <!--<img src="<?php /*echo g('images_root');*/?>icon2.png" alt="" class="hvr_none" alt="Our Process">
                            <img src="<?php /*echo g('images_root');*/?>icon22.png" alt="" class="hide" alt="Our Process">-->
                            <i class="fa fa-bars" aria-hidden="true"></i>

                        </div>
                        <div class="style_div">
                            <h4><a href="<?php echo g('base_url');?>account/orderhistory">My Orders</a> </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 ">
                    <div class="inner_box  wow bounceIn" data-wow-duration="1.2s">
                        <div class="box">
                            <!--<img src="<?php /*echo g('images_root');*/?>icon1.png" alt="" class="hvr_none" alt="Our Process">
                            <img src="<?php /*echo g('images_root');*/?>icon11.png" alt="" class="hide" alt="Our Process">-->
                            <i class="fa fa-key" aria-hidden="true"></i>
                        </div>
                        <div class="style_div">
                            <h4><a href="<?php echo g('base_url');?>account/change-password">Change Password</a> </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 ">
                    <div class="inner_box  wow bounceIn" data-wow-duration="1.2s">
                        <div class="box">
                            <!--<img src="<?php /*echo g('images_root');*/?>icon4.png" alt="" class="hvr_none" alt="Our Process">
                            <img src="<?php /*echo g('images_root');*/?>icon44.png" alt="" class="hide" alt="Our Process">-->
                            <i class="fa fa-sign-out" aria-hidden="true"></i>

                        </div>
                        <div class="style_div">
                            <h4><a href="<?php echo g('base_url');?>user/logout">Logout</a> </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End: Our Process -->