@extends('backend.layout.main')
@section('content')
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Cấu hình website
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{route('setting.add')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Thêm</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Logo</th>
                        <th>Thời gian hoạt động</th>
                        <th>Cấu hình footer</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($setting as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->name_system }}</td>
                            <td><img src="{{ asset($s->logo) }}" width="70" /></td>
                            <td>{{$s->operating_hours}}</td>
                            <td><?php echo $s->contact_information ?></td>

                            <td>
                                <a href="{{route('setting.edit', ['id' => $s->id])}}" class="btn btn-warning"><i
                                        class="fas fa-wrench"></i></a>
                                <a href="javascript:;" class="btn btn-danger" onclick="confirmRemove('{{route('setting.delete', ['id' => $s->id])}}')">
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
{{--quang--}}
