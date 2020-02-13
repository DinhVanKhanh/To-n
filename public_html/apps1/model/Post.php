<?php
class apps_model_Post
{
    private $id_post;
    public function apps_model_Post($id_post = null)
    {
        $this->id_post = $id_post;
    }
    private function CreateId()
    {
        $db = new apps_libs_Dbconn();
        $this->id_post = $db->CreateID("tb_post", "id");
    }
    public function SelectPost()
    {
        if ($this->id_post == null)
            return null;
        $param = [
            "select" => "*",
            "from" => "tb_post",
            "where" => "tb_post.id='$this->id_post'"
        ];

        $db = new apps_libs_Dbconn();
        $result = $db->SelectOne($param);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $data = [
                    "id" => $row["id"],
                    "id_classify_post" => $row["id_classify_post"],
                    "name" => $row["name"],
                    "no_utf8" => $row["no_utf8"],
                    "short_description" => $row["short_description"],
                    "post_body" => $row["post_body"],
                    "time_create" => $row["time_create"],
                    "img_thumb" => $row["img_thumb"],
                    "img" => $row["img"],
                    "active" => $row["active"],
                ];
                return $data;
            }
        }
        return null;
    }
    public function SelectPostToNoUtf8($no_utf8)
    {
        $param = [
            "select" => "*",
            "from" => "tb_post",
            "where" => "tb_post.no_utf8='$no_utf8'"
        ];

        $db = new apps_libs_Dbconn();
        $result = $db->SelectOne($param);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $data = [
                    "id" => $row["id"],
                    "id_classify_post" => $row["id_classify_post"],
                    "name" => $row["name"],
                    "no_utf8" => $row["no_utf8"],
                    "short_description" => $row["short_description"],
                    "post_body" => $row["post_body"],
                    "time_create" => $row["time_create"],
                    "img_thumb" => $row["img_thumb"],
                    "img" => $row["img"],
                    "active" => $row["active"],
                ];
                return $data;
            }
        }
        return null;
    }
    public function InserPost($id_classify_post, $name, $short_description, $post_body, $img_thumb, $img, $active = 1)
    {
        $uti = new apps_libs_Utilities();
        
        $no_utf8 = $uti->StripUnicodeTitle($name);
        if($this->CheackNoUtf8($no_utf8)) return false;

        $db = new apps_libs_Dbconn();
        $this->CreateId();
        $img = $this->CopyImg($img);
        $img_thumb = $this->CopyImgThump($img_thumb);
        $param =
            [
            "from" => "tb_post",
            "param" => [
                "col" => "id,id_classify_post,name,no_utf8,short_description,post_body,time_create,img_thumb,img,active",
                "data" =>
                    [
                    "'" . $this->id_post . "'",
                    "'" . $id_classify_post . "'",
                    "'" . $name . "'",
                    "'" . $no_utf8 . "'",
                    "'" . $short_description . "'",
                    "'" . $post_body . "'",
                    "NOW()",
                    "'" . $img_thumb . "'",
                    "'" . $img . "'",
                    $active
                ]
            ]
        ];

        return $db->Insert($param) ? true : false;
    }
    public function UpdatePost($id_classify_post, $name, $short_description, $post_body, $img_thumb, $img, $active = 1)
    {
        $uti = new apps_libs_Utilities();
        $no_utf8 = $uti->StripUnicodeTitle($name);

        if($this->SelectPost()["name"]!=$name)
            if($this->CheackNoUtf8($no_utf8)) return false;

        if ($this->id_post == null)
            return false;
        $db = new apps_libs_Dbconn();
        $img = $this->CopyImg($img);
        $img_thumb = $this->CopyImgThump($img_thumb);
        $param =
            [
            "from" => "tb_post",
            "param" =>
                [
                "col" => [
                    "id_classify_post", "name", "no_utf8", "short_description", "post_body", "img_thumb", "img", "active"
                ],
                "data" =>
                    [
                    "'" . $id_classify_post . "'",
                    "'" . $name . "'",
                    "'" . $no_utf8 . "'",
                    "'" . $short_description . "'",
                    "'" . $post_body . "'",
                    "'" . $img_thumb . "'",
                    "'" . $img . "'",
                    $active
                ]
            ],
            "where" => "id='$this->id_post'"
        ];

        
        return $db->Update($param) ? true : false;
    }
    private function CheackNoUtf8($no_utf8)
    {
        $db = new apps_libs_Dbconn();
        if ($db->CheackValue("tb_post", "no_utf8", "'$no_utf8'"))
            return true;
        else return false;
    }
    public function CreateTagSelect($id_tag, $id_post = "", $class = "form-control")
    {
        $data = $this->SelectAllSubject();
        $result = "<select id='$id_tag' class='$class'>
        ";
        if ($data) {
            foreach ($data as $item) {
                $select = "";
                $select = $item["id"] == $id_post ? "selected" : "";
                $result .= "<option $select value='" . $item["id"] . "'>" . $item["name"] . "</option>";
            }
        }
        $result .= "</select>";
        return $result;
    }
    private function SelectAllPost()
    {
        $data = null;
        $db = new apps_libs_Dbconn();
        $param = [
            "select" => "*",
            "from" => "tb_post",
            "where" => "1 order by name asc"
        ];
        $result = $db->Select($param);
        if ($result) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$i] = [
                    "id" => $row["id"],
                    "name" => $row["name"]
                ];
                $i++;
            }
            return $data;
        }
        return $data;
    }
    private function CopyImg($img)
    {
        if ($img == "") return "";
        if (explode(".", $img)[0] == $this->id_post) return $img;
        $rt = new apps_libs_Router();
        $firtfile = $rt->GetDocumentRoot() . "/img/rec/" . $img;
        $duoi = explode('.', $firtfile); // tách chuỗi khi gặp dấu .
        $duoi = $duoi[(count($duoi) - 1)];//lấy ra đuôi file
        $new = $rt->GetDocumentRoot() . "/img/post/" . $this->id_post . '.' . $duoi;
        $new_img = $this->id_post . '.' . $duoi;
        if (copy($firtfile, $new)) {
            return $new_img;
        }
        return "";
    }
    private function CopyImgThump($img)
    {
        if ($img == "") return "";
        if (explode(".", $img)[0] == "thumb".$this->id_post) return $img;
        $rt = new apps_libs_Router();
        $firtfile = $rt->GetDocumentRoot() . "/img/rec/" . $img;
        $duoi = explode('.', $firtfile); // tách chuỗi khi gặp dấu .
        $duoi = $duoi[(count($duoi) - 1)];//lấy ra đuôi file
        $new = $rt->GetDocumentRoot() . "/img/post/thumb" . $this->id_post . '.' . $duoi;
        $new_img = "thumb" . $this->id_post . '.' . $duoi;
        if (copy($firtfile, $new)) {
            $rt->DeleteFileOnPath($rt->GetDocumentRoot() . "/img/rec");
            return $new_img;
        }
        return "";
    }
}
?>