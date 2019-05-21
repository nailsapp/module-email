<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>{{email_subject}}</title>
    <style type="text/css">
        img {
            max-width: 100%;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            line-height: 1.6em;
            background-color: #f6f6f6;
        }

        .btn,
        .button {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            box-sizing: border-box;
            font-size: 14px;
            color: #FFF;
            text-decoration: none;
            line-height: 2em;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
            text-transform: capitalize;
            background-color: #348eda;
            margin: 0;
            border-color: #348eda;
            border-style: solid;
            border-width: 10px 20px;
        }

        .btn-block,
        .button-block {
            width: 100%;
        }

        h1 {
            font-weight: 800 !important;
            margin: 20px 0 5px !important;
        }

        h2 {
            font-weight: 800 !important;
            margin: 20px 0 5px !important;
        }

        h3 {
            font-weight: 800 !important;
            margin: 20px 0 5px !important;
        }

        h4 {
            font-weight: 800 !important;
            margin: 20px 0 5px !important;
        }

        h1 {
            font-size: 22px !important;
        }

        h2 {
            font-size: 18px !important;
        }

        h3 {
            font-size: 16px !important;
        }

        .container {
            padding: 0 !important;
            width: 100% !important;
        }

        .content {
            padding: 0 !important;
        }

        .content-wrap {
            padding: 10px !important;
        }

        .content-wrap .table {
            border: 1px solid #bbb;
            width: 100%;
            padding: 0;
            border-spacing: 0;
            border-collapse: collapse;
        }

        .content-wrap .table tbody tr td {
            padding: 0.5rem;
        }

        .content-wrap .table.table--list tbody tr td {
            border-bottom: 1px solid #eee;
        }

        .content-wrap .table.table--list tbody tr td:first-child {
            background: #ccc;
            border-right: 3px solid #bbb;
            border-bottom: 1px solid #bbb;
            padding-right: 1rem;
            vertical-align: top;
            font-weight: bold;
        }

        .content-wrap .table.table--list tbody tr:last-child td {
            border-bottom: 1px solid #bbb;
        }

        @media only screen and (max-width: 640px) {
            body {
                padding: 0 !important;
            }
        }
    </style>
</head>

<body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
<table class="body-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
        <td class="container" width="600" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
            <div class="content" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                        <td class="alert alert-header" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #4a4a4a; margin: 0; padding: 20px;" align="center" bgcolor="#FF9F00" valign="top">
                            {{email_subject}}
                        </td>
                    </tr>
                    <?php
                    if (\Nails\Environment::not(\Nails\Environment::ENV_PROD)) {
                        ?>
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="alert alert-warning" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; background-color: #FF9F00; margin: 0; padding: 20px;" align="center" bgcolor="#FF9F00" valign="top">
                                This email was sent from a testing environment.
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                        <td class="content-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                            {{#sentTo.first_name}}
                            <p>Hi {{sentTo.first_name}},</p>
                            {{/sentTo.first_name}}
                            {{^sentTo.first_name}}
                            <p>Hi,</p>
                            {{/sentTo.first_name}}
