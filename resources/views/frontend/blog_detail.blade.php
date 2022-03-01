@extends('frontend.layout.main')
@section('content')
    <section class="blog-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-details-desc">
                        <div class="article-image">
                            <img src="{{asset($blog_detail->avatar)}}" alt="image">
                            <div class="tag">10 Jun</div>
                        </div>
                        <div class="article-content">
                            <div class="entry-meta">
                                <ul>
                                    <li>
                                        <span>Ngày tạo:</span>
                                       {{$blog_detail->created_at}}
                                    </li>
                                    <li>
                                        <span>Tác giả:</span>
                                        <a href="blog-details.html">{{$blog_detail->name}}</a>
                                    </li>
                                </ul>
                            </div>
                            <h3>{{$blog_detail->position}}</h3>
                            <p>
                                <?php echo $blog_detail['description'] ?>
                            </p>


                        </div>

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
                            <h3 class="widget-title">Mới nhất</h3>
                            @foreach($recent as $rc)
                            <article class="item">
                                <a href="{{asset($rc->avatar)}}" class="thumb">
                                    <span class="fullimage cover bg1" role="img"></span>
                                </a>
                                <div class="info">
                                    <span>{{$rc->created_at}}</span>
                                    <h4 class="title usmall">
                                        <a href="{{route('doctor_blog_detail',['id'=>$rc->id])}}">{{$rc->position}}</a>
                                    </h4>
                                </div>
                            </article>
                            @endforeach
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
