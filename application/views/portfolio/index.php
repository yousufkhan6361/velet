   <section class="hportfolioSec innerMain">
     
     	<div class="container-fluid">
        	
            
            
            <div class="tmOon"></div>
            
            <!--Slider Circle Start Here-->
           
           
               <div class="slider slider slider_circle">
                    <?php
                        if (array_filled($portfolio)) {
                            foreach ($portfolio as $key => $value) {?>
                                
                                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 section  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                                    <div class="boxes">
                                    <div class="iconbox"><img src="<?php echo get_image($value['portfolio_image_path'],$value['portfolio_image']);?>" class="img-responsive"></div>
                                  
                                  <?php
                                        echo html_entity_decode($value['portfolio_description']);
                                  ?>
                                    
                                    </div>
                                </div>
                                <?
                            }
                        }

                    ?>
                <div class="next_button"></div>
                <div class="prev_button"></div>

                </div>
                    
                   
                    
                
                
                
           
           <!--Slider Circle End Here-->
        
        
        <div class="sMoon"></div>
     
     </section>
        
        
        
        <div class="clearfix"></div>
        
        
        
        
        <div class="clearfix"></div>
    <script>
        $(document).ready(function() {
            
            $('.slider_circle').EasySlides({
                'autoplay': true,
                'show':3
            })
            
        });
    
    
    window.onload=function(){
      $('.sliderslick').slick({
      autoplay:true,
      autoplaySpeed:1500,
      arrows:true,
      prevArrow:'<button type="button" class="slick-prev"></button>',
      nextArrow:'<button type="button" class="slick-next"></button>',
      centerMode:true,
      slidesToShow:3,
      slidesToScroll:1,
      });
    };
    
    
  
  
  
    </script>

          <script>
  $(function(){
    $('#menu').slicknav();
  });
  </script>