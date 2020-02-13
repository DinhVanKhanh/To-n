<?php
include ("../../apps/bootstrap.php");
$rt=new apps_libs_Router();

$user_maill=$rt->GetPost("user_email");
if($user_maill==""||$user_maill==null) 
{
    echo "Mời nhập emaill";
    die();
}

$data_user=GetUser($user_maill);
if(!$data_user) 
{
    echo "Có vẻ như bạn nhập sai email";
    die();
}


$user="smartbrain.edu.vn@gmail.com";
$pass="thu611078";
$from="smartbrain";
$title="Lấy lại mật khẩu";
$body="<h1 style='color:#black'>Mật khẩu của bạn là:<strong><span style='color:red'>".$data_user["pass"]."<span></strong> . Đừng quên nữa nhé!</h1>";


$user_re=$user_maill;
$name_re=$data_user["name_re"];

$maill=new apps_libs_SendMaill($user,$pass,$from);
if($maill->SendMaill($user_re,$name_re,$title,$body)) echo "Thành Công! hãy kiểm tra email của bạn";
else echo "Có lỗi xảy ra!";


function GetUser($user_maill)
{
    $db=new apps_libs_Dbconn();
    $param=[
        "from"=>"end_users",
        "select"=>"end_user_fullname,end_user_password",
        "where"=>"end_user_email='$user_maill'"
    ];
    $result=$db->SelectOne($param);
    if($result)
    {
        $row=mysqli_fetch_assoc($result);
        if($row)
        {
            return [
                "name_re"=>$row["end_user_fullname"],
                "pass"=>$row["end_user_password"]
            ];
        }
    }
    return null;
}
?>