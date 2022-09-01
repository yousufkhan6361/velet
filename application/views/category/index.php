<section class="section-alexbanner">
      <div class="container">
        <h1>Categories of Businesses</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb align-items-center justify-content-center">
           <!--  <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
              href="#" >Categories of Businesses</a></li> -->
          </ol>
        </nav>
      </div>
    </section>
   <!-- categeris buisness sec start -->
   <style type="text/css">
     .img-gradient:after {
  content:'';
  position:absolute;
  left:0; top:0;
  width:100%; height:100%;
  display:inline-block;
  background: -moz-linear-gradient(top, rgba(0,47,75,0.5) 0%, rgba(220, 66, 37, 0.5) 100%); /* FF3.6+ */
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(220, 66, 37, 0.5)), color-stop(100%,rgba(0,47,75,0.5))); /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top, rgba(0,47,75,0.5) 0%,rgba(220, 66, 37, 0.5) 100%); /* Chrome10+,Safari5.1+ */
  background: -o-linear-gradient(top, rgba(0,47,75,0.5) 0%,rgba(220, 66, 37, 0.5) 100%); /* Opera 11.10+ */
  background: -ms-linear-gradient(top, rgba(0,47,75,0.5) 0%,rgba(220, 66, 37, 0.5) 100%); /* IE10+ */
  background: linear-gradient(to bottom, rgba(0,47,75,0.5) 0%,rgba(220, 66, 37, 0.5) 100%); /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#002f4b', endColorstr='#00000000',GradientType=0 ); /* IE6-9 */
}
.img-gradient img{
  display:block;
}

.module {
  margin: 10px;
  width: 200px;
  height: 150px;
  float: left;
  background-size: cover;
}
.darken {
  background-image: 
    linear-gradient(
      rgba(0, 0, 0, 0.5),
      rgba(0, 0, 0, 0.5)
    ),
    
}

.proimg.modeule.darken{
  position: relative;
}

.proimg.modeule.darken:before {
    position: absolute;
    content: '';
    background: rgba(0,0,0,0.4);
    width: 100%;
    height: 100%;
}
   </style>
<?php $cats = array_chunk($categories,3); //debug($cats,1); ?>
   <section class="protectionsec">
    <div class="container">

       <?php foreach ($cats as $key => $catee){ ?>

        <?php if($key%1==0){ ?>
         <br><br>
        <?php } ?>
       
        <div class="row">
          <?php foreach ($catee as $key2 => $cat){ ?>

            <?php if($cat['category_id'] != 22){ ?>
              <div class="col-md-4 col-sm-12 col-12">
                 <a href="<?=g('base_url')?>category/<?=$cat['category_slug']?>">
               <div class="protextionbox " style="">
                <div class="proimg modeule darken" style="">
               
                  <img style="width: 360px; height: 180px;object-fit: cover;" src="<?=get_image($cat['category_image_path'],$cat['category_image'])?>" class="img-fluid" alt="img">
               
                </div>
                  <div class="protectionoverlay">
                      <div class="protectiontext">
                    <!-- <h5>PROTECTION</h5> -->
                    <a href="<?=g('base_url')?>category/<?=$cat['category_slug']?>">
                      <h5><?=$cat['category_name']?></h5>
                    </a>
                   <!--  <a href="#">See more</a> -->
                </div>
                </div>
               </div>
                </a>
              </div>
              <?php } ?>
              <?php } ?>
          
        </div>
         <?php } ?>
      
    </div>
</section>

   <!-- <section class="categerissec">
     <div class="container">
       <div class="row">

        <?php foreach ($categories as $key => $cat){ ?>

         <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
           <div class="Categoriesbox" aos-init aos-animate  data-aos="zoom-in" data-aos-delay="800" data-aos-easing="linear">
                <img style="width: 215px; height: 200px;object-fit: contain;" src="<?=get_image($cat['category_image_path'],$cat['category_image'])?>" class="img-fluid" alt="img">
                <h4 class="text-center" style="font-size: 19px;"><?=$cat['category_name']?></h4>
                <a href="<?=g('base_url')?>category/<?=$cat['category_slug']?>" class="hvr-grow tc-image-effect-shine">Read More</a>
              </div>
         </div>
        <?php } ?>
          
       </div>
          
     </div>
   </section> -->