@extends('backend.layout.main')
@section('addStyle')
    <link rel='stylesheet' type='text/css' href='{{ asset('codebase/dhtmlxscheduler_material.css?v=5.3.12') }}'>
    <style>
        .timeline {
            min-height: 800px;
        }
        .dhx_timeline_table_wrapper .dhx_cal_event_line{
            height: 100% !important;
        }
        .datetimepicker table tr td.disabled, .datetimepicker table tr td span.disabled{
            opacity: 0.5;
            background: rgb(187, 187, 187);
        }

        .xep_lich{
            max-width: 800px;
        }
        .modal-body label{
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .modal-xeplich{
            max-width: 1200px;
            width: 100%;
        }
        
    </style>
@endsection
@section('content')

    <div class="row mt-4">
        @if (Auth::user()->role == 2)
            <div class="col-12 timeline">
                <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
                    <div class="dhx_cal_navline">
                        <div class="dhx_cal_prev_button">&nbsp;</div>
                        <div class="dhx_cal_next_button">&nbsp;</div>
                        <div class="dhx_cal_today_button"></div>
                        <div class="dhx_cal_date"></div>
                        <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
                        <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
                        <div class="dhx_cal_tab" name="timeline_tab" style="right:280px;"></div>
                        <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
                    </div>
                    <div class="dhx_cal_header">
                    </div>
                    <div class="dhx_cal_data">
                    </div>
                </div>
            </div>
        @else
        <div class="col-8 timeline">
            <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
                <div class="dhx_cal_navline">
                    <div class="dhx_cal_prev_button">&nbsp;</div>
                    <div class="dhx_cal_next_button">&nbsp;</div>
                    <div class="dhx_cal_today_button"></div>
                    <div class="dhx_cal_date"></div>
                    <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
                    <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
                    <div class="dhx_cal_tab" name="timeline_tab" style="right:280px;"></div>
                    <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
                </div>
                <div class="dhx_cal_header">
                </div>
                <div class="dhx_cal_data">
                </div>
            </div>
        </div>
        @endif
        
        @if (Auth::user()->role != 2)
        <div class="col-4 box_right" style="overflow: hidden">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">
                    <!--begin: Datatable -->
                    <!-- Button trigger modal -->

                    <table class="table table-striped- table-bordered table-hover table-checkable" id="table_id">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã hóa đơn</th>
                            <th>Số điện thoại</th>
                            <th>Dịch vụ</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookingServices as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->booking->booking_code }}</td>
                                <td>{{ $item->booking->phone_number }}</td>
                                <td>{{ $item->services->name }}</td>
                                <td>
                                    @if ($item->status == BOOKING_SERVICES_ACCEPTED)
                                        <span class="btn btn-warning status-booking">Chờ xếp lịch</span>
                                    @elseif($item->status == BOOKING_SERVICES_REFRESH)
                                        <span class="btn btn-warning status-booking">Chờ xếp lịch</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" id="myBtn" data-toggle="modal"
                                       data-target="{{ '#' . '_' . $item->id }}" class="btn btn-warning" onclick="submitId('{{$item->id}}')"><i
                                            class="fas fa-wrench"></i></a>
                                    {{-- <a href="{{ route('cancelScheduled', [ 'id' => $item->booking->id ])}}" class="btn btn-danger " onclick="return confirm('Bạn muốn hủy xếp lịch ?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a> --}}
                                </td>
                            </tr>
                            {{-- modal update_booking --}}
                            <!-- Modal -->
                            <div class="modal fade close_modal" id="{{ '_' . $item->id }}" tabindex="1">
                                <div class="modal-dialog modal-dialog-centered xep_lich" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Xếp lịch</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label  for="">Tên khách hàng: {{ $item->booking->name }}</label>
                                            <br>
                                            <label  for="">Số điện thoại: {{ $item->booking->phone_number }}</label>
                                            <hr>
                                            <label for="">
                                                {{ $item->services->name }} : {{  number_format($item->services->price) }}.vnd - Thời gian làm:
                                                {{ $item->services->time }} phút
                                            </label>
                                            <div class="form-group m-form__group row">
                                                <label class="col-form-label col-12">Bác sĩ</label>
                                                <div class="col-12">
                                                    <select id="doctor_id" class="form-control">
                                                        @foreach ($user as $d)
                                                            @foreach ($d->services as $us)
                                                                @if ($item->services->id == $us->id)
                                                                    <option value="{{ $d->id }}"
                                                                            @if ($d->id == $item->doctor_id)
                                                                                selected
                                                                            @endif
                                                                    >{{ $d->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label class="col-form-label col-12">Giờ khám</label>
                                                <div class="col-12">
                                                    Từ: <input type="text" class="form-control {{$item->id}}_start_date" id="{{$item->id}}_datepicker"
                                                               @if ($item->start_date == "")
                                                               value="{{ date('Y-m-d H:i:00')}}"
                                                               @else
                                                               value="{{$item->start_date}}"
                                                               @endif
                                                               readonly=""
                                                               placeholder="Select date &amp; time" onchange="updateEnd_time({{$item->id}},{{ $item->services->time }})">
                                                </div>
                                                <div class="col-12 mt-2 {{$item->id}}_end_date">

                                                </div>
                                                <p class="error_dateTime col-12"></p>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label class="col-form-label col-12">Ghi chú</label>
                                                <div class="col-12">
                                                    <textarea name="" class="form-control" id="note" cols="30" rows="5">{{$item->note}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            <button type="button"
                                                    onclick="submit('{{ $item->id }}','{{$item->services->time}}')"
                                                    class="btn btn-primary "  >Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        
    </div>

@endsection
@section('script')
    <script src='{{ asset('codebase/dhtmlxscheduler.js?v=5.3.12') }}' type="text/javascript" charset="utf-8"></script>
    <script src='{{ asset('codebase/ext/dhtmlxscheduler_timeline.js?v=5.3.12') }}' type="text/javascript"
            charset="utf-8"></script>
    <script src="{{ asset('codebase/ext/dhtmlxscheduler_multiselect.js') }}"></script>
    <script src="{{ asset('codebase/ext/dhtmlxscheduler_collision.js') }}"></script>

    <script src="{{ asset('backend/demo/default/custom/crud/forms/widgets/bootstrap-datetimepicker.js') }}"
            type="text/javascript"></script>
@endsection
@section('addScript')
    <script>
        function updateEnd_time(id, time){
            let start_date = $('.' + id + '_start_date').val();
            let end_date = '.' + id + '_end_date';
            $(end_date).html();
            $.ajax({
                type: "get",
                url: "{{ route('timeline.update.endDate')}}",
                data: {
                    _token: '{{ csrf_token() }}',
                    id:id,
                    time:time,
                    start_date: start_date
                },
                success: function (response) {
                    $(end_date).html(response['date']);
                }
            });
        }
        function submitId(id){
            let today = moment().format('YYYY-MM-DD HH:mm:SS');
            let tomorrow = moment().add(4, 'days').format('YYYY-MM-DD HH:mm:SS');
            let date = '#' + id +'_datepicker';
            $(date).datetimepicker({
                todayHighlight:!0,
                autoclose:!0,
                format:"yyyy-mm-dd hh:ii:00",
                startDate: today,
                endDate: tomorrow
            });
        }
    </script>
    <script>
        function submit(id, time) {
            let doctor_id = $('#doctor_id').val();
            let start_date = $('.' + id + '_start_date').val();
            let status = $('#status').val();
            let note = $('#note').val();
            $('.close_modal');
            $('.error_dateTime').html();
            $.ajax({
                type: "post",
                url: "{{ route('timeline.add') }}",
                data: {
                    id: id,
                    time: time,
                    doctor_id: doctor_id,
                    start_date: start_date,
                    status: status,
                    note: note,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if(data == ""){
                        $('.close_modal').hide();
                        $('.modal-backdrop').hide();
                        toastr.success('Xếp lịch hẹn thành công !');
                        setTimeout(function() {
                            window.location.href = "{{ route('timeline.index') }}";
                        }, 100);
                    }
                    $('.error_dateTime').html(data);
                }
            });
        }

    </script>
    <script type="text/javascript" charset="utf-8">
        var sections = {!! json_encode($doctorData) !!};
        var services = {!! json_encode($servicesData) !!};
        var data = {!! json_encode($list) !!};
        window.addEventListener("DOMContentLoaded", function() {

            scheduler.locale.labels.timeline_tab = "Timeline";
            scheduler.locale.labels.section_custom = "Section";
            // cho phép kéo
            scheduler.config.drag_move = true;
            scheduler.config.drag_out = true;
            scheduler.config.drag_resize = true;
            scheduler.config.drag_lightbox = false;
            scheduler.config.drag_in = true;
            scheduler.config.drag_create = false;
            scheduler.config.dblclick_create = false;
            // Giới hạn số lịch đặt trong một khung giờ
            scheduler.config.collision_limit = 1;
            scheduler.config.drag_highlight = false;
            //===============
            //Configuration
            //===============
            scheduler.createTimelineView({
                name: "timeline",
                x_unit: "minute",
                x_date: "%H:%i",
                x_step: 30,
                x_size: 26,
                x_start: 15,
                x_length: 48,
                y_unit: sections,
                y_property: "doctor_id",
                render: "bar",
                scrollable: true,
                column_width: 200,
                section_autoheight: false,
                dy: 180
            });
            //===============
            //Data loading
            //===============
            scheduler.config.lightbox.sections = [{
                name: "Ghi chú",
                height: 100,
                map_to: "note",
                type: "textarea",
                focus: true
            },
                {
                    name: "Chọn bác sĩ",
                    height: 30,
                    type: "select",
                    options: sections,
                    map_to: "doctor_id"
                },
                {name:"time", height:72, type:"time", map_to:"auto"}
            ];
            // scheduler.config.buttons_left = ["custom_btn_info"];
            // scheduler.locale.labels["custom_btn_info"] = "Delete";
            scheduler.init('scheduler_here', new Date(moment().format('LL')), "timeline");

            scheduler.parse(
                data
            );
            scheduler.load("/admin/timeline", "json");
            var dp = new dataProcessor("/admin/timeline");
            dp.init(scheduler);
            dp.setTransactionMode({
                mode: "REST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Accept-Language": "fr-FR"
                },
                payload: {
                    _token: '{{ csrf_token() }}'
                }
            }, true);
        });
    </script>

@endsection
