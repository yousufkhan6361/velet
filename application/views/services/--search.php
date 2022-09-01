
  <section class="banner banner1">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12">
          <h1>Search</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="main-servc-page">
    <div class="container">
      <div class="servc-head">                
      </div>
      <div class="row">






<?php
if(count($services) > 0){
$i = 1;
foreach ($services as $key => $value) {

?>

        <div class="col-md-4 col-xs-12 col-sm-4">
          <div class="servc-box">
            <img alt="" class="img-responsive" src="<?php echo get_image($value['service_image_path'],$value['service_image_thumb'])?>">
            <h1><?php echo $value['service_title']?></h1>
            <p><?=truncate(html_entity_decode($value['service_short']),230)?></p>
            <a href="<?=g('base_url')?>service-details/<?php echo $value['service_slug']?>">Learn More</a>
          </div>
        </div>

<?php
if($i == 3){
?>
<div class="clearfix"></div>
<?php
$i = 0;
}
$i++;
}
}
else{
?>

<section class="main-whel-page">
    <div class="container">
      <div class="servc-head">

        <h1>No Records Found</h1>       
      </div>
      
    </div>
  </section>

<?php
}
?>


    </div>
  </section>