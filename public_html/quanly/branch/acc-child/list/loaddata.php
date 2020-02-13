<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckBranch()) die();
// var_dump($_SESSION);die;
$db = new apps_libs_Dbconn;

// Lấy tất cả tỉnh và huyện
$sql = 'select * from devvn_quanhuyen';
$ret_quanhuyen = $db->query($sql);
$sql = 'select * from devvn_tinhthanhpho';
$ret_tinhthanh = $db->query($sql);
// Lấy mã quạn huyện thành phố ra làm key array
foreach($ret_quanhuyen as $k => $v){
    $v->maqh = (int)$v->maqh;
    $v->matp = (int)$v->matp;
    $quanhuyen[(int)$v->maqh] = $v;
}

foreach($ret_tinhthanh as $k => $v){
    $v->matp = (int)$v->matp;
    $tinhthanh[(int)$v->matp] = $v;
}
// Admin tỉnh nên lấy mã quận huyện để lấy admin huyện và tự do con. Tạo kiểu list để truy xuất csdl
$user_maqh_list = '(';


foreach($quanhuyen as $k => $v){
    if($v->matp == $_SESSION['city'])
        $user_maqh_list .= $v->maqh.',';
}
$user_maqh_list = rtrim($user_maqh_list,',');
$user_maqh_list.= ')';
$sql = "select * from users where user_type in (3, 4) and matp in $user_maqh_list order by user_active";
$users = $db->query($sql);
// var_dump($sql);die;
// echo '<pre>';
// var_dump($tinhthanh);die;
function getAddress($user,$quanhuyen,$tinhthanh){
    if(empty($user->matp))
        return;
    // Nếu admin huyện hay tự do thì lấy tên huyện và tỉnh
    if($user->user_type == 3 || $user->user_type == 4 ){
        $maqh = (int)$user->matp;
        $tenqh = $quanhuyen[$maqh]->name;
        $matp = (int)$quanhuyen[$maqh]->matp;;
        $tentp = $tinhthanh[$matp]->name;
        echo $tenqh.' '.$tentp;
    }
    // elseif($user->user_type = 2){
    //     $matp = $user->matp;
    //     $tentp = $tinhthanh[$matp]->name;
    //     echo $tentp;
    // }
}

?>
<table id="table-user" class="table table-bordered">
        <thead>
            <th>Stt</th>
            <th>Username</th>
            <th>Email</th>
            <th>Fullname</th>
            <th>Sdt</th>
            <th>Địa chỉ</th>
            <th>Level</th>
            <th>Tỉnh huyện</th>
            <th>Trạng thái</th>
            <th>Khóa</th>
        </thead>
        <tbody>
<?php
$i = 1;
foreach($users as $key => $val):
    
    switch ($val->user_type) {
        case 3:
            $level = 'Admin huyện';
            break;
        case 4:
            $level = 'Admin tự do';
            break;
    }
    switch ($val->user_active) {
        case 1:
            $state = 'Hoạt động';
            break;
        case 0:
            $state = '<span style="background:red;color:white">Đang khóa</span>';
            break;
    }
?>
    
            <tr id="user_<?=$val->user_id?>">
                <td><?=$i?></td>
                <td><?=$val->user_username?></td>
                <td><?=$val->user_email?></td>
                <td><?=$val->user_fullname?></td>
                <td><?=$val->user_sdt?></td>
                <td><?=$val->addre?></td>
                <td><?=$level?></td>
                <td><?=getAddress($val,$quanhuyen,$tinhthanh);?></td>
                <td id="state_<?=$val->user_id?>" data-status="<?=$val->user_active?>"><?=$state?></td>
                <td>
                    <button onclick="h_lock(<?=$val->user_id?>)" class="btn btn-primary">Khóa</button>
                </td>
            </tr>
        
<?php
    $i++;
endforeach;
?>
    </tbody>   
</table>
<?php
// $number = $rt->GetPost('number');
// $s = $rt->GetPost('s');
// $max = $rt->GetPost('max');

