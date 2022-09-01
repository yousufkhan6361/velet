<!--<section class="bannerSec">
    <img src="<?php /*echo get_image($banner['inner_banner_image_path'], $banner['inner_banner_image']); */?>"
         class="img-responsive" alt="Banner">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h1><?php /*echo $banner['inner_banner_name'] */?></h1>
                </div>
            </div>
        </div>
    </div>
</section>-->
<!-- END: bannerSec -->

<!-- Breadcrumbs -->
<?php
$data['breadcrumb_title'] = '';
$this->load->view('widgets/breadcrumb',$data);?>

<section class="ourBlog">
    <div class="container">
        <?php
        $count =1;
        foreach ($blog_info['data'] as $key => $value): ?>
            <div class="col-md-4 col-xs-12 col-sm-6 hvr-sink">
                <div class="our-services-boxMain">
                    <div class="ourserviceimg"><img src="<?php echo get_image($value['blog_image_path'], $value['blog_image']);?>" width="100%" alt=""></div>
                    <div class="our-services-box">
                        <h2><?php echo $value['blog_title'];?></h2>
                        <h3><?php echo $value['blog_category_name'];?></h3>
                        <h5> <a href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i> Admin</a> | <a href="javascript:void(0)"> <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d F m',strtotime($value['blog_createdon']));?></a> | <a href="javascript:void(0)"> <i class="fa fa-heart" aria-hidden="true"></i> <?php echo $value['comments_count'];?></a></h5>
                        <p><?php echo $value['blog_short_detail'];?> </p>
                        <div class="rd-more"> <a href="<?php echo g('base_url');?>blog/detail/<?php echo $value['blog_slug'];?>">Read More</a> </div>
                    </div>
                </div>
            </div>

            <?php
            if($count%3==0){
                $count= 1;
                ?>
                <div class="clearfix"></div>
            <?php }
            else{
                $count++;
            }
            ?>
        <?php endforeach; ?>

    </div>
</section>

<!--<section class="blogSec">
    <div class="container">
        <?php /*foreach ($blogs as $key => $value) { */?>
            <div class="row flexRow">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <figure>
                        <img src="<?/*= get_image($value['blog_image_path'], $value['blog_image']) */?>"
                             class="img-responsive" alt="Blog">
                    </figure>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <article class="blogDetail">
                        <ul class="list-inline">
                            <li><a href="#"><i
                                            class="fa fa-clock-o"></i> <?/*= date('d F Y', strtotime($value['blog_date'])) */?>
                                </a></li>
                            <li><a href="#"><i class="fa fa-comments"></i> 10</a></li>
                        </ul>
                        <h3><?/*= $value['blog_name'] */?></h3>
                        <?/*= html_entity_decode($value['blog_description']) */?>
                    </article>
                </div>
            </div>
        <?/* } */?>
    </div>
</section>-->