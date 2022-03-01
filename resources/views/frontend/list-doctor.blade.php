@extends('frontend.layout.main')
@section('content')
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content">
                <h2>Bác sĩ nha khoa</h2>
                <ul class="pages-list">
                    <li><a href="{{ route('home')}}">Trang chủ</a></li>
                    <li>Bác sĩ nha khoa</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="doctor-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">
                    <i class="flaticon-hashtag-symbol"></i>
                    Nha sĩ của chúng tôi
                </span>
                <h2>Nha sĩ chuyên ngành và giàu kinh nghiệm của chúng tôi</h2>
            </div>
            <div class="row">
                @foreach ($doctor as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-doctor">
                            <a href="{{ route('detail.doctor', ['id' => $item->id])}}"><img src="{{ asset($item->avatar)}}" alt="image"></a>
                            <div class="doctor-content">
                                <h3>
                                    <a href="{{ route('detail.doctor', ['id' => $item->id])}}">{{ $item->name }}</a>
                                </h3>
                                <span>{{ truncate($item->position, 50) }}</span>
                                <div class="share-link">
                                    <a href="https://www.facebook.com/" target="_blank"><i class="bx bxl-facebook"></i></a>
                                    <a href="https://twitter.com/?lang=en" target="_blank"><i class="bx bxl-twitter"></i></a>
                                    <a href="https://www.linkedin.com/" target="_blank"><i class="bx bxl-linkedin"></i></a>
                                    <a href="https://www.instagram.com/" target="_blank"><i class="bx bxl-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
