<?php
session_start();
class apps_libs_UserLogin
{
    private $user;
    private $pass;

    function apps_libs_UserLogin()
    {

    }

    function EPass()
    {
        return md5($this->pass);
    }

    function Login()
    {
        include("Dbconn.php");
        $rt = new apps_libs_Router();
        $this->user = (new apps_libs_Utilities())->EditDataImportDB(trim($rt->GetPost('user')));
        $this->pass = (new apps_libs_Utilities())->EditDataImportDB(trim($rt->GetPost('pass')));
        $db = new apps_libs_Dbconn();
        $query = ([
            "select" => "*",
            "from" => "users",
            "where" => "user_username='" . $this->user . "' and user_password='" . $this->pass . "'"
        ]);
        

        $result = $db->SelectOne($query);
        if(!$result) return false;
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $_SESSION["userID"] = (string)$row["user_id"];
            $_SESSION["userName"] = (string)$row["user_username"];
            $_SESSION['typeAcc']=(string)$row['user_type'];
            $_SESSION['city']=(string)$row['matp'];
            return true;
        }

        return false;
    }

    function GetAcc()
    {
        if ($this->isOnline())
            return $_SESSION["userID"];
        return null;
    }

    function GetUserNameAcc()
    {
        if ($this->isOnline())
            return $_SESSION["userName"];
        return null;
    }

    function GetCity()
    {
        if ($this->isOnline())
            return $_SESSION["city"];
        return null;
    }

    function Logout()
    {
        unset($_SESSION['userID']);
        unset($_SESSION['userName']);
        unset($_SESSION['typeAcc']);
        unset($_SESSION['city']);
    }

    function isOnline()
    {
        return isset($_SESSION["userID"]);
    }

    function CheckAdmin() // tài khoản admin
    {
        if($this->isOnline())
        {
            if($_SESSION['typeAcc']==1) return TRUE;
        }
        return false;
    }

    function CheckBranch() // tài khoản chi nhánh
    {
        if($this->isOnline())
        {
            if($_SESSION['typeAcc']==2) return TRUE;
        }
        return false;
    }

    function CheckDistrict() // tài khoản chi nhánh huyện
    {
        if($this->isOnline())
        {
            if($_SESSION['typeAcc']==3) return TRUE;
        }
        return false;
    }

    function CheckFree() // tài khoản tự do
    {
        if($this->isOnline())
        {
            if($_SESSION['typeAcc']==4) return TRUE;
        }
        return false;
    }
}
?>