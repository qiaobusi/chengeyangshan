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
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">管理员</h3>
                    </div>
                    <form class="form-horizontal" id="form" action="{{ url("manage/manager/insert") }}">
                        <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">用户名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="用户名称">
                                    <span class="help-block" style="color:#f00;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">登陆密码</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="登陆密码">
                                    <span class="help-block" style="color:#f00;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align:right;">
                            <button type="button" class="btn btn-sm btn-default" id="resetForm">清空</button>&nbsp;
                            <button type="button" class="btn btn-sm btn-primary" id="saveForm">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

    $(function(){
        $('#resetForm').click(function(){
            $('#username').val('');
            $('#password').val('');
        });

        $('#saveForm').click(function(){
            var username = $.trim($('#username').val());
            if (username == '') {
                $('#username').parents('.form-group').addClass('has-error');
                $('#username').parent().find('.help-block').html('请输入用户名称');
                return false;
            }
            var password = $.trim($('#password').val());
            if (password == '') {
                $('#password').parents('.form-group').addClass('has-error');
                $('#password').parent().find('.help-block').html('请输入登陆密码');
                return false;
            }

            $.ajax({
                url: $('#form').attr('action'),
                type: 'POST',
                data: {
                    'username': username,
                    'password': password,
                    '_token': $('#_token').val()
                },
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == 1) {
                        window.location.href = '{{ url("manage/manager/index") }}';
                    } else {
                        showAlert('提示', data.info, null);

                        var _token = '{{ csrf_token() }}';
                        $('#_token').val(_token);
                    }
                }
            });
        });

        $('#username').focus(function(){
            if ($('#username').parents('.form-group').hasClass('has-error')) {
                $('#username').parents('.form-group').removeClass('has-error');
                $('#username').parent().find('.help-block').html('');
            }
        });
        $('#password').focus(function(){
            if ($('#password').parents('.form-group').hasClass('has-error')) {
                $('#password').parents('.form-group').removeClass('has-error');
                $('#password').parent().find('.help-block').html('');
            }
        });

    });

</script>

<!-- right -->
@include('manage.public.right')
<!-- right -->

<!-- foot -->
@include('manage.public.foot')
<!-- foot -->