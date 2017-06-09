<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>chengeyangshan</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link href="{{ asset("assets/AdminLTE/bootstrap/css/bootstrap.min.css") }}" type="text/css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css") }}" type="text/css" rel="stylesheet">
    <!-- Ionicons -->
    <link href="{{ asset("https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css") }}" type="text/css" rel="stylesheet">
    <!-- jvectormap -->
    <link href="{{ asset("assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css") }}" type="text/css" rel="stylesheet">
    <!-- Theme style -->
    <link href="{{ asset("assets/AdminLTE/dist/css/AdminLTE.min.css") }}" type="text/css" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset("assets/AdminLTE/dist/css/skins/_all-skins.min.css") }}" type="text/css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!–[if lt IE 9]>
    <script src="{{ asset("https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("https://oss.maxcdn.com/respond/1.4.2/respond.min.js") }}" type="text/javascript"></script>
    <![endif]–>

    <!-- jQuery 2.2.3 -->
    <script src="{{ asset("assets/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}" type="text/javascript"></script>

    <style type="text/css">
        html, body {
            height: 100%;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
        }
        .container {
            display: table-cell;
            vertical-align: middle;
        }
    </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">

<!-- modal-dialog -->
<div id="confirm" class="modal modal-default">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="confirmTitle"></h4>
            </div>
            <div class="modal-body" id="confirmBody">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-success" id="confirmOk">确认</button>
            </div>
        </div>
    </div>
</div>

<div id="alert" class="modal modal-default">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="alertTitle"></h4>
            </div>
            <div class="modal-body" id="alertBody">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="alertOk">确认</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function showConfirm(title, body, callback) {
        $('#confirmTitle').html(title);
        $('#confirmBody p').html(body);
        $('#confirm').modal('show');
        $('#confirmOk').click(function(){
            callback();
            $('#confirm').modal('hide');
        });
    }

    function showAlert(title, body, callback = null) {
        $('#alertTitle').html(title);
        $('#alertBody p').html(body);
        $('#alert').modal('show');
        $('#alertOk').click(function(){
            $('#alert').modal('hide');
        });
    }
</script>
<!-- modal-dialog -->

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">登录</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" id="form" action="{{ url('manage/index/login')  }}">
                    <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">账号</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="username" placeholder="账号" type="text">
                                <span class="help-block" style="color:#f00;"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">密码</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="password" placeholder="密码" type="password">
                                <span class="help-block" style="color:#f00;"></span>
                            </div>
                        </div>
                        <!--
                        <div class="form-group" style="text-align: left;">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 记住我
                                    </label>
                                </div>
                            </div>
                        </div>
                        -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-right">
                        <button type="button" class="btn btn-default" id="resetForm">清 空</button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-primary" id="saveForm">登 录</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

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
                        window.location.href = '{{url("manage/main/index")}}';
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

<!-- Bootstrap 3.3.6 -->
<script src="{{ asset("assets/AdminLTE/bootstrap/js/bootstrap.min.js")  }}" type="text/javascript"></script>
<!-- FastClick -->
<script src="{{ asset("assets/AdminLTE/plugins/fastclick/fastclick.js")  }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset("assets/AdminLTE/dist/js/app.min.js")  }}" type="text/javascript"></script>
<!-- Sparkline -->
<script src="{{ asset("assets/AdminLTE/plugins/sparkline/jquery.sparkline.min.js")  }}" type="text/javascript"></script>
<!-- jvectormap -->
<script src="{{ asset("assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")  }}" type="text/javascript"></script>
<script src="{{ asset("assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js")  }}" type="text/javascript"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset("assets/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js")  }}" type="text/javascript"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset("assets/AdminLTE/plugins/chartjs/Chart.min.js")  }}" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset("assets/AdminLTE/dist/js/pages/dashboard2.js")  }}" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("assets/AdminLTE/dist/js/demo.js")  }}" type="text/javascript"></script>

</body>
</html>
