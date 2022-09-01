<style type="text/css">
  .otherbtn{
    background-color: #d9dde0;
    border-color: #c5c9ce;
    color: black;
    width: 86px;
  }

  .alertmsg{
    /*color: #004085;*/
    background-color: #b70c0c;
    border-color: #f7f7f7;
    font-size: 23px;
    text-align: center;
    color: white;
  }

  /*Radio button Css*/
  /* Custom Radio Button Start*/

.radiotextsty {
  color: #A5A4BF;
  font-size: 18px;
}

.customradio {
  display: block;
  position: relative;
  padding-left: 30px;
  margin-bottom: 0px;
  cursor: pointer;
  font-size: 18px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.customradio input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 22px;
  width: 22px;
  background-color: white;
  border-radius: 50%;
  border:1px solid #BEBEBE;
}

/* On mouse-over, add a grey background color */
.customradio:hover input ~ .checkmark {
  background-color: transparent;
}

/* When the radio button is checked, add a blue background */
.customradio input:checked ~ .checkmark {
  background-color: white;
  border:1px solid #BEBEBE;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.customradio input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.customradio .checkmark:after {
  top: 2px;
  left: 2px;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background: #A3A0FB;
}


.customradio{
  width: 200px;
}

.navbar{

  margin-bottom: 0 !important;
}
/* Custom Radio Button End*/
.sterik{
  color: red;
}
</style>

