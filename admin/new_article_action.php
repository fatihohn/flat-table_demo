<?php
    include_once '../bbps_db_conn.php';

    $username = $_POST['username'];

    $title = $_POST['title'];
    $title = mysqli_real_escape_string($conn, $title);

    $table_address = $_POST['address'];
    $table_address = mysqli_real_escape_string($conn, $table_address);

    // $categories = $_POST['categories'];
    // $categories = mysqli_real_escape_string($conn, $categories);

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

    $fieldwork_date = $_POST['fieldwork_date'];
    $fieldwork_date = mysqli_real_escape_string($conn, $fieldwork_date);

    // $about = $_POST['about'];
    // $about = mysqli_real_escape_string($conn, $about);


    $tag_vault = $_POST['tag_vault'];
    $tag_vault = mysqli_real_escape_string($conn, $tag_vault);

    $tag_vault = explode(",", $tag_vault);

    // $new_tags = array();
    $old_tags = array();
    $old_tags_id_list = array();
    $new_tags_id_list = array();

    $sql_old_tags = "SELECT tag_name FROM tags";
    $result_old_tags = mysqli_query($conn, $sql_old_tags);
    while($rows_old_tags = $result_old_tags->fetch_assoc()) {
        // array_push($old_tags, array($rows_old_tags['tag_name'], $rows_old_tags['id']));
        array_push($old_tags, $rows_old_tags['tag_name']);
        // array_push($old_tags_id_list, $rows_old_tags['id']);
    }

    // if(count($tag_vault) > 0) {//태그 입력이 있다면
    //     foreach($tag_vault as $tag_input) {
    //         if(in_array($tag_input, $old_tags)) {//전에 입력됐던 태그
    //             $sql_tag_input_id = "SELECT id FROM tags WHERE tag_name = $tag_input";
    //             $result_tag_input_id = mysqli_query($conn, $sql_tag_input_id);
    //             $row_tag_input_id = $result_tag_input_id->fetch_assoc();
    //             $old_tag_id = $row_tag_input_id['id'];

    //             $sql_old_tag_relation = "INSERT INTO article_tag_map VALUES ()"
    //         } else {//새로운 태그

    //         }
    //     }
    // }






    // $sql_new_tags = 
    //     "INSERT INTO tags (tagname) VALUES ('{$}'), ('{$}'), ('{$}');
    //     ";





    $sql = 
        "INSERT INTO articles
            (username, title, table_address, imgs, comment, content, photographer, words, flag, fieldwork_date, about)
        VALUES(
            '{$username}',
            '{$title}',
            '{$table_address}',
            '{$imgs}',
            '{$comment}',
            '{$content}',
            '{$photographer}',
            '{$words}',
            '{$flag}',
            '{$fieldwork_date}',
            'no'
        )";

    $result = mysqli_query($conn, $sql);


    if($result === false){
        echo '저장실패. 관리자에게 문의해주세요';
        echo '<br>';
        echo mysqli_error($conn);
        error_log(mysqli_error($conn));
    } else{//새 article이 만들어지면
        // $sql_new_article_id = "SELECT * FROM articles ORDER BY id DESC LIMIT 1";//새로 만들어진 article의 id도 불러오고
        // $result_new_article_id = mysqli_query($conn, $sql_new_article_id);
        // // $row_new_article_id = $result_new_article_id->fetch_assoc();
        // $row_new_article_id = mysqli_fetch_assoc($result_new_article_id);
        // $new_article_id = $row_new_article_id['id'];


        if(count($tag_vault) > 0) {//태그 입력이 있다면
            foreach($tag_vault as $tag_input) {//-------------------------------------각각 쿼리하는게 아니라, 한데 모아서 쿼리하는 방식으로 변경할 것.
                if(in_array($tag_input, $old_tags)) {//전에 입력됐던 태그가 있다면
                    $sql_old_tag_id = "SELECT * FROM tags WHERE tag_name = $tag_input";//태그의 id값을 구해서
                    $result_old_tag_id = mysqli_query($conn, $sql_old_tag_id);
                    // $row_old_tag_id = $result_old_tag_id->fetch_assoc();
                    if($result_old_tag_id) {
                        $row_old_tag_id = mysqli_fetch_assoc($result_old_tag_id);
                        $old_tag_id = $row_old_tag_id['id'];
        

                        array_push($old_tags_id_list, $old_tag_id);


                        // // $sql_old_tag_relation = "INSERT INTO articles_tags_map (article_id, tag_id) VALUES ('{$new_article_id}', '{$old_tag_id}')";//태그 맵 DB에 old 태그와 article의 id값을 저장한다
                        // $sql_old_tag_relation = "INSERT INTO articles_tags_map SET tag_fk = $old_tag_id, article_fk = LAST_INSERT_ID()";
                        // $result_old_tag_relation = mysqli_query($conn, $sql_old_tag_relation);


                        // if($result_old_tag_relation) {
                        //     echo("<script>alert('평상이 생성되었습니다.');location.href='index.php?q=ok';</script>");
                        // }
                    }
                } else {//새로운 태그라면
                    $sql_new_tag_input = "INSERT INTO tags (tag_name) VALUES ('{$tag_input}')";//새로운 태그 저장
                    $result_new_tag_input = mysqli_query($conn, $sql_new_tag_input);
                    
                    if($result_new_tag_input) {
                        $sql_new_tag_id = "SELECT * FROM tags WHERE tag_name = $tag_input";//저장된 태그의 id 불러오기
                        $result_new_tag_id = mysqli_query($conn, $sql_new_tag_id);
                        // $row_new_tag_id = $result_new_tag_id->fetch_assoc();
                        if($result_new_tag_id) {
                            $row_new_tag_id = mysqli_fetch_assoc($result_new_tag_id);
                            $new_tag_id = $row_new_tag_id['id'];
                            

                            array_push($new_tags_id_list, $new_tag_id);


                            // // $sql_new_tag_relation = "INSERT INTO articles_tags_map (article_id, tag_id) VALUES ('{$new_article_id}', '{$new_tag_id}')";//태그 맵 DB에 new 태그와 article의 id값을 저장한다
                            // $sql_new_tag_relation = "INSERT INTO articles_tags_map SET tag_fk = $new_tag_id, article_fk = LAST_INSERT_ID()";
                            // $result_new_tag_relation = mysqli_query($conn, $sql_new_tag_relation);


                            // if($result_new_tag_relation) {
                            //     echo("<script>alert('평상이 생성되었습니다.');location.href='index.php?q=ok';</script>");
                            // }
                        }
                    }
                }
            }


            if(count($old_tags_id_list) > 0) {
                $old_tag_relation_val = array();
                // $sql_old_tag_relation = "INSERT INTO article_tag_map (@article_id, @tag_id) VALUES";
                $sql_old_tag_relation = "INSERT INTO article_tag_map (article_fk, tag_fk) VALUES";
                for($i=0; $i < count($sql_old_tag_list); $i++) {
                    array_push($old_tag_relation_val, "('{$new_article_id}', '{$sql_old_tag_list[$i]}')");
                }
                $sql_old_tag_relation = $sql_old_tag_relation." ".implode(",", $old_tag_relation_val);
                $result_old_tag_relation = mysqli_query($conn, $sql_old_tag_relation);
                // foreach($old_tags_id_list as $old_id) {
                //     $sql_old_tag_relation = "INSERT INTO article_tag_map (article_id, tag_id) VALUES ('{$new_article_id}', '{$old_id}')";//태그 맵 DB에 old 태그와 article의 id값을 저장한다
                //     $result_old_tag_relation = mysqli_query($conn, $sql_old_tag_relation);
                // }
            }
            if(count($new_tags_id_list) > 0) {
                $new_tag_relation_val = array();
                // $sql_new_tag_relation = "INSERT INTO article_tag_map (@article_id, @tag_id) VALUES";
                $sql_new_tag_relation = "INSERT INTO article_tag_map (article_fk, tag_fk) VALUES";
                for($i=0; $i < count($sql_new_tag_list); $i++) {
                    array_push($new_tag_relation_val, "('{$new_article_id}', '{$sql_new_tag_list[$i]}')");
                }
                $sql_new_tag_relation = $sql_new_tag_relation." ".implode(",", $new_tag_relation_val);
                $result_new_tag_relation = mysqli_query($conn, $sql_new_tag_relation);
                // foreach($old_tags_id_list as $old_id) {
                //     $sql_old_tag_relation = "INSERT INTO article_tag_map (article_id, tag_id) VALUES ('{$new_article_id}', '{$old_id}')";//태그 맵 DB에 old 태그와 article의 id값을 저장한다
                //     $result_old_tag_relation = mysqli_query($conn, $sql_old_tag_relation);
                // }
            }


            echo("<script>alert('평상이 생성되었습니다.');location.href='index.php?q=ok';</script>");
            $conn->close();

        } else {
            echo("<script>alert('평상이 생성되었습니다.');location.href='index.php?q=ok';</script>");
            $conn>close();
        }
    }