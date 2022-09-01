<?
global $config;
$body_att = 'colspan="2" align="left" style="background-color:#fff;color:#E84704;text-align: center;"';
$body_att1 = 'colspan="2" align="left" style="background-color:#57585B;color:#fff;"';
?>

<html>
	<head>
	</head>
	<body>
    <div style="margin-top:-10px;">
        <table width='70%' border='1' cellpadding='6' cellspacing='5' style='font-family:Verdana;font-size:12px; border-collapse:collapse'>
            <tr>
                <td border="0" colspan=2 <?=$body_att?>>
                    <img src="<?=l('assets/front_assets/images/')?>logo.png" width="300" />
                </td>
            </tr>

            <tr>
                <td colspan="2" <?=$body_att1?>><br><?php echo $message;?> </td>
            </tr>
        </table>
    </div>


	</body>
</html>