<!-- begin::Quick Nav -->

<!--begin::Global Theme Bundle -->
<script src="{{ asset('backend/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Vendors -->
<script src="{{ asset('backend/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts -->
<script src="{{ asset('backend/demo/default/custom/crud/datatables/basic/basic.js')}}" type="text/javascript"></script>

<!--end::Page Scripts -->
{{-- bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
{{-- bootstrap --}}
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="{{ asset('backend/demo/default/custom/crud/forms/widgets/bootstrap-switch.js')}}" type="text/javascript"></script>
{{-- Tinymce --}}
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script>tinymce.init({selector:'#editor'});</script>
<script>tinymce.init({selector:'#editor1'});</script>
<script>
    $(document).ready(function () {
        $('#table_id').DataTable();
        $('#table_id_1').DataTable();
    });
</script>

{{-- sweetalert --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
@if (Session::has('success'))
    <script>
        swal("{!! Session::get('success') !!}", "", "success",{
            button: "OK",
        })
    </script>
@endif
@if (Session::has('warning'))
    <script>
        swal("{!! Session::get('warning') !!}", "", "warning",{
            button: "OK",
        })
    </script>
@endif
@if (Session::has('toastrSuccess'))
    <script>
        toastr.success("{!! Session::get('toastrSuccess') !!}");
    </script>
@endif
@if (Session::has('toastrWarning'))
    <script>
        toastr.warning("{!! Session::get('toastrWarning') !!}");
    </script>
@endif
<script>
    toastr.options = {
        // thay đổi nội dung hiển thị trên nút close, vd như "Đóng"
        "closeButton": true,
        "progressBar": true,
        // thay đổi vị trí của notification
        "positionClass": "toast-bottom-left",
        // thời gian, hiệu ứng hiển thị và ẩn
        "showDuration": "200",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "slideDown",
        "hideMethod": "slideUp"
        }
</script>
{{-- sweetalert --}}

{{-- bootbox --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script>
    function confirmRemove(url){
        bootbox.confirm({
            message: "Bạn có chắc chắn muốn xóa !",
            className: 'font-weight-bold text-center',
            buttons: {
                confirm: {
                    label: 'Đồng ý',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Hủy',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if(result){
                    window.location.href = url;
                }
            }
        });
    }

    var msg = '{{Session::get('alert')}}';
    bootbox.dialog({
        message: '{{Session::get('alert')}}',
        className: 'font-weight-bold text-danger text-center',
    });

</script>
