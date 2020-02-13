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
            "table" => "products",
            "where" => "products.product_name LIKE '" . $s . "%' ORDER BY products.product_id ASC",
            "col" => [
                "ID" => "products.product_id",
                "Tên Sản Phẩm" => "products.product_name",
                "Giá" => "products.product_price",
                "Mô Tả Ngắn"=>"products.product_short_des"
            ],
            "function" => [
                "in" => "product_name",
                "out" => "product_id",
                "link" => "?r=product&p=edit&id="
            ],
            "break" => ["products.product_id"]
        ], $number, $max);
        echo CreateTableA($page);
    } else {
        $page = new apps_libs_Page([
            "table" => "products",
            "where" => "1 ORDER BY products.product_id ASC",
            "col" => [
                "ID" => "products.product_id",
                "Tên Sản Phẩm" => "products.product_name",
                "Giá" => "products.product_price",
                "Mô Tả Ngắn"=>"products.product_short_des"
            ],
            "function" => [
                "in" => "product_name",
                "out" => "product_id",
                "link" => "?r=product&p=edit&id="
            ],
            "break" => ["products.product_id"]
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
    $table .= "</tr>";
    if ($data)
        foreach ($data as $item) {
        $table .= "<tr>";
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

?>