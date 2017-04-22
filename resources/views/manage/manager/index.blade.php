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
                        <h3 class="box-title">管理员</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-sm btn-primary" onclick="add()"><span class="glyphicon glyphicon-plus"></span>&nbsp;添加</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>账号</th>
                                    <th>添加时间</th>
                                    <th style="width: 200px; text-align:right;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($managers as $manager)
                                    <tr>
                                        <td>{{ $manager->id }}</td>
                                        <td>{{ $manager->username }}</td>
                                        <td>{{ $manager->created_at }}</td>
                                        <td style="width: 200px; text-align:right;">
                                            <button type="button" class="btn btn-sm btn-info" data-url="{{ url("manage/manager/edit",["id"=>$manager->id])}}" onclick="edit(this)">修改</button>&nbsp;
                                            <button type="button" class="btn btn-sm btn-danger" onclick="del({{ $manager->id }})">删除</button>
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
                        {!! $managers->render() !!}
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

    var delId = 0;

    function add() {
        window.location.href = '{{ url("manage/manager/add") }}';
    }

    function edit(obj) {
        var url = $(obj).data('url');
        window.location.href = url;
    }

    function del(id) {
        delId = id;
        showConfirm('删除', '确认删除？', deleteManager);
    }

    function deleteManager() {
        $.ajax({
            url: '{{ url("manage/manager/del") }}',
            type: 'GET',
            data: {
                'id': delId,
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