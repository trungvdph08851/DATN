<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Page Not Found</title>
    <link href='https://fonts.googleapis.com/css?family=Anton|Passion+One|PT+Sans+Caption' rel='stylesheet' type='text/css'>
    <link href="{{asset('backend/errors/404.css')}}" rel="stylesheet">
</head>

<body>

    <!-- Error Page -->
        <div class="error">
            <div class="container-floud">
                <div class="col-xs-12 ground-color text-center">
                    <div class="container-error-404">
                        <div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
                        <div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
                        <div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
                        <div class="msg">OH!<span class="triangle"></span></div>
                    </div>
                    <h2 class="h1">Xin lỗi! Không tìm thấy trang</h2>
                    <h2 class="h1"><a href="{{ url()->previous() }}">Quay lại</a></h2>
                </div>
            </div>
        </div>
    <!-- Error Page -->
</body>
<script src="{{asset('backend/errors/404.js')}}"></script>
</html>