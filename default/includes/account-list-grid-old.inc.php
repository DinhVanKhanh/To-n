<?php

    if(!isset($_GET['course_id'])) {
        echo 'Khóa học không tồn tại';
        exit;
    }

    $database = new Database(HOST, USER, PASS, DBNAME);
    $conn = $database -> get_connection();


    //Get course
    $sql = "SELECT * FROM products WHERE product_id = :id;";
    $query = $conn -> prepare($sql);
    $query -> execute(array(
        ':id' => (int)$_GET['course_id']
    ));
    $course = $query -> fetch(PDO::FETCH_ASSOC);

    $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
    $html = '
            <form method="post" action="default/includes/check-key.inc.php">
                <h1>Bạn phải nhập code để xem video:</h1>
                <p style="color: red;">' . $error . '</p>
                <input type="text" name="key_string" placeholder="Nhập code của khóa học" required />
                <input type="hidden" name="product_id" value="' . $course['product_id'] . '" />
                <input type="submit" value="Kiểm tra" />
            </form>
        ';

    //Check Had user bought this course before?
    $data = unserialize($_SESSION['data']);
    $userId = $data['end_user_id'];
    $sql = "SELECT * FROM bought_products WHERE user_id = :user_id AND product_id = :product_id;";
    $query = $conn -> prepare($sql);
    $query -> execute(array(
        ':user_id' => $userId,
        ':product_id' => $course['product_id']
    ));
    if($query -> rowCount() > 0) {
        $sql1 = "SELECT * FROM videos WHERE video_product = :id; and demo=0";
        $query1 = $conn -> prepare($sql1);
        $query1 -> execute(array(
            ':id' => (int)$_GET['course_id']
        ));
        $html = ($query1 -> rowCount() > 0) ? '' : '<p>Khóa học này hiện không có video nào.</p>';
        while($video = $query1 -> fetch(PDO::FETCH_ASSOC)) {
            $html .= '
                    <div class="col">
                        <a href="/index.php?view=account&action=list&course_id=' . $_GET['course_id'] . '&video_id=' . $video['video_id'] . '" target="_blank">
                            <div class="box">
                                <div class="box-image">
                                    <div class="image-cover">
                                        <img src="images/play-btn.png">
                                    </div>
                                </div>
                                <div class="box-text text-center">
                                    <div class="box-text-inner blog-post-inner">
                                        <h5 class="post-title is-small ">' . $video['video_name'] . '</h5>
                                        <div class="is-divider"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                ';
        }
    }

    echo $html;
?>