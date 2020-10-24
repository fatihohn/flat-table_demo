<?php
    include_once 'bbps_db_config.php';

    $wi_id = $_POST['wi_id'];

    $title = $_POST['title'];
    $title = mysqli_real_escape_string($conn, $title);

    $model_info = $_POST['model_info'];
    $model_info = mysqli_real_escape_string($conn, $model_info);
    $price = $_POST['price'];
    $price = mysqli_real_escape_string($conn, $price);
    $quantity = $_POST['quantity'];
    $quantity = mysqli_real_escape_string($conn, $quantity);
    $location = $_POST['location'];
    $location = mysqli_real_escape_string($conn, $location);
    $detail = $_POST['detail'];
    $detail = mysqli_real_escape_string($conn, $detail);
    $tag = $_POST['tag'];
    $tag = mysqli_real_escape_string($conn, $tag);
    $images = $_POST['images'];
    // $images = mysqli_real_escape_string($conn, $images);
    $categories = intval($_POST['categories']);
    // $categories = mysqli_real_escape_string($conn, $categories);

    $sql = 
        "INSERT INTO items
            (wi_id, title, model_info, price, quantity, location, detail, tag, images, categories)
        VALUES(
            '{$wi_id}',
            '{$title}',
            '{$model_info}',
            '{$price}',
            '{$quantity}',
            '{$location}',
            '{$detail}',
            '{$tag}',
            '{$images}',
            '{$categories}'
            )";

    $result = mysqli_query($conn, $sql);
    if($result === false){
        echo '저장실패. 관리자에게 문의해주세요';
        echo '<br>';
        echo mysqli_error($conn);
        error_log(mysqli_error($conn));
    }
    else{
        echo("<script>alert('이 생성되었습니다.');location.href='index.php';</script>");
    }