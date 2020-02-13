<?php

define("H_HTTP_PRO", "/");
define("H_CODE", "http://smartbrain.edu.vn");
define("H_FOLDER_ROOT", "toan/quanly");
class apps_libs_Router
{
    public function Router()
    {
    }

    public function LoginPage($router = false)
    {
        $link = $this->GetLinkRoot() . "/login.php";
        if ($router)
            header('Location: ' . $link);
        else return $link;
    }

    public function LogoutPage($router = false)
    {
        $link = $this->GetLinkRoot() . "/logout.php";
        if ($router)
            header('Location: ' . $link);
        else return $link;
    }
    public function DistrictPage($router = false)
    {
        $link = $this->GetLinkRoot() . "/district";
        if ($router)
            header('Location: ' . $link);
        else return $link;
    }
    public function BranchPage($router = false)
    {
        $link = $this->GetLinkRoot() . "/branch";
        if ($router)
            header('Location: ' . $link);
        else return $link;
    }
    public function FreePage($router = false)
    {
        $link = $this->GetLinkRoot() . "/free";
        if ($router)
            header('Location: ' . $link);
        else return $link;
    }

    public function AdminPage($router = false)
    {
        $link = $this->GetLinkRoot() . "/admin";
        if ($router)
            header('Location: ' . $link);
        else return $link;
    }

    public function GetLinkImg($img = null)
    {
        if ($img)
            return $this->GetLinkRoot() . "/img/avatar/" . $img;
        else return $this->GetLinkRoot() . "/img/avatar/default.jpg";
    }

    public function GetLinkImgTestList($img = null)
    {
        if ($img)
            return $this->GetLinkRoot() . "/img/testlist/" . $img; else return $this->GetLinkRoot() . "/img/avatar/default.jpg";
    }

    public function GetLinkImgSubject($img = null)
    {
        if ($img)
            return $this->GetLinkRoot() . "/img/subject/" . $img;
        else return $this->GetLinkRoot() . "/img/avatar/default.jpg";
    }
    public function GetLinkImgPost($img = null)
    {
        if ($img)
            return $this->GetLinkRoot() . "/img/post/" . $img;
        else return $this->GetLinkRoot() . "/img/avatar/default.jpg";
    }
    function GetDocumentRoot()
    {
        return $_SERVER["DOCUMENT_ROOT"] . "/" . H_FOLDER_ROOT;
    }
    public function GetLinkRoot()
    {
        return H_HTTP_PRO . H_FOLDER_ROOT;
    }
    public function GetGet($name = null)
    {
        if ($name != null) {
            return isset($_GET[$name]) ? $_GET[$name] : null;
        }
        return $_GET;
    }

    public function GetPost($name = null)
    {
        if ($name != null) {
            return isset($_POST[$name]) ? $_POST[$name] : null;
        }
        return $_POST;
    }

    public function DeleteFileOnPath($path)
    {
        $path = rtrim($path, '/') . '/';
        $handle = opendir($path);

        while (false !== ($file = readdir($handle))) {
            if ($file != '.' and $file != '..') {
                $fullpath = $path . $file;
                if (is_dir($fullpath)) rmdir_recurse($fullpath);
                else unlink($fullpath);
            }
        }
        closedir($handle);
    }
    public function GetFileInAdmin($r, $p)
    {
        $result = '';
        switch ($r) {
            case 'product':
                $result .= 'product/';
                break;
            case 'acc-child':
                $result .= 'acc-child/';
                break;
            case 'order':
                $result .= 'order/';
                break;
            case 'acc':
                $result .= 'acc/';
                break;
            default:
        }
        switch ($p) {
            case 'create':
                $result .= 'create/create.php';
                break;
            case 'showlist':
                $result .= 'list/show.php';
                break;
            case 'edit':
                $result .= 'edit/edit.php';
                break;
            case 'changepass':
                $result .= 'changepass/changepass.php';
                break;
            case 'footlist':
                $result .= 'list/footer1.php';
                break;
            case 'title1':
                $result .= 'list/title1.php';
                break;
             case 'title2':
                $result .= 'list/title2.php';
                break;
            case 'lienhe':
                $result .= 'list/lienhe.php';
                break;
            default:
        }
        return $result;
    }
    public function GetFileInBranch($r, $p)
    {
        $result = '';
        switch ($r) {
            case 'order':
                $result .= 'order/';
                break;
            case 'acc-child':
                $result .= 'acc-child/';
                break;
            case 'order-branch':
                $result .= 'order-branch/';
                break;
            case 'acc':
                $result .= 'acc/';
                break;
            default:
        }
        switch ($p) {
            case 'create':
                $result .= 'create/create.php';
                break;
            case 'showlist':
                $result .= 'list/show.php';
                break;
            case 'edit':
                $result .= 'edit/edit.php';
                break;
            case 'changepass':
                $result .= 'changepass/changepass.php';
                break;
            default:
        }
        return $result;
    }

    public function GetFileInDistrict($r, $p)
    {
        $result = '';
        switch ($r) {
            case 'order':
                $result .= 'order/';
                break;
            case 'order-district':
                $result .= 'order-district/';
                break;
            case 'acc':
                $result .= 'acc/';
                break;
            default:
        }
        switch ($p) {
            case 'create':
                $result .= 'create/create.php';
                break;
            case 'showlist':
                $result .= 'list/show.php';
                break;
            case 'edit':
                $result .= 'edit/edit.php';
                break;
            case 'changepass':
                $result .= 'changepass/changepass.php';
                break;
            default:
        }
        return $result;
    }
    public function GetFileInFree($r, $p)
    {
        $result = '';
        switch ($r) {
            case 'order-free':
                $result .= 'order-free/';
                break;
            case 'acc':
                $result .= 'acc/';
                break;
            default:
        }
        switch ($p) {
            case 'create':
                $result .= 'create/create.php';
                break;
            case 'showlist':
                $result .= 'list/show.php';
                break;
            case 'edit':
                $result .= 'edit/edit.php';
                break;
            case 'changepass':
                $result .= 'changepass/changepass.php';
                break;
            default:
        }
        return $result;
    }
}
?>