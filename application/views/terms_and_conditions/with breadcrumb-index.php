<!-- Breadcrumbs -->
<?php
$data['breadcrumb_title'] = '';
$this->load->view('widgets/breadcrumb',$data);?>

<section class="inpage terms">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="txt-sec">
                    <?=html_entity_decode($terms_of_service['cms_page_content'])?>
                </div>
            </div>
        </div>
    </div>
</section>