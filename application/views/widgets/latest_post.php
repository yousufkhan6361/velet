<!-- Latest post section start -->
<?
$blog = $this->model_blog->get_post(3);
if(array_filled($blog)){?>
    <div class="clear"></div>

    <div class="latest-section">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <h2>Latest Post</h2>

                </div>

                <?
                foreach($blog as $key=>$value):
                    $url = g('base_url').'blog/'.$value['blog_slug'];
                    $description = mb_strimwidth(html_entity_decode($value['blog_description']),0,220,'...');
                    ?>
                    <div class="col-md-4 lt-item">

                        <a href="<?=$url?>">

                            <img src="<?=Links::img($value['blog_image_path'],$value['blog_image'])?>"
                                 alt="">

                            <h3><?=$value['blog_name']?></h3>

                        </a>

                        <p><?=$description?></p>

                        <a class="rd-btn" href="<?=$url?>">Reading More &#8594;</a>

                    </div>
                <?endforeach;
                ?>

            </div>

        </div>

    </div>
<?}
?>
<!-- Latest post section end -->