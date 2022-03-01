{{--@extends('frontend.layout.main')--}}
{{--@section('content')--}}
{{--    <div class="container mt-5 mb-5">--}}
{{--        <h4>Họ và Tên: {{$data_oder[0]['name']}}</h4>--}}
{{--        <h4>Số điện thoại: {{$data_oder[0]['phone_number']}}</h4>--}}
{{--        <table class="table table-striped mt-4">--}}
{{--            <tbody>--}}
{{--            <tr>--}}
{{--                <th scope="row">STT</th>--}}
{{--                <td scope="row">Dịch vụ khám</td>--}}
{{--                <td scope="row">Giá tiền</td>--}}
{{--                <td scope="row">Ngày đặt</td>--}}
{{--            </tr>--}}
{{--                @foreach ($data_oder as $data)--}}
{{--                    <tr>--}}
{{--                        <th scope="row">{{ $loop->iteration }}</th>--}}
{{--                        <td scope="row">--}}
{{--                            @foreach($data->services as $s)--}}
{{--                                - {{$s->name}}</br>--}}
{{--                            @endforeach--}}
{{--                        </td>--}}
{{--                        <td scope="row">{{number_format($data->price, 0, '', ',')}} vnd</td>--}}
{{--                        <td scope="row">{{$data->created_at}}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--            </tbody>--}}
{{--          </table>--}}
{{--    </div>--}}
{{--@endsection--}}
{{--{{json_decode($bsd->load('bookingServices')->booking_services)->services_id}}--}}
{{--$d = (json_decode($bsd->load('bookingServices')->bookingServices)->services_id)--}}

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
            <div class="appointment-form">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Mã đơn</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Dịch vụ khám</th>
                        <th scope="col">Giá tiền</th>
                        <th scope="col">Ngày đăng ký</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data_oder as $data)
                        <tr>
                            <th scope="row">{{$data->booking_code}}</th>
                            <td>{{$data->name}}</td>
                            <td>{{$data->phone_number}}</td>
                            <td>
                                @foreach($data->services as $s)
                                    - {{$s->name}}</br>
                                @endforeach
                            </td>
                            <td>{{$data->price}}</td>
                            <td>{{$data->created_at}}</td>
                            <td>
                                <a style="display: inline-block;
                                background-color: #06a3da;
                                color: #fff;
                                padding: 15px 25px;
                                font-size: 15px;
                                font-weight: 500;
                                -webkit-transition: .6s;
                                transition: .6s;
                                border-radius: 5px;" href="">Xem chi tiết</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="appointment-form">
            <div class="row">
                <span>dịch vụ chờ khám</span>
                @foreach($data_oder as $item)
                    @if($item->bookingServices)
                        @foreach($item->bookingServices as $bs)
                            <div class="col-6">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Dịch vụ</th>
                                        <th scope="col">Bác sĩ</th>
                                        <th scope="col">Thời gian bắt đầu</th>
                                        <th scope="col">Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{json_decode($bs->load('services')->services)->name}}</td>
                                        <td>{{empty(json_decode($bs->load('doctor')->doctor)->name) ? "" : json_decode($bs->load('doctor')->doctor)->name}}</td>
                                        <td>{{$bs->start_date}}</td>
                                        <td>@if($bs->status == 5) Chờ xếp lịch @elseif($bs->status == 6) Đã xếp lịch @elseif($bs->status == 8) Đã khám @endif</td>
                                    </tr>
                                    <!--                                --><?php
                                    //                                    print_r($bs->load('services')->services);
                                    //                                 ?>
                                    {{--                                    @foreach (json_decode($bs->load('services')->doctor->name) as $value)--}}
                                    {{--                                        {{$value}}--}}
                                    {{--                                    @endforeach--}}
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
        <div class="appointment-form">
            <div class="row">
                <span>Khám định kỳ</span>
                @foreach($data_oder as $item)
                    @if($item->bookingSchedule)
                        @foreach($item->bookingSchedule as $bsd)
                            <div class="col-6">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Dịch vụ</th>
                                        <th scope="col">Bác sĩ</th>
                                        <th scope="col">Thời gian bắt đầu</th>
                                        <th scope="col">Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{\App\Models\Services::where(['id' => json_decode($bsd->load('bookingServices')->bookingServices)->services_id])->first()->name}}</td>
                                        <td>{{empty(json_decode($bsd->load('doctor')->doctor)->name) ? "" : json_decode($bsd->load('doctor')->doctor)->name}}</td>
                                        <td>{{$bsd->start_date}}</td>
                                        <td>@if($bsd->status == 9) chờ khám @elseif($bsd->status == 10) Đã khám @endif</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
{{--{{json_decode($bsd->load('bookingServices')->booking_services)->services_id}}--}}
{{--$d = (json_decode($bsd->load('bookingServices')->bookingServices)->services_id)--}}
