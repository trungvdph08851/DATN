@extends('backend.layout.main')
@section('content')
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Danh sách dịch vụ
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{route('services.add')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Thêm dịch vụ</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th>Giá</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->name }}</td>
                                <td><img src="{{ asset($s->image) }}" width="70" /></td>
                                <td>{{number_format($s->price, 0, '', ',')}} vnd</td>
                                <td>{{ $s->time }} phút</td>
                                <td>
                                    <input data-id="{{$s->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $s->status ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <a href="{{route('services.edit', ['id' => $s->id])}}" class="btn btn-warning"><i
                                        class="fas fa-wrench"></i></a>
                                    <a href="javascript:;" class="btn btn-danger" onclick="confirmRemove('{{route('services.remove', ['id' => $s->id])}}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
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
<script>
    $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data('id');
    console.log(id)
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{route('services.status')}}",
            data: {'status': status, 'id': id},
            success: function(response){
                toastr.success(response.success)
            }
        });
    })
  })
</script>
@endsection
