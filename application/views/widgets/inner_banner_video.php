<?php
if (array_filled($banner)) {
    ?>
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <h1><?php echo $banner['banner_heading']; ?></h1>
                </div>
            </div>
        </div>

        <div class="videoInner">
            <video poster="<?php echo get_image($banner['banner_image_path'], $banner['banner_image']); ?>" playsinline
                   autoplay muted loop>
                <source src="<?php echo get_image($banner['banner_image_path'], $banner['banner_image']); ?>"
                        type="video/mp4">
            </video>
        </div>
    </section>
<?php }
?>