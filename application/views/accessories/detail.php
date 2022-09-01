<!-- Breadcrumbs -->
<?php
$data['breadcrumb_title'] = $detail['product_name'];
//$this->load->view('widgets/breadcrumb', $data);
$stock = $detail['product_stock'];
$page_url = current_url();
$stock = $detail['product_stock'];
?>

<!-- Product Detail -->

<section class="contentSection_view-two">
    <div class="container">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="pro-big-img">
                <img alt="img" class="img-responsive" src="<?php echo get_image($detail['product_image_path'], $detail['product_image']);?>">
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="proDetail">
                <h4><?php echo $detail['product_name']; ?></h4>
                <div class="proRating">
                    <?php
                    for($i=1;$i<=$avg_rating;$i++){?>
                        <i aria-hidden="true" class="fa fa-star"></i>
                    <?php } ?>
                    <span>(<?php echo $count;?> Customers reviews) <i>SKU:</i><?php echo $detail['product_sku']; ?></span>
                </div>

                <h1><?php
                    if($detail['product_type']!='1'){?>
                        <del><?php echo price($detail['product_old_price']);?></del> -
                    <?php } ?> <?php echo price($detail['product_price']);?></h1>
                <?php echo html_entity_decode($detail['product_overview']);?>
            </div>
            <div class="emaiL-remindr">
                <h1>color</h1>
                <select name="" id="product_color">
                    <?php
                    foreach ($colors as $key=>$value):?>
                        <option value="<?php echo $value['color_id'];?>"><?php echo $value['color_name'];?></option>
                    <?php endforeach;
                    ?>
                </select>
            </div>
            <div class="clearfix"></div>
            <!--<div class="main-counter">
                <h1>Hurry up! Sales Ends in</h1>
                <div class="counterSlider">
                    <div id="timer">
                        <ul>
                            <li>
                                <div id="days">
                                    -165<span>Days</span>
                                </div>
                            </li>
                            <li>
                                <div id="hours">
                                    07<span>Hours</span>
                                </div>
                            </li>
                            <li>
                                <div id="minutes">
                                    52<span>Minutes</span>
                                </div>
                            </li>
                            <li>
                                <div id="seconds">
                                    49<span>Seconds</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>-->
            <div class="quantity_div">
                <div class="input-group">
                    <input class="form-control " max="<?php echo $stock;?>" id="quantity" min="1" name="quantity" type="text" value="1" readonly>
                    <span class="input-group-btn">
                        <button class="quantity-right-plus btn-number" data-field="" data-type="plus" type="button">
                            <span class="input-group-btn"><span class="glyphicon glyphicon-plus"></span></span>
                        </button>
                    </span>
                    <span class="input-group-btn">
                        <button class="quantity-left-minus btn-number" data-field="" data-type="minus" type="button">
                            <span class="input-group-btn"><span class="glyphicon glyphicon-minus"></span></span>
                        </button>
                    </span>
                </div><span></span>
                <div class="clearfix"></div>
            </div>
            <div class="qtY">
                <h1>QTY</h1>
            </div>
            <div class="transaction-img">
                <a href="javascript:void(0)"><img alt="" class="img-responsive" src="<?php echo g('images_root');?>img60.png"></a>
            </div>
            <div class="clearfix"></div>
            <div class="procart_div">
                <?php
                if($stock!=0){?>
                    <a class="procart_btn btn-cart" href="javascript:void(0)" data-productid="<?php echo $detail['product_id'];?>">Add to cart<span><i aria-hidden="true" class="fa fa-shopping-cart"></i></span></a>
                <?php }
                ?>

                <a class="procart_share btn-fav" href="javascript:void(0)" data-id="<?php echo ($detail['product_id']);?>"><i aria-hidden="true" class="fa fa-heart-o"></i></a>
                <div class="clearfix"><br><span class="label label-info"><?php echo ($stock!=0)?'In Stock': 'Out of Stock';?></span></div>
            </div>
            <div class="customr">
                <p>24/7 CUSTOMER SERVICE</p>
                <p class="number"><?php echo g('db.admin.phone');?></p>
            </div>
            <div class="clearfix"></div>
            <div class="proshare">
                <ul>
                    <li>share</li>
                    <li>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $page_url;?>/" target="_blank"><i aria-hidden="true" class="fa fa-facebook"></i>share</a>
                    </li>
                    <li>
                        <a href="https://twitter.com/home?status=<?php echo $page_url;?>/ " target="_blank"><i aria-hidden="true" class="fa fa-twitter"></i>Tweet</a>
                    </li>
                    <li>
                        <a href="https://pinterest.com/pin/create/button/?url=<?php echo $page_url;?>/&media=&description=<?php echo $detail['product_name']; ?>" target="_blank"><i aria-hidden="true" class="fa fa-pinterest-p"></i>Pin it</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="main-tab-change">
    <div class="container">
        <div class="row">
            <div class="main-border-line">
                <div class="col-md-3 col-xs-12 col-sm-3">
                    <div class="dscription-form">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active" role="presentation">
                                <a aria-controls="home" data-toggle="tab" href="#home" role="tab">Description</a>
                            </li>
                            <li role="presentation">
                                <a aria-controls="profile" data-toggle="tab" href="#profile" role="tab">Customer Review</a>
                            </li>
                            <li role="presentation">
                                <a aria-controls="messages" data-toggle="tab" href="#messages" role="tab">Additional Information</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-xs-12 col-sm-9">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home" role="tabpanel">
                            <div class="addition-text">
                                <?php echo html_entity_decode($detail['product_detail']);?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel">
                            <?php
                            if(array_filled($comments)){
                                foreach ($comments as $key=>$value):?>
                                    <div class="row top-one">
                                        <div class="col-md-2">
                                            <img class="img img-rounded img-fluid" src="<?php echo g('images_root');?>fan-img.png">
                                            <p class="text-secondary text-center"><?php echo timeago($value['comment_created_on']);?></p>
                                        </div>
                                        <div class="col-md-10">
                                            <p><a class="float-left" href="javascript:void(0)"><strong><?php echo ($value['comment_name']);?></strong></a>
                                                <?php
                                                for($x=1;$x<=$value['comment_rating'];$x++){?>
                                                    <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                                <?php } ?>

                                                </p>
                                            <div class="clearfix"></div>
                                            <?php echo html_entity_decode($value['comment_name']);?>
                                            <!--<div class="right-one-side">
                                                <p><a class="float-right btn btn-outline-primary ml-2"><i class="fa fa-reply"></i> Reply</a> <a class="float-right btn text-white btn-danger"><i class="fa fa-heart"></i> Like</a></p>
                                            </div>-->
                                        </div>
                                    </div>
                                <?php endforeach;
                            }
                            ?>
                            <div class="leave-review">
                                <h3 class="small-title">Leave your review</h3>
                                <div class="your-rating mb-30">
                                    <p class="mb-10"><strong>Your Rating</strong></p>
                                    <span class="btn-rate" data-rate="1"><a href="javascript:void(0)"><i class="fa fa-star-o"></i></a></span> <span class="separator">|</span>
                                    <span class="btn-rate" data-rate="2"><a href="javascript:void(0)"><i class="fa fa-star-o"></i></a> <a href="javascript:void(0)"><i class="fa fa-star-o"></i></a></span> <span class="separator">|</span>
                                    <span class="btn-rate" data-rate="3"><a href="javascript:void(0)"><i class="fa fa-star-o"></i></a> <a href="javascript:void(0)"><i class="fa fa-star-o"></i></a> <a href="javascript:void(0)"><i class="fa fa-star-o"></i></a></span> <span class="separator">|</span>
                                    <span class="btn-rate" data-rate="4"><a href="javascript:void(0)"><i class="fa fa-star-o"></i></a> <a href="javascript:void(0)"><i class="fa fa-star-o"></i></a> <a href="javascript:void(0)"><i class="fa fa-star-o"></i></a> <a href="javascript:void(0)"><i class="fa fa-star-o"></i></a></span> <span class="separator">|</span>
                                    <span class="btn-rate" data-rate="5"><a href="javascript:void(0)"><i class="fa fa-star-o"></i></a> <a href="javascript:void(0)"><i class="fa fa-star-o"></i></a> <a href="javascript:void(0)"><i class="fa fa-star-o"></i></a> <a href="javascript:void(0)"><i class="fa fa-star-o"></i></a> <a href="javascript:void(0)"><i class="fa fa-star-o"></i></a></span>
                                </div>
                                <div class="reply-box">
                                    <form class="form-style form-horizontal" action="<?=g('base_url')?>accessories/comment-save" method="post" id="comment-form">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <input class="form-control" name="comment[comment_name]" placeholder="Your name here..." type="text">
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" name="comment[comment_subject]" placeholder="Subject..." type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="comment[comment_description]" placeholder="Your review here..."></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="comment[comment_post_id]" value="<?php echo $detail['product_id'];?>">
                                        <input type="hidden" name="comment[comment_rating]" id="comment_rating" value="">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <?php $this->load->view('widgets/google_captcha');?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button class="btn btn-common" type="submit" id="btn-comment">Submit Review</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="messages" role="tabpanel">
                            <div class="addition-text">
                                <?php echo html_entity_decode($detail['product_info']);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Detail  -->

