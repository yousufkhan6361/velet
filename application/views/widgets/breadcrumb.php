<!-- Banner Row -->
<?php
$class_name = $layout_data['class_name'];
?>
<div class="topRow">
    <div class="container">
        <?php
        if(!empty($breadcrumb_title)){?>
            <h3> <a href="<?=g('base_url')?>">Home </a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?=g('base_url'). str_replace(array('_'),array('-'),strtolower($class_name))?>"><?php echo humanize($class_name);?> </a><i class="fa fa-angle-right" aria-hidden="true"></i> <span><?php echo $breadcrumb_title;?></span></h3>
        <?php }
        else{?>
            <!--<h3> <a href="<?/*=g('base_url')*/?>">Home </a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?/*=g('base_url'). str_replace(array('_'),array('-'),strtolower($class_name))*/?>"><?php /*echo humanize($class_name);*/?> </a></h3>-->
            <h3> <a href="<?=g('base_url')?>">Home </a> <i class="fa fa-angle-right" aria-hidden="true"></i> <span><?php echo humanize($class_name);?></span></h3>
        <?php }
        ?>
    </div>
</div>