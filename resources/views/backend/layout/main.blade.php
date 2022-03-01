
<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>Phòng khám nha khoa</title>
		<meta name="description" content="Basic datatables examples">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		
		@include('backend.layout.style')
		<link rel="shortcut icon" href="{{ asset('logoUrl.png')}}" />
		@yield('addStyle')
		<style>
			*{
				font-family: 'Roboto', sans-serif;
				font-size: 14px;
			}
			.m-form .form-control-label, .m-form .col-form-label, .m-form .m-form__group>label{
				font-size: 16px !important;
				font-family: 'Roboto', sans-serif !important;
			}
			.m-portlet__head-text{
				font-weight: bold !important;
				font-size: 25px !important;
				font-family: 'Roboto', sans-serif !important;
			}
			
		</style>
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

			@include('backend.layout.header')

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

				@include('backend.layout.sidebar')

				<div class="m-grid__item m-grid__item--fluid m-wrapper">
				
                    @yield('content')
					
				</div>
			</div>

			<!-- end:: Body -->

            @include('backend.layout.footer')
		</div>

		<!-- end:: Page -->


		<!-- end::Quick Sidebar -->

		<!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>

		<!-- end::Scroll Top -->

	

		@include('backend.layout.script')
		@yield('script')
		@yield('addScript')
	</body>

	<!-- end::Body -->
</html>