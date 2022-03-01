@extends('frontend.layout.main')
@section('content')
    <section class="privacy-policy-area ptb-100">
        <div class="container">
            <div class="single-privacy-policy">
                <h3>{{$single_page->title}}</h3>
                <p>{{$single_page->description}}</p>
                <p>
                    <?php echo $single_page['content']; ?>
                </p>
            </div>
        </div>
    </section>
@endsection
