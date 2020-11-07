<?php
    include_once '../bbps_db_conn.php';
    $q = intval($_POST['id']);
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

    $about = $_POST['about'];
    $about = mysqli_real_escape_string($conn, $about);


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


    $sql = 
        "UPDATE articles SET
            `title` = '$title',
            `table_address` = '$table_address',
            `imgs` = '$imgs',
            `comment` = '$comment',
            `content` = '$content',
            `photographer` = '$photographer',
            `words` = '$words',
            `flag` = '$flag',
            `fieldwork_date` = '$fieldwork_date',
            `about` = '$about'
        WHERE `id` = '$q'";
        //     (username, title, table_address, categories, imgs, comment, content, photographer, words, flag, about)
        // VALUES(
        //     '{$username}',
        //     '{$title}',
        //     '{$table_address}',
        //     '{$categories}',
        //     '{$imgs}',
        //     '{$comment}',
        //     '{$content}',
        //     '{$photographer}',
        //     '{$words}',
        //     '{$flag}',
        //     '{$about}'
        //     )";

    $result = mysqli_query($conn, $sql);
    if($result === false){
        echo '저장실패. 관리자에게 문의해주세요';
        echo '<br>';
        echo mysqli_error($conn);
        error_log(mysqli_error($conn));
    }
    else{
        if(count($tag_vault) > 0) {//태그 입력이 있다면

            for ($i = 0; $i < count($tag_vault); $i++) {
                if (!in_array($tag_vault[$i], $item_tag_list)) {//기존에 맵핑된 태그가 아닌 경우
                    if (in_array($tag_vault[$i], $old_tags)) {//전에 입력됐던 태그가 있다면
                        ?>
                        <script>
                            console.log("old: "+"<?=$tag_vault[$i]?>")
                        </script>
                        <?php
                        $sql_old_tag_relation = "INSERT INTO article_tag_map SET 
                            tag_id = (SELECT id FROM tags WHERE tag_name = '$tag_vault[$i]'), 
                            article_id = (SELECT MAX(id) FROM articles)";//태그 테이블 맵핑
                        $result_old_tag_relation = mysqli_query($conn, $sql_old_tag_relation);
                    
                    } else {//새로운 태그라면
                        $sql_new_tag_vault[$i] = "INSERT INTO tags (tag_name) VALUES ('{$tag_vault[$i]}')";//새로운 태그 저장
                        $result_new_tag_vault[$i] = mysqli_query($conn, $sql_new_tag_vault[$i]);
                        
                        if ($result_new_tag_vault[$i]) {
                            ?>
                            <script>
                                console.log("new: "+"<?=$tag_vault[$i]?>")
                            </script>
                            <?php
                            $sql_new_tag_relation = "INSERT INTO article_tag_map SET 
                                tag_id = (SELECT MAX(id) FROM tags), 
                                article_id = (SELECT MAX(id) FROM articles)";//태그 테이블 맵핑
                            $result_new_tag_relation = mysqli_query($conn, $sql_new_tag_relation);
                        }
                    }
                }
            }
            echo("<script>alert('평상이 수정되었습니다.');location.href='article.php?q=$q';</script>");
        } else {
            echo("<script>alert('평상이 수정되었습니다.');location.href='article.php?q=$q';</script>");
        }







    }