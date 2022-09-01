<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<div class="resources_main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="resources_bg">
                    <ul>
                    <?php if(array_filled($resources)){
                        foreach ($resources as $key=>$value):?>
                            <li class="<?php echo ($key%2==0)?'':'resources_bg2';?>"><strong><?php echo $value['resources_title'];?> : </strong> <?php echo html_entity_decode($value['resources_content']);?>
                            </li>
                        <?php endforeach;?>
                        <?php }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?
$this->load->view('widgets/information');
?>