<?php
if (!isset($rt)) die();
?>

<div class="h-padding">
    <div class="row">
        <h1 class="page-header">Danh sách đơn hàng</h1>
    </div>
    <div class="row">  
        <div class="h-block h-padding">
            <div class="row">
                <div class="col-lg-4">
                    <div class="input-group">
                        <input onkeydown="h_key_enter(event)" id="h-tf" type="text" class="form-control" placeholder="Nhập tên danh mục bạn muốn tìm">
                        <span class="input-group-btn">
                            <button onclick="search_acc('h-tf')" class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                            <button id="go-return" onclick="go_return()" class="btn btn-default" type="button">
                                <i class="glyphicon glyphicon-menu-left"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <select onchange="set_max_row()" id="max-row" class="form-control">
                        <option>5</option>
                        <option selected>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" id="data">
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        function h_done_order(id)
        {
            if(confirm("Đã tiếp nhận đơn hàng?"))
            {   
                $("#done"+id).html('Đang Thay Đổi...');
                $.ajax({
                    url: "order/list/order-done.php",
                    type: "post",
                    dataType: "text",
                    data: {
                        id:id
                    },
                    success: function (result) {
                 
                        $("#done"+id).html('Đã Xử Lý');
                        $("#done"+id).removeClass();
                        $("#done"+id).addClass("bg-primary");
                    }
                });
            }
        }
        function h_delete(id)
        {
            if(confirm("Bạn chắc chắn muốn xóa?"))
            {   
                $("#bt"+id).html('Đang xóa...');
                $("#bt"+id).attr('disabled', true);    
                $.ajax({
                    url: "order/delete/delete.php",
                    type: "post",
                    dataType: "text",
                    data: {
                        id:id
                    },
                    success: function (result) {
                        $("#tr"+id).addClass("fade");
                        setTimeout(function()
                        {
                            $("#tr"+id).remove();
                        },500);
                    }
                });
            }
        }
        function load_ajax(number, value = null, max = null) {
            $("#data").html('<img style="margin-left:45%;" src="../img/pleasewait/plw.gif" />');
            if (!max) max = $("#max-row").val();
            $.ajax({
                url: "order/list/loaddata.php",
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
        function search_acc(id) {
            var value = $("#" + id).val();
            load_ajax(1, value);
            $("#go-return").css("display", "inline");
        }

        function h_key_enter(e) {
            var key = e.which;
            if (key == 13) {
                search_acc('h-tf');
            }
        }
        function go_return() {
            load_ajax(1);
            $("#go-return").css("display", "none");
        }
        function set_max_row() {
            var max = $("#max-row").val();
            load_ajax(1, "", max);
        }
        $("#go-return").css("display", "none");
        load_ajax(1);
    </script>