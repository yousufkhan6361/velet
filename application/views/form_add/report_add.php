<style type="text/css"> .submitbtn { background-color: #04a4ce; border: 0;
width: 100%; color: #fff; font-size: 15px; line-height: 20px; padding: 9px 0;
margin: 9px 0; font-family: 'Lato', sans-serif; }

#reportForm{
  border: 2px solid #e8f0fe;
  padding: 18px;
  background-color: #6c757b38;
}

.loginForm{
  border: 2px solid #e8f0fe;
  padding: 18px;
  background-color: #6c757b38;
   padding: 9px -1px !important;

}
input{
  background-color: white !important;
  color: black !important;
  }

.reportlist button {
    background-color: #04a4ce !important;
   

  }

</style>
<main>
    <!-- <section class="section-packages-head">
      <div class="container">
        <h1>My account</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb align-items-center justify-content-center">
            
          </ol>
        </nav>
      </div>
    </section> -->
<!-- account sec start -->
<section class="accountsec">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3">
        <div class="registertext">
          <h4>Report Ad</h4>
          <form method="post" action="<?php echo g('base_url');?>form_add/report_save" id="reportForm">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="accountlist">
                
              
                <label>Email address *</label>
                <input type="text" class="form-control" id="reportemail" name="report_email" placeholder="Email ">
                <label>Name</label>
                <input type="text" class="form-control" id="reportname" name="report_name" placeholder="Name ">
                
                <input type="hidden" name="report_userid" value="<?=$this->userid?>">
                <input type="hidden" name="report_adid" value="<?=$this->uri->segment(2)?>">
                <label>Subject</label>
                <select style="height: 41px;" name="report_subject" id="report_subject" class="form-control">
                  <option value="" >Subject</option>
                  <option selected="selected" value="Report Ad - Listing Guidelines">Does not meet The Northern Ireland Connection Listing Guidelines</option>
                  <option value="Report Ad - Incorrectly Described">This is incorrectly described</option>
                  <option value="Report Ad - Business">This advertiser is a business posing as a private advertiser</option>
                  <option value="Report Ad - Suspicious">This advert is suspicious</option>
                  <option value="Report Ad - Copyright">This advert is an infringement of my copyright</option>
                  <option value="Report Ad - Animal Welfare">I have animal welfare concerns</option>
                  <option value="Other">Other</option>
                </select><br>
                <label>Reason *</label>
                <textarea name="report_desc" id="reportdesc" cols="70" rows="10">
                  
                </textarea>

              
                  
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                 <div class="accountlist">
                   <a href="javascript:void(0)" class="submitbtn">
                    <button type="submit" id="btn-report" style="cursor: pointer;">Submit</button>
                </a>
                 </div>
                
              </div>
            </div>
          </form>
        </div>
      </div>
        
    </div>
  </div>
</section>



