@extends('backend.layout.main')
@section('addStyle')
    <style>
        span{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
        }
        .title_detail{
            font-weight: 500;
        }
        .datetimepicker table tr td.disabled, .datetimepicker table tr td span.disabled{
            opacity: 0.5;
            background: rgb(187, 187, 187);
        }
        .error{
            font-size: 16px;
        }
        .box-schedule{
            position: relative;
            border-radius: 15px;
            margin: 15px 10px !important;
            padding: 10px;
            max-width: 500px;
            box-shadow: 0px 0px 10px 5px rgb(196 197 214 / 45%) !important;
        }
        .alert-dismissible .close{
            right: -15px !important;
        }
        .datepicker table tr td.disabled, .datepicker table tr td.disabled:hover{
            opacity: 0.5;
            background: rgb(187, 187, 187);
        }

    </style>
@endsection
@section('content')
    <div class="m-portlet m-portlet--tab m-3" >
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Đặt lịch khám định kỳ
                    </h3>
                </div>
            </div>
        </div>

        <!--begin::Form-->
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">Tên khách</label>
                        <input class="form-control m-input m-input--solid" value="{{$bookingServices->booking->name}}" id="exampleInputEmail1"
                               type="text" aria-describedby="emailHelp" placeholder="Tên" disabled>
                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Số điện thoại</label>
                        <input class="form-control m-input m-input--solid" value="{{$bookingServices->booking->phone_number}}" id="exampleInputPassword1"
                               type="number" placeholder="Số điện thoại" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Địa chỉ</label>
                        <input class="form-control m-input m-input--solid" value="{{$bookingServices->booking->address}}" id="exampleInputPassword1"
                               type="text" placeholder="Địa chỉ" disabled>
                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-form-label pt-0" for="exampleInputPassword1">Chứng minh thư</label>
                        <input class="form-control m-input m-input--solid" value="{{$bookingServices->booking->cmnd}}" id="exampleInputPassword1"
                               type="text" placeholder="Chứng minh thư" disabled>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group">
                <label class="col-form-label pt-0" for="exampleInputEmail1">Bác sĩ</label>
                <input class="form-control m-input m-input--solid" value="{{$bookingServices->doctor->name}}" id="exampleInputEmail1"
                       type="text" aria-describedby="emailHelp" placeholder="Tên" disabled>
            </div>
            <div class="form-group m-form__group">
                <label class="col-form-label pt-0" for="exampleInputEmail1">Dịch vụ</label>
                <input class="form-control m-input m-input--solid" value="{{$bookingServices->services->name}}"  disabled>
            </div>

        </div>
        <div class="m-portlet__body form-group m-form__group row">
            <div class="col-12">
                <label class="col-form-label pt-0" for="exampleInputPassword1">Lịch hẹn</label>
            </div>
            <div class="col-12">
                <input type="hidden" name="removeSchedule" value="">
                <div class="btn btn-accent"  id="add_time"><i class="la la-plus"></i></div>
                <div class="row">
                    <div class="col-12 row add-schedule mt-3">
                        @foreach ($bookingSchedule as $item)
                            @if($bookingServices->id == $item->booking_services_id)
                                <div class="col-4 row mt-2 box-schedule" id="{{$item->id}}" onclick="loadStart(event, {{$item->id}})">
                                    <div id="{{$item->id}}_error" style="margin: 0 auto;"></div>
                                    <div class="col-12 form-group m-form__group">
                                        <div class="row">
                                            <div class="col-8">
                                                <label class="col-form-label pt-0 mb-2" for="">Bác sĩ</label>
                                            </div>
                                            <div class="col-4 mb-2">
                                                @if ($item->status == BOOKING_SCHEDULE_SCHEDULED)
                                                    <span class="btn m-btn--pill m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning">Chưa khám</span>
                                                @elseif($item->status == BOOKING_SCHEDULE_FINISHED)
                                                    <span class="btn m-btn--pill m-btn m-btn--gradient-from-primary m-btn--gradient-to-info">Đã khám</span>
                                                @endif
                                            </div>
                                        </div>
                                        <select class="form-control {{$item->id}}_doctor_id"  id="">
                                            @foreach ($user as $us)
                                                <option value="{{$us->id}}" 
                                                    @if ($us->id == $item->doctor_id)
                                                        selected
                                                    @endif
                                                >{{$us->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 form-group m-form__group">
                                        <label class="col-form-label pt-0 mb-2" for="">Ngày khám</label>
                                        <input class="form-control {{$item->id}}_date"  id="{{$item->id}}_date" type="text" 
                                        placeholder="Select date"  autocomplete="off" value="{{ date('d-m-Y', strtotime($item->start_date)) }}" required>
                                    </div>
                                    <div class="col-12 form-group m-form__group">
                                        <label class="col-form-label pt-0" for="">Thời gian </label>
                                        <div class="row">
                                            <div class="col-6"> 
                                                Từ: <input class="form-control {{$item->id}}_time_start"  id="{{$item->id}}_time_start" type="text" readonly=""
                                                placeholder="Select time start"  autocomplete="off" value="{{ date('g:i A', strtotime($item->start_date)) }}" required>
                                            </div>
                                            <div class="col-6">
                                                Đến: <input class="form-control {{$item->id}}_time_end" id="{{$item->id}}_time_end" type="text" readonly=""
                                                placeholder="Select time end"  autocomplete="off" value="{{ date('g:i A', strtotime($item->end_date)) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group m-form__group">
                                        <label class="col-form-label pt-0" for="exampleInputPassword1">Ghi chú</label>
                                        <textarea class="form-control m-input m-input--air {{$item->id}}_note"  id="exampleTextarea" placeholder="..." rows="3">{{$item->note}}</textarea>
                                    </div>
                                    @if ($item->status == BOOKING_SCHEDULE_FINISHED)
                                        <input type="hidden" class="{{$item->id}}_status" id="status"  value="10">
                                    @else
                                        <input type="hidden" class="{{$item->id}}_status" id="status"  value="9">
                                    @endif
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            <button type="" name="btn" value="0" onclick="submit({{$item->id}}, {{$bookingServices->id}})" class="btn btn-success">Lưu</button>
                                            <button class="btn btn-danger" onclick="remove(this, {{$item->id}})">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="m-portlet__body ">
            <div class="m-form__actions">
                {{-- <button type="reset" class="btn btn-secondary">Hủy</button> --}}
            </div>
        </div>

        <!--end::Form-->
    </div>
@endsection
@section('script')
    <script src="{{ asset('backend/demo/default/custom/crud/forms/widgets/bootstrap-datetimepicker.js') }}"
            type="text/javascript"></script>

@endsection
@section('addScript')

    <script>
        $(document).ready(function(){
            $('#add_time').click(function(id){
                var rowId = Date.now();
                $('.add-schedule').append(`
                    <div class="col-4 row mt-2 box-schedule" id="${rowId}" onclick="loadStart(event, ${rowId})">
                        <div id="${rowId}_error" style="margin: 0 auto;"></div>
                        <div class="col-12 form-group m-form__group">
                            <label class="col-form-label pt-0 mb-2" for="">Bác sĩ</label>
                            <select class="form-control ${rowId}_doctor_id" name="doctor_id[]" id="">
                                @foreach ($user as $us)
                                    <option value="{{$us->id}}"
                                        @if ($us->id == $bookingServices->doctor_id)
                                            selected
                                        @endif
                                    >{{$us->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 form-group m-form__group">
                            <label class="col-form-label pt-0 mb-2" for="">Ngày khám</label>
                            <input class="form-control ${rowId}_date" name="date[]"  id="${rowId}_date" type="text"
                                        placeholder="Select date"  autocomplete="off" required>
                        </div>
                        <div class="col-12 form-group m-form__group">
                            <label class="col-form-label pt-0" for="">Thời gian </label>
                            <div class="row">
                                <div class="col-6">
                                    Từ: <input class="form-control ${rowId}_time_start" name="time_start[]" id="${rowId}_time_start" type="text" readonly=""
                                    placeholder="Select time start"  autocomplete="off" required>
                                </div>
                                <div class="col-6">
                                    Đến: <input class="form-control ${rowId}_time_end" name="time_end[]" id="${rowId}_time_end" type="text" readonly=""
                                    placeholder="Select time end"  autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 form-group m-form__group">
                            <label class="col-form-label pt-0" for="exampleInputPassword1">Ghi chú</label>
                            <textarea class="form-control m-input m-input--air ${rowId}_note" name="note[]" id="exampleTextarea" placeholder="..." rows="3"></textarea>
                        </div>
                        <input type="hidden" class="${rowId}_status" id="status" name="status[]" value="9">
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="" name="btn" value="0" onclick="submit( ${rowId}, {{$bookingServices->id}})" class="btn btn-success">Lưu</button>
                                <button class="btn btn-danger" onclick="remove(this)">Xóa</button>
                            </div>
                        </div>

                    </div>
                `);
            })

        })

        function loadStart(event, el_rowId){
            let date = '#' + el_rowId + '_date';
            let time_start = '#' + el_rowId + '_time_start';
            let time_end = '#' + el_rowId + '_time_end';
            let today = moment().format('YYYY-MM-DD');
            $(date).datepicker({
                todayHighlight:!0,
                autoclose:!0,
                format:"yyyy-mm-dd",
                startDate: today
            });
            $(time_start).timepicker({
                autoclose:!0
            });
            $(time_end).timepicker({
                autoclose:!0
            });
        }
        function remove(el, id){
            var r = confirm("Bạn có chắc muốn xóa lịch hẹn này !");
            var remove = "remove";
            if (r == true) {
                if(id != undefined){
                    $.ajax({
                        type: "post",
                        url: "{{ route('booking.save.schedule')}}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            remove: remove
                        },
                        success: function (response) {
                            if(response['msg'] == ""){
                                swal("Xóa thành công","","success");
                                // setTimeout(function() {
                                //     window.location.href = "{{ route('booking.index') }}";
                                // }, 200);
                            }
                        }
                    });
                    $(el).parent().parent().parent().remove();
                }
                $(el).parent().parent().parent().remove();
            } else {
            
            }
        }
    </script>
    <script>
        function submit(id, idServices){
            let date = $("." + id + "_date").val();
            let time_start = $("." + id + "_time_start").val();
            let time_end = $("." + id + "_time_end").val();
            let doctor_id = $("." + id + "_doctor_id").val();
            let status = $("." + id + "_status").val();
            let note = $("." + id + "_note").val();
            $("#" + id + "_error").html();
            $.ajax({
                type: "post",
                url: "{{ route('booking.save.schedule')}}",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    idServices: idServices,
                    date: date,
                    time_start: time_start,
                    time_end: time_end,
                    doctor_id: doctor_id,
                    note: note,
                    status: status
                },
                success: function (response) {
                    $("#" + id + "_error").html(response['msg']);
                    if(response['msg'] == ""){
                        toastr.success('Lưu lịch khám thành công!');
                        // setTimeout(function() {
                        //     window.location.href = "{{ route('booking.index') }}";
                        // }, 200);
                    }
                }
            });
        }
    </script>
@endsection
