<?php $this->load->view('widgets/inner_banner'); ?>

    <div class="fpgee_main school_main">
        <div class="container">
            <div class="text-left">
                <h4>Pharmacy School:</h4>
            </div>

            <?php
                if (array_filled($products)) {
                    $split = array_chunk($products, 2);
                    foreach ($split as $key1=>$value1):
                        if($key1==0)
                        {?>
                            <div class="FPGEE_bg naplex_poster_main">
                                <div class="row">
                                    <?php
                                    foreach ($value1 as $key=>$value):
                                        $prices = $this->model_product_price->get_prices($value['product_id']);?>
                                        <div class="col-md-6 col-sm-6 col-xs-12 school_mar">
                                            <h5><?php echo $value['product_name']; ?></h5>
                                            <div class="row">
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <?php /*echo html_entity_decode($value['product_detail']); */?>
                                                    <div class="quantity_select">
                                                        <select name="price" id="price-<?php echo $key; ?>">
                                                            <?php foreach ($prices as $key1 => $value1):
                                                                if ($value1['pricing_type'] == '1') {
                                                                    $text = "Days";
                                                                } elseif ($value1['pricing_type'] == '2') {
                                                                    $text = "Month";
                                                                } elseif ($value1['pricing_type'] == '3') {
                                                                    $text = "Year";
                                                                }
                                                                ?>
                                                                <option value="<?php echo $value1['pricing_id']; ?>">
                                                                    <?php echo $value1['pricing_number']; ?> <?php echo $text; ?>
                                                                    (<?php echo price($value1['pricing_amount']); ?>)
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <a href="javascript:void(0);" data-wishlist="0" data-key="<?php echo $key; ?>"
                                           data-productid="<?php echo $value['product_id']; ?>"
                                           class="Quantity_btn1 Quantity_btn2 addtocart_btn btn-cart">ADD TO CART</a>
                                                    </div>
                                                </div>
                                                <!--<div class="col-md-3 col-sm-3 col-xs-12">
                                                    <div class="price_school">
                                                        <h2><span>$500.00</span></h2>
                                                    </div>
                                                </div>-->
                                            </div>
                                        </div>
                                    <?php endforeach;
                                    ?>
                                </div>
                            </div>
                        <?php }
                        else{?>
                            <div class="fpgee_main school_main">
                                <div class="container">
                                    <div class="FPGEE_bg naplex_poster_main">
                                        <div class="row">
                                            <?php
                                            foreach ($value1 as $key=>$value):
                                                $prices = $this->model_product_price->get_prices($value['product_id']);?>
                                                <div class="col-md-6 col-sm-6 col-xs-12 school_mar">
                                                    <h5><?php echo $value['product_name']; ?></h5>
                                                    <div class="row">
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <?php /*echo html_entity_decode($value['product_detail']); */?>
                                                            <div class="quantity_select">
                                                                <select name="price" id="price-<?php echo $key; ?>">
                                                            <?php foreach ($prices as $key1 => $value1):
                                                                if ($value1['pricing_type'] == '1') {
                                                                    $text = "Days";
                                                                } elseif ($value1['pricing_type'] == '2') {
                                                                    $text = "Month";
                                                                } elseif ($value1['pricing_type'] == '3') {
                                                                    $text = "Year";
                                                                }
                                                                ?>
                                                                <option value="<?php echo $value1['pricing_id']; ?>">
                                                                    <?php echo $value1['pricing_number']; ?> <?php echo $text; ?>
                                                                    (<?php echo price($value1['pricing_amount']); ?>)
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                                <a href="javascript:void(0);" data-wishlist="0" data-key="<?php echo $key; ?>"
                                           data-productid="<?php echo $value['product_id']; ?>"
                                           class="Quantity_btn1 Quantity_btn2 addtocart_btn btn-cart">ADD TO CART</a>
                                                            </div>
                                                        </div>
                                                        <!--<div class="col-md-3 col-sm-3 col-xs-12">
                                                            <div class="price_school">
                                                                <h2><span>$500.00</span></h2>
                                                            </div>
                                                        </div>-->
                                                    </div>
                                                </div>
                                            <?php endforeach;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    endforeach;
                }?>

        </div>
    </div>



<?php $this->load->view('widgets/cart_script'); ?>
<?php $this->load->view('widgets/information'); ?>