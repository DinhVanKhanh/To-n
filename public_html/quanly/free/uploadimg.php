<?php
include_once('../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->isOnline()) $rt->LoginPage();
if (isset($_FILES['file'])) {
    $duoi = explode('.', $_FILES['file']['name']); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)];//lấy ra đuôi file
    $img = "";
    do {
        $img = rand(1, 100000) . '.' . $duoi;
    } while (file_exists('../img/rec/' . $img));

    if (move_uploaded_file($_FILES['file']['tmp_name'], '../img/rec/' . $img)) {
        $thump=$rt->GetPost("thump");
        if($thump)
        {
            $thump="thumb".$img;
            $resizeimg=new apps_libs_ResizeImg('../img/rec/'.$img,'../img/rec/'.$thump);
            if($resizeimg->ResizeImg())
            {
                echo $img."|".$thump;
            }
            else echo "";
        }
        else echo $img;
    } else {
        echo "";
    }
} else {
    echo "";
}
?>