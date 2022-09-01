<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<section>
  <div class="Servicesdetail">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-sm-7 col-xs-12">
          <div class="servicesdetailimg">
            <img src="<?php echo get_image($blog_details['blog_image_path'], $blog_details['blog_image_detail1']);?>" class="img-responsive">
          </div>
        </div>
        <div class="col-md-5 col-sm-5 col-xs-12">
          <div class="servicesdetailcontent">
            <span><?=$blog_details['blog_title']?></span>
            <?php echo html_entity_decode($blog_details['blog_detail']);?>         
          </div>
        </div>
      </div>
    </div>
  </div>
</section>