@extends('frontend.layout.main')
@section('content')
{{--    https://console.twilio.com/?frameUrl=%2Fconsole%3Fx-target-region%3Dus1--}}
    <section class="appointment-area bg-image ptb-100">
        <div class="container">
            <div class="appointment-form">
                <h4><i class="flaticon-calendar"></i>Xác nhận lịch khám</h4>
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                <label for="" style="color: red">*Nhập mã xác nhận gửi tới số điện thoại: {{ Session::get('phone_number') }}</label>
                <div class="row justify-content-md-center">
                <form action="{{route('verify')}}" method="post">
                    @csrf
                    <div class="form-group row ">
                        <div class="col-md-6">
                            <label for="verification_code"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Mã code') }}</label>
                            <input type="hidden" name="phone_number" value="{{ Session::get('phone_number') }}">
                            <input id="verification_code" type="tel"
                                   class="form-control @error('verification_code') is-invalid @enderror"
                                   name="verification_code" value="{{ old('verification_code') }}" required>
                            @error('verification_code')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Xác nhận') }}
                            </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
{{--1--}}
