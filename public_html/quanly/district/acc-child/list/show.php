<?php
if (!isset($rt)) die();
?>

<div class="h-padding">
    <div class="row">
        <h1 class="page-header">Danh sách tài khoản</h1>
    </div>
    <div class="row">  
        <div class="h-block h-padding">
            <div class="row">
                <!-- <div class="col-lg-4">
                    
                </div>
                <div class="col-lg-4">
                    <select onchange="set_max_row()" id="max-row" class="form-control">
                        <option>5</option>
                        <option selected>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select>
                </div> -->
            </div>
            <div class="row">
                <div class="col-lg-12" id="data">
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        setTimeout(function(){
            $('#table-user').DataTable();
        },1000);
        // function h_delete(id)
        // {
        //     if(confirm("Bạn chắc chắn muốn xóa?"))
        //     {   
                
        //         $.ajax({
        //             url: "acc-child/delete/delete.php",
        //             type: "post",
        //             dataType: "text",
        //             data: {
        //                 id:id
        //             },
        //             success: function (result) {
        //                 $("#user_"+id).addClass("fade");
        //                 setTimeout(function()
        //                 {
        //                     $("#user_"+id).remove();
        //                 },500);
        //             }
        //         });
        //     }
        // }
        function h_lock(id,status)
        {
            if(confirm("Bạn chắc chắn muốn thay đổi?"))
            {   
                
                $.ajax({
                    url: "acc-child/delete/lock.php",
                    type: "post",
                    dataType: "text",
                    data: {
                        id:id
                    },
                    success: function (result) {
                        status_td = $("#state_"+id);
                        if(status_td.data('status') == 1){
                            status_td.html("<span style='background:red;color:white'>Đang khóa</span>");
                            status_td.data('status',0);
                        }else{
                            // $("#state_"+id).html("Hoạt động");
                            status_td.html("Hoạt động");
                            status_td.data('status',1);
                        }
                    }
                });
            }
        }
        function load_ajax(number, value = null, max = null) {
            $("#data").html('<img style="margin-left:45%;" src="../img/pleasewait/plw.gif" />');
            if (!max) max = $("#max-row").val();
            $.ajax({
                url: "acc-child/list/loaddata.php",
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