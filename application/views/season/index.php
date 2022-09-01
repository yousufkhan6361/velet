<?php
$products = $product_info['data'];
?>
<section class="NewArrivalsSec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h2 class="title text-center">Season's</h2>
            </div>
            <div class="col-md-6 col-sm-6">
                <a href="<?php echo g('base_url');?>season?type=2"><img src="<?php echo g('images_root');?>season1.jpg" alt="" class="img-responsive seasonImg"></a>
            </div>
            <div class="col-md-6 col-sm-6">
                <a href="<?php echo g('base_url');?>season?type=1"><img src="<?php echo g('images_root');?>season2.jpg" alt="" class="img-responsive seasonImg"></a>
            </div>
        </div>
        <div class="row proThumbRow">
            <?php
            if(array_filled($products)) {
                $i=1;
                foreach ($products as $key => $value):?>
                    <div class="col-md-3 col-sm-4 wow fadeInUp" data-wow-delay="1.2s">
                        <div class="proThumb">
                            <a href="<?php echo g('base_url');?>shop/detail/<?php echo $value['product_slug'];?>"><img alt="" src="<?php echo get_image($value['product_image_path'], $value['product_image_thumb']);?>"></a>
                            <div class="content1">
                                <a href="<?php echo g('base_url');?>shop/detail/<?php echo $value['product_slug'];?>" class="proName"><?php echo $value['product_name'];?></a>
                                <?php
                                if($value['product_type']!='1'){?>
                                    <del><?php echo price($value['product_old_price']);?></del>
                                <?php } ?>
                                <h6><?php echo price($value['product_price']);?></h6>
                                <a href="<?php echo g('base_url');?>shop/detail/<?php echo $value['product_slug'];?>" class="btnStyle1">Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    if($i%4==0){
                        $i=1;?>
                        <div class="clearfix"></div>
                    <?php }
                    else{
                        $i++;
                    }
                endforeach;?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="sort-pre navi">
                        <nav aria-label="Page navigation">
                            <?php echo $product_info['links'];?>
                        </nav>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</section>