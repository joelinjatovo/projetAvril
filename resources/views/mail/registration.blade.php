<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@lang('mail.registration.metatitle')</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" valign="top">
            <img src="{{ $message->embed('public/images/logo.png') }}" style="display:block;">
        </td>
    </tr>
    <tr>
        <td align="center" valign="top" bgcolor="#f1f69d" style="background-color:#f1f69d; font-family:Arial,sans-serif; font-size:13px; color:#000000; padding:10px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
                <tr>
                    <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#525252;">
                        <div style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:16px; color:#000000;">@lang('mail.registration.title')</div>
                        <div style="font-size:12px;"><br>
                            <div><span style="font-weight: bold;">Numero d'inscription : </span>{{ $item->id }}</div><br>
                            <div><span style="font-weight: bold;">@lang('mail.login')  : </span>{{ $item->login }}</div><br>
                            <div><span style="font-weight: bold;">@lang('mail.password') : </span>{{ $item->password }}</div><br><br>
                            @lang('mail.registration.foot') <a href="{{route('login')}}">@lang('mail.registration.clic_here')</a>
                            <br>
                            <br>
                        </div>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td align="left" valign="top" bgcolor="#478730" style="background-color:#478730;">
            <table width="100%" border="0" cellspacing="0" cellpadding="15">
                <tr>
                    <td align="left" valign="top" style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px;">
                        Investir en Australie<br>
                        Contact Person <br>
                        Phone: (123) 456-789 <br>
                        Email: <a href="mailto:name@yourcompanyname.com" style="color:#ffffff; text-decoration:none;">iea@contact.com</a><br>
                        Website: <a href="http://www.yourcompanyname.com" target="_blank" style="color:#ffffff; text-decoration:none;">www.investir-en-australie.com</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