<main>
    <section class="section-submit-add">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="form-main">

              <!-- //$this->session->flashdata('msg') -->
              
              <?php  if(empty($this->session->flashdata('message_name'))){ ?>

            <?php }else{ ?>

              <div class="alert alert-primary alertmsg" role="alert">
                  <?=$this->session->flashdata('message_name')?>
              </div>

            <?php } ?>

            <?php if($userPackageId == 1){ ?>

              <form id="adsForm" action="<?=g('base_url')?>form_add/addForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="">Ad Title <span class="sterik">*</span></label>
                  <input type="text" id="title" name="ads[ads_title]" required="" class="form-control ">
                  <input type="hidden" name="ads[ads_category_id]" id="category_id" value="">
                  <input type="hidden" name="paidPackageId" value="<?=$userPackageId?>">
                  <input type="hidden" name="ads[ads_user_id]" id="user_id" value="<?=$this->userid?>">

                </div>

                <?php if(isset($_GET['cat']) == "promotions"){ ?>

                <div class="form-group">
                  <label for="inputState">Select Category <span class="sterik">*</span></label>
                  <select style="height: auto;" id="category" name="ads[ads_category]" required  class="form-control">
                    <option value="" selected>-select-</option>
      
                    <?php foreach ($categories as $key => $category){ ?>
                    <?php if($category['category_id'] == 22){ ?>
                    <option value="<?=$category['category_slug']?>" catid="<?=$category['category_id']?>">
                      <?=$category['category_name']?>
                        
                    </option>
                    <?php } ?>
                    <?php } ?>
                  </select>

                  <small id="emailHelp" class="form-text text-muted">Select a category for your product</small>
                </div>

              <?php }else{ ?>
                <div class="form-group">
                  <label for="inputState">Select Category <span class="sterik">*</span></label>
                  <select style="height: auto;" id="category" name="ads[ads_category]" required  class="form-control">
                    <option value="" selected>-select-</option>
                      <option value="Other">Other</option>
                    <?php foreach ($categories as $key => $category){ ?>
                    <option value="<?=$category['category_slug']?>" catid="<?=$category['category_id']?>">
                      <?=$category['category_name']?>
                        
                    </option>
                    <?php } ?>
                  </select>

                  <small id="emailHelp" class="form-text text-muted">Select a category for your product</small>
                </div>
              <?php } ?>


                <div class="form-group">
                  <input type="text" name="ads[ads_other_category]" class="form-control " id="otherCategoryField" placeholder="Enter Category">
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Ad Description <span class="sterik">*</span></label>
                  <textarea class="form-control" id="question_text" required name="ads[ads_description]" rows="10"></textarea>
                  <small id="emailHelp" name="ads[ads_description2]" class="form-text text-muted">Provide a short description of your product</small>
                </div>


                <div class="form-group">
                  <label for="">Email <span class="sterik">*</span> </label>
                  <input type="text" id="emailaddres" name="ads[ads_email]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Phone <span class="sterik">*</span> </label>
                  <input type="text" id="fone" name="ads[ads_phone]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Address <span class="sterik">*</span> </label>
                  <input type="text" id="address" name="ads[ads_address]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Website Link </label>
                  <input type="text" id="websitelink" name="ads[ads_websitelink]" class="form-control " value="">
                  <input type="hidden" id="tiny_html" name="ads[ads_tiny_html]" />
                </div>

                <div class="form-group">
                  <label for="">Facebook </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div>

               <!--  <div class="form-group">
                  <label for="">Twitter </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div> -->

                <div class="form-group">
                  <label >Add Logo</label>
                  <input type="file" id="logo" name="ads[ads_image]" class="form-control-file">
                  <small id="emailHelp" class="form-text text-muted">Provide a short description of your product</small>
                </div>

                <div class="form-group">
                  <label >Add Gallery Images</label>
                  <input type="file" class="form-control-file" id="multiImages" name="multiImages[]" multiple>
                  <small id="emailHelp" class="form-text text-muted">Upload additional pictures of your ad and will be shown as image gallery</small>
                </div>

                <button type="button" class="btn-form hvr-grow tc-image-effect-shine formSubmitbtn">Submit</button>
              </form>

            <?php } ?>


            <?php if($userPackageId == 2){ ?>

              <form id="adsForm" action="<?=g('base_url')?>form_add/addForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="">Ad Title <span class="sterik">*</span></label>
                  <input type="text" id="title" name="ads[ads_title]" required class="form-control ">
                  <input type="hidden" name="paidPackageId" value="<?=$userPackageId?>">
                  <input type="hidden" name="ads[ads_category_id]" id="category_id" value="">
                  <input type="hidden" name="ads[ads_user_id]" id="user_id" value="<?=$this->userid?>">

                </div>

              <?php if(isset($_GET['cat']) == "promotions"){ ?>

                <div class="form-group">
                  <label for="inputState">Select Category <span class="sterik">*</span></label>
                  <select style="height: auto;" id="category" name="ads[ads_category]" required  class="form-control">
                    <option value="" selected>-select-</option>
      
                    <?php foreach ($categories as $key => $category){ ?>
                    <?php if($category['category_id'] == 22){ ?>
                    <option value="<?=$category['category_slug']?>" catid="<?=$category['category_id']?>">
                      <?=$category['category_name']?>
                        
                    </option>
                    <?php } ?>
                    <?php } ?>
                  </select>

                  <small id="emailHelp" class="form-text text-muted">Select a category for your product</small>
                </div>

              <?php }else{ ?>

                <div class="form-group">
                  <label for="inputState">Select Category <span class="sterik">*</span></label>
                  <select style="height: auto;" id="category" name="ads[ads_category]" required  class="form-control">
                    <option value="" selected>-select-</option>
                      <option value="Other">Other</option>
                    <?php foreach ($categories as $key => $category){ ?>
                    <option value="<?=$category['category_slug']?>" catid="<?=$category['category_id']?>">
                      <?=$category['category_name']?>
                        
                    </option>
                    <?php } ?>
                  </select>

                  <small id="emailHelp" class="form-text text-muted">Select a category for your product</small>
                </div>
              <?php } ?>

                <div class="form-group">
                  <input type="text" name="ads[ads_other_category]" class="form-control " id="otherCategoryField" placeholder="Enter Category">
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Ad Description <span class="sterik">*</span></label>
                  <textarea id="question_text" class="form-control" required name="ads[ads_description]" rows="10"></textarea>
                  <small id="emailHelp" name="ads[ads_description2]" class="form-text text-muted">Provide a short description of your product</small>
                </div>

                  <div class="form-group">
                  <label for="">Email <span class="sterik">*</span> </label>
                  <input type="text" id="emailaddres" name="ads[ads_email]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Phone <span class="sterik">*</span> </label>
                  <input type="text" id="fone" name="ads[ads_phone]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Address <span class="sterik">*</span> </label>
                  <input type="text" id="address" name="ads[ads_address]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Website Link </label>
                  <input type="text" id="websitelink" name="ads[ads_websitelink]" class="form-control " value="">
                  <input type="hidden" id="tiny_html" name="ads[ads_tiny_html]" />
                </div>

                <div class="form-group">
                  <label for="">Facebook </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Twitter </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label >Ad Logo</label>
                  <input type="file" name="ads[ads_image]" class="form-control-file">
                  <small id="emailHelp" class="form-text text-muted">Provide a short description of your product</small>
                </div>

                <div class="form-group">
                  <label >Add Gallery Images</label>
                  <input type="file" class="form-control-file" id="multiImages" name="multiImages[]" multiple>
                  <small id="emailHelp" class="form-text text-muted">Upload additional pictures of your ad and will be shown as image gallery</small>
                </div>



                <div class="row">
                 <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                     <!--  <label class="labeltext">Do u Like Me ?</label><br> -->
                          <div class="form-check-inline">

                      <label class="customradio">
                        <span class="radiotextsty uploadVideos">Upload Videos</span>
                        <input type="radio" id="" checked="checked" name="radio">
                        <span class="checkmark uploadVideos"></span>
                      </label>
                      <label class="customradio">
                        <span class="radiotextsty addVideos">Add Videos Links</span>
                        <input type="radio" id="" name="radio">
                        <span class="checkmark addVideos"></span>
                      </label>

                    </div>
                  </div>
              </div>

              <div class="videoLinkSection">
              <div class="form-group">
                  <label for="">Video Link 1</label>
                  <input type="text" name="videoLinks[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Video Link 2</label>
                  <input type="text" name="videoLinks[]" class="form-control " value="">
                </div>
              </div>

              

                <div class="form-group videoSection">
                  <label >Add Videos</label>
                  <input type="file" id="multiVideos" class="form-control-file" name="multiVideos[]" multiple>
                  <small id="emailHelp" class="form-text text-muted">Upload additional videos of your ad and will be shown as video gallery
                    <br>
                    Allowed extensions : mp4 | mov | flv
                  </small>
                </div>

                <div class="form-group">
                  <label >Add Documents</label>
                  <input type="file" id="multiDocs" class="form-control-file" name="multiDocs[]" multiple>
                  <small id="emailHelp" class="form-text text-muted">Upload additional documents of your ad and will be shown as document listing
                    <br>
                    Allowed extensions : doc | docx
                  </small>
                </div>

                <button type="button" class="btn-form hvr-grow tc-image-effect-shine formSubmitbtn">Submit</button>
              </form>

            <?php } ?>


            <?php if($userPackageId == 3){ ?>

              <form id="adsForm" action="<?=g('base_url')?>form_add/addForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="">Ad Title <span class="sterik">*</span></label>
                  <input type="text" id="title" name="ads[ads_title]" required class="form-control ">
                  <input type="hidden" name="paidPackageId" value="<?=$userPackageId?>">
                  <input type="hidden" name="ads[ads_category_id]" id="category_id" value="">
                  <input type="hidden" name="ads[ads_user_id]" id="user_id" value="<?=$this->userid?>">

                </div>

                 <?php if(isset($_GET['cat']) == "promotions"){ ?>

                <div class="form-group">
                  <label for="inputState">Select Category <span class="sterik">*</span></label>
                  <select style="height: auto;" id="category" name="ads[ads_category]" required  class="form-control">
                    <option value="" selected>-select-</option>
      
                    <?php foreach ($categories as $key => $category){ ?>
                    <?php if($category['category_id'] == 22){ ?>
                    <option value="<?=$category['category_slug']?>" catid="<?=$category['category_id']?>">
                      <?=$category['category_name']?>
                        
                    </option>
                    <?php } ?>
                    <?php } ?>
                  </select>

                  <small id="emailHelp" class="form-text text-muted">Select a category for your product</small>
                </div>

              <?php }else{ ?>

                <div class="form-group">
                  <label for="inputState">Select Category <span class="sterik">*</span></label>
                  <select style="height: auto;" id="category" name="ads[ads_category]" required  class="form-control">
                    <option value="" selected>-select-</option>
                      <option value="Other">Other</option>
                    <?php foreach ($categories as $key => $category){ ?>
                    <option value="<?=$category['category_slug']?>" catid="<?=$category['category_id']?>">
                      <?=$category['category_name']?>
                        
                    </option>
                    <?php } ?>
                  </select>

                  <small id="emailHelp" class="form-text text-muted">Select a category for your product</small>
                </div>
              <?php } ?>

                <div class="form-group">
                  <input type="text" name="ads[ads_other_category]" class="form-control " id="otherCategoryField" placeholder="Enter Category">
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Ad Description <span class="sterik">*</span></label>
                  <textarea id="question_text" class="form-control " required name="ads[ads_description]" rows="10"></textarea>
                  <small id="emailHelp" name="ads[ads_description2]" class="form-text text-muted">Provide a short description of your product</small>
                </div>

                <div class="form-group">
                  <label for="">Website Link </label>
                  <input type="text" id="websitelink" name="ads[ads_websitelink]" class="form-control " value="">
                  <input type="hidden" id="tiny_html" name="ads[ads_tiny_html]" />
                </div>

                  <div class="form-group">
                  <label for="">Email <span class="sterik">*</span> </label>
                  <input type="text" id="emailaddres" name="ads[ads_email]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Phone <span class="sterik">*</span> </label>
                  <input type="text" id="fone" name="ads[ads_phone]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Address <span class="sterik">*</span> </label>
                  <input type="text" id="address" name="ads[ads_address]" class="form-control " value="">
                </div>

                

                <div class="form-group">
                  <label for="">Facebook </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Twitter </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Instagram </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Youtube </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Pinterest </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label >Ad Logo</label>
                  <input type="file" required name="ads[ads_image]" class="form-control-file">
                  <small id="emailHelp" class="form-text text-muted">Provide a short description of your product</small>
                </div>

                <div class="form-group">
                  <label >Add Gallery Images</label>
                  <input type="file" id="multiImages" class="form-control-file" name="multiImages[]" multiple>
                  <small id="emailHelp" class="form-text text-muted">Upload additional pictures of your ad and will be shown as image gallery</small>
                </div>

                <div class="row">
                 <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                     <!--  <label class="labeltext">Do u Like Me ?</label><br> -->
                          <div class="form-check-inline">

                      <label class="customradio">
                        <span class="radiotextsty uploadVideos">Upload Videos</span>
                        <input type="radio" id="" checked="checked" name="radio">
                        <span class="checkmark "></span>
                      </label>
                      <label class="customradio">
                        <span class="radiotextsty addVideos">Add Videos Links</span>
                        <input type="radio" id="" name="radio">
                        <span class="checkmark "></span>
                      </label>

                    </div>
                  </div>
              </div>

              <div class="videoLinkSection">
              <div class="form-group">
                  <label for="">Video Link 1</label>
                  <input type="text" name="videoLinks[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Video Link 2</label>
                  <input type="text" name="videoLinks[]" class="form-control " value="">
                </div>


                <div class="form-group">
                  <label for="">Video Link 3</label>
                  <input type="text" name="videoLinks[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Video Link 4</label>
                  <input type="text" name="videoLinks[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Video Link 5</label>
                  <input type="text" name="videoLinks[]" class="form-control " value="">
                </div>

              </div>

             



              

                <div class="form-group videoSection">
                  <label >Add Videos</label>
                  <input type="file" id="multiVideos" class="form-control-file" name="multiVideos[]" multiple>
                  <small id="emailHelp" class="form-text text-muted">Upload additional videos of your ad and will be shown as video gallery
                    <br>
                    Allowed extensions : mp4 | mov | flv
                  </small>
                </div>

                <div class="form-group">
                  <label >Add Documents</label>
                  <input type="file" id="multiDocs" required class="form-control-file" name="multiDocs[]" multiple>
                  <small id="emailHelp" class="form-text text-muted">Upload additional documents of your ad and will be shown as document listing
                    <br>
                    Allowed extensions : doc | docx
                  </small>
                </div>

                <button type="button" class="btn-form hvr-grow tc-image-effect-shine formSubmitbtn">Submit</button>
              </form>

            <?php } ?>

              
            </div>
          </div> 
        </div>
      </div>
    </section>
  </main>
  

  <script src="https://cdn.tiny.cloud/1/ufv1dbighol5piud5530h18x4lije4p5dhdzuxrbcrzvt88i/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
