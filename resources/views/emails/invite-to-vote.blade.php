<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tempo-Responsive Email Template</title>

    <style type="text/css">
        /* Client-specific Styles */
        div, p, a, li, td { -webkit-text-size-adjust:none; }
        #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
        html{width: 100%; }
        body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
        /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
        .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing. */
        #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
        img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
        a img {border:none;}
        .image_fix {display:block;}
        p {margin: 0px 0px !important;}
        table td {border-collapse: collapse;}
        table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
        a {color: #33b9ff;text-decoration: none;text-decoration:none!important;}
        /*STYLES*/
        table[class=full] { width: 100%; clear: both; }
        /*IPAD STYLES*/
        @media only screen and (max-width: 640px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: #33b9ff; /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }
            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: #33b9ff !important;
                pointer-events: auto;
                cursor: default;
            }
            table[class=devicewidth] {width: 440px!important;text-align:center!important;}
            table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
            img[class=banner] {width: 440px!important;height:220px!important;}
            img[class=col2img] {width: 440px!important;height:220px!important;}


        }
        /*IPHONE STYLES*/
        @media only screen and (max-width: 480px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: #33b9ff; /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }
            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: #33b9ff !important;
                pointer-events: auto;
                cursor: default;
            }
            table[class=devicewidth] {width: 280px!important;text-align:center!important;}
            table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
            img[class=banner] {width: 280px!important;height:140px!important;}
            img[class=col2img] {width: 280px!important;height:140px!important;}


        }
    </style>

</head>
<body>
<!-- Start of header -->
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
    <tbody>
    <tr>
        <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                <tbody>
                <tr>
                    <td width="100%">
                        <table width="600" bgcolor="#eacb3c" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                            <tbody>
                            <tr>
                                <td>
                                    <!-- logo -->
                                    <table bgcolor="#282828" width="140" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                        <tbody>
                                        <tr>
                                            <td width="140" height="50" align="center">
                                                <div class="imgpop">
                                                    <a target="_blank" href="{{route('vote.index')}}">
                                                        STAT FUT CITY
                                                      <!--  <img src="https://litmus-builder.s3.amazonaws.com/1426192161068" alt="" border="0" width="140" height="50" style="display:block; border:none; outline:none; text-decoration:none;">-->
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- end of logo -->
                                    <!-- start of menu -->
                                    <table bgcolor="#eacb3c" width="250" height="50" border="0" align="right" valign="middle" cellpadding="0" cellspacing="0" border="0" class="devicewidth">
                                        <tbody>
                                        <tr>
                                            <td height="50" align="center" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #282828" st-content="menu">
                                                <a style="text-decoration: none;color: #282828; text-align:center;" target="_blank" href="{{route('vote.index')}}">JE VOTE</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- end of menu -->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!-- End of Header -->