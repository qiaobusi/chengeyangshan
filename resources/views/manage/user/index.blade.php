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
                        <h3 class="box-title">用户</h3>
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
                                    <th>账号</th>
                                    <th>姓名</th>
                                    <th>注册时间</th>
                                    <th style="width: 200px; text-align:right;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td style="width: 200px; text-align:right;">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="del({{ $user->id }})">删除</button>
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
                        {!! $users->render() !!}
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

    function del(id) {
        delId = id;
        showConfirm('删除', '确认删除？', deleteManager);
    }

    function deleteManager() {
        $.ajax({
            url: '{{url("manage/user/del")}}',
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