$(document).ready(function(){

  $(".videoLinkSection").hide();

$(".uploadVideos").click(function(){

$(".videoSection").show();
$(".videoLinkSection").hide();

});


$(".addVideos").click(function(){
$(".videoLinkSection").show();
$(".videoSection").hide();

});

// if($('#addVideos').is(':checked')){ 

// alert("it's checked"); 

// }
});

              


    $(document).ready(function (){    
        $(".formSubmitbtn").click(function (){

          if($("#title").val() == ""){
            AdminToastr.error("Title field is required", 'Error');
            $('html, body').animate({
              scrollTop: $("#title").offset().top
            }, 1000);
            return false;
          }

          if ($('#category option:selected').val() == '') {
             AdminToastr.error("Category field is required", 'Error');
            $('html, body').animate({
              scrollTop: $("#category").offset().top
            }, 1000);
            return false;

          }

          // if($("#websitelink").val() == ""){
          //   AdminToastr.error("Website Link field is required", 'Error');
          //   $('html, body').animate({
          //     scrollTop: $("#websitelink").offset().top
          //   }, 1000);
          //   return false;
          // }

          if($("#emailaddres").val() == ""){
            AdminToastr.error("Email field is required", 'Error');
            $('html, body').animate({
              scrollTop: $("#emailaddres").offset().top
            }, 1000);
            return false;
          }


          if($("#fone").val() == ""){
            AdminToastr.error("Phone field is required", 'Error');
            $('html, body').animate({
              scrollTop: $("#fone").offset().top
            }, 1000);
            return false;
          }

          if($("#address").val() == ""){
            AdminToastr.error("Address field is required", 'Error');
            $('html, body').animate({
              scrollTop: $("#address").offset().top
            }, 1000);
            return false;
          }

          
         
         $('#tiny_html').val(tinyMCE.get('question_text').getContent());

         var url = $("#adsForm").attr("action");
         var form_data = new FormData(document.getElementById("adsForm"));
         //e.preventDefault();
         // AJAX request
         $.ajax({
           url: url, 
           type: 'POST',
           data: form_data,
           dataType: 'json',
           contentType: false,
           processData: false,
           success: function (response) {
            console.log(response);
            //return false;
            if(response.status == 1){

                  AdminToastr.success(response.txt, 'Success');
                  setTimeout(function(){
                  location.reload(); 
                  },2000)
                  
                  //AdminToastr.success("Success", 'Success');
              }
              else{

                //AdminToastr.error(response.txt);
                AdminToastr.error(response.txt, 'Error');
                //AdminToastr.success("Error", 'Error');
              }

           }
         });
            
        });
    });
