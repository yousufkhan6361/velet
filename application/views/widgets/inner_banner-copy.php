<!-- Main Heading Starts Here -->
<div class="sliderSec">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <img src="<?php echo get_image($banner['banner_image_path'],$banner['banner_image']);?>" alt="" style="width:100%;">

                <div class="sliderDetails">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h3><?php echo $banner['banner_heading'];?></h3>
                                <h1><?php echo $banner['banner_sub_heading'];?></h1>
                                <?php echo html_entity_decode($banner['banner_description']);?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Main Heading Ends Here -->