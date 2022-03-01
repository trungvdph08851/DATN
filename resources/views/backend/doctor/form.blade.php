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
                    Thêm bác sĩ
                </h3>
            </div>
        </div>
    </div>

    <!--begin::Form-->
    <form class="theme-form" action="{{route('doctor.save')}}" method="post" enctype="multipart/form-data" novalidate>
        @csrf
        <input type="hidden" name="id" value="{{$model->id}}">
        <div class="m-portlet__body">
            <div class="form-group m-form__group">
                <label class="col-form-label pt-0" for="exampleInputEmail1">Tên bác sĩ</label>
                <input class="form-control" id="exampleInputEmail1" name="name" type="text" value="{{old('name', $model->name)}}">
                {{-- Error --}}
                @if (count($errors) > 0)
                    <span class="text-danger">{{$errors->first('name')}}</span>
                @endif
                {{-- /Error --}}
            </div>
            <div class="form-group m-form__group">
                <label class="col-form-label pt-0" for="exampleInputPassword1">Ảnh</label><br>
                <img class="mb-2" src="{{asset($model->avatar)}}" alt="" width="100">
                <input type="file" id="input-file-now-custom-1" class="form-control" name="avatar"/>
                {{-- Error --}}
                @if (count($errors) > 0)
                    <span class="text-danger">{{$errors->first('avatar')}}</span>
                @endif
                {{-- /Error --}}
            </div>
            <div class="form-group m-form__group">
                <label class="col-form-label pt-0" for="exampleInputPassword1">Chức vụ</label>
                <input class="form-control" id="exampleInputPassword1" name="position" type="text" placeholder="" value="{{old('position', $model->position)}}">
                {{-- Error --}}
                @if (count($errors) > 0)
                    <span class="text-danger">{{$errors->first('position')}}</span>
                @endif
                {{-- /Error --}}
            </div>
            <div class="form-group m-form__group">
                <label class="col-form-label pt-0" for="exampleInputPassword1">Chứng chỉ</label>
                <div class="col-md-12">
                    <textarea name="certificate" id="editor1" rows="15">{{old('certificate', $model->certificate)}}</textarea><br>
                    {{-- Error --}}
                    @if (count($errors) > 0)
                        <span class="text-danger">{{$errors->first('certificate')}}</span>
                    @endif
                    {{-- /Error --}}
                </div>
            </div>
            <div class="form-group m-form__group">
                <label class="col-form-label pt-0" for="exampleInputPassword1">Mô tả</label>
                <div class="col-md-12">
                    <textarea name="description" id="editor" rows="15">{{old('description', $model->description)}}</textarea><br>
                    {{-- Error --}}
                        @if (count($errors) > 0)
                        <span class="text-danger">{{$errors->first('description')}}</span>
                    @endif
                    {{-- /Error --}}
                </div>
            </div>

        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions ml-5">
                <button type="submit" class="btn btn-success">Lưu</button>
                <a href="{{route('doctor.index')}}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>
@endsection
