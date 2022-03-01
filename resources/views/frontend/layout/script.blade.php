<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>

    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>

    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('frontend/js/jquery.meanmenu.js') }}"></script>

    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('frontend/js/jquery.appear.js') }}"></script>

    <script src="{{ asset('frontend/js/odometer.min.js') }}"></script>

    <script src="{{ asset('frontend/js/nice-select.min.js') }}"></script>

    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>

    <script src="{{ asset('frontend/js/form-validator.min.js') }}"></script>

    <script src="{{ asset('frontend/js/contact-form-script.js') }}"></script>

    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>

    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- select 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>

    @if (Session::has('success'))
        <script>
            swal("Thành công !", "{!! Session::get('success') !!}", "success",{
                button: "OK",
            })
        </script>
    @endif
@if (Session::has('error'))
    <script>
        swal("Thông tin không chính xác !", "{!! Session::get('error') !!}", "error",{
            button: "OK",
        })
    </script>
@endif
    <script src="{{asset('vendors/wizard/jquery.validate.min.js')}}"></script>
