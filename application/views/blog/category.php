<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<!-- Blog Listing body-content -->
<div class="inner-page blog">
    <div class="container">

        <!-- Blog section starts -->
        <div class="col-md-8 col-xs-12 col-sm-8">
            <?php
            if(array_filled($blog_info['data'])){
                foreach($blog_info['data'] as $key=>$value):?>
                    <div class="blog-lef">
                        <h2><?php echo $value['blog_name'];?></h2>
                        <img src="<?php echo get_image($value['blog_image_path'],$value['blog_image']);?>" alt="" class="img-responsive">
                        <?php echo mb_strimwidth(html_entity_decode($value['blog_description']), 0, 425, " <strong>. . .</strong></p>")?>

                        <div class="col-md-9 col-xs-12 col-sm-12">
                            <ul class="blog-icons">
                                <li>
                                    <h6 title="Date"><i class="fa fa-clock-o" aria-hidden="true"></i></h6>
                                    <h6><?php echo date('d,M Y',strtotime($value['blog_createdon']));?></h6>
                                </li>
                                <li>
                                    <h6><i class="fa fa-user" aria-hidden="true"></i></h6>
                                    <h6> Admin </h6>
                                </li>
                                <li>
                                    <h6 title="Category"><i class="fa fa-heart" aria-hidden="true"></i></h6>
                                    <h6> <?php echo $value['blog_category_name'];?> </h6>
                                </li>
                                <li>
                                    <h6 title="Comments"><i class="fa fa-comment" aria-hidden="true"></i></h6>
                                    <h6> <?php echo $value['total_comments'];?> </h6>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-12">
                            <div class="read-bt" align="center"><a href="<?php echo g('base_url') . 'blog/'.$value['blog_slug'];?>"> Read More</a></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr class="blog-br">
                <?php endforeach;?>
            <?php } ?>

            <div class="text-center"><?=$blog_info['links']?></div>

        </div>
        <!-- Blog section end -->

        <div class="col-md-4 col-xs-12 col-sm-4">
            <div class="blog-right">
                <div class="boxs boxs2 cat-box">
                    <h3> CATEGORIES </h3>
                    <?php
                    if(array_filled($categories)){ ?>
                        <ul>
                            <?php
                            foreach($categories as $key=>$value):?>
                                <!--<li><a href="<?php /*echo g('base_url') . 'blog/'.$value['blog_category_slug'];*/?>"><?php /*echo $value['blog_category_name'];*/?></a></li>-->
                                <li><a href="<?php echo g('base_url') . 'blog/category/'.$value['blog_category_slug'];?>"><?php echo $value['blog_category_name'];?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <? }
                    ?>
                </div>
                <div class="boxs boxs1 recent-box">
                    <h3> Recent Posts </h3>
                    <?php
                    if(array_filled($recent)){
                        foreach($recent as $key=>$value):?>
                            <ul>
                                <li>
                                    <p><a href="<?php echo g('base_url') . 'blog/' . $value['blog_slug'];?> "><?php echo $value['blog_name'];?></a></p>

                                    <p><span> <?php echo date('d M Y', strtotime($value['blog_createdon']));?> </span></p>
                                </li>
                            </ul>
                        <?php endforeach;
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Listing body-content -->