<?
global $config;
$body_att = 'colspan="2" align="left" style="background-color:#05334D;color:#FFFFFF;"';
?>
<html>
	<head>
	</head>
	<body>

		<p>Hi <?=$signup_fname?>,,&nbsp;</p>

<p>Your Login ID: <?=$signup_email?></p>

<p>Click on the following link to reset your password:</p>

<p><strong><?=g('base_url')?>account/resetpassword?id=<?=$id?></strong></p>

<p>Thank you for being part of our website. </p>

<p>Thenorthernireland</p>

	</body>
</html>