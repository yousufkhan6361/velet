
<!-- Inpage-->

<?php $this->load->view('widgets/inner_banner');?>

<div class="acces_sec inpage">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="inner_acces">
                <div class="row">
                    <div class="mh">
                        <h4><?php echo $result['product_name'];?> - Result</h4>
                    </div>
                </div>
                <div class="row">
                    <!--<h3>Please enter your access code and click on the Begin Your Test button.</h3>-->
                    <hr class="hidde_row">
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-1 ">
                        <!--<span> Don't have an access code? <a href="#" class="get">get one now.</a></span>-->
                        <div class="clearfix"></div>

                        <div style="margin:3%;">
                            <h5>
                                <span style="float:left;margin-left:5%;color: #666;">Total questions:</span>
                                <span class="badge-summary badge-secondary" style="padding:10px; float:right;margin-right:5%;font-weight: bolder;"><?php echo $total_count;?> </span>
                                <br>
                            </h5>
                            <!--<br>
                            <h5>
                                <span style="float:left;margin-left:5%;color: #666;">Total <span class="text-secondary"><b>DUMMY</b></span> questions <b>[Coming soon]</b>:</span>
                                <span class="badge-summary badge-dark" style="padding:10px; float:right;margin-right:5%;font-weight: bolder;">0 </span>
                                <br>
                            </h5>-->
                            <br>
                            <h5>
                                <span style="float:left;margin-left:5%;color: #666;">Questions Answered <span class="text-success"><b>CORRECT</b></span>:</span>
                                <span class="badge-summary badge-success" style="padding:10px; float:right;margin-right:5%;font-weight: bolder;"><?php echo $total_correct_answer;?> </span>
                                <br>
                            </h5>
                            <br>
                            <h5>
                                <span style="float:left;margin-left:5%;color: #666;">Questions Answered <span class="text-danger"><b>WRONG</b></span>:</span>
                                <span class="badge-summary badge-danger" style="padding:10px; float:right;margin-right:5%;font-weight: bolder;"><?php echo $wrong_answer;?> </span>
                                <br>
                            </h5>
                            <!--<br>
                            <h5>
                                <span style="float:left;margin-left:5%;color: #666;">Your Adaptive Score:</span>
                                <span class="badge-summary badge-warning" style="padding:10px; float:right;margin-right:5%;font-weight: bolder;">69</span>
                                <br>
                            </h5>-->
                            <br>
                            <!--<h5>
                                <span style="float:left;margin-left:5%;color: #666;">Your Percentage Score:</span>
                                <span class="badge-summary badge-info" style="padding:10px; float:right;margin-right:5%;font-weight: bolder;"><?php /*echo round($total_count * (1/100),2) * 100;*/?>%</span>
                                <br>
                            </h5>-->
                        </div>

                    </div>
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
                </form>
            </div>
        </div>
    </div>
</div>
            