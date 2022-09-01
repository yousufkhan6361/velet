<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<!-- Blog Listing body-content -->
<section class="innContent blogPg">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <?
                if(array_filled($blog_info['data'])){
                    foreach($blog_info['data'] as $key=>$value):?>
                        <!-- blog item -->
                        <div class="singBlog">
                            <?if(!empty($value['blog_image'])){ ?>
                                <div class="img-responsive blog_thumb" style="background-image: url('<?=get_image($value['blog_image_path'],$value['blog_image'])?>')"></div>
                                <!--<img src="<?/*=get_image($value['blog_image_path'],$value['blog_image'])*/?>" alt="" class="img-responsive blog_thumb" />-->
                            <? }?>
                            <span class="adminDesc"> <?=date('F d, o',strtotime($value['blog_createdon']))?>, In <?=($value['blog_category_name'])?$value['blog_category_name']:'Uncategorized'?> By
                                <a href="javascript:void(0)" class="link">Admin</a>
                            </span>
                            <h3><?=text_highlights($this->session->userdata('search_keyword'),$value['blog_name'], $case = false)?></h3>
                            <?=mb_strimwidth(html_entity_decode($value['blog_description']), 0, 425, " <strong>. . .</strong></p>")?>
                            <a href="<?=g('base_url')?>blog/<?=$value['blog_slug']?>" class="readmore">Read More <i class="fa fa-arrow-right"
                                                                                                                    aria-hidden="true"></i></a>
                        </div>
                        <!-- end blog item -->
                    <?endforeach;
                }
                ?>

                <div class="text-center"><?=$blog_info['links']?></div>

            </div>

            <?$this->load->view('widgets/blog_search');?>
        </div>
    </div>
</section>

<!-- Blog Listing body-content -->