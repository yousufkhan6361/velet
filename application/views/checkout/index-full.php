<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<!-- Breadcrumbs -->
<?php
/*$data['breadcrumb_title'] = 'Detail';
$this->load->view('widgets/breadcrumb',$data);
$products = $product_info['data'];*/
?>

<!-- cartSec start -->

<section class="inpage add-cart ">
    <div class="container">
        <div class="col-md-9">
            <div class="cartsec">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="itm">Item</th>
                            <!--                 <th class="">Quantity</th>
                             -->                <th align="center">Unit Price</th>
                            <th align="center" colspan="2">Sub Price</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        if (array_filled($cart_data)) {
                            foreach ($cart_data as $key => $value):
                                $options = $value['options'];
                                ?>
                                <tr>
                                    <td class="imgtd"><div class="row">
                                            <div class="col-md-3">
                                                <div class="cartimg"> <img src="<?php echo $options['product_img_thumb'];?>" alt="" class="img-responsive"> </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h5><?php echo $value['name'];?> </h5>
                                                <p><?php echo $options['price_number'] . ' ' . $options['price_text'];?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <!--  <td class="text-center"><input type="number" class="qtystyle" value="1">
                                       <a href="" class="update">Update Cart</a></td> -->
                                    <td><h4 class="amount"><?php echo price($value['price']);?></h4></td>
                                    <td><h4 class="amount"><?php echo price($value['price'] * $value['qty']);?></h4></td>
                                    <td><a href="javascript:void(0)" class="remove removeproduct" data-row-id="<?php echo $value['rowid']; ?>">x</a></td>
                                </tr>

                                <!--<tr>
                                    <td>
                                        <h6><?php /*echo $options['product_sku']; */?></h6>
                                    </td>
                                    <td><h6><a href="<?php /*echo $options['product_slug'];*/?>" target="_blank"><?php /*echo $value['name'];*/?></a></h6></td>
                                    <td class="counter">
                                        <div class="">
                                            <div class="qty">
                                                <span class="minus bg-dark"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                                                <input type="number" class="count" name="qty" min="1" value="<?php /*echo $value['qty']; */?>" id="qty-<?php /*echo $key;*/?>" disabled="">
                                                <span class="plus bg-dark"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                                <br/>
                                                <a href="javascript:void(0)" class="update_qty" data-key="<?/*= $key */?>"
                                                   data-product_id="<?/*= $value['rowid'] */?>"><span
                                                            class="glyphicon glyphicon-edit"></span></a>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="">
                                        <h6><?php /*echo price($value['price']); */?> </h6>
                                    </td>
                                    <td class="text-left cros" data-th="Action">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)" class="removeproduct" data-row-id="<?php /*echo $value['rowid']; */?>"><i aria-hidden="true" class="fa fa-times"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>-->
                            <?php endforeach;?>
                        <?php }
                        else{?>
                            <tr>
                                <td colspan="5">
                                    <h3 class="text-center">Cart is Empty</h3>
                                </td>
                            </tr>
                        <?php }
                        ?>

                        </tbody>
                    </table>
                </div>
                <div class="checkoutsec">
                    <div class="row">
                        <!--<div class="col-md-6 text-center"> <a href="shop.html" class="pull-left"> Continue Shopping <i class="fa fa-angle-right"></i></a> </div>-->
                        <div class="col-md-5 text-center"> <a href="javascript:void(0)">
                                <a href="<?php echo g('base_url');?>checkout/step2"><button class="btn btn-block">Proceed To Checkout</button></a>
                            </a>
                            <!--<div class="checkout">
                                <h5>or checkout with</h5>
                                <a href=""><img src="images/paypalc.png" alt="" class="img-responsive"></a> </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="cart-right">
                <div class="totalsec">
                    <h4>Sub Total <span> <?php echo price($cart_total);?> </span></h4>
                    <h4>Discount <span> <?php echo price(0);?> </span> </h4>
                    <!--<h4>Shipping <span> <?php /*echo price(0);*/?> </span> </h4>-->
                    <h3> Total <span> <?php echo price($cart_total);?></span> </h3>
                </div>
                <!--<div class="ship-box">
                    <h4> Shipping </h4>
                    <p> Courier ($15) </p>
                    <br>
                    <h4> Estimate For </h4>
                    <p> United Estate,NY,1230</p>
                </div>-->
            </div>
        </div>
    </div>
</section>
<!-- cartSec End -->



<script>
    $(".allownumericwithoutdecimal").on("keypress keyup blur", function (event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    // Update Cart Start
    $('.update_qty').on('click', function () {
        var obj_qty = $(this);

        Loader.show();
        setTimeout(function () {
            // Get data
            var key = obj_qty.attr('data-key'),
                product_id = obj_qty.attr('data-product_id'),
                qty = $("#qty-"  + key).val(),
                data = {"id": product_id, "qty": qty},
                url = base_url + "checkout/update_qty_cart";

            console.log(data);

            if (qty == 0) {
                AdminToastr.error("Quantity must be greater to 0", 'Error');
            }
            else {
                // Submit action
                var response = AjaxRequest.fire(url, data);
                // Register success
                if (response.status == true) {
                    //AdminToastr.success(response.txt,'Success');

                    window.location = "checkout";
                }
                else if (response.status == 2) {
                    AdminToastr.error("Quantity is not available", 'Error');
                }
            }
            return false;
        },1000);

    });
    // Update Cart End

    // Delete From Cart Start
    $('.removeproduct').on('click', function () {
        // Get data
        var row_id = $(this).attr('data-row-id');
        url = base_url + "checkout/delete_item/" + row_id;

        if (confirm('Are you sure you want to delete this Product from cart')) {
            //  redirect to delete
            location.href = url;
        }
        return false;
    });
    // Delete From Cart End

    $(document).ready(function(){
        var plus_btn,minus_btn,pro_qty;
        $('.count').prop('disabled', true);
        $(document).on('click','.plus',function(){
            plus_btn = $(this);
            pro_qty =  plus_btn.parent().find('input[type=number]').val();
            plus_btn.parent().find('input[type=number]').val(parseInt(pro_qty) + 1 );
        });
        $(document).on('click','.minus',function(){
            minus_btn = $(this);
            pro_qty =  minus_btn.parent().find('input[type=number]').val();
            if(pro_qty=='1'){
            }
            else{
                minus_btn.parent().find('input[type=number]').val(parseInt(pro_qty) - 1 );
            }
        });
    });
</script>