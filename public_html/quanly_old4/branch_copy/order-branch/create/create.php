<?php
if (!isset($rt)) die();
?>
<div class="h-padding">
    <div class="row">
        <h1 class="page-header">Tạo Tài Khoản</h1>
    </div>
    <div class="row" id="noti">

    </div>
    <div class="row">
        <form class="form-horizontal h-block h-padding" action="/action_page.php">
            <div class="form-group">
                <label class="control-label col-sm-2">Tài khoản:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user_username" placeholder="Nhập tài khoản">
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Mật khẩu:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="user_password" placeholder="Nhập mật khẩu">
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Nhập email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user_email" placeholder="Nhập email">
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Chọn thành phố:</label>
                <div class="col-sm-10">
                    <?php
                        $user=new apps_libs_UserLogin();
                        $tp=new apps_model_QuanHuyen();
                        echo $tp->CreateTagSelect("matp","",$user->GetCity());
                    ?>
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <input onclick="send_ajax()" type="button" id="submit" class="btn btn-primary" value="Tạo tài khoản"/>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function send_ajax() {
        $("#submit").val('Đang Lưu...');
        $('#submit').attr('disabled', true);    
        $.ajax({
            url: "acc-child/create/save.php",
            type: "post",
            dataType: "json",
            data: {
                submit:$('#submit').val(),
                user_username:$('#user_username').val(),
                user_password:$('#user_password').val(),
                user_email:$('#user_email').val(),
                matp:$('#matp').val()
            },
            success: function (result) {
                $("#submit").val('Tạo tài khoản');
                $('#submit').removeAttr('disabled');
                create_noti("noti",result.classify_alerts,result.mess);
                up_page();
            }
        });
    }
</script>