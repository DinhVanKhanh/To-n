<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckBranch()) die();

$max = 1000;
$number=1;
if ($number) {
    $page = new apps_libs_Page([
        "table" => "products,price_product",
        "where" => "products.product_id=price_product.product_id and price_product.level=1",
        "col" => [
            "ID Sản Phẩm"=>"products.product_id",
            "Ảnh" => "products.product_images",
            "Tên"=>"products.product_name",
            "Số Tiền" => "price_product.product_price"
        ],
        "function" => [
            "in" => "",
            "out" => "",
            "link" => ""
        ],
        "break" => ["products.product_id","products.product_images"]
    ], $number, $max);
    echo CreateTableA($page);
    //echo CreateListNumberFunction($page);
}

function CreateTableA($page)
{
    $data = $page->GetData();
    $table = "<table class='table table-bordered table-hover'>";
    $table .= "<tr>";
    $table.="<th>Ảnh</th>";
    foreach ($page->col['col'] as $key => $item) {
        if ($page->CheckBreak($item)) continue;
        $table .= "<th>";
        $table .= $key;
        $table .= "</th>";

    }
    $table.="<th>Số Lượng</th>";
    $table .= "</tr>";
    if ($data)
        foreach ($data as $item) {
        $table .= "<tr>";
        $img=$item["product_images"];
        $table .= "<td><img style='width:200px;' src='/uploads/".json_decode($img)[0]."'></td>";
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
        $table .= "<td><input type='number' class='count-sp form-control' data-product='".$item["product_id"]."'/></td>";
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