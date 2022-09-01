<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<main class="pricingPlanPg">
  <!-- pricing sec  -->
  <section class="pricing_sec">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="main_headng text-center"> <img src="images/star.jpg" class="img-responsive" alt="">
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

  <!-- yellow sec  -->
<section class="yelow_sec">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="yelow_div">
          <h4><?=$sec4['cms_page_name']?></h4>
        </div>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="yelow_div text-right">
          <h4><?=$sec4['cms_page_title']?></h4>
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- yellow sec end  -->

<!-- faqsec start -->
<div class="inpage faqsec">
  <div class="container">
    <div class="body-space">
      <div class="row">
        <div class="col-md-12 col-sm-2 col-xs-12">
          <div class="heading">
            <h2><?=$sec5['cms_page_name']?></h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="faqs">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="faq_img wow fadeInLeft" data-wow-duration="2s" > <img src="<?php echo get_image($sec5['cms_page_image_path'], $sec5['cms_page_image']);?>" class="img-responsive" alt=""> </div>
          </div>
          <div class="col-md-6">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <?php
                if (array_filled($faqs)) {
                  foreach ($faqs as $key => $value) {
              ?>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="heading<?=$key?>">
                    <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$key?>" aria-expanded="ture" aria-controls="collapse<?=$key?>"><?=$value['faq_title']?> </a> </h4>
                  </div>
                  <div id="collapse<?=$key?>" class="panel-collapse collapse <?=($key == 0) ? 'in' : ''?>" role="tabpanel" aria-labelledby="heading<?=$key?>">
                    <div class="panel-body">
                      <?php echo html_entity_decode($value['faq_content']);?>
                    </div>
                  </div>
                </div>
              <?php
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- faqsec end -->

<!-- start section start -->
<section class="start-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <h4>Start Saving Today! Get your free U.S. address!</h4>
        <a href="javascript:void(0)" class="sign">Sign Up Free</a> </div>
    </div>
  </div>
  <!-- start section end -->
</section>
<!-- start section end --> 
</main>