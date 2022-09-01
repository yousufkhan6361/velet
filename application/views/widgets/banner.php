<?php
if (array_filled($banner)) {?>
    <!--<section class="sliderMain">
        <div id="carousel-example-generic1" class="carousel slide online-main" data-ride="carousel">

            <div class="carousel-inner" role="listbox">

                <?php
/*                foreach ($banner as $key => $value):*/?>

                    <div class="item <?php /*if($key == 0){echo "active";}*/?>">
                        <div class="sliderOverly"> <img src="<?php /*echo get_image($value['banner_image_path'],$value['banner_image']);*/?>" alt="slider" > </div>

                        <div class="carousel-caption"><div class="container">
                                <div class="carousel-captionDiv">
                                    <?php /*echo html_entity_decode($value['banner_description']);*/?>
                                    <div class="clearfix"></div>
                                    <div class="pull-right">
                                        <?php /*if(!empty($value['banner_button_1'])){*/?>
                                            <a href="<?php /*echo (!empty($value['banner_button_1_link'])) ? $value['banner_button_1_link']: "javascript:void(0)";*/?>" class="slider1 tc-image-effect-circle"><?php /*echo $value['banner_button_1'];*/?></a>
                                        <?php /*}
                                        if (!empty($value['banner_button_2'])){*/?>
                                            <a href="<?php /*echo (!empty($value['banner_button_2_link'])) ? $value['banner_button_2_link']: "javascript:void(0)";*/?>" class="slider2 tc-image-effect-circle"><?php /*echo $value['banner_button_2'];*/?></a> </div>
                                        <?php /*}
                                        */?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php /*endforeach;*/?>
            </div>
        </div>
    </section>-->

    <div class="main-slider wow fadeInUp" data-wow-delay="0.4s">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php
                $count = count($banner);
                for ($i=1;$i<=$count;$i++){?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i-1;?>" class="<?php echo ($i==1)?'active':'';?>">0<?php echo $i;?></li>
                <?php } ?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
            <?php
            foreach ($banner as $key => $value):?>
                <div class="item <?php echo ($key==0)?'active':'';?>">
                    <img src="<?php echo get_image($value['banner_image_path'],$value['banner_image']);?>" alt="">
                    <div class="carousel-caption <?php echo ($key==0)?'slideStyle1':'slideStyle2';?> <?php echo $value['banner_content_placement'];?>">
                        <?php echo html_entity_decode($value['banner_description']);?>
                        <a href="<?php echo g('base_url');?>merchandise" class="btnStyle1">Shop Now</a>
                    </div>
                </div>
            <?php endforeach;?>

            </div>
        </div>
    </div>

<?php } ?>
