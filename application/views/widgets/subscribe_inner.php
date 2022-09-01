<?
$subscribe_content = $this->model_cms_page->get_page(18);
?>

<div class="subscribeSec text-center">
    <h3><?=$subscribe_content['cms_page_title']?></h3>

    <?=html_entity_decode($subscribe_content['cms_page_content'])?>

    <div class="formSec">
        <form action="<?=g('base_url')?>subscribe/store" method="post">
            <div class="col-md-8 col-sm-10 col-xs-10 noPadding">
                <input type="text" placeholder="Enter your email address" name="subscribe[subscribe_email]" id="subs-email-inner" >
            </div>
            <div class="col-md-4 col-sm-2 col-xs-2 noPadding">
                <input type="submit" value="SUBSCRIBE NOW!" class="btn-subscribe" >
            </div>
        </form>
    </div>

</div>

<div class="clearfix"></div>