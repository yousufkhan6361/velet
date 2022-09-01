<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<main class="servicePg">

  <!-- money section  -->
  <section class="money_sec">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="main_headng text-center">
            <h3>Saving Money is the #1 Reason Why Customers Use Pack Glob</h3>
            <p>Millions and Millions of Packages Shipped Since 2020</p>
          </div>
        </div>
        <div class="servicesSec">
          <div class="row">
            <?php
                if (array_filled($services)) {
                  foreach ($services as $key => $value) {
              ?>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="serDet.html">
                <div class="money_box text-center wow zoomIn" data-wow-duration="2s"> <img src="<?php echo get_image($value['service_image_path'], $value['service_image']);?>" class="img-responsive" alt="">
                  <h4><?=$value['service_title']?></h4>
                <?php echo html_entity_decode($value['service_description']);?>
                </div>
              </div>
            </div>
            <?php
                  }
                }
              ?>
          </div>
        </div>
        <!-- <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-1 col-sm-offste-1">
          <div class="blogslid">
            
            
            
            
            <div class="">
              <div class="money_box text-center wow zoomIn" data-wow-duration="2s"> <img src="images/mn_4.jpg" class="img-responsive" alt="">
                <h4>45, 60, or 90 days  free storage for Premium Members and 7  days free storage for  Free Accounts.</h4>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </section>

  <!-- join pack start-->
  <section class="join_sec">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="main_headng text-center">
          <h3><?=$sec2['cms_page_name']?></h3>
        </div>
      </div>
      <div class="col-xs-12 col-sm-3 col-md-3 pd">
        <div class="join_box"> <img src="<?php echo get_image($sec2['cms_page_image_path'], $sec2['cms_page_image']);?>" class="img-responsive" alt=""> </div>
      </div>
      <div class="col-xs-12 col-sm-3 col-md-3 pd">
        <div class="join_box text">
          <?php echo html_entity_decode($sec2['cms_page_content']);?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-3 col-md-3 pd">
        <div class="join_box "> <img src="<?php echo get_image($sec2['cms_page_image_path'], $sec2['cms_page_image_4']);?>" class="img-responsive" alt=""> </div>
      </div>
      <div class="col-xs-12 col-sm-3 col-md-3 pd">
        <div class="join_box text orange">
          <?php echo html_entity_decode($sec2['cms_page_other_content']);?>
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- join pack end-->

  <!-- pricing sec  -->
  <section class="pricing_sec">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="main_headng text-center"> <img src="<?=g('images_root')?>star.jpg" class="img-responsive" alt="">
          <h6><?=$sec3['cms_page_name']?></h6>
          <h3><?=$sec3['cms_page_title']?></h3>
        </div>
      </div>
      <?php
        if (array_filled($pricings)) {
          foreach ($pricings as $key => $value) {
      ?>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
          <div class="price_div text-center wow zoomIn" data-wow-duration="2s">
            <h3><?=price($value['pricing_amount'])?></h3>
            <p><?=$value['pricing_name']?></p>
            <a href="javascript:void(0)" > Book Today</a> </div>
        </div>
      <?php
          }
        }
      ?>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="text text-center">
          <?php echo html_entity_decode($sec3['cms_page_content']);?>
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- pricing end  -->

  <!-- start section start -->
  <section class="start-sec">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <h4>Start Saving Today! Get your free U.S. address!</h4>
          <a href="javascript:void(0)" class="sign">Sign Up Free</a> </div>
      </div>
    </div>
  </section>
  <!-- start section end --> 

  <!-- yellow sec  --> 
</main>