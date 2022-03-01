@extends('frontend.layout.main')
@section('content')
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content">
                <h2>Đăt lịch khám</h2>
                <ul class="pages-list">
                    <li><a href="index.html">Trang chủ</a></li>
                    <li>Đặt lịch khám</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="features-area-two pt-100 pb-70">
        <div class="container">
            <div class="row ">
                <div class="col-lg-4 col-sm-6">
                    <div class="single-features-box">
                        <div class="content">
                            <div class="icon">
                                <i class="flaticon-caduceus"></i>
                            </div>
                            <h3>
                                <a href="services-details.html">Chất lượng nha khoa</a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single-features-box">
                        <div class="content">
                            <div class="icon">
                                <i class="flaticon-diamond"></i>
                            </div>
                            <h3>
                                <a href="services-details.html">Kinh nghiệm</a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single-features-box">
                        <div class="content">
                            <div class="icon">
                                <i class="flaticon-hospitalisation"></i>
                            </div>
                            <h3>
                                <a href="services-details.html">Chăm sóc bệnh nhân</a>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="appointment-area bg-image ptb-100">
        <div class="container">
            <div class="appointment-form">
                <h4><i class="flaticon-calendar"></i>Đặt lịch khám</h4>
                <form action="" id="form_booking" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="0" name="status">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Tên">

                                <div id="name_err" class="form-text text-danger"></div>

                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone_number" placeholder="Số điện thoại">

                                <div id="phone_number_err" class="form-text text-danger"></div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <select class="form-control" id="select_two" name="services_id[]" multiple="multiple">
                                    @foreach ($services as $services)
                                        <option value="{{$services->id}}">{{$services->name}}</option>
                                    @endforeach
                                </select>

                                <div id="service_err" class="form-text text-danger"></div>

                            </div>
                            <div class="">
                                <textarea class="form-control" name="note" id="" cols="30" rows="5"
                                    placeholder="Ghi chú"></textarea>

                                <div id="note_err" class="form-text text-danger"></div>

                            </div>
                        </div>
                    </div>

                    <button class="default-btn">
                        <div id='loader' style='display: none; float: left'>
                        <img src="http://127.0.0.1:8000/img/loading.gif" alt="" width="20px">
                        </div>
                        Đặt lịch khám
                    </button>

                </form>
            </div>
        </div>
        </div>
    </section>

@endsection
@section('script')
    <script type="text/javascript">
    $('#select_two').select2({
        maximumSelectionLength: 2,
        placeholder: 'Chọn dịch vụ khám',
    });
  </script>
    <script>
        $(document).ready(function() {
            $('#form_booking').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url : "{{route('booking')}}",
                    method : 'POST',
                    data : new FormData(this),
                    dataType : 'JSON',
                    contentType : false,
                    cache : false,
                    processData : false,
                    beforeSend: function(){
                        $("#loader").show();
                        $('button').prop('disabled', true);
                    },
                    complete:function(){
                        $("#loader").hide();
                        $('button').prop('disabled', false);
                    },
                    success : function (response){
                        console.log(response);
                        if(response){
                            $('#form_booking')[0].reset();
                            window.location.href = response.data.redirect;
                        }
                    },
                    error : function (response){
                        $('#name_err').text(response.responseJSON.errors.name);
                        $('#phone_number_err').text(response.responseJSON.errors.phone_number);
                        $('#service_err').text(response.responseJSON.errors.services_id);
                        $('#note_err').text(response.responseJSON.errors.note);
                    }
                })
            })
            });
    </script>
@endsection
