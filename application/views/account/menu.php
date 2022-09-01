<ul class="list-group margin-bottom-25 sidebar-menu">
<li class="list-group-item clearfix <?php if($this->router->class=='account'&& $this->router->method == 'index'){?>active<?}?>">
<a href="<?=g('base_url')?>my-account"><i class="fa fa-angle-right"></i> Dashboard</a></li>
<li class="list-group-item clearfix <?php if($this->router->method == 'info'){?>active<?}?>">
<a href="<?=g('base_url')?>my-account/info"><i class="fa fa-angle-right"></i> Account Settings</a></li>
<?php
// Buyer
$user = $this->model_signup->find_by_pk($this->userid); 

?>

<!-- <li class="list-group-item clearfix <?php if($this->router->method == 'mywishlist'){?>active<?}?>"><a href="<?=g('base_url')?>my-account/wishlist"><i class="fa fa-angle-right"></i> My Wishlist</a></li> -->
 <li class="list-group-item clearfix <?php if($this->router->method == 'orderhistory' || $this->router->method== 'getinvoice2'){?>active<?}?>"><a href="<?php echo g('base_url');?>account/orderhistory"><i class="fa fa-angle-right"></i> My Order History</a></li> 



<li class="list-group-item clearfix <?php if($this->router->method == 'affiliate'){?> active <?}?>">
<a href="<?=g('base_url')?>my-account/affiliate"><i class="fa fa-angle-right"></i> Affiliate Link</a></li>


<li class="list-group-item clearfix <?php if($this->router->method == 'editads' || $this->router->method == 'editForm'){ ?> active <? } ?>">
<a href="<?=g('base_url')?>my-account/edit-ads"><i class="fa fa-angle-right"></i> Edit Ads </a></li>



<li class="list-group-item clearfix">
	<a href="<?=g('base_url')?>form_add?cat=promotions">
		<i class="fa fa-angle-right"></i> Promotions 
	</a>
</li>



<!-- <li class="list-group-item clearfix <?=($this->router->class=='product')?'active':''?>">
                <a href="<?=g('base_url')?>seller_dashboard/product"><i class="fa fa-angle-right"></i> My Products</a></li> -->
<!-- <li class="list-group-item clearfix <?=($this->router->class=='seller_shop')?'active':''?>">
                <a href="<?=g('base_url')?>seller-shop"><i class="fa fa-angle-right"></i> Seller Shop</a></li> -->

<li class="list-group-item clearfix <?php if($this->router->method == 'change_password'){?>active<?}?>"><a href="<?=g('base_url')?>my-account/change-password"><i class="fa fa-angle-right"></i> Change Password</a></li>
<li class="list-group-item clearfix <?php if($this->router->method == 'logout'){?>active<?}?>"><a href="<?=g('base_url')?>user/logout"><i class="fa fa-angle-right"></i> Logout</a></li>
</ul>
