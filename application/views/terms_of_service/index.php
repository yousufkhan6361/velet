<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<section class="innContent parentPg">
    <div class="container">
        <div class="col-md-12 text-center"><p><h2><?php echo $terms_of_service['cms_page_title'];?></h2></p></div>
        <div class="col-md-12"><?=html_entity_decode($terms_of_service['cms_page_content'])?></div>
        <div class="clearfix"></div>
    </div>
</section>