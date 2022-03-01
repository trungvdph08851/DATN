<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Đơn khám mới</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
        }
        .logo{
            width: 100%;
            text-align: center;
            padding-top: 15px;
            padding-bottom: 10px;
            background: #00d1fa1f;
        }
        .title-block{
            font-weight: 500;
        }
        .information{
            padding: 5px 0px;
        }
        .click{
            box-sizing: border-box;
            border-collapse: collapse;
            border: 2px dashed #0ecef1;
            width: 90%;
            text-align: center;
            padding: 20px;
            margin: 20px auto;
        }
        .click a{
            text-decoration: none;
            box-sizing: border-box;
            display: inline-block;
            background-image: initial;
            background-size: initial;
            background-origin: initial;
            background-clip: initial;
            background-color: #0ecef1;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
            border-bottom-left-radius: 0px;
            font-size: 18px;
            font-family: roboto,'helvetica neue',helvetica,arial,sans-serif;
            font-weight: normal;
            font-style: normal;
            line-height: 120%;
            text-decoration-line: none;
            text-decoration-style: initial;
            text-decoration-color: initial;
            width: auto;
            text-align: center;
            color: #ffffff;
            border-width: 10px 20px 10px 20px;
            border-color: #0ecef1;
            border-style: solid;
        }
    </style>
</head>
<body itemscope itemtype="http://schema.org/EmailMessage" style="margin: 0; padding: 0;background: #8080800d;">

<table  align="center"  cellpadding="0" cellspacing="0" width="700" style="border-collapse: collapse;background: #fff;">
    
    <tr>
        
        <td class="container" width="700">
            <div class="logo">
                <img  src="{{asset('logo.png')}}" alt="">
            </div>
            <div class="content">
                <table class="main" width="100%" style="padding-left: 15px;" cellpadding="0" cellspacing="0" itemprop="action" itemscope>
                    <tr>
                        <td class="content-wrap">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="content-block">
                                        <p class="title-block" style="font-size: 20px;padding: -5px 0px !important;">Thông báo có đơn đặt khám mới: </p>
                                    </td>
                                </tr>
                                <tr>
                                    <table>
                                        <tr>
                                            <td class="information" style="text-transform: uppercase;">Họ tên: {{$msg['nam']}}   </td>
                                        </tr>
                                        <tr>
                                            <td class="information">Số điện thoại: {{$msg['phone']}}</td>
                                        </tr>
                                        <tr>
                                            <td >Dịch vụ:</td>
                                            <td>
                                                @foreach($msg['service'] as $name)
                                                    <tr>
                                                        <td class="information" style="font-weight: bolder;">- Tên: {{$name->services->name}}</td> <td  style="padding-right: 20px;font-weight: bolder; " >Thời gian: {{$name->services->time}} phút</td><td style="font-weight: bolder;">Giá tiền: {{ number_format($name->services->price) }}.vnđ</td>
                                                    </tr>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </table>
                                </tr>
                            </table>
                            <div class="click">
                                <a href="{{$msg['link']}}" class="">Xem chi tiết</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td>
        </td>
    </tr>

</table>

</body>
</html>
