<?php //debug($feature_products);
$array = $feature_products;
$arr = [6,2,3,2]; // Sequence as created in HTML
$result_arr = [];
foreach($arr as $k => $v){
    $result_arr['row-'.($k+1)] = array_splice($array,0,$v);
}
?>
<section class="proShowCase">
    <div class="container">
        <div class="row">
            <?php
            if(array_key_exists('row-1', $result_arr)){
                $row_1 = $result_arr['row-1'];
                foreach ($row_1 as $key=>$value):?>
                    <div class="col-md-4 col-sm-4">
                        <a href="<?php echo g('base_url');?>merchandise/detail/<?php echo $value['product_slug'];?>" class="proThumb wow fadeInUp" data-wow-delay="0.4s">
                            <img src="<?php echo get_image($value['product_image_path'],$value['product_image']);?>" alt="">
                            <div class="content">
                                <?php echo html_entity_decode($value['product_overview']);?>
                                <span><?php echo $value['product_name'];?></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach;
            }
            ?>
            <?php
            if(array_key_exists('row-2', $result_arr)){
                $row_2 = $result_arr['row-2'];
                foreach ($row_2 as $key=>$value):
                    if($key==0){?>
                        <div class="col-md-8 col-sm-8">
                            <a href="<?php echo g('base_url');?>merchandise/detail/<?php echo $value['product_slug'];?>" class="proThumb wow fadeInUp" data-wow-delay="0.4s">
                                <img src="<?php echo get_image($value['product_image_path'],$value['product_image']);?>" alt="">
                                <div class="content">
                                    <?php echo html_entity_decode($value['product_overview']);?>
                                    <span><?php echo $value['product_name'];?></span>
                                </div>
                            </a>
                        </div>
                    <?php }
                    else{?>
                        <div class="col-md-4 col-sm-4">
                            <a href="<?php echo g('base_url');?>merchandise/detail/<?php echo $value['product_slug'];?>" class="proThumb wow fadeInUp" data-wow-delay="0.4s">
                                <img src="<?php echo get_image($value['product_image_path'],$value['product_image']);?>" alt="">
                                <div class="content">
                                    <?php echo html_entity_decode($value['product_overview']);?>
                                    <span><?php echo $value['product_name'];?></span>
                                </div>
                            </a>
                        </div>
                    <?php }
                    ?>
                <?php endforeach;
            }
            ?>
        </div>
    </div>
</section>

<section class="proShowCase">
    <div class="container">
        <div class="row">
            <?php
            if(array_key_exists('row-3', $result_arr)){
                $row_3 = $result_arr['row-3'];
                foreach ($row_3 as $key=>$value):?>
                    <div class="col-md-4 col-sm-4">
                        <a href="<?php echo g('base_url');?>shop/detail/<?php echo $value['product_slug'];?>" class="proThumb wow fadeInUp" data-wow-delay="0.4s">
                            <img src="<?php echo get_image($value['product_image_path'],$value['product_image']);?>" alt="">
                            <div class="content">
                                <?php echo html_entity_decode($value['product_overview']);?>
                                <span><?php echo $value['product_name'];?></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach;
            }
            ?>

            <?php
            if(array_key_exists('row-4', $result_arr)){
                $row_4 = $result_arr['row-4'];
                foreach ($row_4 as $key=>$value):
                    if($key==0){?>
                        <div class="col-md-8 col-sm-8">
                            <a href="<?php echo g('base_url');?>shop/detail/<?php echo $value['product_slug'];?>" class="proThumb wow fadeInUp" data-wow-delay="0.4s">
                                <img src="<?php echo get_image($value['product_image_path'],$value['product_image']);?>" alt="">
                                <div class="content">
                                    <?php echo html_entity_decode($value['product_overview']);?>
                                    <span><?php echo $value['product_name'];?></span>
                                </div>
                            </a>
                        </div>
                    <?php }
                    else{?>
                        <div class="col-md-4 col-sm-4">
                            <a href="<?php echo g('base_url');?>merchandise/detail/<?php echo $value['product_slug'];?>" class="proThumb wow fadeInUp" data-wow-delay="0.4s">
                                <img src="<?php echo get_image($value['product_image_path'],$value['product_image']);?>" alt="">
                                <div class="content">
                                    <?php echo html_entity_decode($value['product_overview']);?>
                                    <span><?php echo $value['product_name'];?></span>
                                </div>
                            </a>
                        </div>
                    <?php }
                    ?>
                <?php endforeach;
            }
            ?>
        </div>
    </div>
</section>