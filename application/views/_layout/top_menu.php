<div class="topsec">
<div class="container">
<div class="row">
<div class="col-md-12">

<a href="<?=g('base_url')?>help">Help </a>

<?php 
if($this->userid > 0){
?>


<a href="<?=g('base_url')?>account/logout">Log Out </a>
<a href="<?=g('base_url')?>my-account">My Account </a>


<?php 
}
else
{
?>

<a href="<?=g('base_url')?>account/register">Sign Up </a>
<a href="<?=g('base_url')?>account/login">Log In </a>


<?php 
}
?>

<a href="<?=g('base_url')?>checkout">Cart </a>

</div>
</div>
</div>
</div>