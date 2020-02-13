<?php
if (isset($_FILES['file'])) {
    $duoi = explode('.', $_FILES['file']['name']); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)];//lấy ra đuôi file
    $img = "";
    // tạo tên file ngẫu nhiên, tránh trùng lặp file đã có trong folder rec
    do {
        $img = rand(1, 100000) . '.' . $duoi;
    } while (file_exists('rec/' . $img));

    //upload file vừa được truyền lên server vào folder rec
    if (move_uploaded_file($_FILES['file']['tmp_name'], 'rec/' . $img)) {
        echo $img; // trả về tên file nếu upload thành công
    } else {
        echo ""; // upload thất bại
    }
} else {
    echo ""; // chặn những truy cập trái phép
}
?>