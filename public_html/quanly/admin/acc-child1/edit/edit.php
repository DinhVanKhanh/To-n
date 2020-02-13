<?php
if (!isset($rt)) die();
$id = '';
if ($rt->GetGet('id')) {
    $id = $rt->GetGet('id');
}
$user = new apps_model_User($id);
$data = $user->SelectUser();
?>
<div class="h-padding">
    <div class="row">
        <h1 class="page-header">Sửa tài khoản</h1>
    </div>
    <div class="row" id="noti">
    </div>
    <div class="row">
        <form class="form-horizontal h-block h-padding" action="/action_page.php">
        <div class="form-group">
                <label class="control-label col-sm-2">Tài khoản:</label>
                <div class="col-sm-10">
                    <input value="<?php echo $data["user_username"] ?>" disabled type="text" class="form-control" id="user_username">
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Mật khẩu:</label>
                <div class="col-sm-10">
                    <input value="<?php echo $data["user_password"] ?>" type="password" class="form-control" id="user_password">
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Nhập email:</label>
                <div class="col-sm-10">
                    <input value="<?php echo $data["user_email"] ?>" type="text" class="form-control" id="user_email" placeholder="Nhập email">
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Địa Chỉ:</label>
                <div class="col-sm-10">
                    <textarea class='form-control' id="addre"><?php echo $data["addre"] ?></textarea>
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <input onclick="send_ajax()" type="button" id="submit" class="btn btn-primary" value="Lưu tài khoản"/>
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
            url: "acc-child/edit/save.php",
            type: "post",
            dataType: "json",
            data: {
                user_id:<?php echo '"' . $data['user_id'] . '"' ?>,
                submit:$('#submit').val(),
                user_password:$('#user_password').val(),
                user_email:$('#user_email').val(),
                addre:$("#addre").val()
            },
            success: function (result) {
                $("#submit").val('Lưu tài khoản');
                $('#submit').removeAttr('disabled');
                create_noti("noti",result.classify_alerts,result.mess);
                up_page();
            }
        });
    }
    function upload_img()
        {
        //Lấy ra files
        var file_data = $('#file').prop('files')[0];
        //lấy ra kiểu file
        var type = file_data.type;
        //Xét kiểu file được upload
        var match= ["image/png","image/jpg","image/jpeg"];
        //kiểm tra kiểu file
        if(type == match[0] || type == match[1]|| type == match[2])
        {
            //khởi tạo đối tượng form data
            var form_data = new FormData();
            //thêm files vào trong form data
            form_data.append('file', file_data);
            //sử dụng ajax post
            $.ajax({
                url: 'uploadimg.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                       
                type: 'post',
                success: function(res){
                    $('#img').val(res);
                    if(res!="")
                    {
                        $("#img_show").attr("src","../img/rec/"+res);
                        $("#img_show").css("display","block");
                    }
                    //$('#resultfile').html(res);
            }
        });
        } else{
                $('#file').val('');
                alert("Không hỗ trợ loại ảnh này");
        }
        return false;
        }
</script>