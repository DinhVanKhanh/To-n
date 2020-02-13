<?php
if (!isset($rt)) die();
$id = '';
if ($rt->GetGet('id')) {
    $id = $rt->GetGet('id');
}
$db = new apps_libs_Dbconn();
$user = new apps_model_User($id);
$data = $user->SelectUser();

// Lấy tất cả tỉnh và huyện
$tinhthanh = $db->getAllTp();
$quanhuyen = $db->getAllQh();
// Nếu chưa có name và sdt set bang null
// var_dump($tinhthanh);

if(empty($data['user_fullname']))
    $data['user_fullname'] = '';
if(empty($data['user_sdt']))
    $data['user_sdt'] = '';

// xét theo loại admin để lấy địa chỉ
if($data['user_type'] == 3 || $data['user_type'] == 4){
    // var_dump($quanhuyen['016']);
    $maqh1 = (int)$data['matp'];
    if(!empty($maqh1)){      
        $matp = $quanhuyen[$maqh1]->matp;
    }else{
        $maqh1 = 1;
        $matp = 1;
    }
}else{
    $matp = $data['matp'];
    $maqh1 = 0;
}

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
                    <input type="text" class="form-control" id="user_username" placeholder="Nhập tài khoản" readonly="" value="<?=$data['user_username']?>">
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Mật khẩu:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="user_password" placeholder="Nhập mật khẩu" readonly value="<?=$data['user_password']?>">
                    <label>
                        <input id="changepass" type="checkbox" name="changepass" value="0" onchange="changePass(this)" >Đổi mật khẩu
                    </label>

                    <span class="h-proviso"></span>
                </div>
            </div>
                <div class="form-group ">
                    <label class="control-label col-sm-2">Họ Tên:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="user_fullname" placeholder="Họ Tên" value="<?=$data['user_fullname']?>">
                        <span class="h-proviso"></span>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="control-label col-sm-2">Sdt:</label>
                    <div class="col-sm-10">
                        <input type="text" maxlength="11" class="form-control" id="user_sdt" placeholder="Số điện thoại" value="<?=$data['user_sdt']?>">
                        <span class="h-proviso"></span>
                    </div>
                </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Nhập email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user_email" placeholder="Nhập email" readonly value="<?=$data['user_email']?>">
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Chọn Loại Tài Khoản:</label>
                <div class="col-sm-10">
                    <select onchange="change()" id='select_chose_type' class='form-control'>    
                        <option value="2">Tài Khoản Thành Phố</option>
                        <option value="3">Tài Khoản Huyện</option>
                        <option value="4">Tài Khoản Tự Do</option>
                    </select>
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Địa Chỉ:</label>
                <div class="col-sm-10">
                    <textarea class='form-control' id="addre">
                        <?=$data['addre']?>"
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
                    <input onclick="send_ajax()" type="button" id="submit" class="btn btn-primary" value="Cập nhật" />
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    setTimeout(function(){
        $('#select_chose_type').val(<?=$data['user_type']?>).change();
        matp = <?=$matp?>;

        if(<?=$data['user_type']?> == 3 || <?=$data['user_type']?> == 4){
            if(matp < 10)
                matp = '0'+matp;
            $('#matp').val(matp).change();
            setTimeout(function(){
                maqh = <?=$maqh1?>;
                if(maqh < 100){
                if(maqh < 10)
                    maqh = '00'+maqh;
                else{
                    maqh = '0'+ maqh;
                }   
            }
            $('#maqh').val(maqh);
            },500);
        }else{
            if(matp < 10)
                matp = '0'+matp;
            $('#matp').val(matp);
        }
        
    },500);
    function changePass(e){
        pass_input = $('#user_password');
        if(e.checked){
            e.value = 1;
            pass_input.prop('readonly',false);
        }else{
             e.value = 0;
            pass_input.prop('readonly',true);
        }
    }
    function change(){
        if($("#select_chose_type").val()==2)
        {   
            $("#chose_qh").css("display","none");
            $("#chose_tp").css("display","block");
        }else if($("#select_chose_type").val()==3 || $("#select_chose_type").val()==4)
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
        // $("#submit").val('Đang Lưu...');
        $('#submit').attr('disabled', true);
        var matp=null;
        var type_acc=$("#select_chose_type").val();
        if(type_acc==2) matp= $('#matp').val()
        else if(type_acc==3 || type_acc==4) matp= $('#maqh').val()
        else matp= "";
        
        $.ajax({
            url: "acc-child/edit/save.php",
            type: "post",
            dataType: "json",
            data: {
                submit: $('#submit').val(),
                user_id: <?=$data['user_id']  ?>,
                user_username: $('#user_username').val(),
                user_password: $('#user_password').val(),
                user_fullname: $('#user_fullname').val(),
                changepass: $('#changepass').val(),
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
<!--  -->