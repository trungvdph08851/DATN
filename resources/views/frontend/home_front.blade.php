@extends('frontend.layout.main')
@section('content')
    <div class="others-option-for-responsive">
        <div class="container">
            <div class="dot-menu">
                <div class="inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>
            <div class="container">
                <div class="option-inner">
                    <div class="others-options d-flex align-items-center">
                        <div class="option-item">
                            <div class="search-btn">
                                <a class="#" href="#searchmodal" data-bs-toggle="modal"
                                    data-bs-target="#searchmodal">
                                    <i class="flaticon-search"></i>
                                </a>
                            </div>
                        </div>
                        <div class="option-item">
                            <div class="navbar-btn">
                                <a href="appointment.html" class="default-btn">Đặt Lịch</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade fade-scale searchmodal" id="searchmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <i class='bx bx-x'></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="modal-search-form">
                        <input type="search" class="search-field" placeholder="Search...">
                        <button type="submit"><i class='bx bx-search-alt'></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="home-slides owl-carousel owl-theme">
        @foreach ($slider as $sl)
            <div class="main-slides-item">
                <img src="{{ $sl->image }}" alt="" >
                <div class="container"
                    style=" position: absolute;top: 40%;left: 50%;transform: translate(-50%, -50%);font-size: 18px;">
                    <div class="main-slides-content">
                        <span class="sub-title" style="font-size:18px">
                            <i class="flaticon-hashtag-symbol"></i>
                            {{ $sl->title }}
                        </span>
                        <h1 style="font-size:80px">{{ $sl->title }}</h1>
                        <p style="font-size:20px">{{ $sl->description }}</p>
                        <div class="slides-btn">
                            <a href="appointment.html" class="default-btn">Đặt Lịch Khám</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




    <section class="services-area pb-70">
        <div class="container">
            <div class="row align-items-center mt-3">
                <div class="col-lg-7">
                    <div class="section-title-warp">
                        <span class="sub-title">
                            <i class="flaticon-hashtag-symbol"></i>
                            Dịch vụ
                        </span>
                        <h2>Dịch vụ thế mạnh</h2>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="section-warp-btn">
                        <a href="{{ route('service_list') }}" class="default-btn">Tất cả</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($Servicess as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-services">
                            <div class="services-image">
                                <a href="{{ route('service_detail', ['id' => $item->id]) }}"><img
                                        src="{{ asset($item->image) }}" style="height: 300px" alt="image"></a>
                                <div class="icon">
                                    <a href="services-details.html"><i class="flaticon-dental-care"></i></a>
                                </div>
                            </div>
                            <div class="services-content">
                                <h3>
                                    <a href="services-details.html">{{ $item->name }}</a>
                                </h3>
                                <p>{{ truncate($item->title, 100) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
   
    <section class="about-area pb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="about-content">
                        <span class="sub-title">
                            <i class="flaticon-hashtag-symbol"></i>
                            Nha khoa Đông Anh
                        </span>
                        <h3>Khách hàng đến khám sẽ nhận được sự chắm sóc của bác sĩ và các dịch vụ nha khoa chất lượng
                            <span>của Nha khoa Đông Anh</span>
                        </h3>
                        <div class="row mt-2">
                        </div>
                        {{-- <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <ul class="about-list">
                                    @foreach ($Servicess as $sv)
                                        <li>
                                            
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="about-info">
                                    <i class="flaticon-caduceus"></i>
                                    <h4>5 năm </h4>
                                    <span>Thành lập phát triển</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="about-info">
                                    <i class="flaticon-chair"></i>
                                    <h4>6405+</h4>
                                    <span>Phục vụ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="about-image">
                        <img src="{{ asset('doctor.png') }}" width="500px" alt="image">
                    </div>
                </div>
            </div>          
        </div>
    </section>
    <section class="doctor-area pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="section-title-warp">
                        <span class="sub-title">
                            <i class="flaticon-hashtag-symbol"></i>
                            Bác sĩ
                        </span>
                        <h2>Bác sĩ chuyên khoa trong lĩnh vực răng miệng</h2>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-warp-btn">
                        <a href="{{ route('list.doctor')}}" class="default-btn">Tất cả</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($doctors as $dts)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-doctor">
                            <a href="{{ route('detail.doctor', ['id' => $dts->id])}}"><img src="{{ $dts->avatar }}" alt="image" style="width:400px"></a>
                            <div class="doctor-content">
                                <h3>
                                    <a href="{{ route('detail.doctor', ['id' => $dts->id])}}">{{ $dts->name }}</a>
                                </h3>
                                <p style=" margin-left: 10px; font-size: 13px">
                                    {{ truncate($dts->position, 50) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Bài viết --}}
    <section class="doctor-area pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="section-title-warp">
                        <span class="sub-title">
                            <i class="flaticon-hashtag-symbol"></i>
                            Bài viết
                        </span>
                        <h2>Bài viết mới nhất</h2>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-warp-btn">
                        <a href="{{ route('baiviet_list') }}" class="default-btn">Tất cả</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($Article_new as $at_new)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-doctor">
                            <a href="{{ $at_new->url }}"><img src="{{ asset('img') }}/{{ $at_new->avatar }}"
                                    alt="image" width="100%" ;height="300px"></a>
                            <div class="doctor-content">
                                <h3>
                                    <a href="{{ $at_new->url }}">{{ truncate($at_new->title, 50) }}</a>
                                </h3>
                                {{-- <span>Prosthodontics Dentist</span> --}}
                                <div class="share-link">
                                    {{-- <a href="https://www.facebook.com/" target="_blank"><i class='bx bxl-facebook'></i></a> --}}
                                    {{-- <a href="https://twitter.com/?lang=en" target="_blank"><i --}}
                                    {{-- class='bx bxl-twitter'></i></a> --}}
                                    {{-- <a href="https://www.linkedin.com/" target="_blank"><i class='bx bxl-linkedin'></i></a> --}}
                                    {{-- <a href="https://www.instagram.com/" target="_blank"><i --}}
                                    {{-- class='bx bxl-instagram'></i></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
{{-- 1 --}}
