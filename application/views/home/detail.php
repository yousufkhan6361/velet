<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>

<!-- News and Events Deatil page start -->
<section class="Comment_sect">
      <div class="postsArea ">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
              <div class="blog-details-content">
                <div class="blog-meta-2">
                  <!-- <ul>
                    <li>22 April, 2018</li>
                  </ul> -->
                </div>
                <h3><?= $news_details['news_name'] ?></h3>
                <?= html_entity_decode($news_details['news_description']) ?>
              </div>
              
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="blogDetails">
                <figure>
                  <img src="<?php echo get_image($news_details['news_image_path'], $news_details['news_image']); ?>" class="img-resposiv">
                </figure>
                
              </div>
             
            </div>            
          </div>
        </div>
        
      </section>
<!-- News and Events Deatil page end -->