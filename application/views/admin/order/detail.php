<? global $config;
//$discount_base = discount_value( $order_detail[ 'order_discount' ] , $order_detail[ 'order_discount_type' ] , $order_detail[ 'order_total' ] );
//$discount = discount_text( $order_detail[ 'order_discount' ] , $order_detail[ 'order_discount_type' ] , $order_detail[ 'order_currency' ] , $order_detail[ 'order_currency_rate' ] ,false ) ;
//debug($order_detail,1);
?>
<style>
     .btn-sub {
    font-weight: 700;
    float: left;
    margin-top: 20px;
    margin-left: 400px;
    background: #000;
    color: #fff;
    padding: 9px;
    font-size: 17px;
}


</style>
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-shopping-cart"></i>
                <strong>Order #<?= $order_detail['order_id'] ?> </strong>
                <small> / <?= date("Y-m-d", strtotime($order_detail['order_createdon'])) ?></small>
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="javascript:;" class="reload">
                </a>
            </div>
        </div>

        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="invoice" style="padding: 20px;">
                <div class="row invoice-logo" style="text-align: center;">
                    <div class="col-xs-12 invoice-logo-space">
                        <a href="<?= $config['base_url'] ?>admin">
                            <img style="width: 100px;" src="<?= get_image($this->layout_data['logo'][0]['logo_image_path'], $this->layout_data['logo'][0]['logo_image']) ?>"
                                 alt="logo" class="main-tem-logo"/>
                        </a>
                    </div>
                </div>
                <hr>
                <div class="row" style="background: antiquewhite;padding: 15px;">
                    <!-- <div class="col-xs-4">
                        <h3><strong>Info:</strong></h3>
                        <ul class="list-unstyled">
                            <li><strong> Address: </strong><?= $order_detail['order_address1']; ?> </li>
                            <li><strong> City: </strong><?= $order_detail['order_city']; ?> </li>
                            <li><strong> Zip: </strong><?= $order_detail['order_zip']; ?> </li>
                            <li><strong> Country: </strong><?= $order_detail['order_country']; ?> </li>
                            <?php if(!empty($order_detail['order_tracking_number'])){  ?>
                            <li><strong> Tracking Number: </strong><?=$order_detail['order_tracking_number'];?> </li>
                            <?php } ?>
                        </ul>
                    </div> -->
                    <!--<div class="col-xs-4">
                        <h3><strong>Shipping Address:</strong></h3>
                        <ul class="list-unstyled">
                            <li><strong> First Name: </strong><?/*= $order_detail['order_shipping_firstname']; */?> </li>
                            <li><strong> Last Name: </strong><?/*= $order_detail['order_shipping_firstname']; */?></li>
                            <li><strong> Email: </strong><?/*= $order_detail['order_shipping_email']; */?> </li>
                            <li><strong> Phone: </strong><?/*= $order_detail['order_shipping_phone']; */?> </li>
                            <li><strong> Address: </strong><?/*= $order_detail['order_shipping_address1']; */?> </li>
                            <li><strong> City: </strong><?/*= $order_detail['order_shipping_city']; */?> </li>
                            <li><strong> State: </strong><?/*= $order_detail['order_shipping_state']; */?> </li>
                            <li><strong> Zip: </strong><?/*= $order_detail['order_shipping_zip']; */?> </li>
                            <li><strong> Country: </strong><?/*= $order_detail['order_shipping_country']; */?> </li>
                        </ul>
                    </div>-->
                    <div class="col-xs-4">
                        <h3><strong>Billing Info:</strong></h3>
                        <ul class="list-unstyled">
                            <li><strong> First Name: </strong><?= $signupData['signup_firstname']; ?> </li>
                            <li><strong> Email: </strong><?= $signupData['signup_email']; ?> </li>
                            <li><strong> Phone: </strong><?= $signupData['signup_phone']; ?> </li>
                            <li><strong> Address: </strong><?= $signupData['signup_address']; ?></li> 
                            
                        </ul>
                    </div>
                    <div class="col-xs-4">
                        <h3><strong>Payment Info:</strong></h3>

