<?
global $config;
$body_att = 'colspan="2" align="left" style="background-color:#05334D;color:#FFFFFF;"';
$body_att1 = 'colspan="2" align="left" style="background-color:#fff;color:#E84704;font-size:14px;"';
?>
<html>
	<head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<p>Hi,&nbsp;</p>

<!--<p>Welcome to <?/*=g('site_name')*/?>.</p>-->

<p>Today's Job Opportunities.</p>

<table width='70%' border='1' cellpadding='6' cellspacing='5' style='font-family:Verdana;font-size:12px; border-collapse:collapse'>
    <thead>
    <tr>
        <th <?=$body_att?>>Job Title</th>
        <th <?=$body_att?>>Company</th>
        <th <?=$body_att?>>Location</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td <?=$body_att1?>><a href="<?=g('base_url')?>job/show/<?=$insert_id?>" target="_blank"><?=$job_data['job_name']?></a> </td>
        <td <?=$body_att1?>><?=$company_name?></td>
        <td <?=$body_att1?>><?=$job_data['job_location']?></td>
    </tr>
    </tbody>
</table>

<p>Thank you</p>

<p>Regards,</p>

<p><?=g('site_name')?></p>

	</body>
</html>