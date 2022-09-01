<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->


    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i" rel="stylesheet">

    <!-- CSS Reset : BEGIN -->
    <style>

        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
        }

        @import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }

    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

        .primary{
            background: #f3a333;
        }

        .bg_white{
            background: rgba(117,12,50,.9);
        }
        .bg_light{
            background: #fafafa;
        }
        .bg_black{
            background: #000000;
        }
        .bg_dark{
            background: rgba(0,0,0,.8);
        }
        .email-section{
            padding:2.5em;
        }

        /*BUTTON*/
        .btn{
            padding: 10px 15px;
        }
        .btn.btn-primary{
            border-radius: 30px;
            background: #f3a333;
            color: #ffffff;
        }



        h1,h2,h3,h4,h5,h6{
            font-family: 'Roboto', sans-serif;
            color: #000000;
            margin-top: 0;
        }

        body{
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(0,0,0,.4);
        }

        a{
            color: #FFF;
            font-family: 'Montserrat', sans-serif;
        }

        p{
            font-family: 'Montserrat', sans-serif;
        }


        table{
        }

        .click_btn{
            border: 1px solid #fff;
            padding: 5px 15px;
        }
        /*LOGO*/

        .logo h1{
            margin: 0;
        }
        .logo h1 a{
            color: #000;
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
        }


        .hero{
            position: relative;
        }
        .hero img{

        }
        .hero .text{
            color: rgba(255,255,255,.8);
        }
        .hero .text h2{
            color: #750c32;
            font-size: 30px;
            margin-bottom: 0;
        }

        .bg_Second{
            background: #FFF;
        }

        .btn.btn-primary {
            background: #750c32;
        }

        /*HEADING SECTION*/
        .heading-section{
        }
        .heading-section h2{
            color: #FFF;
            font-size: 28px;
            margin-top: 0;
            line-height: 1.4;
        }
        .heading-section .subheading{
            margin-bottom: 20px !important;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #FFF;
            position: relative;
        }
        .heading-section .subheading::after{
            position: absolute;
            left: 0;
            right: 0;
            bottom: -10px;
            content: '';
            width: 100%;
            height: 2px;
            background: #750c32;
            margin: 0 auto;
        }

        .heading-section-white{
            color: rgba(255,255,255,.8);
        }
        .heading-section-white h2{
            font-size: 28px;
            font-family:
            line-height: 1;
            padding-bottom: 0;
        }
        .heading-section-white h2{
            color: #ffffff;
        }
        .heading-section-white .subheading{
            margin-bottom: 0;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #FFF;
        }


        .icon{
            text-align: center;
        }
        .icon img{
        }


        /*SERVICES*/
        .text-services{
            padding: 10px 10px 0;
            text-align: center;
        }
        .text-services h3{
            font-size: 20px;
            color: #FFF;
        }

        /*BLOG*/
        .text-services .meta{
            text-transform: uppercase;
            font-size: 14px;
        }

        /*TESTIMONY*/
        .text-testimony .name{
            margin: 0;
        }
        .text-testimony .position{
            color: rgba(0,0,0,.3);

        }


        /*VIDEO*/
        .img{
            width: 100%;
            height: auto;
            position: relative;
        }
        .img .icon{
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            bottom: 0;
            margin-top: -25px;
        }
        .img .icon a{
            display: block;
            width: 60px;
            position: absolute;
            top: 0;
            left: 50%;
            margin-left: -25px;
        }



        /*COUNTER*/
        .counter-text{
            text-align: center;
        }
        .counter-text .num{
            display: block;
            color: #ffffff;
            font-size: 34px;
            font-weight: 700;
        }
        .counter-text .name{
            display: block;
            color: rgba(255,255,255,.9);
            font-size: 13px;
        }


        /*FOOTER*/

        .footer{
            color: rgba(255,255,255,.5);

        }
        .footer .heading{
            color: #ffffff;
            font-size: 20px;
        }
        .footer ul{
            margin: 0;
            padding: 0;
        }
        .footer ul li{
            list-style: none;
            margin-bottom: 10px;
        }
        .footer ul li a{
            color: rgba(255,255,255,1);
        }


        @media screen and (max-width: 500px) {

            .icon{
                text-align: left;
            }

            .text-services{
                padding-left: 0;
                padding-right: 20px;
                text-align: left;
            }

        }

        .box_second{
            color: white;
            font-weight: bold;
        }

    </style>


