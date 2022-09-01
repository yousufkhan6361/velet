<!-- Banner Row -->
<div class="topRow">
  <div class="container">
    <h3> <a href="index.html">Home </a> <i class="fa fa-angle-right" aria-hidden="true"></i> Resources <i class="fa fa-angle-right" aria-hidden="true"></i> <span> FAQ </span></h3>
  </div>
</div>

<!-- Banner Row  Ends--> 

<!-- Inpage-->

<section class="inpage resources">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="reRight">
          <h1 class="mainh blue"> FAQ </h1>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="tabsecset">
                <div aria-multiselectable="true" class="panel-group" id="accordion2" role="tablist">

<?php foreach ($faqs as $key => $value): ?>
                  <div class="panel">
                    <div class="panel-heading" id="heading<?php echo $key+1;?>" role="tab">
                      <h4 class="panel-title"> <a aria-controls="collapse<?php echo $key+1;?>" class="<?=($key == 0 ? '' : 'collapsed')?>" aria-expanded="<?=($key == 0 ? 'true' : 'false')?>" data-parent="#accordion2" data-toggle="collapse" href="#collapse<?php echo $key+1;?>">
                        <label for=""><?php echo $key+1;?></label>
                        <?php echo $value['faq_title']?></a></h4>
                    </div>
                    <div aria-labelledby="heading<?php echo $key+1;?>" class="panel-collapse collapse <?=($key == 0 ? 'in' : '')?>" aria-expanded="<?=($key == 0 ? 'true' : 'false')?>" id="collapse<?php echo $key+1;?>" role="tabpanel" >
                      <div class="panel-body">
                        <?php echo html_entity_decode($value['faq_content'])?>
                      </div>
                    </div>
                  </div>
<?php endforeach ?>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
