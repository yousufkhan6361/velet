<?php
if(array_filled($step)){?>
    <section class="stepSec">
        <div class="container">
            <div class="owl-carousel" id="stepList">
                <?php foreach ($step as $key=>$value):?>
                    <div class="stepBox tc-image-effect-shine">
                        <div class="row">
                            <div class="col-md-12">
                                <span><?php echo $key+1;?></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <diw class="row">
                            <div class="stepBoxText">
                                <h2><?php echo $value['step_title'];?></h2>
                                <?php echo html_entity_decode($value['step_description']);?>
                            </div>
                        </diw>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
<?php }
?>
<script type="text/javascript" defer>


    $('#stepList').owlCarousel({

        loop:true,
        slideBy: 1,
        items: 4,
        autoPlay:false,

        itemsDesktop : [1199, 4]
    });



</script>