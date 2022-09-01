<?
// Banner heading
$this->load->view('widgets/inner_banner');
// Banner section
?>
<!-- banner start -->
<!-- banner end --> 

<!-- aboutPg sec  -->
<main class="aboutPg">

  <!-- abtSec start -->
  <div class="abtSec">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-md-12 col-xs-12 text-center">
          <?php
            if($flag == 1){
          ?>
            <h1 class="cb">Merchant Coming Soon</h1>
          <?php
            }
            elseif ($flag == 3) {
          ?>
            <h1 class="cb">You have already subscribed this package</h1>
          <?php
            }
            else{
          ?>
            <h1 class="cb">This is a free package</h1>  
          <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- aboutPg end -->