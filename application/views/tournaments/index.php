    <section class="bannerSec">
        <img src="<?php echo get_image($banner['inner_banner_image_path'],$banner['inner_banner_image']);?>" class="img-responsive" alt="Banner">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h1><?php echo $banner['inner_banner_name']?></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: bannerSec -->
<section class="tournaments-section">
        <div class="container">
            <div class="tournaments-diver">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="row">
                            <?php foreach ($tournaments as $key => $value) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="tournaments-item">
                                    <h1><?=$value['tournaments_day']?></h1>
                                    <h2><?=date('d F h:i:s A', strtotime($value['tournaments_date']))?> EDT</h2>
                                    <ul>
                                        <li>
                                            <a href="#" class="ateam-logo">
                                                <img src="<?=get_image($value['tournaments_image_path'],$value['tournaments_image'])?>"></a>
                                            <span class="vs-span">
                                                <img src="<?=g('images_root')?>vs-span.png">
                                            </span>
                                            <a href="#" class="ateam-logo">
                                                <img src="<?=get_image($value['tournaments_image_path'],$value['tournaments_image2'])?>"></a>
                                            </li>
                                    </ul>
                                    <?=html_entity_decode($value['tournaments_description'])?>
                                    <h3>PRIZE POOL</h3>
                                    <h1><?=price($value['tournaments_price'])?></h1>
                                </div>
                            </div>
                            <?}?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="next-team fixer-area">
                            <div class="fixer-header fixerborder-bottom">
                                <h3>NEXT TEAM MATCH</h3>
                            </div>
                            <div class="fixer-content">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="nextteam">
                                            <a href="#" class="nextteam-a">
                                                <img class="" src="<?=g('images_root')?>nextteam-img1.png">
                                                <span>BULLYZ</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="nextteam">
                                            <a href="#" class="nextteam-vs">
                                                <img src="<?=g('images_root')?>nextteam-vs.png">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="nextteam">
                                            <a href="#" class="nextteam-a">
                                                <img class="" src="<?=g('images_root')?>nextteam-img2.png">
                                                <span>STARKS</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fixer-footer">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="teamfixercode">BF4</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="fixerfooter-content">
                                            <h3>MONTH<span>September</span></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="fixerfooter-content">
                                            <h3>DAY<span>25</span></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="fixerfooter-content">
                                            <h3>HOUR<span>12:10r</span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="next-team fixer-area">
                            <div class="fixer-header">
                                <h3>UPCOMING TOURNAMENTS</h3>
                            </div>
                            <div class="fixer-tabcontent">
                                <div class="tabcontent-table">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab1default" data-toggle="tab">All</a></li>
                                        <li><a href="#tab2default" data-toggle="tab">CS:GO</a></li>
                                        <li><a href="#tab3default" data-toggle="tab">Dota 2</a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1default">
                                        <table class="ritekhed-client-detail">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <figure class="figure-ateam"><img src="<?=g('images_root')?>ateam-logo1.png" alt=""></figure>
                                                    </td>
                                                    <td><span class="match-sc">0:0</span></td>
                                                    <td>
                                                        <figure class="figure-ateam"><img src="<?=g('images_root')?>ateam-logo2.png" alt=""></figure>
                                                    </td>
                                                    <td>
                                                        <h4>CS:GO <span>274 WEEKS AGO</span></h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <figure class="figure-ateam"><img src="<?=g('images_root')?>ateam-logo1.png" alt=""></figure>
                                                    </td>
                                                    <td><span class="match-sc">0:0</span></td>
                                                    <td>
                                                        <figure class="figure-ateam"><img src="<?=g('images_root')?>ateam-logo2.png" alt=""></figure>
                                                    </td>
                                                    <td>
                                                        <h4>CS:GO <span>274 WEEKS AGO</span></h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <figure class="figure-ateam"><img src="<?=g('images_root')?>ateam-logo1.png" alt=""></figure>
                                                    </td>
                                                    <td><span class="match-sc">0:0</span></td>
                                                    <td>
                                                        <figure class="figure-ateam"><img src="<?=g('images_root')?>ateam-logo2.png" alt=""></figure>
                                                    </td>
                                                    <td>
                                                        <h4>CS:GO <span>274 WEEKS AGO</span></h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>