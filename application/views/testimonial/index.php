<?$this->load->view('widgets/inner_banner');?>

<!-- Testimonial Section Starts -->
<?
if(array_filled($content)){ ?>
    <section class="innContent parentPg">
        <div class="container">
            <section class="clientReview">
                <? foreach($content as $key=>$value): ?>
                    <div class="col-md-6 col-xs-12 col-sm-6">
                        <div class="clientReviewBox">
                            <div class="col-md-3 col-xs-12 col-sm-3"><img src="<?=Links::img($value['testimonial_image_path'],$value['testimonial_image'])?>" class="img-responsive"></div>
                            <div class="col-md-9 col-xs-12 col-sm-9">
                                <h2><?=$value['testimonial_name']?></h2>

                                <h3><?=$value['testimonial_designation']?></h3>

                                <p><?=$value['testimonial_description']?></p>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </section>
        </div>
    </section>
<?}
?>
<div class="clearfix"></div>
<!-- Testimonial Section End -->