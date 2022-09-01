<!-- Breadcrumbs -->
<div class="topRow">
    <div class="container">
        <h3><a href="<?= g('base_url') ?>">Home </a> <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span><?php echo humanize($detail['category_name']); ?></span></h3>
    </div>
</div>

<section class="inpage resources ser-mol-biology">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="left_side">
                    <h3>Categories </h3>

                    <div aria-multiselectable="true" class="panel-group" id="accordion" role="tablist">

                        <?php
                        $param_two['where']['category_type'] = 2;
                        $category_type_two = $this->model_category->find_all_active($param_two);
                        // debug($category_type_two,1);
                        ?>

                        <?php
                        foreach ($category_type_two as $key => $value) {?>

                            <div class="panel panel-default">
                                <div class="panel-heading" id="headingOne<?php echo $key;?>" role="tab">
                                    <h4 class="panel-title"><a aria-controls="collapseOne<?php echo $key;?>" aria-expanded="true" class="<?php echo ($detail['category_id']==$value['category_id'])?'':'collapsed'?>" data-parent="#accordion" data-toggle="collapse" href="#collapseOne<?php echo $key;?>" role="button"> <?php echo $value['category_name'];?> </a></h4>
                                </div>
                                <div aria-labelledby="headingOne<?php echo $key;?>" class="panel-collapse collapse <?php echo ($detail['category_id']==$value['category_id'])?'in':'';?>" id="collapseOne<?php echo $key;?>" role="tabpanel" aria-expanded="true" style="">
                                    <div class="panel-body">
                                        <?php
                                        $param_three['where']['category_type'] = 3;
                                        $param_three['where']['category_parent_id'] = $value['category_id'];
                                        $category_type_three = $this->model_category->find_all_active($param_three);?>
                                        <ul>
                                        <?php foreach ($category_type_three as $key1 => $value1) {?>
                                            <li> <a href="<?php echo g('base_url');?>category/<?php echo $value1['category_slug'];?>"> <?php echo $value1['category_name'];?> </a></li>
                                        <?php }
                                        ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div class="reRight media-sec">

                    <h2><?php echo $detail['category_name'];?></h2>
                    <br/>

                    <?php
                    // Show image IF set
                    if(!empty($detail['category_image'])){?>
                        <div class="row">
                            <ul class="media-list" style="background-image: url('<?php echo get_image($detail['category_image_path'], $detail['category_image']);?>');">
                            </ul>


                        </div>
                        <div class="clearfix"></div>
                    <?php }
                    ?>

                    <br/>
                    <?php echo html_entity_decode($detail['category_detail'])?>
                    <hr>
                    <?php
                    $param_three['where']['category_type'] = 3;
                    $param_three['where']['category_parent_id'] = $detail['category_id'];
                    $category_type_three = $this->model_category->find_all_active($param_three);
                    if(array_filled($category_type_three)){?>
                        <div class="col-md-12">
                            <div class="botbtn text-center">
                                <?php
                                foreach ($category_type_three as $key3=>$value3):?>
                                    <a href="<?php echo g('base_url');?>category/<?php echo $value3['category_slug'];?>" class="btn btn1"><?php echo $value3['category_name'];?></a>
                                <?php endforeach;
                                ?>
                            </div>
                        </div>
                    <?php }
                    ?>

                </div>
            </div>
</section>

