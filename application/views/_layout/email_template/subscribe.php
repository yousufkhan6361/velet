<?
global $config;
$body_att = 'colspan="2" align="left" style="background-color:#05334D;color:#FFFFFF;"';
?>
<html>
	<head>
	</head>
	<body>
		<p>Hi Admin,&nbsp;</p>

<p><strong><a href="mailto:<?=$newsletter_email?>"><?=$newsletter_email?></a></strong> has been successfully subscribed. </p>

<p>Regards,</p>

<p><?=g('site_name')?></p>

	</body>
</html>