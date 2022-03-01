@extends('backend.layout.main')
@section('content')
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Danh sách bài viết
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{route('article.add')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Thêm bài viết</span>
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
                        <th>Tiêu đề</th>
                        <th>Danh mục</th>
                        <th>Ảnh</th>
                        <th>Ngày tạo</th>
                        <th>Trạng thái</th>
                        <th><span class="m-bootstrap-switch m-bootstrap-switch--pill">
                </span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{Str::limit($article->title, 30, ' ...')}}</td>
                            <td>{{ $article->CategoryArticle->name }}</td>
                            <td><img src="{{ asset('img') }}/{{$article->avatar}}" alt="" width="100px"></td>
                            <td>{{ $article->created_at }}</td>
                            <td>
                                <input type="checkbox" class="toggle-class" data-toggle="toggle" data-id="{{$article->id}}" data-on="Enabled" data-off="Disabled" {{$article->status == true ? 'checked' : ''}}>
                            </td>
                            <td>
                                <a href="{{route('article.edit', ['id' => $article->id])}}" class="btn btn-warning"><i
                                        class="fas fa-wrench"></i></a>
                                <a href="javascript:;" class="btn btn-danger" onclick="confirmRemove('{{ route('article.delete', [ 'id' => $article->id ]) }}')">
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
            $('#toggle-two').bootstrapToggle({
                on: 'Enabled',
                off: 'Disabled'
            });
        })
    </script>
    <script>
        $('.toggle-class').on('change',function (){
            var status = $(this).prop('checked') == true ? 1 : 0;
            var article_id = $(this).data('id');
            var url = '{{route('article.changeStatus')}}';
            $.ajax({
                type : 'GET',
                url : url,
                dataType : 'JSON',
                data : {
                    'id' : article_id,
                    'status' : status
                },
                success : function (response){
                    toastr.success(response.success)
                }
            })
        })
    </script>
@endsection
{{--quang--}}
