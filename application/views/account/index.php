
<style>
/* 17-Apr-2020 */
.services_slider .slick-list a{
  text-decoration: none;
  font-size: 15px;
  font-weight: 400;
  color: #5e5e5e;
  line-height: 28px;
}
.content-page {margin: 50px;}
.content-page h3{margin-bottom: 34px;}
  .inner_box {
    padding: 45px 0px 40px 0px;
    transition: all .3s ease-in-out;
    background: #f0f0f0;
    border: 1px solid #3333330a;
  }
  .inner_box img {
    display: block;
    margin: 0 auto 20px;
  }
  .style_div h4 {
    position: relative;
    color: #545454;
    text-align: center;
    font-size: 24px;
    font-weight: 700;
    padding-top: 8px;
  }
  .inner_box:hover h4, .inner_box:hover p, .inner_box:hover .text-muted {
    color: #fff;
  }
  .inner_box:hover .hide {
    display: block !important;
  }
  .inner_box:hover .hvr_none {
    display: none !important;
  }
  .inner_box .box {
    text-align: center;
    margin: 0 auto;
    font-size: 40px;
  }
  .myaccount-sidebar ul>li.active a {
    color: white;
  }
 section.accountSec {
 margin: 28px 28px 70px 28px;
}
.style_div a{
    color: #333;
}
.style_div a:hover{
    color: #c6393e;
}
.box .fa {
    color: #333;
}.box .fa:hover {
    /*color: #00c3c6;*/
}
  /* My Account area end */
}
</style>
<?
// Banner heading
//$this->load->view('widgets/inner_banner');
// Banner section
?>
<!-- begin-section Our Process-->
<? $this->load->view("account/header"); ?>
<!-- <div class="signup"> -->
<div class="container" id='goTo'>
       <?php $this->load->view('widgets/breadcrum'); ?>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar1 col-md-3 col-sm-3">
         <? $this->load->view("account/menu"); ?>
         </div>
          <!-- END SIDEBAR -->
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7" style="margin-bottom: 15px;">
            <br>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 ">
                    <div class="inner_box  wow bounceIn" data-wow-duration="1.2s">
                    <div class="box">
                        <a href="<?php echo g('base_url');?>account/info">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </a>
                        </div>
                        <div class="style_div">
                            <h4><a href="<?php echo g('base_url');?>account/info">Account Settings</a> </h4>
                         </div>
                    </div>
                </div>

                <?php
                    // Buyer
                    $buyer = $this->model_signup->find_by_pk($this->userid); 
                ?>

                  <div class="col-md-4 col-sm-4 col-xs-12 ">
                    <div class="inner_box  wow bounceIn" data-wow-duration="1.2s">
                        <div class="box">
                         <a href="<?php echo g('base_url');?>account/orderhistory">
                            <i class="fa fa-history" aria-hidden="true"></i>
                        </a>
                        </div>
                        <div class="style_div">
                            <h4><a href="<?php echo g('base_url');?>account/orderhistory">Order History</a> </h4>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4 col-sm-4 col-xs-12 ">
                    <div class="inner_box  wow bounceIn" data-wow-duration="1.2s">
                        <div class="box">
<a href="<?php echo g('base_url');?>my-account/wishlist">
                            <i class="fa fa-heart" aria-hidden="true"></i>
</a>
                        </div>
                        <div class="style_div">
                            <h4><a href="<?php echo g('base_url');?>my-account/wishlist">Wishlist</a> </h4>
                        </div>
                    </div>
                </div> --> 
          
               
                   <!-- <div class="col-md-4 col-sm-4 col-xs-12 ">
                    <div class="inner_box  wow bounceIn" data-wow-duration="1.2s">
                        <div class="box">
                         <a href="<?php echo g('base_url');?>seller_dashboard/product">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </a>
                        </div>
                        <div class="style_div">
                            <h4><a href="<?php echo g('base_url');?>seller_dashboard/product">My Products</a> </h4>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-md-4 col-sm-4 col-xs-12 ">
                    <div class="inner_box  wow bounceIn" data-wow-duration="1.2s">
                        <div class="box">
<a href="<?php echo g('base_url');?>seller-shop">
                            <i class="fa fa-handshake-o" aria-hidden="true"></i>
</a>
                        </div>
                        <div class="style_div">
                            <h4><a href="<?php echo g('base_url');?>seller-shop">Seller Shop</a> </h4>
                        </div>
                    </div>
                </div> -->

<div class="col-md-4 col-sm-4 col-xs-12 ">
    <div class="inner_box  wow bounceIn" data-wow-duration="1.2s">
        <div class="box">
          <a href="<?php echo g('base_url');?>account/change-password">
            <i class="fa fa-key" aria-hidden="true"></i>
          </a> 
        </div>
        <div class="style_div">
            <h4><a href="<?php echo g('base_url');?>account/change-password">Change Password</a> </h4>
        </div>
    </div>
</div>

</div>
<br>
<div class="row">

<div class="col-md-4 col-sm-4 col-xs-12 ">
  <div class="inner_box  wow bounceIn" data-wow-duration="1.2s">
      <div class="box">
        <a href="<?=g('base_url')?>my-account/affiliate">
          <!-- <i class="fa fa-key" aria-hidden="true"></i> -->
          <i class="fab fa-affiliatetheme"></i>
        </a> 
      </div>
      <div class="style_div">
          <h4><a href="<?=g('base_url')?>my-account/affiliate">Affiliate Link</a> </h4>
      </div>
  </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12 ">
<div class="inner_box  wow bounceIn" data-wow-duration="1.2s">
<div class="box">
<a href="<?php echo g('base_url');?>user/logout">
<i class="fa fa-sign-out" aria-hidden="true"></i>
</a>
</div>
<div class="style_div">
<h4><a href="<?php echo g('base_url');?>user/logout">Logout</a> </h4>
</div>
</div>
</div>



</div>
                <br>
            </div>           
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      <!-- </div> -->
</div>
</div>
<!-- End: Our Process -->
<script type="text/javascript">
 

</script>