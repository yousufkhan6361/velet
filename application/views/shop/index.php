<!-- Breadcrumbs -->
<?php
$data['breadcrumb_title'] = $banner_heading;
//$this->load->view('widgets/breadcrumb',$data);
$products = $product_info['data'];
?>

<section class="NewArrivalsSec">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 wow fadeInLeft" data-wow-delay="0.5s">
                <div class="colct-left">
                    <div class="jeans-details">
                        <!--<p class="path">Home > <a href="javascript:void(0)">Sale</a></p>-->
                        <label class="btnStyle1">Shop Sale By</label>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Category
                                        </a>
                                    </h4>
                                </div>
                                <?php
                                if(array_filled($categories)){?>
                                    <div id="collapseOne" class="panel-collapse collapse <?php echo ( (isset($_GET)) && (isset($_GET['product_category_id'])) ) ? 'in' : '';?>" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <ul class="list-unstyled" id="category">
                                                <?php
                                                foreach ($categories as $key=>$value):?>
                                                    <li>
                                                        <a href="<?php echo current_url();?>?product_category_id=<?php echo $value['category_id'];?>"><?php echo $value['category_name'];?> <span>(<?php echo $value['cat_count'];?>)</span></a>
                                                    </li>
                                                <?php endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Style
                                        </a>
                                    </h4>
                                </div>
                                <?php
                                if(array_filled($styles)){?>
                                    <div id="collapseTwo" class="panel-collapse collapse <?php echo ( (isset($_GET)) && (isset($_GET['product_style_id'])) ) ? 'in' : '';?>" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <ul class="list-unstyled" id="category">
                                                <?php
                                                foreach ($styles as $key=>$value):?>
                                                    <li>
                                                        <a href="<?php echo current_url();?>?product_style_id=<?php echo $value['style_id'];?>"><?php echo $value['style_name'];?> <span>(<?php echo $value['style_count'];?>)</span></a>
                                                    </li>
                                                <?php endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            By Brand
                                        </a>
                                    </h4>
                                </div>
                                <?php
                                if(array_filled($brands)){?>
                                    <div id="collapseThree" class="panel-collapse collapse <?php echo ( (isset($_GET)) && (isset($_GET['product_brand_id'])) ) ? 'in' : '';?>" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">
                                            <ul class="list-unstyled" id="category">
                                                <?php
                                                foreach ($brands as $key=>$value):?>
                                                    <li>
                                                        <a href="<?php echo current_url();?>?product_brand_id=<?php echo $value['brand_id'];?>"><?php echo $value['brand_name'];?> <span>(<?php echo $value['brand_count'];?>)</span></a>
                                                    </li>
                                                <?php endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-9">
                <div class="row">
                    <div class="getLatest">
                        <h4>Get The Latest Offers In Your Inbox <input type="text" id="search-user-widget"></h4>
                    </div>
                    <div class="sorting-sec wow fadeInDown" data-wow-delay="1s">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="sort-sec">
                                <!--<p>Items 1 to 24 of 28 total   |   Sort By <select id="" name="">-->
                                <p>Sort By <select id="sort_filter" name="sort">
                                        <option value="">Select</option>
                                        <option value="asc" data-attr="" <?php echo ( (isset($_GET)) && ($_GET['sort']=='asc') ) ? 'selected' : ''?>>
                                            Ascending A-Z
                                        </option>
                                        <option value="desc" data-attr="" <?php echo ( (isset($_GET)) && ($_GET['sort']=='desc') ) ? 'selected' : ''?>>
                                            Descending Z-A
                                        </option>
                                    </select></p>
                            </div>
                        </div>
                        <!--<div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="sort-pre">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li>
                                            <a href="#"><span>View as</span></a>
                                        </li>
                                        <li>
                                            <a href="#">1</a>
                                        </li>
                                        <li>
                                            <a href="#">2</a>
                                        </li>
                                        <li>
                                            <a href="#">3</a>
                                        </li>
                                    </ul>
                                    <ul class="pagination">
                                        <li>
                                            <a href="#"><span>Page</span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-th-large"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-th"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>-->
                    </div>
                </div>
                <div class="row proThumbRow">
                    <?php
                    if(array_filled($products)) {
                        $i=1;
                        foreach ($products as $key => $value):?>
                            <div class="col-md-3 col-sm-4 wow fadeInUp" data-wow-delay="1.2s">
                                <div class="proThumb chatBox">
                                    <a href="<?php echo g('base_url');?>shop/detail/<?php echo $value['product_slug'];?>"><img alt="" src="<?php echo get_image($value['product_image_path'], $value['product_image_thumb']);?>"></a>
                                    <div class="content1 chatName">
                                        <a href="<?php echo g('base_url');?>shop/detail/<?php echo $value['product_slug'];?>" class="proName"><?php echo $value['product_name'];?></a>
                                        <?php
                                        if($value['product_type']!='1'){?>
                                            <del><?php echo price($value['product_old_price']);?></del>
                                        <?php } ?>

                                        <h6>Now <?php echo price($value['product_price']);?></h6>
                                        <a href="<?php echo g('base_url');?>shop/detail/<?php echo $value['product_slug'];?>" class="btnStyle1">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        if($i%4==0){
                            $i=1;?>
                            <div class="clearfix"></div>
                        <?php }
                        else{
                            $i++;
                        }
                        endforeach;
                    }?>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="sort-pre navi">
                        <nav aria-label="Page navigation">
                            <?php echo $product_info['links'];?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('#sort_filter').on('change',function () {
        var slug = $(this).find(':selected').val();
        if(slug.length > 0 ){
            window.location.href = '<?php echo current_url();?>?sort=' + slug;
        }
    });

    $("#search-user-widget").keyup(function(){

        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val(), count = 0;

        // Loop through the comment list
        $(".chatBox .chatName .proName").each(function(){

            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).parent().parent().parent().fadeOut();

                // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).parent().parent().parent().show();
            }
        });
    });
</script>

