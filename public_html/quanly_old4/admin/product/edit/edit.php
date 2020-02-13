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
$row = null;
$result = $db->SelectOne($param);
if ($result) {
    $row = mysqli_fetch_assoc($result);
}

$price_product = new apps_model_PriceProduct();
?>
<div class="h-padding">
    <div class="row">
        <h1 class="page-header">Video giới thiệu</h1>
    </div>
    <div class="row" id="noti">
    </div>
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#video">Video Giới Thiệu</a>
            </li>
            <li>
                <a data-toggle="tab" href="#price1">Giá Cấp Thành Phố</a>
            </li>
            <li>
                <a data-toggle="tab" href="#price2">Giá Cấp Huyện</a>
            </li>
            <li>
                <a data-toggle="tab" href="#price3">Giá Tự Do</a>
            </li>
        </ul>

        <div class="tab-content  h-block h-padding">
            <div id="video" class="tab-pane fade in active">
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
                                <input onclick="up()" id="upload_file" type="button" class="btn btn-primary btn-sm" value="Tải tệp lên" />
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
                            <video <?php echo $row ? "" : "style='display:none'"; ?> controls style="width:300px;height:150px;" controlsList="nodownload">
                                <?php echo $row ? "<source src=\"/blockdonwload/donwload.php?key=" . $row["keyss"] . '&video_id=' . $row["video_id"] . '"></source>' : ""; ?>
                            </video>
                            <?php echo $row ? $row["video_name"] : "" ?>
                        </div>
                    </div>
                </form>
            </div>
            <div id="price1" class="tab-pane fade">
                <form class="form-horizontal h-block h-padding" action="/action_page.php">  
                    <div class="form-group">
                        <label class="control-label col-sm-2">Sản phẩm:</label>
                        <div class="col-sm-10">
                            <input disabled value=<?php echo '"' . $data["product_name"] . '"'; ?> type="text" class="form-control" placeholder="">
                            <span class="h-proviso"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Giá:</label>
                        <div class="col-sm-10">
                            <?php
                            $data_price1 = $price_product->SelectPriceProductToIdProduct($id, 1);
                            ?>
                            <input id="product_price1" value=<?php echo '"' . (isset($data_price1["product_price"]) ? $data_price1["product_price"] : "0") . '"'; ?> type="number" class="form-control" placeholder="">
                            <span class="h-proviso"></span>
                        </div>
                    </div>
                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <input onclick="send_ajax(1)" type="button" id="submit" class="btn btn-primary" value="Lưu giá"/>
                        </div>
                    </div>
                </form>
            </div>
            <div id="price2" class="tab-pane fade">
                <form class="form-horizontal h-block h-padding" action="/action_page.php">  
                    <div class="form-group">
                        <label class="control-label col-sm-2">Sản phẩm:</label>
                        <div class="col-sm-10">
                            <input disabled value=<?php echo '"' . $data["product_name"] . '"'; ?> type="text" class="form-control" placeholder="">
                            <span class="h-proviso"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Giá:</label>
                        <div class="col-sm-10">
                            <?php
                            $data_price2 = $price_product->SelectPriceProductToIdProduct($id, 2);
                            ?>
                            <input id="product_price2" value=<?php echo '"' . (isset($data_price2["product_price"]) ? $data_price2["product_price"] : "0") . '"'; ?> type="number" class="form-control" placeholder="">
                            <span class="h-proviso"></span>
                        </div>
                    </div>
                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <input onclick="send_ajax(2)" type="button" id="submit" class="btn btn-primary" value="Lưu giá"/>
                        </div>
                    </div>
                </form>
            </div>
            <div id="price3" class="tab-pane fade">
                <form class="form-horizontal h-block h-padding" action="/action_page.php">  
                    <div class="form-group">
                        <label class="control-label col-sm-2">Sản phẩm:</label>
                        <div class="col-sm-10">
                            <input disabled value=<?php echo '"' . $data["product_name"] . '"'; ?> type="text" class="form-control" placeholder="">
                            <span class="h-proviso"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Giá:</label>
                        <div class="col-sm-10">
                            <?php
                            $data_price3 = $price_product->SelectPriceProductToIdProduct($id, 3);
                            ?>
                            <input id="product_price3" value=<?php echo '"' . (isset($data_price3["product_price"]) ? $data_price3["product_price"] : "0") . '"'; ?> type="number" class="form-control" placeholder="">
                            <span class="h-proviso"></span>
                        </div>
                    </div>
                    <div class="form-group"> 
                        <div class="col-sm-offset-2 col-sm-10">
                            <input onclick="send_ajax(3)" type="button" id="submit" class="btn btn-primary" value="Lưu giá"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function send_ajax(i) { 
        $("#submit").val('Đang Lưu...');
        $('#submit').attr('disabled', true);  
        var product_price=0;
        switch(i)
        {
            case 1:
                product_price=$("#product_price1").val();
                break;
            case 2:
                product_price=$("#product_price2").val();
                break;
            case 3:
                product_price=$("#product_price3").val();
                break;
        }
        $.ajax({
            url: "product/edit/save-price.php",
            type: "post",
            dataType: "json",
            data: {
                submit:$("#submit").val(),
                product_id:<?php echo '"' . $id . '"' ?>,
                product_price:product_price,
                level:i
            },
            success: function (result) {
                $("#submit").val('Lưu giá');
                $('#submit').removeAttr('disabled');
                create_noti("noti",result.classify_alerts,result.mess);
                up_page();
            }
        });
    }
    function up() {
        $("#upload_file").attr("disabled", true);
        $("#upload_file").val("Đang tải lên");
        $("#submit").attr("disabled", true);
        $("#submit").val("Chờ tải file");


        $("#gr-upload-pro").css("display", "block");
        doUpload('file', 'progress-group', '../../../../uploads/upload.php',<?php echo '"' . $id . '"'; ?>);
        check_done();
    }
    function check_done() {
        setTimeout(function () {
            if (checkUploaded == true) {
                $("#upload_file").removeAttr("disabled");
                $("#upload_file").val("Tải tệp lên");
            }
            else check_done();
        }, 100);
    }
</script>