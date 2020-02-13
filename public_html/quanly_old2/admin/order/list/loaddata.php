<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckAdmin()) die();

$number = $rt->GetPost('number');
$s = $rt->GetPost('s');
$max = $rt->GetPost('max');

if (!$max) $max = 10;
if ($number) {
    if ($s) {
        $page = new apps_libs_Page([
            "table" => "order_branch,users,products",
            "where" => "products.product_id=order_branch.order_product and order_branch.order_user=users.user_id and (users.user_email LIKE '" . $s . "%' or users.user_username LIKE '" . $s . "%') order by  order_branch.order_completed ASC,order_branch.created_at",
            "col" => [
                "ID" => "order_branch.order_id",
                "Email" => "users.user_email",
                "Người Mua" => "users.user_username",
                "ID User" => "users.user_id",
                "ID Level" => "users.user_type",
                "Sản Phẩm" => "products.product_name",
                "Số Lượng" => "order_branch.order_quantity",
                "Ngày Đặt" => "order_branch.created_at",
                 "Gía Tiền" => "products.product_price",
                "Tình Trạng" => "order_branch.order_completed",
                "Địa Chỉ"=>"users.addre"
            ],
            "function" => [],
            "break" => ["order_branch.order_id","users.user_id"]
        ], $number, $max);
        echo CreateTableA($page);
    } else {
        $page = new apps_libs_Page([
            "table" => "order_branch,users,products",
            "where" => "products.product_id=order_branch.order_product and order_branch.order_user=users.user_id order by  order_branch.order_completed ASC,order_branch.created_at",
            "col" => [
                "ID" => "order_branch.order_id",
                "Email" => "users.user_email",
                "Người Mua" => "users.user_username",
                "ID User" => "users.user_id",
                "ID Level" => "users.user_type",
                "Sản Phẩm" => "products.product_name",
                "Số Lượng" => "order_branch.order_quantity",
                "Ngày Đặt" => "order_branch.created_at",
                 "Gía Tiền" => "products.product_price",
                "Tình Trạng" => "order_branch.order_completed",
                "Địa Chỉ"=>"users.addre"
            ],
            "function" => [],
            "break" => ["order_branch.order_id","users.user_id","order_branch.order_completed"]
        ], $number, $max);
        echo CreateTableA($page);
        // echo CreateListNumberFunction($page);
    }
}

