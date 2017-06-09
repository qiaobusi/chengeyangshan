<!-- head -->
@include('manage.public.head')
<!-- head -->

<!-- left -->
@include('manage.public.left')
<!-- left -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            管理后台
            <small>1.0.0</small>
        </h1>
        <ol class="breadcrumb">
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">文章</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>类型</th>
                                    <th>标题</th>
                                    <th>发布时间</th>
                                    <th>状态</th>
                                    <th style="width: 200px; text-align:right;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($articles as $article)
                                    <tr>
                                        <td>{{ $article->id }}</td>
                                        <td style="color:#ff0000;">@if($article->type == 1) 善 @else 恶 @endif</td>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ $article->created_at }}</td>
                                        <td style="color:#ff0000;">@if($article->state == 1) 正常 @else 关闭 @endif</td>
                                        <td style="width: 200px; text-align:right;">
                                            @if($article->state == 1)
                                                <button type="button" class="btn btn-sm btn-info" onclick="doclose({{ $article->id }})">关闭</button>
                                            @else
                                                <button type="button" class="btn btn-sm btn-info" onclick="doopen({{ $article->id }})">开启</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {!! $articles->render() !!}
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
        </div>
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

    var dataId = 0;

    function doclose(id) {
        dataId = id;
        showConfirm('关闭', '确认关闭？', docloseUser);
    }

    function docloseUser() {
        $.ajax({
            url: '{{url("manage/article/close")}}',
            type: 'GET',
            data: {
                'id': dataId,
            },
            dataType: 'JSON',
            success: function(data) {
                showAlert('提示', data.info, null);
                if (data.status == 1) {
                    window.location.reload();
                }
            }
        });
    }

    function doopen(id) {
        dataId = id;
        showConfirm('打开', '确认打开？', doopenUser);
    }

    function doopenUser() {
        $.ajax({
            url: '{{url("manage/article/open")}}',
            type: 'GET',
            data: {
                'id': dataId,
            },
            dataType: 'JSON',
            success: function(data) {
                showAlert('提示', data.info, null);
                if (data.status == 1) {
                    window.location.reload();
                }
            }
        });
    }

</script>

<!-- right -->
@include('manage.public.right')
<!-- right -->

<!-- foot -->
@include('manage.public.foot')
<!-- foot -->