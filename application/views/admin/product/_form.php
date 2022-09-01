<?global $config;
$model_heads = explode("," , $dt_params['dt_headings'] );
?>

<style>
    /*table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 80%;
        margin: 0 auto;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 15px;
        width: 50%;
    }
    .addons a {
    text-shadow: none;
    color: #ffffff;
}

    td:first-child{
        font-weight: bold;
    }

    tr:nth-child(odd) {
        background-color: #dddddd;
    }
    .image-box .fa-eye{font-size: 18px;}
    .big-image{width: 100%;}*/


</style>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="tabbable tabbable-custom boxless tabbable-reversed">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_0" data-toggle="tab">
                        Product </a>
                </li>
                <?if($form_data){?>
                    <li class="">
                        <a href="#tab_1" data-toggle="tab">
                             Images </a>
                    </li>
                
                    <!-- <li class="">
                        <a href="#tab_2" data-toggle="tab">Videos
                            </a>
                    </li>
 -->


                <?}?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_0">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-shopping-cart"></i>
                                <small>Add Details to <?=humanize($class_name)?></small>
                            </div>
                            <!--<div class="tools">
                                <a href="javascript:;" class="collapse">
                                </a>
                                <a href="javascript:;" class="reload">
                                </a>
                            </div>-->
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <?$this->load->view("admin/widget/form_generator");?>
                            <!-- END FORM-->
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
                <?
                // Images only in edit mode.
                if($form_data){?>
                    <div class="tab-pane" id="tab_1">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-shopping-cart"></i><?=humanize($class_name)?>
                                    <small><?=humanize($class_name)?></small>

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
                                <?$this->load->view("admin/widget/uploadfiles");?>
                                <!-- END FORM-->
                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_2">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-shopping-cart"></i>
                                    <small><?//humanize($class_name)?> Add-ons</small>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                    <a href="javascript:;" class="reload">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <? //$this->load->view("admin/widget/uploadvideos");?>
                            </div>
                        </div>
                    </div>



                <?}?>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function(){
        <?php
        if($this->uri->segment(4)!=null){
            if($form_data['product']['product_type'] == '2'){?>
            // $('#product-product_old_price').parent().parent().show('slow');
            <?php }
        }

        ?>
    };
    $(document).ready(function() {
        // $('#product-product_old_price').parent().parent().hide('slow');
        //$('.fancybox').fancybox();
        Metronic.init(); // init metronic core components
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
        UIAlertDialogApi.init(); //UI Alert API
        FormFileUpload.init();
        if(!<?=$id?>) // when add product detail, disabled images and item set tab
        {
            $('.tabbable li a[href=\#tab_1]').css({"background-color": "#CFD1CF",
                "color": "#fff"
            });
            $('.tabbable li a[href=\#tab_2]').css({"background-color": "#CFD1CF",
                "color": "#fff"
            });
            $('.tabbable li a[href=\#tab_1]').click(false);
            $('.tabbable li a[href=\#tab_2]').click(false);
        }
        if('<?=$_GET["msgtype"]?>' == 'success'){ // when add/edit product detail, switched to images tab
            $('.tabbable li a[href=\#tab_1]').click();
        }

        <?if($error)
        echo "AdminToastr.error('".str_replace("\n","",validation_errors('<div>', '</div></br>'))."');";
        ?>

        $("#product-product_brand_id").on('change',function(){
            //alert($(this).val());
            //get brand categories populate in selected categories
            var params = {} ;
            params.search_val = $(this).val();
            var res = AjaxRequest.fire($js_config.base_url + "admin/product/get_brand_categories" , params);
            var selCat = [];
            $(res).each(function(i,v){
                selCat.push(v.bc_category_id);
            })
            if($(selCat).length > 0)
            {
                $('#product_category-pc_category_id').multiSelect('select', selCat);
            }
            else
            {
                $('#product_category-pc_category_id').multiSelect('deselect_all');
            }
        })

        $('#product-product_type').on('change',function(){
            // var album_type = $('.select2-chosen').val();
            //  $('.select2-chosen').text();
            // #select2-chosen-2

            // #select2-chosen-2

            //  alert($('.select2-chosen').text());
            //console.log(this.value);
            //console.log();

            // Public
            if(this.value == '1'){
                $('#product-product_old_price').parent().parent().hide('slow');
                //$('#album-album_passcode').val('-');
            }
            else{
                $('#product-product_old_price').parent().parent().show('slow');
            }
        });
    });
</script>
