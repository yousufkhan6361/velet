<!-- Main Heading Starts Here -->
<div class="Inner_Banner" style="background: url('<?php echo get_image($banner['inner_banner_image_path'],$banner['inner_banner_image']);?>');">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>Support</h2>
            </div>
        </div>
    </div>
</div>
<!-- Main Heading Ends Here -->


<div class="mpje_main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <!--<h3><?php /*echo $about_us['cms_page_title']*/?></h3>-->
                <?php echo html_entity_decode($content['cms_page_content'])?>
            </div>
        </div>
    </div>
</div>

