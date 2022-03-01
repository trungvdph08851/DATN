@extends('backend.layout.main')
@section('addStyle')
    <link rel='stylesheet' type='text/css' href='{{ asset('codebase/dhtmlxscheduler_material.css?v=5.3.12') }}'>
    <style>
        span {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
        }
        .title_detail {
            font-weight: 500;
        }
    </style>
@endsection
@section('content')
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Danh sách chờ khám lần đầu
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">

                </div>
            </div>
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="table_id">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã đơn</th>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Dịch vụ</th>
                        <th>Bác sĩ</th>
                        <th>Ngày</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                        <th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($booking_services as $bs)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$bs->booking->booking_code}}</td>
                            <td>{{$bs->booking->name}}</td>
                            <td>{{$bs->booking->phone_number}}</td>
                            <td>{{$bs->services->name}}</td>
                            <td>
                                @if ($bs->doctor_id)
                                    {{$bs->doctor->name}}
                                @endif
                            </td>
                            <td>
                                @if ($bs->start_date && $bs->end_date)
                                    {{ date('d-m-Y', strtotime($bs->start_date)) }}
                                @endif
                            </td>
                            <td>
                                @if ($bs->start_date && $bs->end_date)
                                    {{ date('H:i:s', strtotime($bs->start_date)) }} - {{ date('H:i:s', strtotime($bs->end_date)) }}
                                @endif
                            </td>
                            <td>
                                @if ($bs->status == BOOKING_SERVICES_SCHEDULED)
                                    <span class="btn btn-warning status-booking">Đang chờ khám</span>
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                       data-bs-target="{{ '#' . '_' . $bs->id }}"><i class="flaticon-eye"></i>Xem chi
                                        tiết</a>
                                </div>
                            </td>
                        </tr>
                        {{-- modal detail --}}
                        <div class="modal fade" id="{{ '_' . $bs->id }}" tabindex="-1"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn đặt lịch</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class=" btn btn-danger ">Mã đơn:
                                            @if ($bs->booking->booking_code)
                                                {{ $bs->booking->booking_code }}
                                            @endif
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Thông tin khách hàng</h3>
                                            <div class="col-12 row">
                                                <div class="col-6">
                                                    <span>Tên khách hàng: {{ $bs->booking->name }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>Số điện thoại: {{  $bs->booking->phone_number }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>CMND: {{  $bs->booking->cmnd }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>Địa chỉ: {{  $bs->booking->address }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Dịch vụ</h3>
                                            <div class="col-12 row">
                                                <div class="col-6"><span>Tên dịch vụ: {{$bs->services->name}}</span> </div>
                                                <div class="col-3"><span>Giá: {{$bs->services->price}}</span></div>
                                                <div class="col-3"><span>Thời gian làm: {{$bs->services->time}}</span></div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Bác sĩ</h3>
                                            <div class="col-12">
                                                    <span>Tên bác sĩ khám:
                                                        @if ($bs->doctor->id)
                                                            {{ $bs->doctor->name }}
                                                        @endif
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Thời gian khám</h3>
                                            <div class="col-12">
                                                    <span>Ngày khám:
                                                        @if ($bs->start_date && $bs->end_date)
                                                            {{ date('d-m-Y', strtotime($bs->start_date)) }}
                                                        @endif
                                                    </span>
                                            </div>
                                            <div class="col-12">
                                                    <span>Giờ khám:
                                                        @if ($bs->start_date && $bs->end_date)
                                                            {{ date('H:i:s', strtotime($bs->start_date)) }}
                                                            - {{ date('H:i:s', strtotime($bs->end_date)) }}
                                                        @endif
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Trạng thái</h3>
                                            <div class="col-12">
                                                @if ($bs->status == 1)
                                                    <span class="btn btn-warning status-booking">Chờ khám</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Ghi chú</h3>
                                            <div class="col-12">
                                                    <textarea name="note" class="form-control" id="note" cols="30"
                                                              rows="5">{{ $bs->note }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        <button type="button" onclick="submit({{ $bs->id }})" id="submit"
                                            data-bs-dismiss="modal" class="btn btn-primary">Đã khám song</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal detail --}}
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Danh sách chờ khám định kỳ
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">

                </div>
            </div>
            <div class="m-portlet__body">

                <table class="table table-striped- table-bordered table-hover table-checkable" id="table_id_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã đơn</th>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Dịch vụ</th>
                        <th>Bác sĩ</th>
                        <th>Ngày</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                        <th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($booking_schedule as $bs)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bs->booking->booking_code }}</td>
                            <td>{{ $bs->booking->name }}</td>
                            <td>{{ $bs->booking->phone_number }}</td>
                            <td>
                                @foreach ($servicesAll as $item)
                                    @if($item->id == $bs->bookingServices->services_id)
                                        {{$item->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                {{$bs->doctor->name}}
                            </td>
                            <td>
                                @if ($bs->start_date && $bs->end_date)
                                    {{ date('d-m-Y', strtotime($bs->start_date)) }}
                                @endif
                            </td>
                            <td>
                                @if ($bs->start_date && $bs->end_date)
                                    {{ date('H:i:s', strtotime($bs->start_date)) }}
                                    - {{ date('H:i:s', strtotime($bs->end_date)) }}
                                @endif
                            </td>
                            <td>
                                @if ($bs->status == BOOKING_SCHEDULE_SCHEDULED)
                                    <span class="btn btn-warning status-booking">Đang chờ khám</span>
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                       data-bs-target="{{ '#' . '_' . $bs->id }}"><i class="flaticon-eye"></i>Xem chi
                                        tiết</a>
                                </div>
                            </td>
                        </tr>


                        <div class="modal fade" id="{{ '_' . $bs->id }}" tabindex="-1"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn đặt lịch</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class=" btn btn-danger ">Mã đơn:
                                            @if ($bs->booking->booking_code)
                                                {{ $bs->booking->booking_code }}
                                            @endif
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Thông tin khách hàng</h3>
                                            <div class="col-12 row">
                                                <div class="col-6">
                                                    <span>Tên khách hàng: {{ $bs->booking->name }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>Số điện thoại: {{ $bs->booking->phone_number }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>CMND: {{ $bs->booking->cmnd }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>Địa chỉ: {{ $bs->booking->address }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Dịch vụ</h3>
                                            <div class="col-12">
                                                <div class="row">
                                                    @foreach ($servicesAll as $s)
                                                        @if ($s->id == $bs->bookingServices->services_id)
                                                            <div class="col-6">
                                                                <span>Tên dịch vụ: {{ $s->name }}</span>
                                                            </div>
                                                            <div class="col-3">
                                                                <span>Giá: {{ number_format($s->price) }}.vnd</span>
                                                            </div>
                                                            <div class="col-3">
                                                                <span>Thời gian làm: {{ $s->time }}</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Bác sĩ</h3>
                                            <div class="col-12">
                                                    <span>Tên bác sĩ khám:
                                                        {{$bs->doctor->name}}
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Thời gian khám</h3>
                                            <div class="col-12">
                                                    <span>Ngày khám:
                                                        @if ($bs->start_date && $bs->end_date)
                                                            {{ date('d-m-Y', strtotime($bs->start_date)) }}
                                                        @endif
                                                    </span>
                                            </div>
                                            <div class="col-12">
                                                    <span>Giờ khám:
                                                        @if ($bs->start_date && $bs->end_date)
                                                            {{ date('H:i:s', strtotime($bs->start_date)) }}
                                                            - {{ date('H:i:s', strtotime($bs->end_date)) }}
                                                        @endif
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Trạng thái</h3>
                                            <div class="col-12">
                                                @if ($bs->status == BOOKING_SCHEDULE_SCHEDULED)
                                                    <span class="btn btn-warning status-booking">Chờ khám</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Ghi chú</h3>
                                            <div class="col-12">
                                                    <textarea name="note" class="form-control" id="noteSchedule" cols="30"
                                                              rows="5">{{ $bs->note }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        <button type="button" onclick="submitSchedule({{ $bs->id }})" id="submit"
                                                data-bs-dismiss="modal" class="btn btn-primary">Đã khám song</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
@endsection
@section('script')
    <script src="{{ asset('backend/demo/default/custom/crud/forms/widgets/bootstrap-datetimepicker.js') }}"
            type="text/javascript"></script>

@endsection
@section('addScript')
    <script>
        function submit(id) {
            let note = $('#note').val();
            $.ajax({
                type: "post",
                url: "{{ route('booking.waitingLine.save') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    note: note
                },
                success: function(response) {
                    toastr.success('Lịch khám đã hoàn thành !');
                    setTimeout(function() {
                        window.location.href = "{{ route('booking.waitingLine.today') }}";
                    }, 100);
                }
            });
        }
        function submitSchedule(id) {
            let note = $('#noteSchedule').val();
            $.ajax({
                type: "post",
                url: "{{ route('booking.waitingLine.schedule.save') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    note: note
                },
                success: function(response) {
                    toastr.success('Lịch khám đã hoàn thành !');
                    setTimeout(function() {
                        window.location.href = "{{ route('booking.waitingLine.today') }}";
                    }, 100);
                }
            });
        }
    </script>

@endsection
