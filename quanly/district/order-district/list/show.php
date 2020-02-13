<?php
if (!isset($rt)) die();
?>

<div class="h-padding">
    <div class="row">
        <h1 class="page-header">Danh Sách Mặt Hàng</h1>
    </div>
    <div class="row" id="noti">

    </div>
    <div class="row">  
        <div class="h-block h-padding">
            <div class="row">
                <div class="col-lg-12" id="data">
                </div>
                <div class="col-lg-12">
                    <div class="form-group"> 
                        <div class="col-sm-10">
                            <input onclick="send_ajax()" type="button" id="submit" class="btn btn-primary" value="Đặt Hàng"/>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        function send_ajax() {
            $("#submit").val('Đang Đặt Hàng...');
            $('#submit').attr('disabled', true);    
            $.ajax({
                url: "order-district/list/send-order.php",
                type: "post",
                dataType: "json",
                data: {
                    submit:$('#submit').val(),
                    json:create_json()
                },
                success: function (result) {
                    $("#submit").val('Đặt Hàng');
                    $('#submit').removeAttr('disabled');
                    create_noti("noti",result.classify_alerts,result.mess);
                    up_page();
                }
            });
        }

        function create_json()
        {
            var json='[';
            var data=$(".count-sp");
            for(var i=0;i<data.length;i++)
            {
                var product_id=$(data[i]).attr("data-product");
                var quantity=$(data[i]).val();
                if(quantity>0)
                json += "{\"product_id\":\"" + product_id + "\",\"quantity\":\"" + quantity + "\"},";
            }

            if (json.length > 8) json = json.substring(0, json.length - 1);
            json+="]";
            return json;
        }

        function load_ajax(number, value = null, max = null) {
            $("#data").html('<img style="margin-left:45%;" src="../img/pleasewait/plw.gif" />');
            if (!max) max = $("#max-row").val();
            $.ajax({
                url: "order-district/list/loaddata.php",
                type: "post",
                dataType: "text",
                data: {
                    number: number,
                    s: value,
                    max: max
                },
                success: function (result) {
                    $('#data').html(result);
                    $('#data').slideUp(50, 'swing').fadeIn(200);
                }
            });
        }
        load_ajax(1);
    </script>