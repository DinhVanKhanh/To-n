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
                <div class="form-group ">
                    <label class="control-label col-sm-2">Họ Tên:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="user_fullname" placeholder="Họ Tên">
                        <span class="h-proviso"></span>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="control-label col-sm-2">Sdt:</label>
                    <div class="col-sm-10">
                        <input type="text" maxlength="11" class="form-control" id="user_sdt" placeholder="Số điện thoại">
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
                <label class="control-label col-sm-2">Chọn Loại Tài Khoản:</label>
                <div class="col-sm-10">
                    <select onchange="change()" id='select_chose_type' class='form-control'>    
                        <option value="1">Tài Khoản Thành Phố</option>
                        <option value="2">Tài Khoản Huyện</option>
                        <option value="3">Tài Khoản Tự Do</option>
                    </select>
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Địa Chỉ:</label>
                <div class="col-sm-10">
                    <textarea class='form-control' id="addre">
                    </textarea>
                    <span class="h-proviso"></span>
                </div>
            </div>
                <div id="chose_tp" class="form-group">
                    <label class="control-label col-sm-2">Chọn thành phố:</label>
                    <div class="col-sm-10">
                        <?php
                            $tp=new apps_model_TinhThanh();
                            echo $tp->CreateTagSelect("matp");
                        ?>
                        <span class="h-proviso"></span>
                    </div>
                </div>
                <div style="display: none" id="chose_qh" class="form-group">
                    <label class="control-label col-sm-2">Chọn huyện:</label>
                    <div class="col-sm-10">
                        <select id='maqh' class='form-control'>
                        </select>
                        <span class="h-proviso"></span>
                    </div>
                </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input onclick="send_ajax()" type="button" id="submit" class="btn btn-primary" value="Tạo tài khoản" />
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function change(){
        if($("#select_chose_type").val()==1)
        {
            $("#chose_qh").css("display","none");
            $("#chose_tp").css("display","block");
        }else if($("#select_chose_type").val()==2 || $("#select_chose_type").val()==3)
        {
            $("#chose_qh").css("display","block");
            $("#chose_tp").css("display","block");
        }
        // else if($("#select_chose_type").val()==3)
        // {
        //     $("#chose_qh").css("display","none");
        //     $("#chose_tp").css("display","none");
        // }
    }
    function load_ajax_district(select = null) {
        cityValue = $("#matp").val();
        $.ajax({
            url: '../../default/includes/get-district.inc.php',
            data: {
                'cityValue': cityValue,
                select: select
            },
            dataType: 'TEXT',
            method: 'POST',
            success: function (result) {
                $('#maqh').html(result);
            }
        });
    };
    function send_ajax() {
        $("#submit").val('Đang Lưu...');
        $('#submit').attr('disabled', true);
        var matp=null;
        var type_acc=$("#select_chose_type").val();
        if(type_acc==1) matp= $('#matp').val()
        else if(type_acc==2 || type_acc==3) matp= $('#maqh').val()
        else matp= "";
        
        $.ajax({
            url: "acc-child/create/save.php",
            type: "post",
            dataType: "json",
            data: {
                submit: $('#submit').val(),
                user_username: $('#user_username').val(),
                user_password: $('#user_password').val(),
                user_fullname: $('#user_fullname').val(),
                user_sdt: $('#user_sdt').val(),
                user_email: $('#user_email').val(),
                addre:$("#addre").val(),
                matp: matp,
                type_acc:type_acc
                
            },
            success: function (result) {
                $("#submit").val('Tạo tài khoản');
                $('#submit').removeAttr('disabled');
                create_noti("noti", result.classify_alerts, result.mess);
                up_page();
            }
        });
    }
</script>