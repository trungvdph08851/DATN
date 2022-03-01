@extends('frontend.layout.main')
@section('content')
    <div class="page-banner-area">
        <div class="container">
            <div class="page-banner-content">
                <h2>{{ $service->name }}</h2>
                <ul class="pages-list">
                    <li><a href="index.html">Trang chủ</a></li>
                    <li>{{ $service->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="services-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="services-details-content">
                        <p>{!! $service->description !!}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area">
                        <div class="widget widget_grin_posts_thumb">
                            <h3 class="widget-title">Tin tức</h3>
                            @foreach ($article as $item)
                                <article class="item">
                                    <a href="#" class="thumb">
                                        <img src="{{ asset('img/' .$item->avatar) }}"  style="height: 80px;" alt="">
                                    </a>
                                    <div class="info">
                                        <span>{{ $item->created_at}}</span>
                                        <h4 class="title usmall">
                                            <a href="#">{{ $item->title }}</a>
                                        </h4>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        
                        <div class="widget widget_tag_cloud">
                            <h3 class="widget-title">Dịch vụ</h3>
                            <div class="tagcloud">
                                @foreach ($listServices as $item)
                                    <a href="{{ route('service_detail', ['id' => $item->id])}}">{{ $item->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
<script>

</script>
{{-- 1 --}}
