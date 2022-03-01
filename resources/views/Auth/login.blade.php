@extends('Auth.layout.main')
@section('content')
  <div class="m-stack m-stack--hor m-stack--desktop">
    <div class="m-stack__item m-stack__item--fluid" style="width:500px;height:500px">
      <div class="m-login__wrapper" style="max-width: 600px;
    background: rgb(231 231 231);
    margin: 0px auto;     background: #fff;
    box-shadow: 0 0 15px rgb(0 0 0 / 10%);
    border-radius: 10px;padding: 10% 2rem 2rem 2rem;" >
        <div class="m-login__logo" style="    text-align: center;
    margin: 0px auto 0rem auto;">
          <a href="#">
            <img src="{{ asset ('logo.png')}}" width="250px">
          </a>
        </div>
        <div class="m-login__signin">
          <div class="m-login__head">
            <h3 class="m-login__title" style="margin: 0 0 40px;
    font-size: 23px;
    font-weight: 400;
    color: #587172;">Đăng nhập vào admin</h3>
          </div>
         
          <form class="m-login__form m-form" action="" method="post" enctype="multipart/form-data">
            @csrf
           
            <div class="form-group form-box">
                <label for="first_field" class="form-label" style="color: rgb(45, 45, 45);font-size: 16px;font-weight: 500;">Tài Khoản</label>
                <input name="email" type="email" class="form-control" id="first_field" placeholder="Email Address" aria-label="Email Address"value="{{old('email')}}" name="email" autocomplete="off">
            </div>
            @error('email')
                <p style="color:red">{{ $message }}</p>
            @enderror
            

            <div class="form-group form-box">
                                    <label for="second_field" class="form-label" style="color: rgb(45, 45, 45);font-size: 16px;font-weight: 500;">Mật Khẩu</label>
                                    <input name="password" type="password" class="form-control" autocomplete="off" id="second_field" placeholder="Password" aria-label="Password" style="
    margin-right: 200px;
">
                                </div>
            @error('password')
                <p style="color:red">{{ $message }}</p>
            @enderror
            @if (session('msg'))
                <p class="text-danger">{{ session('msg') }}</p>
            @endif
            {{-- <div class="row m-login__form-sub">
              <div class="col m--align-left">
                <label class="m-checkbox m-checkbox--focus">
                  <input type="checkbox" name="remember"> Remember me
                  <span></span>
                </label>
              </div>
              <div class="col m--align-right">
                <a href="javascript:;" id="m_login_forget_password" class="m-link">Forget Password ?</a>
              </div>
            </div> --}}
            <input type="hidden" name="url" value="{{$url}}">
            <div class="m-login__form-action">
              <button type="submit" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">Đăng nhập</button>
            </div>
          </form>

          
        </div>
      </div>
    </div>
  </div>
@endsection
