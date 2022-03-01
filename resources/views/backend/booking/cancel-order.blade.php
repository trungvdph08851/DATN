@extends('backend.layout.main')
@section('addStyle')
    
@endsection
@section('content')
<div class="m-content">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Danh sách lịch khám đã hủy
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                
            </div>
        </div>
        <div class="m-portlet__body data">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="table_id">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã hóa đơn</th>
                        <th>Tên</th>
                        <th>Số điện thoại</th>
                        <th>Dịch vụ</th>
                        <th>Ngày đặt</th>
                        <th>Lý do hủy</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($booking as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->booking_code }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone_number }}</td>
                            <td>
                                @foreach ($item->services as $s)
                                    *{{ $s->name }} <br>
                                @endforeach
                            </td>
                            <td>{{ date('Y-m-d H:i', strtotime($item->created_at)) }}</td>
                            <td>{{$item->note}}</td>
                            <td>
                                @if ($item->status == BOOKING_REJECTED)
                                    <span class="btn btn-danger status-booking">Hủy bỏ</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('restore.order', ['id' => $item->id])}}" class="btn m-btn--pill m-btn--air         btn-metal"><i class="la la-history"></i>Khôi phục đơn</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
@section('script')
    

@endsection
@section('addScript')

    
@endsection
