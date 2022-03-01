@extends('backend.layout.main')
@section('content')
    <div class="m-portlet m-3">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <a href="{{ route('booking.index')}}">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    Lịch đặt
                                </h4><br>
                                <span class="m-widget24__desc">
                                    Tất cả lịch đặt khám
                                </span>
                                <span class="m-widget24__stats m--font-brand">
                                    {{ count($booking)}}
                                </span>
                                <div class="m--space-10"></div>
                               
                            </div>
                        </a>
                    </div>

                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <a href="{{ route('services.index')}}">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    Dịch vụ
                                </h4><br>
                                <span class="m-widget24__desc">
                                    Tất cả dịch vụ
                                </span>
                                <span class="m-widget24__stats m--font-info">
                                    {{ count($services) }}
                                </span>
                                <div class="m--space-10"></div>
                            </div>
                        </a>
                    </div>
                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <a href="{{ route('user.index')}}">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    Tài khoản
                                </h4><br>
                                <span class="m-widget24__desc">
                                    Tất cả tài khoản
                                </span>
                                <span class="m-widget24__stats m--font-danger">
                                    {{ count($user)}}
                                </span>
                                <div class="m--space-10"></div>
                                
                            </div>
                        </a>
                    </div>

                    <!--end::New Orders-->
                </div>
               
            </div>
        </div>
    </div>
    <div class="row m-3">
        <div class="col-xl-12">

            <!--begin:: Widgets/User Progress -->
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Bác sĩ có lịch khám nhiều nhất
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_widget4_tab1_content">
                            <div class="m-widget4 m-widget4--progress">
                                @foreach ($topDoctor as $item)
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__img m-widget4__img--pic">
                                            <img src="{{ asset($item['avatar'])}}" alt="">
                                        </div>
                                        <div class="m-widget4__info">
                                            <span class="m-widget4__title">
                                                {{$item['name']}}
                                            </span><br>
                                            <span class="m-widget4__sub">
                                                Tổng lần khám: {{$item['sumServices']}}
                                            </span>
                                        </div>
                                        <div class="m-widget4__progress">
                                            <div class="m-widget4__progress-wrapper">
                                                <span class="m-widget17__progress-number">{{$item['percent']}}%</span>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$item['percent']}}%;height: 10px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="m_widget4_tab2_content">
                        </div>
                        <div class="tab-pane" id="m_widget4_tab3_content">
                        </div>
                    </div>
                </div>
            </div>

            <!--end:: Widgets/User Progress -->
        </div>
    </div>
@endsection
@section('script')

@endsection
{{--quang--}}
