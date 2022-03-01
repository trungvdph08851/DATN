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
                        Tạo chuyên mục
                    </h3>
                </div>
            </div>
        </div>

        <!--begin::Form-->
        <form class="theme-form" action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="m-portlet__body">
                <div class="form-group m-form__group">
                    <input class="form-control" id="" name="name" type="text" placeholder="Tên danh mục bài viết">
                </div>
                <div class="form-group m-form__group">
                    <input class="form-control" id="" name="url_name" type="text" placeholder="đường dẫn">
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions ml-5">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{route('category.index')}}" class="btn btn-danger">Hủy</a>
                </div>
            </div>
        </form>

        <!--end::Form-->
    </div>
@endsection
{{--quang--}}
