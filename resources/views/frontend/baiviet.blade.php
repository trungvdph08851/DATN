@extends('frontend.layout.main')
@section('content')
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content">
                <h2>Tin tức</h2>
                <ul class="pages-list">
                    <li><a href="{{route('home')}}">Trang chủ</a></li>
                    <li><a href="{{route('service_list')}}">Bìa viết</a></li>
                </ul>
            </div>
        </div>
    </div>


    <section class="services-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">
                    <i class="flaticon-hashtag-symbol"></i>
                    Tin tức phòng khám mới nhất
                </span>
                <h2>Enjoy Specialized Care Through Precision, Artistry, and Experience</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>
<span class="sub-title">
<i class="flaticon-hashtag-symbol"></i>
    Tin tức nổi bật hàng ngày
</span>
                <h2>Những bài viết hay và ý nghĩa giúp bạn tự tin </h2>
{{--                <p>Dịch vụ chất lượng, an toàn mang đến nụ cười toả nắng cho bạn</p>--}}
            </div>
            <div class="row">
                @foreach ($list_baiviet as $lbv)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-services">
                            <div class="services-image">
                                <a href="{{ route('singlepage', ['slug' => $lbv->url]) }}"><img
                                        src="{{ asset('img') }}/{{$lbv->avatar}}" style="height: 300px" alt="image"></a>
                                <div class="icon">
                                    <a href="{{ route('singlepage', ['slug' => $lbv->url]) }}"><i class="flaticon-dental-care"></i></a>
                                </div>
                            </div>
                            <div class="services-content">
                                <h3>
                                    <a href="{{ route('singlepage', ['slug' => $lbv->url]) }}">{{ truncate($lbv->title,55) }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
