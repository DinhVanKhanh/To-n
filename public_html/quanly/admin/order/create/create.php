<?php
if (!isset($rt)) die();
?>
<div class="h-padding">
    <div class="row">
        <h1 class="page-header">Tạo danh mục bài viết</h1>
    </div>
    <div class="row" id="noti">

    </div>
    <div class="row">
        <form class="form-horizontal h-block h-padding" action="/action_page.php">
            <div class="form-group">
                <label class="control-label col-sm-2">Tên danh mục</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Nhập tên danh mục">
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <input onclick="send_ajax()" type="button" id="submit" class="btn btn-primary" value="Tạo danh mục"/>
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
            url: "post/classify-post/create/save.php",
            type: "post",
            dataType: "json",
            data: {
                submit:$('#submit').val(),
                name:$('#name').val()
            },
            success: function (result) {
                $("#submit").val('Tạo danh mục');
                $('#submit').removeAttr('disabled');
                create_noti("noti",result.classify_alerts,result.mess);
                up_page();
            }
        });
    }
</script>