<?php
class apps_model_OrderBranch
{
    private $user_id;
    public function apps_model_OrderBranch($user_id = null)
    {
        $this->user_id = $user_id;
    }
    public function SelectOrderBranch()
    {
        if ($this->user_id == null)
            return null;
        $param = [
            "select" => "*",
            "from" => "order_branch",
            "where" => "order_branch.order_id=$this->user_id"
        ];

        $db = new apps_libs_Dbconn();
        $result = $db->SelectOne($param);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $data = [
                    "order_id" => $row["order_id"],
                    "order_user" => $row["order_user"],
                    "order_product" => $row["order_product"],
                    "order_completed" => $row["order_completed"],
                    "order_quantity" => $row["order_quantity"],
                    "created_at" => $row["created_at"]
                ];
                return $data;
            }
        }
        return null;
    }
    public function InserOrderBranch($order_user, $order_product, $order_quantity)
    {
        $db = new apps_libs_Dbconn();
        $param =
            [
            "from" => "order_branch",
            "param" => [
                "col" => "order_user,order_product,order_quantity,created_at",
                "data" =>
                    [
                    $order_user,
                    $order_product,
                    $order_quantity,
                    "NOW()"
                ]
            ]
        ];

        $db = new apps_libs_Dbconn();
        return $db->Insert($param) ? true : false;
    }
    // không cần thiết chưa làm
    /*
    public function UpdateOrderBranch($user_password, $user_email)
    {
        $db = new apps_libs_Dbconn();
        $param =
            [
            "from" => "order_branch",
            "param" =>
                [
                "col" => [
                    "user_password", "user_email"
                ],
                "data" =>
                    [
                    "'" . $user_password . "'",
                    "'" . $user_email . "'"
                ]
            ],
            "where" => "user_id=$this->user_id"
        ];
        return $db->Update($param) ? true : false;
    }
    */
}
?>