<?php
    include 'wantit_db_config.php';

    $wi_id = $_POST['wi_id'];

    $title = $_POST['title'];
    $title = mysqli_real_escape_string($conn, $title);

    $content = $_POST['content'];
    $content = mysqli_real_escape_string($conn, $content);

    $sql = "
        INSERT INTO articles
            (wi_id, title, content)
        VALUES(
            '{$wi_id}',
            '{$title}',
            '{$content}'
            )";

    $result = mysqli_query($conn, $sql);
    if($result === false){
        echo '저장실패. 관리자에게 문의해주세요';
        error_log(mysqli_error($conn));
    }
    else{
        echo("<script>alert('게시물이 생성되었습니다.');location.href='index.php';</script>");
    }