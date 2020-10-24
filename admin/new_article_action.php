<?php
    include_once '../bbps_db_conn.php';

    $username = $_POST['username'];

    $title = $_POST['title'];
    $title = mysqli_real_escape_string($conn, $title);

    $table_address = $_POST['address'];
    $table_address = mysqli_real_escape_string($conn, $table_address);

    $categories = $_POST['categories'];
    $categories = mysqli_real_escape_string($conn, $categories);

    $imgs = $_POST['imgs'];
    $imgs = mysqli_real_escape_string($conn, $imgs);

    $comment = $_POST['comment'];
    $comment = mysqli_real_escape_string($conn, $comment);

    $content = $_POST['content'];
    $content = mysqli_real_escape_string($conn, $content);

    $photographer = $_POST['photographer'];
    $photographer = mysqli_real_escape_string($conn, $photographer);

    $words = $_POST['words'];
    $words = mysqli_real_escape_string($conn, $words);
    
    $flag = $_POST['flag'];
    $flag = mysqli_real_escape_string($conn, $flag);

    $sql = 
        "INSERT INTO articles
            (username, title, table_address, categories, imgs, comment, content, photographer, words, flag)
        VALUES(
            '{$username}',
            '{$title}',
            '{$table_address}',
            '{$categories}',
            '{$imgs}',
            '{$comment}',
            '{$content}',
            '{$photographer}',
            '{$words}',
            '{$flag}'
            )";

    $result = mysqli_query($conn, $sql);
    if($result === false){
        echo '저장실패. 관리자에게 문의해주세요';
        echo '<br>';
        echo mysqli_error($conn);
        error_log(mysqli_error($conn));
    }
    else{
        echo("<script>alert('평상이 생성되었습니다.');location.href='index.php';</script>");
    }