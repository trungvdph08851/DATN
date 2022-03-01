@extends('backend.layout.main')
@section('addStyle')
    <link rel="stylesheet" href="{{ asset('demoCss/css/radio.css') }}">
    <style>
        td.disabled.day {
            background: rgba(177, 177, 177, 0.596) !important;
            opacity: 0.5;
        }
        #time>span{
            border: 1px solid rgb(194, 194, 194);
            background: rgb(194, 194, 194);
            border-radius: 10px;
            padding: 10px;
            margin-left: 15px;
        }
    </style>
@endsection
@section('content')
    <div class="m-portlet m-portlet--tab">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Tạo lịch khám
                    </h3>
                </div>
            </div>
        </div>

        <!--begin::Form-->
        <form action="" method="post" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right">
            @csrf
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group m-form__group">
                            <label class="col-form-label pt-0" for="exampleInputEmail1">Tên khách</label>
                            <input class="form-control m-input m-input--solid" id="exampleInputEmail1" name="name"
                                type="text" aria-describedby="emailHelp" placeholder="Tên">
                            @error('name')
                                <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group m-form__group">
                            <label class="col-form-label pt-0" for="exampleInputPassword1">Số điện thoại</label>
                            <input class="form-control m-input m-input--solid" id="exampleInputPassword1"
                                name="phone_number" type="number" placeholder="Số điện thoại">
                            @error('phone_number')
                            <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group m-form__group">
                            <label class="col-form-label pt-0" for="exampleInputPassword1">Địa chỉ</label>
                            <input class="form-control m-input m-input--solid" id="exampleInputPassword1" name="address"
                                type="text" placeholder="Địa chỉ">
                        </div>
                        <div class="form-group m-form__group">
                            <label class="col-form-label pt-0" for="exampleInputPassword1">Chứng minh thư</label>
                            <input class="form-control m-input m-input--solid" id="exampleInputPassword1" name="cmnd"
                                type="text" placeholder="Chứng minh thư">
                            @error('cmnd')
                            <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Dịch vụ</label>
                    <select class="form-control " id="js-example-basic-single"
                        name="services_id[]" multiple data-select2-id="js-example-basic-single" tabindex="-1"
                        aria-hidden="true">
                        @foreach ($services as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group m-form__group">
                    <label class="col-form-label pt-0" for="exampleInputPassword1">Ghi chú</label>
                    <textarea class="form-control m-input m-input--air" name="note" id="exampleTextarea" placeholder="..." rows="3"></textarea>
                    @error('note')
                    <div id="emailHelp" class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>

            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{route('booking.index')}}" class="btn btn-danger">Hủy</a>
                </div>
            </div>
        </form>

        <!--end::Form-->
    </div>
@endsection
@section('script')
    <!--begin::Page Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!--end::Page Scripts -->
@endsection
@section('addScript')
    <script>
        $(document).ready(function() {
            $('#js-example-basic-single').select2({
                placeholder: "Chọn dịch vụ",
                allowClear: true,
            });
        });
    </script>

@endsection
