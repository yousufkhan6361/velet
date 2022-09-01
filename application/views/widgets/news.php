<?php
if (isset($news_content) && array_filled($news_content)) { ?>
    <section class="eventsSec">
        <div class="container">
            <h1> <?php echo $news_content['cms_page_title'];?></h1>
            <h6><?php echo html_entity_decode(strip_tags($news_content['cms_page_content']));?></h6>
            <?php
            // debug($news_content,1);
            foreach ($news as $key => $value) {
                $launchdate = date('F d Y', strtotime($value['news_date']));?>
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <div class="blogBox"> <img src="<?php echo get_image($value['news_image_path'], $value['news_image']); ?>" class="img-responsive" alt="blog">
                        <div class="blogText">
                            <!-- <h3><?= $value['news_name'] ?></h3> -->
                             <h3><a href="<?=g('base_url')?>news-and-event-details/<?=$value['news_slug']?>"><?= $value['news_name'] ?></a></h3>
                            <ul>
                                <li><a href="javascript:void(0)"><i class="fa fa-user"></i> <?= $value['news_auhtor'] ?></a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-calendar"></i> <?php echo $launchdate; ?></a></li>
                                <!-- <li><a href="javascript:void(0)"><i class="fa fa-heart"></i> 127</a></li> -->
                            </ul>
                            <?php echo mb_strimwidth(html_entity_decode($value['news_description']), 0, 220, " <strong>. . .</strong></p>")?>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </section>
<?php } ?>