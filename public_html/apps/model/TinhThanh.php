<?php
class apps_model_TinhThanh
{
    public function apps_model_TinhThanh()
    {
        
    }
    public function CreateTagSelect($id_tag, $id_devvn_tinhthanhpho = "", $class = "form-control",$disabled=false)
    {
        $data = $this->SelectAllTinhThanh();
        $result = "<select onchange='load_ajax_district()' ".($disabled?"disabled":"")." id='$id_tag' class='$class'>
        ";
        if ($data) {
            foreach ($data as $item) {
                $select = "";
                $select = $item["matp"] == $id_devvn_tinhthanhpho ? "selected" : "";
                if($this->Check($item["matp"]))
                {
                    $result .= "<option style='color:red' $select value='" . $item["matp"] . "'>" . $item["name"] . "-<span style='color:red'>Đã tồn tại tài khoản</span></option>";
                }else $result .= "<option $select value='" . $item["matp"] . "'>" . $item["name"] . "</option>";
            }
        }
        $result .= "</select>";
        return $result;
    }
    private function SelectAllTinhThanh()
    {
        $data = null;
        $db = new apps_libs_Dbconn();
        $param = [
            "select" => "*",
            "from" => "devvn_tinhthanhpho",
            "where" => "1 order by name asc"
        ];
        $result = $db->Select($param);
        if ($result) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$i] = [
                    "matp" => $row["matp"],
                    "name" => $row["name"]
                ];
                $i++;
            }
            return $data;
        }
        return $data;
    }

    private function Check($id_devvn_tinhthanhpho)
    {
        $db = new apps_libs_Dbconn();
        $param = [
            "select" => "*",
            "from" => "users",
            "where" => "matp='$id_devvn_tinhthanhpho'"
        ];
        $result = $db->Select($param);
        if($result)
        {
            $row=mysqli_fetch_assoc($result);
            return isset($row["matp"])?true:false;
        }
        return false;
    }
}
?>