<div class="third">
    <div class="thirdImg">
        <img src="<?php echo get_image($supplier_cms['cms_page_image_path'],$supplier_cms['cms_page_image']);?>" alt="" class="img-responsive">
    </div>

    <div class="thirdText">
        <div class="container">
            <div class="col-md-7 col-md-offset-5">
                <h1><?php echo $supplier_cms['cms_page_title'];?></h1>
                <?php echo html_entity_decode($supplier_cms['cms_page_content'])?>

                <div class="row">

                </div>

                <div class="row">
                    <?php
                    if(array_filled($suppliers)){
                        $i=1;
                        foreach($suppliers as $key=>$value):?>
                            <div class="col-md-3 feature-box">
                                <img src="<?php echo get_image($value['supplier_image_path'],$value['supplier_image']);?>" alt="" class="img-responsive">
                            </div>
                            <?php if($i%4==0){?>
                                <div class="clearfix"></div>
                            <?php }?>
                        <?php $i++;endforeach;
                    }
                    ?>
                </div>
                <!--<ul class="list-unstyled list-inline">
                    <li><img src="<?php /*echo g('images_root');*/?>clients.jpg" alt="" class="img-responsive"></li>
                </ul>-->
            </div>
        </div>
    </div>

</div>