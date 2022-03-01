@extends('frontend.layout.main')
@section('content')
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content">
                <h2>Chi tiết bác sĩ</h2>
                <ul class="pages-list">
                    <li><a href="index.html">Trang chủ</a></li>
                    <li>Chi tiết bác sĩ</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="dentist-details-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="dentist-details-image">
                        <img src="{{ asset($doctor->avatar)}}" alt="image">
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="dentist-details-content">
                        <h3>
                            <a href="#">Dr. {{ $doctor->name }}</a>
                        </h3>
                        <span>{{ $doctor->position}}</span>
                        <div class="share-link">
                            <a href="https://www.facebook.com/" target="_blank"><i class="bx bxl-facebook"></i></a>
                            <a href="https://twitter.com/?lang=en" target="_blank"><i class="bx bxl-twitter"></i></a>
                            <a href="https://www.linkedin.com/" target="_blank"><i class="bx bxl-linkedin"></i></a>
                            <a href="https://www.instagram.com/" target="_blank"><i class="bx bxl-instagram"></i></a>
                        </div>
                        <div class="content-overview">
                            {!!$doctor->certificate!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="dentist-details-overview-content">
                {!!$doctor->description!!}
            </div>
        </div>
    </section>
@endsection
