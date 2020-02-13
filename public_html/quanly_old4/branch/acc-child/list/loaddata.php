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
            "table" => "users,devvn_tinhthanhpho,devvn_quanhuyen",
            "where" => "devvn_tinhthanhpho.matp=".$user->GetCity()." and devvn_tinhthanhpho.matp=devvn_quanhuyen.matp and users.user_type=3 and users.matp=devvn_quanhuyen.maqh and users.user_username LIKE '" . $s . "%' ORDER BY users.user_id ASC",
            "col" => [
                "ID" => "users.user_id",
                "Tài Khoản" => "users.user_username",
                "Email" => "users.user_email",
                "TP" => "users.matp"
            ],
            "function" => [
                "in" => "user_username",
                "out" => "user_id",
                "link" => "?r=acc-child&p=edit&id="
            ],
            "break" => ["users.user_id", "users.matp"]
        ], $number, $max);
        echo CreateTableA($page);
    } else {
        $page = new apps_libs_Page([
            "table" => "users,devvn_tinhthanhpho,devvn_quanhuyen",
            "where" => "devvn_tinhthanhpho.matp=".$user->GetCity()." and devvn_tinhthanhpho.matp=devvn_quanhuyen.matp and users.user_type=3 and users.matp=devvn_quanhuyen.maqh ORDER BY users.user_id ASC",
            "col" => [
                "ID" => "users.user_id",
                "Tài Khoản" => "users.user_username",
                "Email" => "users.user_email",
                "TP" => "users.matp"
            ],
            "function" => [
                "in" => "user_username",
                "out" => "user_id",
                "link" => "?r=acc-child&p=edit&id="
            ],
            "break" => ["users.user_id", "users.matp"]
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
    $table .= "<th>Quận Huyện</th>";
    $table .= "<th>Xóa</th>";
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
        $table .= GetQh($item["matp"]);
        $table .= "</td>";
        $table .= "<td><button id='bt".$item["user_id"]."' class='btn btn-sm btn-danger' onclick=\"h_delete('" . $item["user_id"] . "')\">Xóa</button></td>";
        $table .= "</tr>";
    }

    $table .= "</table> ";

    return $table;
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