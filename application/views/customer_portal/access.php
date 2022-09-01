<!-- Banner Row  Ends-->
<?
$phone2=g('db.admin.phone');
$phonenum2 = str_replace(array(')','(','-',' '),array('','','',''),$phone2);
?>
<!-- Inpage-->

<?php $this->load->view('widgets/inner_banner');?>

<div class="acces_sec inpage">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="inner_acces">
                <div class="row">
                    <div class="mh">
                        <h4><?php echo $info['product_name'];?> - Practice Test</h4>
                    </div>
                </div>
                <div class="row">
                    <h3>Please enter your access code and click on the Begin Your Test button.</h3>
                    <hr class="hidde_row">
                </div>
                <div class="row">
                    <form action="<?php echo g('base_url_portal');?>verification" method="post" id="form-verification">
                        <input type="hidden" name="oid" value="<?php echo string_encrypt($info['order_id']);?>">
                        <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-1 ">
                            <input type="text" name="code" placeholder="Enter Your Access Code Here">
                            <input type="hidden" name="p_id" value="<?php echo string_encrypt($info['order_item_product_id']);?>">
                            <input type="hidden" name="exam_e_list_id" value="<?php echo ($exam_e_list_id);?>">
                            <!--<span> Don't have an access code? <a href="#" class="get">get one now.</a></span>-->
                            <div class="clearfix"></div>
                            <div class="col-md-3 no-margin">
                                <a href="javascript:void(0)" ><input type="submit" class="btn-verify"></a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="bh">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <!--<a href="" class="exit" data-toggle="modal" data-target="#myModal"> Exit</a>-->
                            <!--<a href="acces_2.html" class="exit pull-right">Next</a>-->
                        </div>
                    </div>
                </div>

                <form action="<?php echo g('base_url_portal');?>exam" method="post" id="form-exam">
                    <input type="hidden" name="oi_id" value="<?php echo $info['order_item_id'];?>">
                    <input type="hidden" name="exam_e_list_id" value="<?php echo ($exam_e_list_id);?>">
                </form>

                <form action="<?php echo g('base_url_portal');?>confirm" method="post" id="form-exam-confirm">
                    <input type="hidden" name="oi_id" value="<?php echo $info['order_item_id'];?>">
                    <input type="hidden" name="exam_e_list_id" value="<?php echo ($exam_e_list_id);?>">
                </form>
            </div>
        </div>
    </div>
</div>
            