<?php
class apps_model_Products
{
    private $product_id;
    public function apps_model_Products($product_id = null)
    {
        $this->product_id = $product_id;
    }
    public function SelectProducts()
    {
        if ($this->product_id == null)
            return null;
        $param = [
            "select" => "*",
            "from" => "products",
            "where" => "products.product_id=$this->product_id"
        ];

        $db = new apps_libs_Dbconn();
        $result = $db->SelectOne($param);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $data = [
                    "product_id" => $row["product_id"],
                    "product_name" => $row["product_name"],
                    "product_cate" => $row["product_cate"],
                    "product_images" => $row["product_images"],
                    "product_price" => $row["product_price"],
                    "product_short_des" => $row["product_short_des"],
                    "product_long_des" => $row["product_long_des"],
                    "created_at" => $row["created_at"]
                ];
                return $data;
            }
        }
        return null;
    }
}
?>