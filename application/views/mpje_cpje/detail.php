<?php $this->load->view('widgets/inner_banner');?>

    <div class="fpgee_main">
        <div class="container">
            <div class="text-left">
                <h4><?php echo $detail['product_name'];?></h4>
            </div>
            <div class="FPGEE_bg">
                <div class="row">
                    <div class="clearfix"></div>
                    <div class="col-md-4  col-sm-4  col-xs-12">
                        <div class="FPGEE_quantity">
                            <!--<h5>PTCE Test Bank</h5>-->
                            <!--<a href="javascript:void(0)" class="Quantity_btn1">BUY 5 OR MORE PRODUCTS!<br> SAVE 25% ON TRIAL</a>-->
                            <div class="quantity_select">
                                <select name="price" id="price-0">
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
                            <a href="javascript:void(0);" data-wishlist="0" data-key="0" data-productid="<?php echo $detail['product_id'];?>" class="Quantity_btn1 Quantity_btn2 addtocart_btn btn-cart">ADD TO CART</a>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="Quantity_ul">
                            <?php echo html_entity_decode($detail['product_detail']);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('widgets/cart_script');?>
<?php $this->load->view('widgets/information');?>