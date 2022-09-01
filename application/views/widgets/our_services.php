<section class="ourServices">
    <div class="container">
        <h1><?php echo $service_content['cms_page_title'];?></h1>
        <h6><?php echo html_entity_decode(strip_tags($service_content['cms_page_content'])); ?></h6>

        <?php
        if (isset($services) && array_filled($services)) {
            foreach ($services as $key => $value) {?>
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <div class="servicesBox tc-image-effect-circle">
                        <div class="servicesBoxPd">
                            <div class="icon1" style="background: url('<?php echo get_image($value['service_image_path'], $value['service_image']);?>') no-repeat;"></div>
                            <h4><?= $value['service_title'] ?></h4>
                            <p><?php echo html_entity_decode($value['service_short_detail']); ?></p>
                        </div>
                    </div>
                </div>
            <?php }?>
        <?php }?>

        <a href="<?php echo g('base_url');?>services" class="mainBtn tc-image-effect-circle"> View All Services</a> </div>
</section>