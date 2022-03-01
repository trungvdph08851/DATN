@extends('backend.layout.main')
@section('addStyle')
    <link rel='stylesheet' type='text/css' href='{{ asset('codebase/dhtmlxscheduler_material.css?v=5.3.12') }}'>
    <style>
        span{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            padding: 8px 0px
        }
        .title_detail{
            font-weight: 500;
        }
        .datetimepicker table tr td.disabled, .datetimepicker table tr td span.disabled{
            opacity: 0.5;
            background: rgb(187, 187, 187);
        }
        .modal-detail{
            max-width: 1300px;
        }
        .modal-cancel{
            max-width: 1000px;
        }
        .detail_services{
            max-width: 400px;
            box-shadow: 0px 0px 8px 1px #a6a5a554;
            padding: 10px;
            border-radius: 10px;
            margin-right: 10px;
            margin-top: 10px;
        }
        .border_schedule{
            box-shadow: 0px 5px 10px 2px rgb(196 197 214 / 40%) !important;
            margin: 5px 10px !important;
            max-width: 400px;
            padding: 10px 10px !important;
        }
        .modal-invoi{
            max-width: 1200px;
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
                            Danh sách lịch khám
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('booking.add')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <i class="la la-plus"></i>
                                Tạo lịch khám
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body data">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-7"></div>
                        <div class="col-2">
                            <label for="">Thời gian</label>
                            <input type="text" class="form-control date_start" name="date" id="date_start"
                            @if(isset($searchData['date'])) value="{{$searchData['date']}}" @endif
                            placeholder="Chọn ngày" autocomplete="off">
                        </div>
                        <div class="col-2 form-group">
                            <label for="">Trạng thái</label>
                            <select class="form-control filter_status" name="status" id="">
                                <option @if(isset($searchData['status']) &&  $searchData['status'] == "") selected @endif value="">Tất cả</option>
                                <option @if(isset($searchData['status']) &&  $searchData['status'] == 0) selected @endif value="0">Chưa xác nhận</option>
                                <option @if(isset($searchData['status']) &&  $searchData['status'] == 1) selected @endif value="1">Chờ xếp lịch</option>
                                <option @if(isset($searchData['status']) &&  $searchData['status'] == 2) selected @endif value="2">Đã xếp lịch</option>
                                <option @if(isset($searchData['status']) &&  $searchData['status'] == 4) selected @endif value="4">Đã khám song</option>
                            </select>
                        </div>
                        <div class="col-1 mt-4">
                            <button type="submit" class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-success m-btn--gradient-to-accent">Tìm kiếm</button>
                        </div>
                    </div>
                </form>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="table_id">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã hóa đơn</th>
                            <th>Tên</th>
                            <th>Số điện thoại</th>
                            <th>Dịch vụ</th>
                            <th>Giá</th>
                            <th>Ngày đặt</th>
                            <th>Trạng thái</th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($booking as $b)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $b->booking_code }}</td>
                                <td>{{ $b->name }}</td>
                                <td>{{ $b->phone_number }}</td>
                                <td>
                                    @foreach ($b->services as $s)
                                        *{{ $s->name }} <br>
                                    @endforeach
                                </td>
                                <td>{{ number_format($b->price) }}vnd</td>
                                <td>{{ date('Y-m-d H:i', strtotime($b->created_at)) }}</td>
                                <td>
                                    @if ($b->status == BOOKING_PENDING)
                                        <span class="btn btn-warning status-booking">Chờ xác nhận</span>
                                    @elseif($b->status == BOOKING_ACCEPTED)
                                        <span class="btn btn-warning status-booking">Chờ xếp lịch</span>
                                    @elseif($b->status == BOOKING_SCHEDULED)
                                        <span class="btn btn-info status-booking">Đã xếp lịch</span>
                                    @elseif($b->status == BOOKING_REJECTED)
                                        <span class="btn btn-danger status-booking">Hủy bỏ</span>
                                    @elseif($b->status == BOOKING_FINISHED)
                                        <span class="btn btn-success status-booking">Đã khám xong</span>
                                    @else
                                        <span class="badge rounded-pill bg-info status-booking">Không có trạng thái</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-4 dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="la la-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="{{'#'. '_' . $b->id}}"><i class="flaticon-eye"></i>Xem chi tiết</a>
                                                <a href="{{ route('booking.edit', ['id' => $b->id]) }}" class="dropdown-item"><i class="la la-check-square"></i>Xác nhận đơn</a>
                                                @if($b->status == BOOKING_SCHEDULED)
                                                <a href="{{ route('guitinnhan', ['id' => $b->id]) }}" class="dropdown-item"><i class="la la-send"></i></i>Gửi tin nhắn</a>
                                                @endif
                                                <a href="{{route('xuathoadon', ['id' => $b->id])}}" class="dropdown-item" onclick="return confirm('Bạn có muốn xuất hóa đơn này?')"><i class="flaticon-download"></i> Xuất hóa đơn</a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="{{'#'. 'cancel_' . $b->id}}" class="dropdown-item" ><i class="flaticon-delete"></i> Hủy đơn</a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <a href="{{ route('booking.remove', ['id' => $b->id]) }}" class="btn btn-danger "
                                                onclick="return confirm('Bạn có muốn xóa?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        {{--  modal detail --}}
                        <div class="modal fade" id="{{'_' . $b->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-detail">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn đặt lịch</h5>
                                        <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                            <span class="glyphicon glyphicon-remove"></span>X
                                        </button>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class=" btn btn-danger ">Mã đơn:
                                            @if ($b->booking_code)
                                                {{$b->booking_code}}
                                            @endif
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Thông tin khách hàng</h3>
                                            <div class="col-12 row">
                                                <div class="col-6">
                                                    <span>Tên khách hàng: {{$b->name}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>Số điện thoại: {{$b->phone_number}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>CMND: {{$b->cmnd}}</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>Địa chỉ: {{$b->address}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Dịch vụ</h3>
                                            <div class="col-12 row">
                                                @php
                                                    $sumTime = 0;
                                                @endphp
                                                @foreach ($b->services as $key => $item)
                                                    @php
                                                        $sumTime += $item->time;
                                                    @endphp
                                                    <div class="col-4 detail_services">
                                                        <div class="row">
                                                            <div class="col-8"><span>Tên dịch vụ: {{$item->name}}</span></div>
                                                            <div class="col-4">
                                                                @if ($b->bookingServices[$key]->status == BOOKING_PENDING)
                                                                    <button type="button" class="mb-2 btn m-btn--pill m-btn--air btn-outline-warning">Chờ xác nhận</button>
                                                               @elseif ($b->bookingServices[$key]->status == BOOKING_SERVICES_ACCEPTED)
                                                                    <button type="button" class="mb-2 btn m-btn--pill m-btn--air btn-outline-warning">Chưa xếp lịch</button>
                                                                @elseif($b->bookingServices[$key]->status == BOOKING_SERVICES_SCHEDULED)
                                                                    <button type="button" class="mb-2 btn m-btn--pill m-btn--air btn-outline-accent">Đã xếp lịch</button>
                                                                @elseif($b->bookingServices[$key]->status == BOOKING_SERVICES_FINISHED)
                                                                    <button type="button" class="mb-2 btn m-btn--pill m-btn--air btn-outline-success">Đã khám song</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6"><span>Giá:  {{number_format($item->price)}}vnd</span></div>
                                                            <div class="col-6"><span>Thời gian làm: {{$item->time}}Phút</span></div>
                                                        </div>
                                                        <span>Bác sĩ khám:
                                                            @foreach ($user as $u)
                                                                @if ($u->id == $b->bookingServices[$key]->doctor_id)
                                                                    {{$u->name}}
                                                                @endif
                                                            @endforeach
                                                        </span><br>
                                                        <span>Ngày khám:
                                                            @if ($b->bookingServices[$key]->start_date && $b->bookingServices[$key]->end_date)
                                                                {{ date('d-m-Y', strtotime($b->bookingServices[$key]->start_date)) }}
                                                            @endif
                                                        </span><br>
                                                        <span>Giờ khám:
                                                            @if ($b->bookingServices[$key]->start_date && $b->bookingServices[$key]->end_date)
                                                                {{ date('H:i:s', strtotime($b->bookingServices[$key]->start_date)) }}
                                                                - {{ date('H:i:s', strtotime($b->bookingServices[$key]->end_date)) }}
                                                            @endif
                                                        </span><br>
                                                        <span>Ghi chú:
                                                            @if ($b->bookingServices[$key]->note)
                                                                {{$b->bookingServices[$key]->note}}
                                                            @endif
                                                        </span><br>
                                                        @if ($b->bookingServices[$key]->status == BOOKING_SERVICES_FINISHED)
                                                            <a href="{{ route('booking.add.schedule', ['id' => $b->bookingServices[$key]->id])}}">
                                                                <button type="button" class="mt-2 btn m-btn--pill m-btn--air btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Hẹn khám định kỳ</button>
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            {{-- Tổng giá và Thời gian làm --}}
                                            <span class="col-12 mt-3">Tổng giá: {{number_format($b->price)}}vnd</span>
                                            <span class="col-12">Tổng Thời gian khám: {{$sumTime}}Phút</span>
                                        </div>
                                        <div class="row mt-2">
                                            <h3 class="col-12 title_detail" style="color: red">Lịch hẹn khám định kỳ</h3>
                                            <div class="col-12">
                                            @foreach ($b->bookingServices as $item)
                                                <div class="row">
                                                    <span class="col-12">- Dịch vụ: {{$item->services->name}}</span>
                                                    @foreach ($bookingSchedule as $itemBs)
                                                        @if ($item->id == $itemBs->booking_services_id)
                                                            <div class="col-4 border_schedule">
                                                                <div class="row">
                                                                    <span class="col-8">Bác sĩ: {{$itemBs->doctor->name}}</span>
                                                                    @if ($itemBs->status == BOOKING_SCHEDULE_SCHEDULED)
                                                                        <button type="button" class="mb-2 btn m-btn--pill m-btn--air btn-outline-warning">Chưa khám</button>
                                                                    @elseif($itemBs->status == BOOKING_SCHEDULE_FINISHED)
                                                                        <button type="button" class="mb-2 btn m-btn--pill m-btn--air btn-outline-success">Đã khám</button>
                                                                    @endif
                                                                    <span class="col-12">Ngày khám: {{date('d-m-Y', strtotime($itemBs->start_date))}}</span>
                                                                    <span class="col-12">Giờ khám: {{date('H:i:s', strtotime($itemBs->start_date))}} - {{date('H:i:s', strtotime($itemBs->end_date))}}</span>
                                                                    <span class="col-12">Ghi chú: {{ $itemBs->note}}</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        {{-- <button type="button"  class="btn btn-primary">Save changes</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal detail --}}
                        {{-- modal cancel order --}}
                            <div class="modal close_modal" id="{{'cancel_' . $b->id}}" tabindex="-1">
                                <div class="modal-dialog modal-cancel">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Bạn có chắc muốn hủy đơn này</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="m-portlet">
                                                <div class="m-portlet__head">
                                                    <div class="m-portlet__head-caption">
                                                        <div class="m-portlet__head-title">
                                                            <span class="m-portlet__head-icon">
                                                                <i class="flaticon-delete"></i>
                                                            </span>
                                                            <h3 class="m-portlet__head-text">
                                                                Lý do hủy đơn
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="m-portlet__body">
                                                    <textarea class="form-control" name="" id="{{$b->id}}_reason" cols="30" rows="5" placeholder="Nhập lý do hủy đơn !"></textarea>
                                                    <span class="m--font-danger" id="{{$b->id}}_errorReason"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <button type="button" onclick="cancelOrder({{$b->id}})" class="btn btn-primary">Hủy đơn</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- end modal cancel order --}}

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
        $('#date_start').datepicker({
            todayHighlight:!0,
            autoclose:!0,
            format:"yyyy-mm-dd"
        })
    </script>

    <script>
        function cancelOrder(id){
            let reason = $('#' + id + '_reason').val();
            if (reason == "") {
                $('#' + id + '_errorReason').html('Lý do không được để trống');
                return false;
            }
            $.ajax({
                type: "post",
                url: "{{ route('cancel.order')}}",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    reason: reason
                },
                success: function (response) {
                    if(response['msg'] == ""){
                        $('.close_modal').hide();
                        $('.modal-backdrop').hide();
                        toastr.success('Hủy lịch khám thành công!');
                        setTimeout(function() {
                            window.location.href = "{{ route('booking.index') }}";
                        }, 100);
                    }
                }
            });
        }
    </script>
@endsection