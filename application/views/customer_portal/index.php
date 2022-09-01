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
                        <h4>Select Program</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-1 ">
                        <div class="select_program">
                            <?php
                            if (array_filled($programs)) {
                                foreach ($programs as $key => $value):
                                    foreach ($value['order_items'] as $key1 => $value1):
                                        $options = unserialize($value1['order_item_option']);
                                        // debug($value1);

                                        /*$date1 = date("Y/m/d");
                                        $date2 = date("Y/m/d", strtotime($value1['order_item_createdon']));
                                        $diff = abs(strtotime($date2) - strtotime($date1));
                                        $years = floor($diff / (365 * 60 * 60 * 24));
                                        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));*/

                                        $now = time(); // or your date as well
                                        $your_date = strtotime($value1['order_item_createdon']);
                                        $datediff = $now - $your_date;
                                        $days = round($datediff / (60 * 60 * 24));
                                        /*debug("ORDER - " . $value1['order_item_createdon']);
                                        debug("DIFF - " . $days);*/
                                        //echo round($datediff / (60 * 60 * 24));
// debug($days,1);

                                        ?>
                                        <!--<form action="<?php /*echo g('base_url_portal'); */?>access" method="post">-->
                                        <form action="<?php echo g('base_url_portal'); ?>selection" method="post">
                                            <input type="hidden" name="oi_id"
                                                   value="<?php echo $value1['order_item_id']; ?>">
                                            <div class="row">


                                                <div class="col-md-9"><p><?php echo $value1['product_name']; ?></p>

                                                    <label><?php echo $options['price_number'] . " " . $options['price_text']; ?></label>
                                                    <?php
                                                    if($days > intval($options['price_number'])){?>
                                                        <label>- Expired</label>
                                                    <?php }
                                                    ?>

                                                    <!--<label> - Expire Date (<?php /*echo $options['price_number'] . " " . $options['price_text'];*/
                                                    ?>)</label>-->
                                                </div>

                                                <?php
                                                if($days <= intval($options['price_number'])){?>
                                                    <div class="col-md-3"><input type="submit" value="Select"></div>
                                                <?php }
                                                ?>


                                            </div>
                                        </form>
                                        <div class="clearfix"></div>
                                    <?php endforeach;
                                    ?>
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
            