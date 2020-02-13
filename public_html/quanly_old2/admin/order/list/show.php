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
                    <!-- <div class="input-group">
                        <input onkeydown="h_key_enter(event)" id="h-tf" type="text" class="form-control" placeholder="Nhập tên danh mục bạn muốn tìm">
                        <span class="input-group-btn">
                            <button onclick="search_acc('h-tf')" class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                            <button id="go-return" onclick="go_return()" class="btn btn-default" type="button">
                                <i class="glyphicon glyphicon-menu-left"></i>
                            </button>
                        </span>
                    </div> -->
                </div>
                <div class="col-lg-4">
                    <!-- <select onchange="set_max_row()" id="max-row" class="form-control">
                        <option>5</option>
                        <option selected>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select> -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" id="data">
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .wrap-detail{
        display: none;
        position: fixed;
        width: 90%;
        height: 100%;
        top:0;
        left: 5%;
        background: white;
        z-index: 1001;
    }
    /*.detail.dp-user-mgmt{
        
    }*/
    .bg-overlay{
        display: none;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        z-index: 1000;
        background: black;
        opacity: .5;
        left: 0
    }
    td{
        text-align: center;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        
    // Settimeout để lệnh chạy sau khi ajax lấy dữ liệu hoàn tất
    setTimeout(function(){
        $('#table-donhang').DataTable();
        $('table.detail').each(function(){
            $(this).DataTable();
        });
         $('.xulytatca_btn').click(function(){
            if(confirm('Bạn có chắc xử lý tất cả?')){
            $(this).attr('disabled',true);
            setTimeout(function(){
                location.reload();
            },1500);
            parent = $(this).parents('.wrap-detail');
            children = parent.find('table tr.order_id');
            children.each(function(){
                id = $(this).attr('id');
                $.ajax({
                    url: "order/list/order-done.php",
                    type: "post",
                    dataType: "text",
                    data: {
                        id:id
                    },
                });
            })
            }
        });
         $('.xoatatca_btn').click(function(){
            if(confirm('Bạn có chắc xóa tất cả đơn đã xử lý?')){
            $(this).attr('disabled',true);
            setTimeout(function(){
                location.reload();
            },1500);
            parent = $(this).parents('.wrap-detail');
            children = parent.find('table tr.order_id[data-status="1"]');
            children.each(function(){
                id = $(this).attr('id');
              
                $.ajax({
                    url: "order/delete/delete.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        id:id
                    }
                });
            })
            }
        });
         //click vào email show tất cả đơn hàng của người đó
        $('td.email').click(function(e){
            slot = $(this).data('slot');
            detail = $('.wrap-detail[data-slot='+slot+']');
            detail.show();
            bg_overlay = $('.bg-overlay');
            console.log(bg_overlay);
            bg_overlay.show();
            bg_overlay.click(function(){
                bg_overlay.hide();
                detail.hide();
            });
            // $(this).parent('table').sibling('.detail.dp-user-mgmt').show();
        });
    },1000);
        
    });
 
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
                $("tr#"+id).html('Đang xóa...');
                $("tr#"+id).attr('disabled', true);    
                $.ajax({
                    url: "order/delete/delete.php",
                    type: "post",
                    dataType: "text",
                    data: {
                        id:id
                    },
                    success: function (result) {
                        $("tr#"+id).addClass("fade");
                        setTimeout(function()
                        {
                            $("tr#"+id).remove();
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