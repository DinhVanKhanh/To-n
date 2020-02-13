<?php
if (!isset($rt)) die();
$id = '';
if ($rt->GetGet('id')) {
    $id = $rt->GetGet('id');
}
$product = new apps_model_Products($id);
$data = $product->SelectProducts();

$db = new apps_libs_Dbconn();
$param = [
    "select" => "*",
    "from" => "videos",
    "where" => "video_product=$id and demo=1"
];
$row=null;
$result = $db->SelectOne($param);
if ($result) {
    $row = mysqli_fetch_assoc($result);
}
?>
<div class="h-padding">
    <div class="row">
        <h1 class="page-header">Video giới thiệu</h1>
    </div>
    <div class="row" id="noti">
    </div>
    <div class="row">
        <form class="form-horizontal h-block h-padding" action="/action_page.php">
            <div class="form-group">
                <label class="control-label col-sm-2">Sản phẩm:</label>
                <div class="col-sm-10">
                    <input disabled value=<?php echo '"' . $data["product_name"] . '"'; ?> type="text" class="form-control" id="name" placeholder="">
                    <span class="h-proviso"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2">Chọn file upload:</label>
                <div class="col-lg-10">
                    <input class="col-lg-6" type="file" name="file" id="file" multiple>
                    <div class="col-lg-6">
                        <input onclick="up()" id="upload_file" type="button" class="btn btn-primary btn-sm" value="Tải tệp lên"/>
                    </div>
                </div>
            </div>
            <div id="gr-upload-pro" style="display:none" class="form-group">
                <label class="col-lg-2">Các file đang upload:</label>
                <div class="col-lg-10" id="progress-group">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2">Video đã up:</label>
                <div class="col-lg-10">
                    <video <?php echo $row?"":"style='display:none'"; ?> controls style="width:300px;height:150px;" controlsList="nodownload">
                        <?php echo $row?"<source src=\"/blockdonwload/donwload.php?key=".$row["keyss"]. '&video_id='.$row["video_id"].'"></source>':""; ?>    
                    </video>
                    <?php echo $row?$row["video_name"]:""?>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function up() {
        $("#upload_file").attr("disabled",true);
        $("#upload_file").val("Đang tải lên");
        $("#submit").attr("disabled",true);
        $("#submit").val("Chờ tải file");


        $("#gr-upload-pro").css("display","block");
        doUpload('file', 'progress-group', '../../../../uploads/upload.php',<?php echo '"' . $id . '"'; ?>);
        check_done();
    }
    function check_done()
    {
        setTimeout(function () {
            if(checkUploaded==true) 
            {
                $("#upload_file").removeAttr("disabled");
                $("#upload_file").val("Tải tệp lên");
            }
            else check_done();
        },100);
    }
</script>