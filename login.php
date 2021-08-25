<?php
include 'function.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>√</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="amazeui.flat.min.css" />
    <style>
        .header {
            text-align: center;
        }

        .header h1 {
            font-size: 200%;
            color: #333;
            margin-top: 30px;
        }

        .header p {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="am-g">
            <h1>√</h1>
        </div>
    </div>
    <div class="am-g">
        <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">

            <form method="post" class="am-form" id="myform">

                <input type="password" name="pass" id="pass" value="" required>
                <br>
                <br />
                <div class="am-cf">
                    <input type="submit" name="" value="√" class="am-btn am-btn-primary am-btn-sm am-fl">

                </div>
            </form>
            <hr>

        </div>
    </div>

    <div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">错误</div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>

    <script src="jquery.min.js"></script>
    <script src="amazeui.min.js"></script>
    <script src="js.js"></script>
    <script>
        $(function () {
            $('#myform').bind('submit', function () {
                var pass = $('#pass').val();
                $.post('js_login.php', {'pass': pass,'rand': Math.random() }, function (data) {
                    //alert(data);
                    if (data == 'success') {
                        window.location.href='index.php';
                    }
                    else {
                        $('#my-alert').modal();
                    }
                });
                return false;
            });
        });
    </script>
</body>

</html>