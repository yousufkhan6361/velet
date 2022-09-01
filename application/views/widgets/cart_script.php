<script>
    $(".btn-cart").click(function () {
        is_login = '<?php echo $this->userid;?>';

        if(is_login>0){
            //var wishlist = $(this).attr('data-wishlist');
            var productid = $(this).attr('data-productid');
            //var qtyID = $('#cart-qty').val();
            var qtyID = 1, key = $(this).attr('data-key');
            var price_id = $("#price-"+key).val();


            /*if($('input[name=option1]:checked').val()){
                kit_id= $('input[name=option1]:checked').val();
            }

            if($('input[name=option2]:checked').val()){
                prep_id = $('input[name=option2]:checked').val();
            }*/
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
                //data: "product_id=" + productid + "&product_qty=" + qtyID + '&kit_id='+kit_id + "&prep_size_id=" + prep_id,
                data: "product_id=" + productid + "&product_qty=" + qtyID + '&price_id='+price_id,
                dataType: "json",
                success: function (response) {
                    Loader.hide();

                    if (response.status == true) {
                        AdminToastr.success('Your item has been added into shopping cart.', 'Success');
                        $(".badge").html(response.total_items);
                        //$("#item_count").html(response.total);
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
</script>