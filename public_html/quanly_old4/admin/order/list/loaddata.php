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
                "Sản Phẩm" => "products.product_name",
                "Số Lượng" => "order_branch.order_quantity",
                "Ngày Đặt" => "order_branch.created_at",
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
                "Sản Phẩm" => "products.product_name",
                "Số Lượng" => "order_branch.order_quantity",
                "Ngày Đặt" => "order_branch.created_at",
                "Tình Trạng" => "order_branch.order_completed",
                "Địa Chỉ"=>"users.addre"
            ],
            "function" => [],
            "break" => ["order_branch.order_id","users.user_id","order_branch.order_completed"]
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