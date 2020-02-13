<?php
include_once('../../../../apps/bootstrap.php');
$rt=new apps_libs_Router();
$user=new apps_libs_UserLogin();
if (!$user->CheckBranch()) die();
$user_id=$user->GetAcc();

if ($rt->GetPost('submit'))
{
    $pass=$rt->GetPost("pass");
    $newpass=$rt->GetPost("newpass");
    $repeatnewpass=$rt->GetPost("repeatnewpass");

    if(!$pass||!$newpass||!$repeatnewpass
    ||$pass==""||$newpass==""||$repeatnewpass=="") 
    {
        echo create_noti(3, "Mời nhập đủ thông tin");
        die();
    }

    $pass=(new apps_libs_Utilities())->EditDataImportDB(rtrim($pass));
    $newpass=(new apps_libs_Utilities())->EditDataImportDB(rtrim($newpass));
    $repeatnewpass=(new apps_libs_Utilities())->EditDataImportDB(rtrim($repeatnewpass));

    if($newpass!=$repeatnewpass)
    {
        echo create_noti(3, "Mật khẩu mới và nhập lại mật khẩu không trùng khớp");
        die();
    }

    $db=new apps_libs_Dbconn();

    $query = ([
        "select" => "*",
        "from" => "users",
        "where" => "user_id=" . $user_id . " and user_password='" . $pass . "'"
    ]);
    $result = $db->SelectOne($query);
    $row=null;
    if($result)
        $row = mysqli_fetch_assoc($result);

    if($row)
    {
        $param=[
            "from"=>"users",
            "where"=>"user_id=".$user_id."",
            "param"=>[
                "col"=>[
                    "user_password"
                ],
                "data"=>[
                    "\"".$newpass."\""
                ]
            ]
        ];
        if($db->Update($param))
        {
            echo create_noti(1, "Thay đổi mật khẩu thành công!");
        }else echo create_noti(4, "Có lỗi xảy ra");
    }
    else echo create_noti(4, "Mật khẩu của bạn không đúng");
}


function create_noti($classify_alerts, $mess)
{
    return json_encode([
        "classify_alerts" => $classify_alerts,
        "mess" => $mess
    ]);
}
?>