<?php $this->load->view('widgets/wishlist_script');?>

<script>

    // Comment Form Submit Start
    // Get form object
    var $form = $("#comment-form"),obj;
    // On submit action start
    $('#btn-comment').on('click', function (event) {
        event.preventDefault();

        obj = $(this);
        Loader.show();
        setTimeout(function () {
            // Disable the submit button to prevent repeated clicks:
            $form.find('#btn-comment').prop('disabled', true);
            // Get form
            var form = obj.closest('form');
            // Get action url
            var url = form.attr('action');
            // Get form data
            var data = form.serialize();
            // Submit action
            var response = AjaxRequest.fire(url, data);
            // Register success
            if (response.status) {
                $form.find('#btn-comment').prop('disabled', false);
                // Reset form
                $form[0].reset();

                location.reload();

            }
            // Register fail
            else {
                // Enable form
                $form.find('#btn-comment').prop('disabled', false);
            }

            event.preventDefault();
        },1000);
        return false;
    });

    // Comment Form Submit End

    /*$(function () {

        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 5,
            arrows: true,
            dots: false,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            focusOnSelect: true,
            verticalSwiping: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 741,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        autoplay: true,
                        dots: false,
                        arrows: false,
                        verticalSwiping: false,
                        vertical: false,
                        centerPadding: '60px'
                    }
                },
                {
                    breakpoint: 641,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        autoplay: true,
                        dots: false,
                        arrows: false,
                        verticalSwiping: false,
                        vertical: false,
                        centerPadding: '60px'
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        autoplay: true,
                        dots: false,
                        arrows: false,
                        verticalSwiping: false,
                        centerPadding: '60px',
                        vertical: false
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

    });
*/

    $('.btn-number').click(function (e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });

    $('.input-number').focusin(function () {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function () {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>

<script>
    $(".btn-cart").click(function () {
        is_login = '<?php echo $this->userid;?>';

        if(is_login>0){
            //var wishlist = $(this).attr('data-wishlist');
            var productid = $(this).attr('data-productid');
            var qtyID = $('#quantity').val();
            var kit_id=0,prep_id=0,color_id;

            if($('input[name=option1]:checked').val()){
                kit_id= $('input[name=option1]:checked').val();
            }

            if($('input[name=option2]:checked').val()){
                prep_id = $('input[name=option2]:checked').val();
            }
            if($('#product_color option:selected').val()){
                color_id = $('#product_color option:selected').val();
            }
            /*var color = $("#color").val();*/
//var consoleTag = $("#console").val();
//var sherpas = $("#sherpas").val();
//var character = $("#character").val();
//var playwith = $("#playwith").val();

//var cartForm = $("#cartForm").serialize();

//var size = $("#size").val();
//var hiddencolor = $("#hiddencolor").val();


            /*if (qtyID == 0) {
                AdminToastr.error('Please select the quantity.', 'Error');
                return false;
            }

            if (color == 0) {
                AdminToastr.error('Please provide the Color.', 'Error');
                return false;
            }*/

            /*
             if(consoleTag == ''){
             AdminToastr.error('Please select the console.','Error');
             return false;
             }
             if(character == ''){
             AdminToastr.error('Please select the character.','Error');
             return false;
             }*/
            /*
             if(playwith == ''){
             AdminToastr.error('Please select the playwith.','Error');
             return false;
             }*/

            $.ajax({
                type: "POST",
                url: base_url + "checkout/add_cart",
                // addone_array = define in detail page
                data: "product_id=" + productid + "&product_qty=" + qtyID + '&kit_id='+kit_id + "&prep_size_id=" + prep_id + '&color=' + color_id,
                dataType: "json",
                success: function (response) {
                    Loader.hide();

                    if (response.status == true) {
                        AdminToastr.success('Your item has been added into shopping cart.', 'Success');
                        $(".badge").html(response.total_items);
                        $("#item_count").html(response.total);
                    }
                    else {
                        AdminToastr.error(response.msg, 'Error');
                    }
                },
                beforeSend: function () {
                    Loader.show();
                }
            });
        }
        else{
            AdminToastr.error('Please Login to add item in cart', 'Error');
        }



        return false;
    });

    $('.btn-rate').on('click',function(){
        var rating = $(this).attr('data-rate');
        $('#comment_rating').val(rating);

        // Remove other stars
        $(this).parent().find('i').removeClass('comment_rating');
        $(this).find('i').addClass('comment_rating');
    });

    $(document).ready(function(){
        var quantitiy=0;
        var max_value = $('#quantity').attr("max");
        $('.quantity-right-plus').click(function(e){
            e.preventDefault();
            var quantity = parseInt($('#quantity').val());
            if(quantity + 1 > max_value){

            }
            else{
                $('#quantity').val(quantity + 1);
            }
        });
        $('.quantity-left-minus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            if(quantity>0){
                $('#quantity').val(quantity - 1);
            }
        });
    });
</script>