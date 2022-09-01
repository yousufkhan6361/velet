<style type="text/css">
  #adp{
    text-align: center;
    /*font-size: 14px;
    font-weight: 600;
*/
    color: #777;
    font-size: 17px;
    /* border-top: 1px dashed; */
    /* margin: auto; */
    padding: 0px 0;
    font-family: Lato;
  }

  .li-items{
  margin-right:  45px;
  }
</style>
<main>
    <section class="section-packages-head">
      <div class="container">
        <h1>Packages</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb align-items-center justify-content-center">
            <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Packages</li> -->
          </ol>
        </nav>
      </div>
    </section>

    <section class="section-packages">
      <h2>our packages</h2>
      <div class="container">

        <div class="row align-items-center justify-content-center">
      <?php foreach ($packages as $key => $package){ ?>
          <div class="col-md-6 col-sm-12 col-12 col-lg-6 col-xl-4">
            <div class="card-packages">
              <div class="categ-price">
                <h5 class="card-category-main"><?=$package['packages_name']?></h5>
                <h2 class="card-category-price">£ <?=$package['packages_price']?></h2>
              </div>
              <div class="item-days">
                <?=html_entity_decode($package['packages_description'])?>

                <?php if($package['packages_name'] == "Premium"){ ?>
                    <p id="adp">Promote your business in up to 3 different categories</p>
                  <?php } ?>
                <div class="card-btn">
                  <!-- <a href="<?=g('base_url')?>package/<?=$package['packages_name']?>" class="btn-card">BUY NOW</a> -->
                  <a href="javascript:void(0);" packageid="<?=$package['packages_id']?>" packagename="<?=$package['packages_name']?>" class="btn-card buyNow">BUY NOW</a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

          <!-- <div class="col-md-6 col-sm-12 col-12 col-lg-6 col-xl-4">
            <div class="card-packages">
              <div class="categ-price">
                <h5 class="card-category-main">Standard</h5>
                <h2 class="card-category-price">£ 40</h2>
              </div>
              <div class="item-days">
                <ul class="ul-days">
                  <li class="days-head">For 30 days</li>
                  <li class="li-items">Logo</li>
                  <li class="li-items">6 Pics</li>
                  <li class="li-items">2 videos</li>
                  <li class="li-items">1 document</li>
                  <li class="li-items">Website link</li>
                </ul>
                <div class="card-btn">
                  <a href="#" class="btn-card">BUY NOW</a>
                </div>
              </div>
            </div>
          </div> -->

          <!-- <div class="col-md-6 col-sm-12 col-12 col-lg-6 col-xl-4">
            <div class="card-packages">
              <div class="categ-price">
                <h5 class="card-category-main">Premium</h5>
                <h2 class="card-category-price">£ 100</h2>
              </div>
              <div class="item-days">
                <ul class="ul-days">
                  <li class="days-head">For 45 days</li>
                  <li class="li-items">Logo</li>
                  <li class="li-items">15 Pics</li>
                  <li class="li-items">5 videos</li>
                  <li class="li-items">5 document</li>
                  <li class="li-items">Website link</li>
                  <li class="li-items">1 document</li>
                  <li class="li-items">Social media links</li>
                  <li class="li-items">1 business each month will be featured/promoted on our social media sites and in the monthly newsletter</li>
                </ul>
                <div class="card-btn">
                  <a href="#" class="btn-card">BUY NOW</a>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </section>
  </main>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){

      $(".buyNow").click(function(){

        var pid = $(this).attr("packageid");
        var pname = $(this).attr("packagename");

        if(<?=$this->userid?>){
          //check for already subscription
          $.ajax({
                  url: "<?=g('base_url')?>packages/checkSubscription",
                  data : {pid:pid},
                  type: "post",
                  success: function(response)
                  {
                  response = JSON.parse(response);
                   // console.log(response);
                   // return false;
                  if(response.status == 0){
                    AdminToastr.info(response.txt,"Warning");
                    //AdminToastr.info(response.data,"Info");
                    // setTimeout(function(){
                    // //window.location="<?=g('base_url')?>product";
                    //   //location.reload();
                    // },1000)
                  }else{

                    swal({
                          title: "Are you sure?",
                          text: "You want to buy this package",
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {
                              $.ajax({
                              url: "<?=g('base_url')?>packages/saveOrder",
                              data : {pid:pid},
                              type: "post",
                              success: function(response)
                              {
                              response = JSON.parse(response);
                              // console.log(response);
                              // return false;
                              if(response.status == 1){

                                var oid = response.oid;
                              //AdminToastr.info(response.data,"Info");
                              setTimeout(function(){
                              //window.location="<?=g('base_url')?>packages/payment?package="+pname+"&oid="+oid;
                              //window.location="<?=g('base_url')?>propackages/payment?package="+pname+"&oid="+oid;
                              window.location="<?=g('base_url')?>propackages2/payment?package="+pname+"&oid="+oid;
                                //location.reload();
                                // /propackages
                              },3000)
                              }else{
                                AdminToastr.info(response.txt,"Info");
                              }
                              }
                              });

                            swal("Your Order has been saved successfully!", {
                              icon: "success",
                            });
                          } else {
                            swal("Your Order is safe!");
                          }
                        });
                      }
                    }
                  });
                }else{
              Loader.show();
              setTimeout(function(){
              window.location="<?=g('base_url')?>user/signup";
            },2000);
          }
      });
    });
  </script>
 