<!-- Banner Row  Ends-->
<?
$phone2=g('db.admin.phone');
$phonenum2 = str_replace(array(')','(','-',' '),array('','','',''),$phone2);
?>
<!-- Inpage-->

<?php $this->load->view('widgets/inner_banner');?>

<div class="acces_sec pg_2 inpage">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="inner_acces">
                <div class="row">
                    <div class="mh">
                        <p class="pull-left"><?php echo $result['product_name'];?></p>
                        <!--<p class="pull-right">Expired</p>-->
                    </div>
                </div>
                <?php
                if($total_count>0){
                    ?>
                    <div class="row">
                        <div class="red_bg">
                            <p>Question <?php echo (!empty($position)) ? $position :1;?> of <?php echo $total_count;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 exam-box">
                            <h4><?php echo html_entity_decode($programs['exam_question']);?> </h4>
                            <label class="container_1"><?php echo $programs['exam_option_1'];?>
                                <input type="radio" checked="checked"  name="user_exam_answer" value="1">
                                <span class="checkmark"></span> </label>
                            <label class="container_1"><?php echo $programs['exam_option_2'];?>
                                <input type="radio"  name="user_exam_answer" value="2">
                                <span class="checkmark"></span> </label>
                            <label class="container_1"><?php echo $programs['exam_option_3'];?>
                                <input type="radio"  name="user_exam_answer" value="3">
                                <span class="checkmark"></span> </label>
                            <label class="container_1"><?php echo $programs['exam_option_4'];?>
                                <input type="radio"  name="user_exam_answer" value="4">
                                <span class="checkmark"></span> </label>
                            <!--<label class="container_1"><?php /*echo $programs['exam_option_5'];*/?>
                                <input type="radio"  name="user_exam_answer" value="5">
                                <span class="checkmark"></span> </label>-->
                            <!--<p class="r">once you click the show explanation new button you will not be able to change your answer</p>-->
                            <div class="col-md-3 no-margin">
                                <input type="submit" value="show explanation now" class="btn_explaination">
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 no-margin show_explaination">
                                <?php echo html_entity_decode($programs['exam_answer_description']);?>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
                <div class="row">
                    <div class="bh">
                        <div class="col-xs-12 col-sm-12 col-md-12"> <a href="#" class="exit" data-toggle="modal" data-target="#myModal"> Exit</a>
                            <?php
                            if($total_count>0){
                                if($position==$total_count){?>
                                    <a href="javascript:void(0)" class="exit pull-right btn-summary">Finish</a>
                                    <form method="post" action="<?php echo g('base_url_portal');?>summary" id="form-summary">
                                        <input type="hidden" name="exam_id" value="<?php echo $programs['exam_id'];?>">
                                        <input type="hidden" name="oi_id" value="<?php echo $result['order_item_id'];?>">
                                        <input type="hidden" name="position" value="<?php echo $position;?>">
                                        <input type="hidden" name="exam_e_list_id" value="<?php echo $exam_e_list_id;?>">
                                        <input type="hidden" name="answer" value="1" id="exam_answer">
                                    </form>
                                <?php }
                                else{?>
                                    <a href="javascript:void(0)" class="exit pull-right btn-next-slide">Next</a>
                                <?php }
                                ?>
                            <?php }
                            ?>
                            <form method="post" action="<?php echo g('base_url_portal');?>exam" id="form-next-slide">
                                <input type="hidden" name="exam_id" value="<?php echo $programs['exam_id'];?>">
                                <input type="hidden" name="oi_id" value="<?php echo $result['order_item_id'];?>">
                                <input type="hidden" name="exam_e_list_id" value="<?php echo $exam_e_list_id;?>">
                                <input type="hidden" name="position" value="<?php echo $position;?>">
                                <input type="hidden" name="answer" value="1" id="exam_answer">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="acces_modal">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel" >Exit Your Test</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <p>you are about to exit  your test,this procedure is irreversible.you will lose all your questions.</p>
                        <h4>Do you want to proceed?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="button_1" data-dismiss="modal"> Go back to test </a>
                    <a href="<?php echo g('base_url_portal');?>" class="button_1"> Exit </a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<!-- Confirmation modal start -->
<div class="acces_modal">
    <div class="modal fade" id="myModal_confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Review</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <p>It look like you already taken this practice test do you want to review the test or retake the test? </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="acces.html" class="button_1" data-dismiss="modal"> Review</a>
                    <a href="acces_2.html" class="button_1"> Retake </a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<!-- Confirmation modal end -->

<script>
    $('.btn_explaination').click(function () {
        $('.show_explaination').toggle('slow');
    });

    $('.btn-next-slide').click(function () {
        $('#form-next-slide').submit();
    });

    $(document).ready(function(){
        //$('#myModal_confirm').modal('show');
    });

    $('input:radio[name="user_exam_answer"]').change(
        function(){
            $('#exam_answer').val($(this).val());
        });

</script>
            