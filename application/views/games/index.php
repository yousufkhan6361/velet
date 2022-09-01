    <section class="bannerSec">
        <img src="<?php echo get_image($banner['inner_banner_image_path'],$banner['inner_banner_image']);?>" class="img-responsive" alt="Banner">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h1>games</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: bannerSec -->
    <!-- BEGIN: gameSec -->
    <?php
        if (isset($games_posters) && array_filled($games_posters)) {
    ?>
        <section class="gameSec">
        <div class="container">
            <div class="swiper-container2">
                <div class="swiper-wrapper">
                    <?php
                        foreach ($games_posters as $key => $value) {
                    ?>
                        <div class="swiper-slide"><img src="<?php echo get_image($value['game_slider_image_path'],$value['game_slider_image']);?>" class="img-responsive" alt=""></div>
                    <?php    
                        }
                    ?>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>
    <?php
        }


    ?>
    

    <!-- END: gameSec -->
    <!-- BEGIN: popularSec -->
    <section class="popularSec gameDetail">
        <div class="container">
            <div class="gameRow">
                <div class="row flexRow">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <figure>
                            <img src="<?php echo get_image($featured_game['popular_games_image_path'],$featured_game['popular_games_image']);?>" class="img-responsive" alt="">
                        </figure>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <article class="detail">
                            <h2><?=$featured_game['popular_games_name']?></h2>
                            <?php
                                $launchdate = date('F Y',strtotime($featured_game['popular_games_launch_date']));
                            ?>
                            <p>Launch: <span><?= $launchdate;?></span></p>
                            <ul class="list-unstyled">
                                <li>price: <span><?= price($featured_game['popular_games_price']);?></span></li>
                                <li>rating: <span><?= $featured_game['popular_games_rating'];?></span></li>
                            </ul>
                            <div class="rating">
                                <div class="stars star-rating">
                                    <?php
                                        $rating = intval($featured_game['popular_games_rating']);
                                        $remaining = 5 - $rating;
                                    ?>

                                    <?php
                                        for($i = 0; $i< $rating; $i++)
                                        {
                                    ?>
                                                <span class="fa fa-star checked"></span> 
                                    <?php
                                        }
                                        for ($i=0; $i < $remaining; $i++) { 
                                    ?>
                                           <span class="fa fa-star-o"></span> 
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php echo html_entity_decode($featured_game['popular_games_description']);?>
                            <ul class="list-inline">
                                <li><a href="<?=$featured_game['popular_games_play_store_link']?>" target="_blank"><img src="<?php echo g('base_url');?>assets/front_assets/images/google-play-icon.png" class="img-responsive" alt="Play Store"></a></li>
                                <li><a href="<?=$featured_game['popular_games_app_store_link']?>" target="_blank"><img src="<?php echo g('base_url');?>assets/front_assets/images/apple-icon.png" class="img-responsive" alt="App Store"></a></li>
                            </ul>
                        </article>
                    </div>
                </div>
            </div>

            <?php
                if (isset($lastsec) && array_filled($lastsec)) {
            ?>


            <div class="detailArea">
                <?php echo html_entity_decode($lastsec['cms_page_content']);?>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo html_entity_decode($lastsec['cms_page_other_content']);?>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <a href="<?php echo get_image($lastsec['cms_page_image_path'],$lastsec['cms_page_image_4']);?>" data-fancybox="video">
                            <img src="<?php echo get_image($lastsec['cms_page_image_path'],$lastsec['cms_page_image']);?>" class="img-responsive" alt="Video">
                            <span class="overlay">
                                <img src="<?php echo g('base_url');?>assets/front_assets/images/play-icon.png" class="img-responsive" alt="Play">
                            </span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo html_entity_decode($lastsec['cms_page_other_content_3']);?>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo html_entity_decode($lastsec['cms_page_other_content_4']);?>
                    </div>
                </div>
            </div>
            <?php                    
                }
            ?>
        </div>
    </section>