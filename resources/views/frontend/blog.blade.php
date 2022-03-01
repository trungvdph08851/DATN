@extends('frontend.layout.main')
@section('content')
<section class="blog-area pt-100 pb-100">
    <div class="container">
        <div class="section-title">
<span class="sub-title">
<i class="flaticon-hashtag-symbol"></i>
Tin tức chuyên khoa
</span>
            <h2>Tin tức chuyên khoa</h2>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="single-blog">
                    <div class="blog-image">
                        <a href="{{route('doctor_blog_detail',['id'=>$blog->id])}}"><img src="{{asset($blog->avatar)}}" alt="image"></a>
                        <div class="tag">10 Jun</div>
                        <div class="tag-two"><a href="{{route('doctor_blog_detail',['id'=>$blog->id])}}">{{$blog->position}}</a></div>
                    </div>
                    <div class="blog-content">
                        <h3>
                            <a href="{{route('doctor_blog_detail',['id'=>$blog->id])}}">{{$blog->name}}</a>
                        </h3>

                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-lg-12 col-md-12">
                <div class="pagination-area">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
