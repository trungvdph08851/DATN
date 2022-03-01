@extends('frontend.layout.main')
@section('content')
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content">
                <h2>Dịch vụ</h2>
                <ul class="pages-list">
                    <li><a href="index.html">Trang chủ</a></li>
                    <li>Dịch vụ</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="services-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">
                    <i class="flaticon-hashtag-symbol"></i>
                    Dịch vụ nha khoa tốt nhất của chúng tôi
                </span>
                <h2>Tận hưởng sự chăm sóc đặc biệt thông qua độ chính xác, tính nghệ thuật và kinh nghiệm</h2>
                <p>Dịch vụ</p>
            </div>
            <div class="row">
                @foreach ($list_services as $ls)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-services">
                            <div class="services-image">
                                <a href="{{ route('service_detail', ['id' => $ls->id]) }}"><img
                                        src="{{ asset($ls->image) }}" style="height: 300px" alt="image"></a>
                                <div class="icon">
                                    <a href="{{ route('service_detail', ['id' => $ls->id]) }}"><i
                                            class="flaticon-dental-care"></i></a>
                                </div>
                            </div>
                            <div class="services-content">
                                <h3>
                                    <a href="{{ route('service_detail', ['id' => $ls->id]) }}">{{ $ls->name }}</a>
                                </h3>
                                <p>{{ truncate($ls->title, 100) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
