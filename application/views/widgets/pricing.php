<div class="fiveBack">

    <div class="five">
        <div class="container">
            <div class="head text-center">
                <h1>Our Pricing</h1>
            </div>

            <div class="row">
                <?php
                if(array_filled($pricing)){
                    $pricing_type = $this->model_pricing->get_fields('pricing_type')['list_data'];
                    foreach($pricing as $key=>$value):?>
                        <div class="col-md-3">
                            <div class="fiveBox">
                                <h4><?php echo $pricing_type[$value['pricing_type']];?></h4>
                                <h1>$<?php echo $value['pricing_amount'];?></h1>
                                <ul class="list-unstyled">
                                    <li><?php echo $value['pricing_description'];?></li>
                                </ul>
                                <a href="javascript:void(0)">Buy Now</a>
                                <?php
                                if($value['pricing_is_popular']=='1'){?>
                                    <h5 class="brander">Most Popular</h5>
                                <?php }
                                ?>
                            </div>
                        </div>
                    <?php endforeach;
                }
                ?>

            </div>
        </div>
    </div>

    <?php $this->load->view('widgets/subscribe')?>
</div>