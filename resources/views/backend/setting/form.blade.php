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
                        Cấu hình website
                    </h3>
                </div>
            </div>
        </div>

        <!--begin::Form-->
        @if(isset($data))
        <form class="theme-form" action="{{route('setting.saveEdit',['id' => $data->id])}}" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="m-portlet__body">
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputEmail1">Tên hệ thống  </label>
                    <input class="form-control" id="exampleInputEmail1" name="name_system" type="text" value="{{$data->name_system}}">

                </div>

                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Thời gian hoạt động</label>
                    <input class="form-control" id="exampleInputPassword1" name="operating_hours" type="text" placeholder="" value="{{$data->operating_hours}}">

                </div>

                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Ảnh đại diện</label><br>
                    <img class="mb-2" src="" alt="" width="100">
                    <input type="file" id="input-file-now-custom-1" class="form-control" name="logo"/>

                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Cấu hình contact hệ thống</label>
                    <div class="col-md-12">
                        <textarea name="contact_information" id="editor" rows="15">{{$data->contact_information}}</textarea><br>

                    </div>
                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Địa chỉ hệ thống</label>
                    <input type="text" class="form-control" min="1" name="address" value="{{$data->address}}">

                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Google Map</label>
                    <input type="" class="form-control" min="1" name="google_map" value="{{$data->google_map}}">

                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Hotline</label>
                    <input type="" class="form-control" min="1" name="hotline" value="{{$data->hotline}}">

                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Email</label>
                    <input type="" class="form-control" min="1" name="email_contact" value="{{$data->email_contact}}">

                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Facebook</label>
                    <input type="" class="form-control" min="1" name="social_fb" value="{{$data->social_fb}}">

                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Youtube</label>
                    <input type="" class="form-control" min="1" name="social_yt" value="{{$data->social_yt}}">

                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Instagram</label>
                    <input type="" class="form-control" min="1" name="social_instagram" value="{{$data->social_instagram}}">

                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions ml-5">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{route('setting.index')}}" class="btn btn-danger">Hủy</a>
                </div>
            </div>
        </form>
    @else
            <form class="theme-form" action="{{route('setting.store')}}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">Tên hệ thống  </label>
                        <input class="form-control" id="exampleInputEmail1" name="name_system" type="text" value="">

                    </div>

                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Thời gian hoạt động</label>
                        <input class="form-control" id="exampleInputPassword1" name="operating_hours" type="text" placeholder="" value="">

                    </div>

                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Ảnh đại diện</label><br>
                        <img class="mb-2" src="" alt="" width="100">
                        <input type="file" id="input-file-now-custom-1" class="form-control" name="logo"/>

                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Cấu hình contact hệ thống</label>
                        <div class="col-md-12">
                            <textarea name="contact_information" id="editor" rows="15"></textarea><br>

                        </div>
                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Địa chỉ hệ thống</label>
                        <input type="text" class="form-control" min="1" name="address" value="">

                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Google Map</label>
                        <input type="" class="form-control" min="1" name="google_map" value="">

                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Hotline</label>
                        <input type="" class="form-control" min="1" name="hotline" value="">

                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Email</label>
                        <input type="" class="form-control" min="1" name="email_contact" value="">

                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Facebook</label>
                        <input type="" class="form-control" min="1" name="social_fb" value="">

                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Youtube</label>
                        <input type="" class="form-control" min="1" name="social_yt" value="">

                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Instagram</label>
                        <input type="" class="form-control" min="1" name="social_instagram" value="">

                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions ml-5">
                        <button type="submit" class="btn btn-success">Lưu</button>
                        <a href="{{route('setting.index')}}" class="btn btn-danger">Hủy</a>
                    </div>
                </div>
            </form>
        @endif
        <!--end::Form-->
    </div>
@endsection
{{--quang--}}
