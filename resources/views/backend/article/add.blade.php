@extends('backend.layout.main')
@section('content')
    <div class="m-portlet m-portlet--tab">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                    <h3 class="m-portlet__head-text">
                        Thêm bài viết
                    </h3>
                </div>
            </div>
        </div>

        <!--begin::Form-->
        <form class="theme-form" action="{{route('article.store')}}" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="m-portlet__body">
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputEmail1">Title</label>
                    <input class="form-control" id="exampleInputEmail1" name="title" type="text" value="{{old('title')}}">
                    @error('title')
                    <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Miêu tả ngắn</label>
                    <input class="form-control" id="exampleInputPassword1" name="description" type="text" placeholder="" value="{{old('description')}}">
                    @error('description')
                    <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Nội dung</label>
                    <div class="col-md-12">
                        <textarea name="content" id="editor" rows="15">{{old('content')}}</textarea><br>
                        @error('content')
                        <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Ảnh</label><br>
                    <img class="mb-2" src="" alt="" width="100">
                    <input type="file" id="input-file-now-custom-1" class="form-control" name="avatar"/>
                    @error('avatar')
                    <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Seo image</label>
                    <div class="col-md-12">
                        <input class="form-control" id="exampleInputPassword1" name="url" type="text" placeholder="" value="{{old('url')}}">
                    </div>
                    @error('url')
                    <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Chuyên mục mục</label>
                    <div class="col-md-12">
                        <select class="form-select form-control" aria-label="Default select example" name="cate_id">
                            @foreach($categories as $cate)
                                <option value="{{$cate->id}}" >{{$cate->name}}</option>
                            @endforeach
                        </select>
                        @error('cate_id')
                            <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Trang</label>
                    <div class="col-md-12">
                        <select class="form-select form-control" aria-label="Default select example" name="single_page">
                            <option value="1">trang đơn</option>
                            <option value="0" selected>bài viết</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions ml-5">
                    <button type="submit" class="btn btn-success">Lưu</button>
                    <a href="{{route('article.index')}}" class="btn btn-danger">Hủy</a>
                </div>
            </div>
        </form>

        <!--end::Form-->
    </div>
@endsection
{{--quang--}}
