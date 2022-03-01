@extends('backend.layout.main')
@section('content')
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Danh sách Slider
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{route('slider.add')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Thêm slider</span>
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
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sliders as $slider)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $slider->title }}</td>
                            <td><img src="{{ asset($slider->image) }}" alt="" width="70px"></td>
                            <td>
                                <input type="checkbox" class="toggle-class" data-toggle="toggle" data-id="{{$slider->id}}" data-on="Enabled" data-off="Disabled" {{$slider->status == true ? 'checked' : ''}}>
                            </td>
                            <td>
                                <a href="{{route('slider.edit', ['id' => $slider->id])}}" class="btn btn-warning"><i
                                        class="fas fa-wrench"></i></a>
                                <a href="javascript:;" class="btn btn-danger" onclick="confirmRemove('{{ route('slider.deleteEdit', [ 'id' => $slider->id ]) }}')">
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
{{--1--}}
@section('script')
    <script>
        $(function() {
            $('#toggle-two').bootstrapToggle({
                on: 'Enabled',
                off: 'Disabled'
            });
        })
    </script>
    <script>
        $('.toggle-class').on('change',function (){
            var status = $(this).prop('checked') == true ? 1 : 0;
            var slider_id = $(this).data('id');
            var url = '{{route('slider.changeStatus')}}';
            $.ajax({
                type : 'GET',
                url : url,
                dataType : 'JSON',
                data : {
                    'id' : slider_id,
                    'status' : status
                },
                success : function (response){
                    toastr.success(response.success)
                }
            })
        })
    </script>
@endsection

