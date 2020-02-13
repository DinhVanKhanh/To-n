<?php
include("../apps/bootstrap.php");
//Các Mimes quản lý định dạng file
if (isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileError = $_FILES['file']['error'];
    $id_product = $_POST["id_history_status_advisory"];
    $fileStatus = array(
        'status' => 0,
        'message' => '',
        'name' => $fileName
    );
    if ($fileError == 1) { //Lỗi vượt dung lượng
        $fileStatus['message'] = 'Dung lượng quá giới hạn cho phép';
    } else { //Không có lỗi nào
        /*
        $file=new apps_model_File();
        $id_file=$file->InserFile($fileName);
        $file_advisoty=new apps_model_FileAdvisory();
        $file_advisoty->InserFileAdvisory($id_history_status_advisory,$id_file);
         */
        $fileType=explode("/",$fileType)[1];
        $video_source = "";
        $db = new apps_libs_Dbconn();
        $param = [
            "select" => "*",
            "from" => "videos",
            "where" => "video_product=$id_product and demo=1"
        ];
        $ck = true;
        $result = $db->SelectOne($param);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $video_source = $row["video_source"];
                unlink("videos/" . $video_source);
                $ck = false;
                $param = [
                    "from" => "videos",
                    "param" => [
                        "col" => ["video_name"],
                        "data" => [
                            "'$fileName'"
                        ]
                        ],
                    "where"=>"video_product=$id_product and demo=1"
                ];
                $db->Update($param);
            }
        }
        if ($ck) {
            do {
                $video_source = rand(1, 100000) . '.' . $fileType;
            } while (file_exists('video/' . $video_source));
            $param = [
                "from" => "videos",
                "param" => [
                    "col" => "video_source,video_des,video_product,video_name,demo",
                    "data" => [
                        "'$video_source'","''",$id_product,"'$fileName'",1
                    ]
                ]
            ];
            $db->Insert($param);
        }


        move_uploaded_file($_FILES['file']['tmp_name'], 'videos/' . $video_source);
        $fileStatus['status'] = 1;
        $fileStatus['message'] = "Bạn đã upload thành công";
    }
    echo json_encode($fileStatus);
    exit();
}