function CreateTableA($page)
{
    $data = $page->GetData();


    $ret_data = array();
    foreach($data as $key => $val){
        $ret_data[$val['user_email']][] = $val;
    }
    // return json_encode($data);die;
    ?>
    <div class="bg-overlay"></div>
    <table id="table-donhang" class='table table-bordered table-hover'>
        <thead>
            <tr>
                <th>STT</th>
                <th>Mail Người Mua</th>
                <th>Tên Người Mua</th>
                <th>Cấp admin</th>
                <th>Ngày Mua</th>
                <th>Tình Trạng</th>
                <th>Tổng Tiền</th>
                <!-- <th>Xóa</th> -->
            </tr>
        </thead>
        <tbody>
    <?php
    $i = 1;
    foreach($ret_data as $key => $val):
        $tongtien = 0;
        //Tính tổng tiền đơn đã xử lý
        foreach($val as $k1 => $v1){
            if($v1['order_completed'] != 0)
                $tongtien += $v1['order_quantity'] * $v1['product_price'] ;
        }
    ?>
        <tr>
            <td><?= $i?></td>
            <td class="email" data-slot="<?=$i?>"><a href="javascript:void(0)" ><?= $key ?></td>
            <td><?= $val[0]['user_username']?></td>
            <td>
                <?php
                    switch ($val[0]['user_type']) {
                        case 2:
                            echo 'Admin Tỉnh';
                            break;
                        case 3:
                            echo 'Admin Huyện';
                            break;
                        case 4:
                            echo 'Admin Tự Do';
                            break;
                    }
                ?>
            </td>
            <td><?= $val[0]['created_at']?></td>
            <td><?php if($val[0]['order_completed']){
                echo "<span class='bg-primary'>Đã xử lý</span>";
            }else{
                echo "<span class='bg-danger'>Chưa xử lý</span>";
            }
            ?>    
            </td>
            <td><?= $tongtien ?></td>
            <!-- <td><button type="button">Xóa Đơn Hàng</button></td> -->
        </tr>
            
    <?php 
    $i++;
    endforeach;   
      ?>           
        </tbody>
    </table>
    <?php 
$i = 1;
foreach($ret_data as $k => $v):
    $tongtien = 0;
        foreach($v as $k1 => $v1){
            if($v1['order_completed'] != 0)
                $tongtien += $v1['order_quantity'] * $v1['product_price'] ;
        }
?>
    <!--Bảng tất cả đơn hàng của từng khách khi click vào khách sẽ hiện ra-->

    <div class="wrap-detail" data-slot="<?=$i?>">
                <div style="width:100%;height:100%;overflow: auto">
                    <div class="customer_info col-md-7" style="font-size:18px;float: left;text-align: left;">
                        <span>Họ Tên Khách Hàng: <bold style="font-size:22px;color: red;display: inline-block;"> <?= $v[0]['user_username']?></bold></span><br>
                        

                    <span>Địa chỉ: <?= GetLocation($v[0]["user_id"]) ?></span>
                    </div>
                    <div class="col-md-5" style="text-align: left;font-size: 18px">
                        <span>Tổng tiền: <i style="font-size:22px;"><?=$tongtien?></i></span><br>
                        <button class="btn btn-success xulytatca_btn" >
                            Xử lý tất cả đơn
                        </button>
                        <button class="btn btn-danger xoatatca_btn" >
                            Xóa tất cả đơn đã xử lý
                        </button>
                    </div>
                
                <table class="table table-bordered table-hover detail" >
                    <thead>
                        <tr style="background: linear-gradient(to bottom,blue, white, blue)">
                            <th>STT</th>
                            <th>Khóa học</th>
                            <th>Số lượng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Thành tiền</th>
                            <th>Tình trạng</th>
                            <th>Báo đã xử lý</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                $j = 1;
                foreach($v as $key => $val):
                    $thanhtien = $val['order_quantity'] * $val['product_price'];
                ?> 
                    <tr class="order_id" id="<?= $val['order_id']?>" data-status="<?=$val['order_completed']?>">
                        <td><?= $j?></td>
                        <td><?= $val['product_name']?></td>
                        <td><?= $val['order_quantity'] ?></td>
                        <td><?= $val['created_at']?></td>
                        <td><?= $thanhtien ?></td>
                        <td><?php if($val['order_completed']){
                            echo "<p id = 'done{$val['order_id']}' class='bg-primary'>Đã xử lý</p>";
                        }else{
                            echo "<p id = 'done{$val['order_id']}' class='bg-danger'>Chưa xử lý</span>";
                        }
                        ?>    
                        </td>
                        <td>
                            <button onclick='h_done_order(<?=$val['order_id']?>)' class="btn btn-success">Xử lý</button>
                        </td>
                        <td>
                            <button onclick='h_delete(<?=$val['order_id']?>)' class="btn btn-danger">Xóa</button>
                        </td>
                        

                    </tr>
                <?php $j++;endforeach;?>
                </tbody>
                </table>
                </div>
            </div>
            
<?php
    $i++;
     endforeach;
    
  
    // return json_encode($ret_data);die;
    // $table = "<table class='table table-bordered table-hover'>";
    // $table .= "<tr>";
    // foreach ($page->col['col'] as $key => $item) {
    //     if ($page->CheckBreak($item)) continue;
    //     $table .= "<th>";
    //     $table .= $key;
    //     $table .= "</th>";
    // }
    // $table .= "<th>Địa Chỉ</th>";
    // $table .= "<th>Tình Trạng</th>";
    // $table .= "<th>Báo Cáo</th>";
    // $table .= "</tr>";
    // if ($data)
    //     foreach ($data as $item) {
    //     $table .= "<tr>";
    //     foreach ($page->col['col'] as $key => $it) {
    //         if ($page->CheckBreak($it)) continue;
    //         $table .= "<td>";
    //         $table .= $item[$page->CupString($it)];
    //         $table .= "</td>";
    //     }
    //     $table .= "<td>".GetLocation($item["end_user_id"])."</td>";
    //     $table .= "<td>".($item["order_completed"]==1?"<p id='done".$item["order_id"]."' class=\"bg-primary\">Đã Xử Lý</p>":"<p id='done".$item["order_id"]."' class=\"bg-danger\">Chưa Xử Lý</p>")."</td>";
    //     $table.="<td><button onclick='h_done_order(\"".$item["order_id"]."\")' class=\"btn btn-success\">Đã xử lý</button></td>";
    //     $table .= "</tr>";
    // }

    // $table .= "</table> ";

    // return $table;
}

function CreateListNumberFunction($page)
{
    $count = $page->GetCount();
    $maxindex = (int)($count / $page->maxrow);
    if ($maxindex != $count / $page->maxrow) $maxindex += 1;

    $div = "<div class=\"\">";
    if ($page->index - 3 > 1) {
        $div .= "<button onclick=\"load_ajax('1')\" class='list-index btn' ><span>1</span></button>";
        $div .= "<button class='list-index btn' ><span>...</span></button>";
    }
    for ($i = 1; $i <= $maxindex; $i++)
        if ($i == $page->index)
        $div .= "<button onclick=\"load_ajax('" . $i . "')\" style='background-color:#337ab7;color:#fff' class='list-index btn'><span>" . $i . "</span></button>";
    else {
        if ($i >= $page->index - 3 && $i <= $page->index + 3)
            $div .= "<button onclick=\"load_ajax('" . $i . "')\" class='list-index btn' ><span>" . $i . "</span></button>";
    }
    if ($page->index + 3 < $maxindex) {
        $div .= "<button class='list-index btn' ><span>...</span></button>";
        $div .= "<button onclick=\"load_ajax('" . $maxindex . "')\" class='list-index btn' ><span>" . $maxindex . "</span></button>";
    }
    $div .= "</div>";
    return $div;
}


function GetLocation($id_user)
{
    $param=[
        "select"=>"devvn_tinhthanhpho.name as name_tp",
        "from"=>"devvn_tinhthanhpho,users",
        "where"=>"users.user_id=$id_user 
                    and users.matp=devvn_tinhthanhpho.matp"
    ];
    $db=new apps_libs_Dbconn();
    
    $result=$db->SelectOne($param);
    if($result)
    {
        $row=mysqli_fetch_assoc($result);
        if($row)
            return $row["name_tp"];
    }
    return "";
}

?>