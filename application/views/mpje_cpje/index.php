<?php $this->load->view('widgets/inner_banner');?>

<div class="mpje_main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h3><?php echo str_replace($banner['inner_banner_name'],'MPJE | CPJE',$banner['inner_banner_name']);?> Computer Adaptive</h3>
                <!-- <span>You need access code</span> -->
            </div>
        </div>
        <div class="row">
            <?php
            if(array_filled($products)){
                $i=1;
                foreach ($products as $key=>$value):?>
                    <div class="col-md-3 col-xs-12 col-sm-3">
                        <div class="mpje_box">
                            <div class="mpje_img">
                                <img src="<?php echo get_image($value['product_image_path'], $value['product_image']);?>" alt="img">
                            </div>
                            <div class="mpje_text">
                                <h6><?php echo $value['product_name'];?></h6>
                            </div>
                            <a href="<?php echo g('base_url');?>mpje-cpje/detail/<?php echo $value['product_slug'];?>" class="Quantity_btn2">ADD TO CART</a>
                        </div>
                    </div>
                <?php
                if($i%4==0){?>
                    <div class="clearfix"></div>
                <?php }
                $i++;
                endforeach;
            }
            ?>
        </div>

    </div>
</div>

<?php $this->load->view('widgets/information');?>