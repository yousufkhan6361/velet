<style type="text/css">
	#toph{
		font-size: 20px;
    font-weight: bold;
    /* background: #007aff; */
    /* color: white; */
    padding: 14px;
    border-radius: 10px;
    font-family: inherit;
	}

	li{
		font-family: system-ui;
	}
</style>
<div class="portlet box green">

	<div class="portlet-title">

	<div class="caption">

	<i class="fa fa-shopping-cart"></i>

	<strong>Referral Users </strong>

	<!-- <small>  27 Apr 2021</small> -->

	</div>

	<div class="tools">

	<a href="javascript:;" class="collapse">

	</a>

	<a href="javascript:;" class="reload">

	</a>

	</div>

	</div>

	<div class="portlet-body form">

	                  <!-- BEGIN FORM-->

	<div class="invoice">

		<div class="container">

		<div class="row invoice-logo">

			<div class="col-xs-6 invoice-logo-space">

				<a href="http://localhost/irelconnection_dev/admin">

					<img src="<?=g('base_url')?>assets/uploads/logo/logo161841820742.png" alt="logo" class="main-tem-logo" style="margin-top: 10px;width:129px !important;height:94px !important;"/>

				</a>

			</div>

			<div class="col-xs-6">

			</div>

			<!-- <div class="col-xs-6">

				<p>

					 Order #3 <span class="muted">

					On: 2021-04-27 </span>

				</p>

			</div> -->

		</div>

		<hr style="margin-top:0px;">

		<div class="row">

			<div class="col-xs-12">

				<h3 style="color: #8cbe41;"><strong>Affiliate User Info

:</strong></h3>

				<ul class="list-unstyled">
					<?php //debug($affiliateData); ?>
					<li><strong>Name:</strong> <?=$affiliateData['affiliate_username']?>  </li>
					<!-- <li><strong>Phone #:</strong> 023423423 </li> -->
					<li><strong>Email:</strong>  <?=$affiliateData['affiliate_useremail']?></li>

					<li><strong>Link:</strong>  <?=$affiliateData['affiliate_link']?></li>
		           <!-- <li><strong>Order Note:</strong> asdasda</li> -->										
				</ul>

			</div>

			<!-- <div class="col-xs-4">
				<h3 style="color: #6ca0b2;"><strong>Address
:</strong></h3>
				<ul class="list-unstyled">
					<li><strong>Address:</strong> werwerw</li>
					<li><strong>Country:</strong> albania</li>
					<li><strong>Town / City:</strong> rwerwr</li>
					<li><strong>Postcode:</strong> 423423</li>
				</ul>
			</div> -->

			<!-- <div class="col-xs-4">
				<h3 style="color: #f8a935;"><strong>Payment Info:</strong></h3>
				<ul class="list-unstyled">		
					<li><strong>Total Products:</strong> 1 </li>					
					<li> <strong>Total Quantity:</strong> 1  </li>
					<li> <strong>Subtotal:</strong> $ 100.00</li> 
					<li> <strong>Shipping Charges:</strong> $ 0.00  </li> 
                    <li> <strong>Discount:</strong> - $ 0.00</li>	
                    <li> <strong>Grand Total:</strong> $ 100.00</li>
				</ul>
			</div> -->

		</div>

		<hr>

		<div class="row">
			<div class="col-xs-12">
				<h2 id="toph">List of users who used above affiliate link</h2>
				<table class="table table-striped table-hover table-bordered">
					<thead style="background: black;">
						<tr>

							<th class="hidden-480 text-center" style="color: #8cbe41;">
								 <strong>Id</strong>
							</th>
							<th class="hidden-480 text-center" style="color: #8cbe41;">
								 <strong>Name</strong>
							</th>
							<th class="hidden-480 text-center" style="color: #4d9ec3;">
								 Email
							</th>

							<th class="hidden-480 text-center" style="color: #4d9ec3;">
								 Link
							</th>

							 <th class="hidden-480 text-center" style="color: #0ec514b3">
								 <strong>Status</strong>
							</th>  
						</tr>
					</thead>
					<tbody>

						<?php foreach ($ReferralData as $key => $value) { ?>
							<tr>

								<td class="text-center" style="padding:10px 0; vertical-align:middle;">
							  		<?=$value['referral_id']?>
								</td>


							  	<td class="text-center" style="padding:10px 0; vertical-align:middle;">
							  		<?=$value['referral_name']?>
								</td>


							  	<td class="text-center" style="padding:10px 0; vertical-align:middle;">
							  		<?=$value['referral_email']?>
								</td>

								<td class="text-center" style="padding:10px 0; vertical-align:middle;">
							  		<?=$affiliateData['affiliate_link']?>
								</td>

								

								<td class="text-center" style="padding:10px 0; vertical-align:middle;">

							  	1

								</td> 

							

							</tr>

						<?php } ?>



						
						

		  			</tbody>

				</table>

			</div>

		</div>

		<div class="row">



			<div class="col-xs-4">

								</div>

			<div class="col-xs-8 invoice-block">

				<ul class="list-unstyled amounts">

					<!-- <li><strong style="color:#333">Total Products</strong> : 1 </li> -->

					<!-- <li><strong style="color:#333">No of Items</strong> :  </li> -->

					<!-- <li><strong style="color:#333">Price</strong> : $ 0.00 </li> -->

					<!-- <li><strong style="color:#333">Total Price</strong> : $ 100.00 </li> -->

				</ul>

				<br>

				<!--a onclick="javascript:window.print();" class="btn btn-lg blue hidden-print margin-bottom-5">

				Print <i class="fa fa-print"></i>

				</a>

				<a class="btn btn-lg green hidden-print margin-bottom-5">

				Submit Your Invoice <i class="fa fa-check"></i>

				</a-->

			</div>

		</div>

	</div>

    </div>

<!-- END VALIDATION STATES-->

</div>

</div>



                  <!-- END FORM-->


            </div>








            <div class="tab-pane" id="tab_1">


                  

            </div>





            <!--div class="tab-pane" id="tab_2">


                  

            </div-->





          </div>


      </div>


  </div>


</div>