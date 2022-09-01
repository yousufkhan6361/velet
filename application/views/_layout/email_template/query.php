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
			<?if($title){?>
			<tr>
				<td colspan="2" <?=$body_att1?>>>&nbsp;<strong><?=$title?>:</strong></td>
			</tr>
			<?}?>
			<tr>
				<td colspan="2" <?=$body_att1?>>>&nbsp;<strong>User Input:</strong></td>
			</tr>
			
		<?
		if(isset($form_input) && is_array($form_input))
			foreach ($form_input as $key => $value) {?>
				<tr>
					<td width='14%' align='left'><?=ucfirst(str_replace("_", " ", $key))?></td>
					<td width='14%' align='left'>
						<?
							if(is_array($value))
							{
								foreach ($value as $sub_value) 
								{
									echo $sub_value."<br/>";
								}
							}
							else
								echo $value;
						?>
					</td>
				</tr>
			<?}?>
		</table>
	</div>
	</body>
</html>