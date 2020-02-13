<?php
class apps_model_QuanHuyen
{
    public function apps_model_QuanHuyen()
    {
        
    }
    public function CreateTagSelect($id_tag, $id_devvn_quanhuyen = "",$id_devvn_tinhthanh=null, $class = "form-control",$disabled=false)
    {
        $data = $this->SelectAllQuanHuyen($id_devvn_tinhthanh);
        $result = "<select ".($disabled?"disabled":"")." id='$id_tag' class='$class'>
        ";
        if ($data) {
            foreach ($data as $item) {
                $select = "";
                $select = $item["maqh"] == $id_devvn_quanhuyen ? "selected" : "";
                if($this->Check($item["maqh"]))
                {
                    $result .= "<option style='color:red' $select value='" . $item["maqh"] . "'>" . $item["name"] . "-<span style='color:red'>Đã tồn tại tài khoản</span></option>";
                }else $result .= "<option $select value='" . $item["maqh"] . "'>" . $item["name"] . "</option>";
            }
        }
        $result .= "</select>";
        return $result;
    }
    private function SelectAllQuanHuyen($id_devvn_tinhthanh)
    {
        $data = null;
        $db = new apps_libs_Dbconn();
        $param = [
            "select" => "*",
            "from" => "devvn_quanhuyen",
            "where" => ($id_devvn_tinhthanh?"matp=$id_devvn_tinhthanh":"1 ")." order by name asc"
        ];
        $result = $db->Select($param);
        if ($result) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$i] = [
                    "maqh" => $row["maqh"],
                    "name" => $row["name"]
                ];
                $i++;
            }
            return $data;
        }
        return $data;
    }

    private function Check($id_devvn_quanhuyen)
    {
        $db = new apps_libs_Dbconn();
        $param = [
            "select" => "*",
            "from" => "users",
            "where" => "matp='$id_devvn_quanhuyen'"
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