</script>

  <script>
  // ;(function($) {
  //   $('input#submit').click(function() {
  //     var file = $('input[type="file"]').val();
  //     var exts = ['doc','docx','rtf','odt'];
  //     // first check if file field has any value
  //     if ( file ) {
  //       // split file name at dot
  //       var get_ext = file.split('.');
  //       // reverse name to check extension
  //       get_ext = get_ext.reverse();
  //       // check file type is valid as given in 'exts' array
  //       if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
  //         alert( 'Allowed extension!' );
  //       } else {
  //         alert( 'Invalid file!' );
  //       }
  //     }
  //   });
  // })(jQuery);
</script>


  <script type="text/javascript">
    $(document).ready(function(){
    //  $(".formSubmitbtn").click(function(){

        

        //     if($("#title").val() == ""){

        //       AdminToastr.error('Error', "Title field is empty");
        //       return false;

        //     }

        //     if($("#category").val() == ""){

        //       AdminToastr.error('Error', "Category field is empty");
        //       return false;

        //     }

        //     if($("#description").val() == ""){

        //       AdminToastr.error('Error', "Description field is empty");
        //       return false;

        //     }

        //     var videos = document.getElementById('videos');

        //     var files = $("#videos").files;
        //     var files2 = $("#docs").files;

        //      // console.log(videos.files.length);
        //      // return false;



        //     if(videos.files.length > 0){
        //       for (var i=0; i<videos.files.length; i++) {
        //           var ext = videos.files[i].name.substr(-3);
        //           if(ext!== "mp4" && ext!== "m4v" && ext!== "fv4")  {

        //               AdminToastr.error('Error', "Video file format is invalid");
        //               return false;
        //           }
        //       } 
        //     }

        //       var docs = document.getElementById('docs');
        //       if(docs.files2.length > 0){
        //       for (var i=0; i<docs.files2.length; i++) {
        //           var ext = docs.files2[i].name.substr(-3);
        //           if(ext!== "docx" && ext!== "doc")  {

        //               AdminToastr.error('Error', "Document file format is invalid");
        //               return false;
        //           }
        //       }
        //     } 

        // $("#adsForm").submit();

  //    });

    });
  </script>


<script type="text/javascript">
  $(document).ready(function(){

    $("#otherCategoryField").hide();


    $("#category").on('change',function(){

      var cat = $(this).val();
      //var catId = $(this).attr('catid');
      var catId = $('#category option:selected').attr('catid');
      $("#category_id").val(catId);

      //alert(catId);
      if(cat == "Other"){

        $("#otherCategoryField").fadeIn();

      }else{

        $("#otherCategoryField").fadeOut();

      }
    });

  });
</script>



<!-- <script>
  tinymce.init({
    selector: 'textarea#editor',
    menubar: true
  });
</script> -->
<script>
  
tinymce.init({
  selector: 'textarea#question_text',
  height: 500,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste imagetools wordcount'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});


</script>

 