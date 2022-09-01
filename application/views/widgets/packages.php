<section class="main-pricng-page">

    <div class="container">

        <div class="main-heading wow fadeInRight animated" data-wow-duration="2s">

            <h4><?php echo $cms_title[3]['cms_title_text'];?></h4>

            <h2><?php echo $cms_title[4]['cms_title_text'];?></h2>

        </div>

        <div class="row">

            <?php

            if(array_filled($packages)){

                foreach ($packages as $key=>$value):?>

                    <div class="col-md-4 col-xs-12 col-sm-4 wow fadeInLeft animated" data-wow-duration="2s">

                        <div class="pricing">

                            <div class="pkg">

                                <div class="header">

                                    <h4><?php echo $this->model_packages->get_fields('packages_type')['list_data'][$value['packages_type']];?></h4>

                                    <h2><sup>$</sup><?php echo $value['packages_amount'];?></h2>

                                </div>

                                <div class="body"><?php echo  html_entity_decode($value['packages_description']);?>

                                </div>

                                <a class="btn btn-default btnStyle3" href="javascript:void(0)">Get Started</a></div>

                        </div>

                    </div>

                <?php endforeach;

            }

            ?>







        </div>

    </div>

</section>



<script>

    $(function () {

        $('.pricing').find('img').attr('src',base_url + 'assets/front_assets/images/check.png');

    })

</script>