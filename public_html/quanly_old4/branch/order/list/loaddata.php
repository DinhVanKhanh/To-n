<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckBranch()) die();

$number = $rt->GetPost('number');
$s = $rt->GetPost('s');
$max = $rt->GetPost('max');

if (!$max) $max = 10;
if ($number) {
    if ($s) {
        $page = new apps_libs_Page([
            "table" => "orders,end_users,products",
            "where" => "products.product_id=orders.order_product and orders.order_user=end_users.end_user_id and end_users.end_user_city='" . $user->GetCity() . "' and (end_users.end_user_email LIKE '" . $s . "%' or end_users.end_user_fullname LIKE '" . $s . "%') order by  orders.order_completed ASC,orders.created_at",
            "col" => [
                "ID" => "orders.order_id",
                "Email" => "end_users.end_user_email",
                "Người Mua" => "end_users.end_user_fullname",
                "ID User" => "end_users.end_user_id",
                "Số Điện Thoại" => "end_users.end_user_phone_number",
                "Sản Phẩm" => "products.product_name",
                "Số Lượng" => "orders.order_quantity",
                "Ngày Đặt" => "orders.created_at",
                "Tình Trạng" => "orders.order_completed",
            ],
            "function" => [],
            "break" => ["orders.order_id","end_users.end_user_id"]
        ], $number, $max);
        echo CreateTableA($page);
    } else {
        $page = new apps_libs_Page([
            "table" => "orders,end_users,products",
            "where" => "products.product_id=orders.order_product and orders.order_user=end_users.end_user_id and end_users.end_user_city='" . $user->GetCity() . "' order by  orders.order_completed ASC,orders.created_at",
            "col" => [
                "ID" => "orders.order_id",
                "Email" => "end_users.end_user_email",
                "Người Mua" => "end_users.end_user_fullname",
                "ID User" => "end_users.end_user_id",
                "Số Điện Thoại" => "end_users.end_user_phone_number",
                "Sản Phẩm" => "products.product_name",
                "Số Lượng" => "orders.order_quantity",
                "Ngày Đặt" => "orders.created_at",
                "Tình Trạng" => "orders.order_completed",
            ],
            "function" => [],
            "break" => ["orders.order_id","end_users.end_user_id","orders.order_completed"]
        ], $number, $max);
        echo CreateTableA($page);
        echo CreateListNumberFunction($page);
    }
}

function CreateTableA($page)
{
    $data = $page->GetData();
    $table = "<table class='table table-bordered table-hover'>";
    $table .= "<tr>";
    foreach ($page->col['col'] as $key => $item) {
        if ($page->CheckBreak($item)) continue;
        $table .= "<th>";
        $table .= $key;
        $table .= "</th>";
    }
    $table .= "<th>Địa Chỉ</th>";
    $table .= "<th>Tình Trạng</th>";
    $table .= "<th>Báo Cáo</th>";
    $table .= "</tr>";
    if ($data)
        foreach ($data as $item) {
        $table .= "<tr>";
        foreach ($page->col['col'] as $key => $it) {
            if ($page->CheckBreak($it)) continue;
            $table .= "<td>";
            $table .= $item[$page->CupString($it)];
            $table .= "</td>";
        }
        $table .= "<td>".GetLocation($item["end_user_id"])."</td>";
        $table .= "<td>".($item["order_completed"]==1?"<p id='done".$item["order_id"]."' class=\"bg-primary\">Đã Xử Lý</p>":"<p id='done".$item["order_id"]."' class=\"bg-danger\">Chưa Xử Lý</p>")."</td>";
        $table.="<td><button onclick='h_done_order(\"".$item["order_id"]."\")' class=\"btn btn-success\">Đã xử lý</button></td>";
        $table .= "</tr>";
    }

    $table .= "</table> ";

    return $table;
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
        "select"=>"end_users.end_user_address,devvn_tinhthanhpho.name as name_tp,devvn_quanhuyen.name as name_qh,devvn_xaphuongthitran.name as name_xp",
        "from"=>"devvn_tinhthanhpho,devvn_quanhuyen,devvn_xaphuongthitran,end_users",
        "where"=>"end_users.end_user_id=$id_user 
                    and end_users.end_user_city=devvn_tinhthanhpho.matp
                    and end_users.end_user_district=devvn_quanhuyen.maqh
                    and  end_users.end_user_ward=devvn_xaphuongthitran.xaid"
    ];
    $db=new apps_libs_Dbconn();
    
    $result=$db->SelectOne($param);
    if($result)
    {
        $row=mysqli_fetch_assoc($result);
        if($row)
            return $row["end_user_address"].", ".$row["name_xp"].", ".$row["name_qh"].", ".$row["name_tp"];
    }
    return "";
}

?>