<!-- Banner Row  Ends-->
<?
$phone2 = g('db.admin.phone');
$phonenum2 = str_replace(array(')', '(', '-', ' '), array('', '', '', ''), $phone2);
?>
<!-- Inpage-->

<?php $this->load->view('widgets/inner_banner'); ?>

<div class="acces_sec inpage">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="inner_acces">
                <div class="row">
                    <div class="mh">
                        <h4>Select Exam</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-1 ">
                        <div class="select_program">
                            <?php
                            if (array_filled($exam_list)) {
                                foreach ($exam_list as $key => $value):?>
                                    <form action="<?php echo g('base_url_portal'); ?>access" method="post">
                                        <input type="hidden" name="oi_id" value="<?php echo $oi_id; ?>">
                                        <input type="hidden" name="exam_product_id" value="<?php echo $value['exam_list_product_id']; ?>">
                                        <input type="hidden" name="exam_e_list_id" value="<?php echo $value['exam_list_id']; ?>">
                                        <div class="row">


                                            <div class="col-md-9"><p><?php echo $value['exam_list_title']; ?></p>
                                            </div>

                                            <div class="col-md-3"><input type="submit" value="Select"></div>

                                        </div>
                                    </form>
                                    <div class="clearfix"></div>
                                <?php endforeach;
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            