<?
// Banner heading
///$this->load->view('widgets/inner_banner');
// Banner section
?>

<section class="videoSec">
    <div class="container">
        <div class="row">
            <?php
            if(array_filled($videos)){
                $i=1;
                foreach ($videos as $key=>$value):?>
                    <!--<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-6">-->
                    <div class="col-md-6  col-xs-12">
                        <iframe width="100%" height="350px" src="<?php echo $value['video_url'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                <?php
                if($i%2==0){
                    $x=1;?>
                    <div class="clearfix"></div>
                <?php }
                else{
                    $x++;
                }
                endforeach;
            }
            ?>
        </div>
    </div>
</section>

