<?
global $config;
$body_att = 'colspan="2" align="left" style="background-color:#05334D;color:#FFFFFF;"';
?>
<html>
	<head>
	</head>
	<body>
		<p>Hello,&nbsp;</p>
<p>Welcome to <?=g('site_name')?>.</p>

<p><?=$details['product_name']?> is in the stock now.</p>

<p><strong><a href="<?=g('base_url')?>product/detail/<?=$details['product_slug']?>">Continue Shopping</a></strong></p>

<p>Thank you</p>

<p>Regards,</p>

<p><?=g('site_name')?></p>

	</body>
</html>