@extends('frontend.layout.main')
@section('content')
    <section class="services-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="services-details-image">
                        <img src="{{asset('img')}}/{{$data_article->avatar}}" alt="image">
                    </div>
                    <div class="services-details-content">
                        <h3>Mô tả</h3>
                        <p>{{$data_article->title}}</p>
                    </div>

                    <p>{{$data_article->description}}</p>
                    <div class="services-details-overview-content">
                        <p>
                            <?php echo $data_article->content; ?>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area">
                        <div class="widget widget_search">
                            <form class="search-form">
                                <input type="search" class="search-field" placeholder="Search...">
                                <button type="submit"><i class='bx bx-search-alt'></i></button>
                            </form>
                        </div>
                        <div class="widget widget_grin_posts_thumb">
                            <h3 class="widget-title">Bài viết liên quan</h3>
                            @foreach($Related_posts as $post)
                            <article class="item">
                                <a href="" class="thumb">
                                    <img class="fullimage cover bg1" src="{{asset('img')}}/{{$post->avatar}}" alt="">
                                </a>
                                <div class="info">
                                    <span>{{$post->updated_at}}</span>
                                    <h4 class="title usmall">
                                        <a href="{{$post->url}}">{{$post->title}}</a>
                                    </h4>
                                </div>
                            </article>
                            @endforeach
                        </div>
                        <div class="widget widget_tag_cloud">
                            <h3 class="widget-title">Chuyên mục</h3>
                            @foreach($categories as $cates)
                            <div class="tagcloud">
                                <a href="{{route('baiviet_category',['slug'=>$cates->url_name])}}">{{$cates->name}}</a>
                            </div>
                            @endforeach
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection

