<!-- Main Heading Starts Here -->
<div class="Inner_Banner" style="background: url('<?php echo get_image($banner['inner_banner_image_path'],$banner['inner_banner_image']);?>');">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>Service Detail</h2>
            </div>
        </div>
    </div>
</div>
<!-- Main Heading Ends Here -->

<section class="blogdetail inpage">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="blogdet">
                    <h1><?php echo $service_details['service_title'];?></h1>
                    <h5><strong>Date:<?php echo date('d-m-y',strtotime($service_details['service_createdon']));?> </strong></h5>
                    <?php echo html_entity_decode($service_details['service_description']);?>
                </div>
            </div>
        </div>
    </div>
</section>