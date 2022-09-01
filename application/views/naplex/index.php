<?php $this->load->view('widgets/inner_banner');?>

    <div class="naplex_biosta_page">
        <div class="container">
            <div class="row">
                <?php
                if(array_filled($products)){
                    foreach ($products as $key=>$value):
                        $prices = $this->model_product_price->get_prices($value['product_id']);
                    //debug($prices);
                        ?>
                        <div class="col-md-6 col-sm-4 col-xs-12">
                            <div class="fpgee_main">
                                <h4><?php echo $value['product_name'];?></h4>
                                <div class="FPGEE_bg">
                                    <div class="FPGEE_quantity">
                                        <?php echo html_entity_decode($value['product_detail']);?>
                                        <!--<a href="javascript:void(0)" class="Quantity_btn1">BUY 5 OR MORE PRODUCTS!<br> SAVE 25% ON TRIAL</a>-->
                                        <div class="quantity_select">
                                            <select name="price" id="price-<?php echo $key;?>">
                                                <?php foreach ($prices as $key1=>$value1):
                                                    if($value1['pricing_type']=='1'){
                                                        $text = "Days";
                                                    }
                                                    elseif($value1['pricing_type']=='2'){
                                                        $text = "Month";
                                                    }
                                                    elseif($value1['pricing_type']=='3'){
                                                        $text = "Year";
                                                    }
                                                    ?>
                                                    <option value="<?php echo $value1['pricing_id'];?>">
                                                        <?php echo $value1['pricing_number'];?> <?php echo $text;?> (<?php echo price($value1['pricing_amount']);?>)
                                                    </option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <a href="javascript:void(0);" data-wishlist="0" data-key="<?php echo $key;?>" data-productid="<?php echo $value['product_id'];?>" class="Quantity_btn1 Quantity_btn2 addtocart_btn btn-cart">ADD TO CART</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                } ?>
            </div>
        </div>
    </div>



<?php $this->load->view('widgets/cart_script');?>
<?php $this->load->view('widgets/information');?>