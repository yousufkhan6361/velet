<?php
if (isset($category_parent) && array_filled($category_parent)) {
    ?>
    <section class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                    <div class="productsheading">
                        <?php
                        $explode = explode(' ', $cms_title[1]['cms_title_text']);
                        if(count($explode)>1){
                            ?>
                            <h1><span><?php echo $explode[0];?></span> <?= strstr($cms_title[1]['cms_title_text'], ' ')?></h1>
                        <?php }
                        else{?>
                            <h1><?= $cms_title[1]['cms_title_text']?></h1>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                    <div class="productlisting">
                        <ul>

                            <?php
                            foreach ($category_parent as $key => $value) {
                                ?>
                                <li>
                                    <div class="productbox"> <img src="<?php echo get_image($value['category_parent_image_path'],$value['category_parent_image']);?>" alt="" class="img-responsive one"> <img src="<?php echo get_image($value['category_parent_image_path'],$value['category_parent_image_2']);?>" alt="" class="img-responsive two"> </div>
                                    <span><?= $value['category_parent_name'];?></span>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
}
?>