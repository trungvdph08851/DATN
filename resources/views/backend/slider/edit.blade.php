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
                        Quản lý sửa slider
                    </h3>
                </div>
            </div>
        </div>

        <!--begin::Form-->
        <form class="theme-form" action="{{route('slider.saveEdit',['id'=>$slider->id])}}" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="m-portlet__body">
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputEmail1">Title</label>
                    <input class="form-control" id="exampleInputEmail1" name="title" type="text" value="{{$slider->title }}">
                    @error('title')
                    <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Miêu tả ngắn</label>
                    <input class="form-control" id="exampleInputPassword1" name="description" type="text" placeholder="" value="{{$slider->description }}">
                    @error('description')
                    <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Ảnh</label><br>
                    <img class="mb-2" src="" alt="" width="100">
                    <input type="file" id="input-file-now-custom-1" class="form-control" name="image"/>
                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Seo image</label>
                    <div class="col-md-12">
                        <input class="form-control" id="exampleInputPassword1" name="url_slug" type="text" placeholder="" value="{{$slider->url_slug }}">
                        <input type="hidden" value="1" name="status" >
                    </div>
                    @error('url_slug')
                    <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="hidden" value="1" name="status" >
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions ml-5">
                    <button type="submit" class="btn btn-success">Lưu</button>
                    <a href="{{route('slider.index')}}" class="btn btn-danger">Hủy</a>
                </div>
            </div>
        </form>

        <!--end::Form-->
    </div>
@endsection
{{--1--}}
