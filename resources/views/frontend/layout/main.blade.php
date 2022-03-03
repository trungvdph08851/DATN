<!doctype html>
<html lang="zxx">

<!-- Mirrored from templates.hibootstrap.com/grin/default/appointment.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Oct 2021 03:04:19 GMT -->

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nha khoa Đông Anh</title>
    <link rel="icon" type="image/png" href="{{ asset('logoUrl.png') }}">
    @include('frontend.layout.style')
    <style>
        .section-title {
            max-width: 900px;
        }
    </style>
</head>
<body>
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "100957151675096");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <div class="preloader">
        <div class="loader">
            <div class="sbl-half-circle-spin"></div>
        </div>
    </div>
    @include('frontend.layout.header')

    @yield('content')


    @include('frontend.layout.footer')


    @include('frontend.layout.script')

    <!-- Messenger Plugin chat Code -->
    
    @yield('script')
    
</body>

<!-- Mirrored from templates.hibootstrap.com/grin/default/appointment.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Oct 2021 03:04:19 GMT -->

</html>
