<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <title>Order Confirmation</title>

</head>

<style>

    table tr:first-child > td > center{

        /*background: #ff0000;*/

    }

</style>

<body>





<table style="background:#fff; border:#000000 1px solid;" width="622" cellspacing="0" cellpadding="0" border="0"

       align="center">

    <tbody>

    <tr class="first">

        <td>

            <center>

                <img src="<?=get_image($this->layout_data['logo']['logo_image_path'],$this->layout_data['logo']['logo_image'])?>" style="padding: 15px;">

            </center>

        </td>

    </tr>

    <tr>

        <td height="1"></td>

    </tr>

    <tr>

        <td style="font-family:Arial, Helvetica, sans-serif;" bgcolor="#f5f9f6">

            <table width="622" cellspacing="0" cellpadding="0" border="0" align="center">

                <tbody>

                <tr>

                    <td style="padding:8px 15px;"><p><strong>Dear <?=ucfirst($email)." ".ucfirst($userdata['signup_lastname'])?>,</strong></p></td>

                </tr>

                <tr>

                    <td style="font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px;">
                        <?php
                        $changeDate = date_create($expiryDate);
                        $date = date_format($changeDate,"Y-M-d ");
                        ?>
                        your subscription with us expires with this month on <?=$date?>. However, we have mailed the next month issue as we know you will renew your subscription in due package.<br>
                        <a href="<?=g('base_url')?>packages">Click here to subscribe a package</a>

                    </td>

                </tr>

                </tbody>

            </table>

        </td>

    </tr>

    </tbody>

</table>

</body>

</html>