// if (!$max) $max = 10;
// if ($number) {
//     if ($s) {
//         $page = new apps_libs_Page([
//             "table" => "users",
//             "where" => "users.user_type != 1 and users.user_username LIKE '" . $s . "%' ORDER BY users.user_id ASC",
//             "col" => [
//                 "ID" => "users.user_id",
//                 "Tài Khoản" => "users.user_username",
//                 "Email" => "users.user_email",
//                 "TP" => "users.matp",
//                 "Fullname"=>"users.user_fullname",
//                 "Sdt"=>"users.user_sdt",
//                 "Trạng Thái"=>"users.user_active",
//                 "Type"=>"users.user_type"
//             ],
//             "function" => [
//                 "in" => "user_username",
//                 "out" => "user_id",
//                 "link" => "?r=acc-child&p=edit&id="
//             ],
//             "break" => ["users.user_id", "users.matp","users.user_type","users.user_active"]
//         ], $number, $max);
//         echo CreateTableA($page);
//     } else {
//         $page = new apps_libs_Page([
//             "table" => "users",
//             "where" => "users.user_type != 1 and  ORDER BY users.user_id ASC",
//             "col" => [
//                 "ID" => "users.user_id",
//                 "Tài Khoản" => "users.user_username",
//                 "Email" => "users.user_email",
//                 "TP" => "users.matp",
//                 "Fullname"=>"users.user_fullname",
//                 "Sdt"=>"users.user_sdt",
//                 "Trạng Thái"=>"users.user_active",
//                 "Type"=>"users.user_type"
//             ],
//             "function" => [
//                 "in" => "user_username",
//                 "out" => "user_id",
//                 "link" => "?r=acc-child&p=edit&id="
//             ],
//             "break" => ["users.user_id", "users.matp","users.user_type","users.user_active"]
//         ], $number, $max);
//         echo CreateTableA($page);
//         echo CreateListNumberFunction($page);
//     }
// }

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
    $table .= "<th>Thành phố hoặc quận huyện</th>";
    $table .= "<th>Loại</th>";
    $table .= "<th>Khóa</th>";
    $table .= "<th>Xóa/Sửa</th>";
    $table .= "</tr>";
    if ($data)
        foreach ($data as $item) {
        $table .= "<tr id='tr".$item["user_id"]."'>";
        foreach ($page->col['col'] as $key => $it) {
            if ($page->CheckBreak($it)) continue;
            if ($page->CupString($it) == $page->col['function']['in']) {
                $table .= "<td><a href=\"" . $page->col['function']['link'] . $item[$page->col['function']['out']] . "\">";
                $table .= $item[$page->CupString($it)];
                $table .= "</a></td>";
            } else {
                $table .= "<td>";
                $table .= $item[$page->CupString($it)];
                $table .= "</td>";
            }
        }
        $table .= "<td>";
        $table .= (($item["user_type"]==2)?GetTp($item["matp"]):GetQh($item["matp"]));
        $table .= "</td>";
        
        $table .= "<td>";
        if($item["user_type"]==2) $table .="<span style='color:green'>Thành Phố</span>";
        else if($item["user_type"]==3)$table.="<span style='color:blue'>Quận Huyện</span>";
        else if($item["user_type"]==4)$table.="<span style='color:red'>Tự Do</span>";
        $table .= "</td>";
        if($item["user_active"] == 1){
            $table .= "<td><button id='bt".$item["user_id"]."' class='btn btn-sm btn-danger' onclick=\"h_delete('" . $item["user_id"] . "')\">Khóa</button></td>";
        }
        else{
            $table .= "<td><button id='bt".$item["user_id"]."' class='btn btn-sm btn-success' onclick=\"h_delete('" . $item["user_id"] . "')\">Mở khóa</button></td>";
        }
        $table .= "<td>
            <button id='bt".$item["user_id"]."' class='btn btn-sm btn-primary' onclick=\"h_delete('" . $item["user_id"] . "')\">Sửa</button>
            <button id='bt".$item["user_id"]."' class='btn btn-sm btn-danger' onclick=\"h_delete('" . $item["user_id"] . "')\">Xóa</button>
        </td>";
        $table .= "</tr>";
    }

    $table .= "</table> ";

    return $table;
}

function GetTp($matp)
{
    $param = [
        "select" => "name",
        "from" => "devvn_tinhthanhpho",
        "where" => "matp='$matp'"
    ];
    $db = new apps_libs_Dbconn();
    $result = $db->SelectOne($param);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            return $row["name"];
        }
    }
    return null;
}

function GetQh($matp)
{
    $param = [
        "select" => "name",
        "from" => "devvn_quanhuyen",
        "where" => "maqh='$matp'"
    ];
    $db = new apps_libs_Dbconn();
    $result = $db->SelectOne($param);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            return $row["name"];
        }
    }
    return null;
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

?>