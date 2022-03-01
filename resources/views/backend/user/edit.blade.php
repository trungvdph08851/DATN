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
                        Sửa tài khoản
                    </h3>
                </div>
            </div>
        </div>

        <!--begin::Form-->
        <form action="" method="post" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right">
            @csrf
            <div class="m-portlet__body">
                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Tên</label>
                    <input type="text" class="form-control m-input m-input--solid" name="name" value="{{$user->name}}" placeholder="Enter name">
                </div>
                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control m-input m-input--solid" name="email" value="{{$user->email}}" placeholder="Enter email">
                </div>
                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Số điện thoại</label>
                    <input type="number" class="form-control m-input m-input--solid" name="phone_number" value="{{$user->phone_number}}" placeholder="Enter số điện thoại">
                </div>
                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Ảnh</label>
                    <div class="custom-file">
                        <input type="file" name="avatar" class="custom-file-input" id="customFile">
                        <label class="custom-file-label"  for="customFile">Choose file</label>
                    </div>
                    <img src="{{ asset($user->avatar)}}" width="150px" alt="">
                </div>
                <div class="form-group m-form__group">
                    <label for="exampleInputPassword1">Mật khẩu mới</label>
                    <input type="password" class="form-control m-input m-input--solid" name="newPassword"  id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group m-form__group">
                    <label for="exampleInputPassword1">Phân quyền</label>
                    <select class="form-control" name="role" id="doctor_services">
                        @foreach (statusLogin as $item)
                            <option value="{{$item['id']}}"
                            @if ($user->role == $item['id'])
                                selected
                            @endif
                            >{{$item['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group m-form__group" id="show_services">
                @if ($user->role == 2)
                    <label for="exampleInputPassword1">Dịch vụ bác sĩ</label>
                    <div class="row">
                        @foreach ($services as $item)
                            <div class="col-2">
                                <label class="m-checkbox m-checkbox--success">
                                    <input type="checkbox" name="services_id[]"
                                        @foreach ($user->services as $us)
                                            @if ($item->id == $us->id)
                                                checked
                                            @endif
                                        @endforeach
                                    value="{{$item->id}}"> {{$item->name}}
                                    <span></span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <button type="submit" class="btn btn-success">Lưu</button>
                    <a href="{{route('user.index')}}" class="btn btn-danger">Hủy</a>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
    <input type="hidden" id="userId" value="{{$user->id}}">
@endsection
@section('script')
    {{-- Link script --}}
@endsection
@section('addScript')
  <script>
     $('#doctor_services').change(function () {
        let id = $('#doctor_services').val();
        let userId = $('#userId').val();
        $('#show_services').html();
        $.ajax({
            type: "get",
            url: "{{ route('user.get.services.doctor')}}",
            data: {
                id:id,
                userId: userId,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $('#show_services').html(response['data']);
            }
        });
     });
  </script>
@endsection
{{--quang--}}
