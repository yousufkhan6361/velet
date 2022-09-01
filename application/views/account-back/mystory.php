<style type="text/css">
    .table-striped>tbody>tr:nth-child(odd)>td {

    background-color: inherit !important;
}
       tr:hover {

    background-color: inherit !important;
}

</style>
<!--Inner Start-->
<div class="container">
<div class="row">
<div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
<section id="login">
<div class="container">
<div class="inner">
<div class="row">
<div class="col-xs-12 inner-sec">
<div class="form-wrap">

<? $this->load->view("account/header"); ?>
<!--login-banner-->

<div class="signup myfont">


        <ul class="breadcrumb">
            <li><a href="<?=g('base_url')?>">Home</a></li>
            <li class="active"><?=$title?></li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <? $this->load->view("account/menu"); ?>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            
            <div class="content-page">
              
            	<div class="row">
                <div class="portlet grey-cascade box">
                          <div class="portlet-body">
                            <div class="table-responsive">
                              <table class="table table-hover table-bordered table-striped">
                              <thead>
                              <tr>
                                <th>Story#</th>
                                <th>Story Title</th>
                                <th>Story Postedon</th>
                                <th>Status</th>
                                <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                             $x = 1;
                              foreach ($story as $key => $value) {                               
                              ?>
                              <tr>
                                <td><?=$x?></td>
                                <td>
                                   <?=$value['story_title']?>
                                </td>
                                <td>
                                   <?=date('d M Y',strtotime($value['story_createdon']))?>
                                </td>
                                <td>
                                <?php
                                if($value['story_status'] == 1){
                                ?>
                                  <span class="label label-sm label-success" >
                                  Approved
                                  </span>
                                <?php
                                }
                                else{
                                ?>
                                  <span class="label label-sm label-default" >
                                  Pending
                                  </span>
                                <?php
                                }
                                ?>
                                </td>
                                <td>
                                  <a href="<?=g('base_url')?>story/<?=$value['story_slug']?>">Explore Now</a>
                                </td>
                                
                              </tr>
                              <?php
                              $x++;
                              }
                              ?>
                              </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
              </div>

            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      

</div>
<!--Signup-->

</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function () {	
	$("#submitInfo").click(function(){
	var data = $("#saveForm").serialize();
	var url = $("#saveForm").attr("action");
	AjaxRequest.fire(url, data) ;
	//window.location = '<?=g("base_url")?>';
	return false;
	});
});
</script>