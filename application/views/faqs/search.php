<div class="banner"> <img src="<?php echo get_image($banner['inner_banner_image_path'], $banner['inner_banner_image']) ?>" alt="Avatar" class="image">
  <div class="overlay">
    <div class="container">
      <div class="text">
        <h1 class="playf">
<?if(isset($_GET['search'])  && (!empty($_GET['search'])) )
                    echo 'Search : ' .$_GET['search'];
                  else
                     echo $banner['inner_banner_title']
?>      </h1>
      </div>
    </div>
  </div>
</div>

<section class="faq_ask inpage">
  <div class="container pd-lf">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="search_box">
<form method="GET" action="<?=g('base_url');?>faq" id="SearchForm">
          <div class="input-group">
            <input type="text" name="search" class="form-control search-input" id="search_input" placeholder="Search FAQ" aria-label="Search FAQ">
            <a href="javascript:void(0)" id="submitSearch"><span class="input-group-addon">SEARCH</span></a>
          </div>
</form>
        </div>
      </div>
    </div>
    <div class="panlegroup">
      <h3><a href="javascript:void(0)" class="pull-right"></a></h3>
      <div class="panel-group" id="accordion">

 <?php
               
if(array_filled($faqs)){
                    $x = 1;
foreach($faqs as $key=>$value):?>
        <div class="panel">
          <div class="panel-heading">
            <h4 class="panel-title">
              <!-- <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key+1;?>" class="collapsed" aria-expanded="true"> -->
              <?php echo $value['faq_title']?>
            <!-- </a>  -->
          </h4>
          </div>
          <div id="collapse<?php echo $key+1;?>" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body"><?php echo html_entity_decode($value['faq_content'])?></div>
          </div>
        </div>
                    <?php
if($x%4==0){?>
                        <div class="clearfix"></div>
                    <?$x=1;}
else{
                        $x++;
                    }
endforeach
                ?>
                    <?php }else {
?>

                    <center><h1 style="color: #f3a333;">No Records Found</h1></center>

<?
}?> 



        
      </div>
    </div>
    
  </div>
</section>

