<!-- header1 -->
<div class="top-header-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <ul class="top-header-information">
                    <li>
                        <i class='bx bxs-map'></i>
                        {{$setting->address}}
                    </li>
                    <li>
                        <i class='bx bx-envelope-open'></i>
                        <a
                            href="https://templates.hibootstrap.com/cdn-cgi/l/email-protection#e5969095958a9791a582978c8bcb868a88"><span
                                class="__cf_email__"
                                data-cfemail="cebdbbbebea1bcba8ea9bca7a0e0ada1a3">[email&#160;{{$setting->email_contact}}]</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-12">
                <ul class="top-header-optional">
                    <li>
                        <a href="{{$setting->social_fb}}" target="_blank">
                            <i class='bx bxl-facebook'></i>
                        </a>
                        <a href="{{$setting->social_yt}}" target="_blank">
                            <i class='bx bxl-youtube'></i>
                        </a>
                        <a href="{{$setting->social_instagram}}" target="_blank">
                            <i class='bx bxl-instagram'></i>
                        </a>
                    </li>
                    <li class="languages-list">
                        <!-- <select>
<option value="1">English</option>
<option value="2">العربيّة</option>
<option value="3">Deutsch</option>
<option value="3">Português</option>
<option value="3">简体中文</option>
</select> -->
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- header2 -->
<div class="middle-header-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-12">
                <div class="middle-header">
                    <h1>
                        <a href="/">
                            <img src="{{ asset($setting->logo)}}" width="150px" alt="">
                        </a>
                    </h1>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <ul class="middle-header-content">
                    <li>
                        <i class="flaticon-emergency-call"></i>
                        Liên Lạc
                        <span><a href="tel:088123654987">{{$setting->hotline}}</a></span>
                    </li>
                    <li>
                        <i class="flaticon-wall-clock"></i>
                        Mở Cửa
                        <span>{{$setting->operating_hours}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="navbar-area">
    <div class="main-responsive-nav">
        <div class="container">
            <div class="main-responsive-menu">
                <div class="logo">
                    <a href="index.html">
                        <img src="{{ asset($setting->logo)}}" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="main-navbar">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('home')}}" class="nav-link active">
                                Trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/gioi-thieu-nha-khoa-dong-anh.html" class="nav-link">Giới thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('list.doctor')}}" class="nav-link">Bác sĩ</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('service_list')}}" class="nav-link">
                                Dịch vụ
                                <i class='bx bx-caret-down'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    @foreach($servicess as $service)
                                     <a href="{{route('service_detail',   $service->id)}}" >{{$service->name}}</a>
                                    @endforeach
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('baiviet_list')}}" class="nav-link">
                                Bài viết
                                <i class='bx bx-caret-down'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    @foreach($categories as $ctgr)
                                        <a href="/bai-viet/{{create_slug($ctgr->url_name)}}" >{{$ctgr->name}}</a>
                                    @endforeach
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                    <div class="others-options d-flex align-items-center">
                        <div class="option-item">
                            <div class="navbar-btn">
                                <a class="default-btn" href="#searchmodal" data-bs-toggle="modal"
                                    data-bs-target="#searchmodal">
                                    <i class="flaticon-search"></i>
                                </a>
                            </div>
                        </div>
                        <div class="option-item">
                            <div class="navbar-btn">
                                <a href="{{route('booking')}}" class="default-btn">Đặt Lịch</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
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
                                    Lịch khám
                                </a>
                            </div>
                        </div>
                        <div class="option-item">
                            <div class="navbar-btn">
                                <a href="appointment.html" class="default-btn">Đặt lịch</a>
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
                <form class="modal-search-form" action="{{route('search.prescription')}}" method="post">
                    @csrf
                    <input type="search" name="phone_or_cmnn" class="search-field" placeholder="Tìm kiếm đơn khám của bạn">
                    <button type="submit" name="submit"><i class='bx bx-search-alt'></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
{{--1--}}
