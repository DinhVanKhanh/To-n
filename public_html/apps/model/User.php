<?php
class apps_model_User
{
    private $user_id;
    public function apps_model_User($user_id = null)
    {
        $this->user_id = $user_id;
    }
    public function SelectUser()
    {
        if ($this->user_id == null)
            return null;
        $param = [
            "select" => "*",
            "from" => "users",
            "where" => "users.user_id=$this->user_id"
        ];

        $db = new apps_libs_Dbconn();
        $result = $db->SelectOne($param);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $data = [
                    "user_id" => $row["user_id"],
                    "user_username" => $row["user_username"],
                    "user_password" => $row["user_password"],
                    "user_key" => $row["user_key"],
                    "user_email" => $row["user_email"],
                    "user_reset" => $row["user_reset"],
                    "user_reset_key" => $row["user_reset_key"],
                    "user_active" => $row["user_active"],
                    "user_type" => $row["user_type"],
                    "user_fullname" => $row["user_fullname"],
                    "user_sdt" => $row["user_sdt"],
                    "matp" => $row["matp"],
                    "created_at" => $row["created_at"],
                    "addre" => $row["addre"]
                ];
                return $data;
            }
        }
        return null;
    }
    public function InserUser($user_username,$user_password,$user_fullname,$user_sdt,$user_email,$addre,$user_type=2,$matp="")
    {
        $db = new apps_libs_Dbconn();
        if ($db->CheackValue("users", "user_username", "'$user_username'"))
            return false;
        $param =
            [
            "from" => "users",
            "param" => [
                "col" => "user_username,user_password,user_fullname,user_sdt,user_email,user_type,matp,addre",
                "data" =>
                    [
                    "'" . $user_username . "'",
                    "'" . $user_password . "'",
                    "'" . $user_fullname . "'",
                    "'" . $user_sdt . "'",
                    "'" . $user_email . "'",
                    $user_type,
                    "'" . $matp . "'",
                    "'" . $addre . "'"
                ]
            ]
        ];

        $db = new apps_libs_Dbconn();
        return $db->Insert($param) ? true : false;
    }
    public function UpdateUser($user_sdt,$user_password,$user_email,$addre)
    {
        $db = new apps_libs_Dbconn();
        $param =
            [
            "from" => "users",
            "param" =>
                [
                "col" => [
                    "user_sdt","user_password", "user_email","addre"
                ],
                "data" =>
                    [
                    "'" . $user_sdt . "'",
                    "'" . $user_password . "'",
                    "'" . $user_email . "'",
                    "'" . $addre . "'"
                ]
            ],
            "where" => "user_id=$this->user_id"
        ];
        return $db->Update($param) ? true : false;
    }
}
?>