</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
<center style="width: 100%; background-color: #f1f1f1;">
    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">

    </div>
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
        <!-- BEGIN BODY -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td class="bg_Second logo" style="padding: 1em 2.5em; text-align: center">
                    <h1><a href="<?php echo g('base_url');?>" target="_blank"><img src="<?php echo get_image($logo['logo_image_path'],$logo['logo_image']);?>"></a></h1>
                </td>
            </tr><!-- end tr -->
            <tr>
                <td valign="middle" class="hero" style="background-image: url('http://demo-designproficient.com/cpje-naplex-dev/assets/uploads/banner/slider1157778637396.jpg'); background-size: cover; ">
                    <table  style="background: rgba(255,255,255,0.7)">
                        <tr>
                            <td>
                                <div class="text" style="padding: 0 3em; text-align: center;">
                                    <h2>Thank you for your order !!!</h2>

                                    <h3>Your Access code is: <strong><?php echo $access_code;?></strong></h3>

                                    <!--<h4>Your access code is valid for ONE year (unlimited time reviews/retests)</h4>-->

                                    <h5>YOU WILL BE BANNED FROM OUR SERVER IF YOU SHARE YOUR ACCESS CODE TO OTHER PEOPLE</h5>

                                    <p style="color:#000">Log-in:Use Your Existing Credentials</p>

                                    <p style="color:#000">If you have any question, please let us know at <br/><br/>
                                        <a class="btn btn-primary" href="mailto:<?php echo g('db.admin.email');?>">
                                            <?php echo g('db.admin.email');?></a></p>

                                    <p></p>

                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->

            <tr>
                <td class="bg_white email-section">
                    <div class="heading-section" style="text-align: center; padding: 0 30px;">
                        <span class="subheading">Access Code?</span>
                        <h2>How to Use the Access Code?</h2>

                    </div>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody><tr>
                            <td valign="top" width="50%" style="padding-top: 20px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">

                                    <tbody>
                                    <?php
                                    foreach ($order_item as $key=>$value):
                                        $exam_list = $this->model_exam_list->get_product_exam($value['product_id']);
                                        ?>
                                        <tr>
                                            <td class="box_second">
                                                <p><h3><?php echo $value['product_name'];?></h3></p>
                                                <?php
                                                foreach ($exam_list as $key1=>$value1):?>
                                                    <p><?php echo $value1['exam_list_title'];?> ----- <?php echo $value1['exam_count'] . " Questions";?> <!--<a href="<?php /*echo g('base_url');*/?>customer-portal">Click here to take the test</a>--> </p>
                                                <?php endforeach;
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody></table>
                </td>
            </tr>

            <!-- 1 Column Text + Button : END -->
        </table>
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td valign="middle" class="bg_black footer email-section">
                    <table>
                        <tr>
                            <td valign="top" width="100%" style="padding-top: 20px;">
                                <p>MPJE is federally registered trademark owned by the National Association of Boards of Pharmacy (NABP), PreMPJE.com web site is in no way authorized or sponsored by the NABP . </p>
                                <p>
                                    Our questions are solely derived from the different resources, which do not include
                                    previously asked questions. However, it may have the same kind of questions because we have
                                    used the same resources recommended by NABP or American universities.
                                </p>
                            </td>


                        </tr>
                    </table>
                </td>

            </tr>
        </table>
        </td>
        </tr><!-- end: tr -->
        </table>

    </div>
</center>
</body>
</html>