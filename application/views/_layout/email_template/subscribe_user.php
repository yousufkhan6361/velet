<?
global $config;
$body_att = 'colspan="2" align="left" style="background-color:#05334D;color:#FFFFFF;"';
$name = explode('@',$email);
?>
<html>
	<head>
	</head>
	<body>
		<p>Hi <?=$name[0]?>,&nbsp;</p>

<p>You have successfully subscribed for newsletter.</p>

<p>Regards,</p>

<p><?=g('site_name')?></p>

	</body>
</html>