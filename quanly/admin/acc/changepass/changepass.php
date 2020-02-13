<?php
if (!isset($rt)) die();
$user=new apps_libs_UserLogin();
?>
<div class="h-padding">
    <div class="row">
        <h1 class="page-header">Sửa mật khẩu</h1>
    </div>
    <div class="row" id="noti">

    </div>
    <div class="row">
        <form class="form-horizontal h-block h-padding" action="/action_page.php">
            <div class="form-group">
                <label class="control-label col-sm-2">Tài khoản:</label>
                <div class="col-sm-10">
                    <input disabled type="text" value=<?php echo '"'.$user->GetUserNameAcc().'"';?> class="form-control" id="user_name" placeholder="">
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Nhập Mật Khẩu Hiện Tại:</label>
                <div class="col-sm-10">
                    <input class="form-control" id='pass' type="password" placeholder="Điền mật khẩu hiện tại" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Nhập Mật Khẩu Mới:</label>
                <div class="col-sm-10">
                    <input class="form-control" id='newpass' type="password" placeholder="Điền mật khẩu mới" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Nhập Lại Mật Khẩu Mới:</label>
                <div class="col-sm-10">
                    <input class="form-control" id='repeatnewpass' type="password" placeholder="Điền lại mật khẩu mới" />
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <input onclick="send_ajax()" type="button" id="submit" class="btn btn-primary" value="Đổi mật khẩu"/>
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
            url: "acc/changepass/save.php",
            type: "post",
            dataType: "json",
            data: {
                submit:$('#submit').val(),
                pass:$('#pass').val(),
                newpass:$('#newpass').val(),
                repeatnewpass:$('#repeatnewpass').val(),
            },
            success: function (result) {
                $("#submit").val('Đổi mật khẩu');
                $('#submit').removeAttr('disabled');
                create_noti("noti",result.classify_alerts,result.mess);
                up_page();
            }
        });
    }
</script>