<ul class="list-unstyled">

<li><strong>Package:</strong> <?= $order_detail['order_package_name']; ?></li>
<li><strong>Price:</strong> £<?=$order_detail['order_amount']; ?></li>
<li><strong>Duration:</strong> <?= $order_detail['order_package_days']; ?> days</li>
<li><strong>Coupon Discount:</strong> <?php if($order_detail['order_coupon_discount'] == ""){ ?> --- <?php }else{ ?> <?=$order_detail['order_coupon_discount']?>%<?php } ?></li>

<li><strong>Business Feature:</strong> <?php if($order_detail['order_business_feature'] == 0){ ?> Off <?php }else{ ?> £5 <?php } ?></li>
<li><strong>Payment Status:</strong> <?= $this->model_order->get_payment_status($order_detail['order_payment_status']);?></li>
<!-- <li><strong>Total Quantity:</strong> <?= $total_quantity ?>  </li> -->
<!-- <li><strong>Total Amount:</strong>£<?=($order_detail['order_amount'])?></li>
<li><strong>Created:</strong> <?= $order_detail['order_createdon']; ?></li> -->

</ul>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped table-hover table-bordered">
                            <thead style="background: black;color: white;">
                            <tr>
                                <th>Order</th>
                                <th>Order Date</th>
                                <th>Package</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Discount</th>
                                <th>Business Feature</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>

                        <tr style="background: #066309d9;color: white;font-weight: bold;">
                            <td style="padding:10px 0; vertical-align:middle;padding-left: 10px;">
                                <?=$order_detail['order_id']; ?>
                            </td>

                            <td style="padding:10px 0; vertical-align:middle;padding-left: 10px;">
                                <?=date('d M Y',strtotime($order_detail['order_createdon']))?>
                            </td>

                            <td style="padding:10px 0; vertical-align:middle;padding-left: 10px;">
                               <?=$order_detail['order_package_name']; ?>
                            </td>

                            <td style="padding:10px 0; vertical-align:middle;padding-left: 10px;">
                               <?=$order_detail['order_package_days']; ?>
                            </td>

                            <td style="padding:10px 0; vertical-align:middle;padding-left: 10px;">
                               <?= $this->model_order->get_payment_status($order_detail['order_payment_status']);?>
                            </td>


                            <td style="padding:10px 0; vertical-align:middle;padding-left: 10px;">
                               <?php if($order_detail['order_coupon_discount'] == ""){ ?>
                                ---
                                <?php }else{ ?>
                                    <?=$order_detail['order_coupon_discount']?>%
                                <?php } ?>
                            </td>

                            <td style="padding:10px 0; vertical-align:middle;padding-left: 10px;">
                               <?php if($order_detail['order_business_feature'] == 0){ ?>
                                Off
                                <?php }else{ ?>

                                   £5

                                <?php } ?>
                            </td>
                        
                            <td style="padding:10px 0; vertical-align:middle;padding-left: 10px;">
                                £<?=$order_detail['order_amount']?>
                            </td>
                        </tr>


                          

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row text-right">
                    <div class="col-md-12 col-xs-12 invoice-block">
                        <ul class="list-unstyled amounts">
                            <li><strong style="color:#333">Sub Total: </strong>£<?=$order_detail['order_amount']?> </li>


                            <li><strong style="color:#333">Coupon Discount: </strong>
                            <?php if($order_detail['order_coupon_discount'] == ""){ ?>
                                0%
                            <?php }else{ ?>
                                <?=$order_detail['order_coupon_discount']?>% 
                            <?php } ?>
                                

                            </li>
                            <li><strong style="color:#333">Business Feature: </strong> <?php if($order_detail['order_business_feature'] == 0){ ?> Off <?php }else{ ?> £5 <?php } ?>
                                
                                
                            </li>
                            <li><strong style="color:#333">Total Price: </strong>
                                 £<?=$order_detail['order_total']?> </li>
                        </ul>
                        <br>
                    </div>
                </div>



            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
<? create_modal_html("address_update", "", "", 'method="POST" action="' . $config['base_url'] . 'admin/order/save_address"', false) ?>