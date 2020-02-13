<?php
class apps_model_PriceProduct
{
    private $price_id;
    public function apps_model_PriceProduct($price_id = null)
    {
        $this->price_id = $price_id;
    }
    public function SelectPriceProduct()
    {
        if ($this->price_id == null)
            return null;
        $param = [
            "select" => "*",
            "from" => "price_product",
            "where" => "price_product.price_id=$this->price_id"
        ];

        $db = new apps_libs_Dbconn();
        $result = $db->SelectOne($param);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $data = [
                    "price_id" => $row["price_id"],
                    "product_id" => $row["product_id"],
                    "product_price" => $row["product_price"],
                    "level" => $row["level"]
                ];
                return $data;
            }
        }
        return null;
    }
    public function SelectPriceProductToIdProduct($id_product,$level=1)
    {
        $param = [
            "select" => "*",
            "from" => "price_product",
            "where" => "price_product.product_id=$id_product and level=$level"
        ];

        $db = new apps_libs_Dbconn();
        $result = $db->SelectOne($param);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $data = [
                    "price_id" => $row["price_id"],
                    "product_id" => $row["product_id"],
                    "product_price" => $row["product_price"],
                    "level" => $row["level"]
                ];
                return $data;
            }
        }
        return null;
    }
    public function InserPriceProduct($product_id,$product_price,$level=1)
    {
        $db = new apps_libs_Dbconn();
        $param =
            [
            "from" => "price_product",
            "param" => [
                "col" => "product_id,product_price,level",
                "data" =>
                    [
                    $product_id,
                    $product_price,
                    $level
                ]
            ]
        ];

        $db = new apps_libs_Dbconn();
        return $db->Insert($param) ? true : false;
    }
    public function UpdatePriceProduct($product_price)
    {
        $db = new apps_libs_Dbconn();
        $param =
            [
            "from" => "price_product",
            "param" =>
                [
                "col" => [
                    "product_price"
                ],
                "data" =>
                    [
                        $product_price
                ]
            ],
            "where" => "price_id=$this->price_id"
        ];
        return $db->Update($param) ? true : false;
    }
}
?>