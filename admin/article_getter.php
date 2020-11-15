<?php
    include_once '../bbps_db_conn.php';

    // $str = $_GET['str'];
    $scrollTag = $_GET['q'];
    $hashTag = $_GET['tag'];
    $articleRow = 8 + intval($_GET['row']);



    





    // $rows_article_all = mysqli_fetch_assoc($result_article_data_all);
    if(isset($hashTag)) {
        $hashTag = mysqli_real_escape_string($conn, $hashTag);
        // $hashTagMeta = trim($hashTag)."%";
        // $hashTagMeta = $hashTag;
        // $sql_get_hashtag_id = "SELECT * FROM tags WHERE tag_name = '$hashTag' LIMIT 1";
        // $result_get_hashtag_id = mysqli_query($conn, $sql_get_hashtag_id);

        
        // $query = "SELECT * FROM user_data WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        $sql_get_hashtag_id = "SELECT * FROM tags WHERE tag_name LIKE ? LIMIT 1";
        if (!mysqli_stmt_prepare($stmt, $sql_get_hashtag_id)) {
            echo "query error";
        } else {
            mysqli_stmt_bind_param($stmt, "s", $hashTag);
            mysqli_stmt_execute($stmt);
            $result_get_hashtag_id = mysqli_stmt_get_result($stmt);
                // mysqli_stmt_close();
        }




        $row_get_hashtag_id = mysqli_fetch_assoc($result_get_hashtag_id);
        $hashTag_id = intval($row_get_hashtag_id['id']);

        //get articles with hashtag
        $article_with_hashtag = array();
        
        $sql_hashtag_article = "SELECT * FROM article_tag_map WHERE tag_id = $hashTag_id";
        $result_hashtag_article = mysqli_query($conn, $sql_hashtag_article);
        while($row_hashtag_article = $result_hashtag_article->fetch_assoc()) {
            array_push($article_with_hashtag, "'".$row_hashtag_article['article_id']."'");
        }
        // for($ii; $ii < mysqli_fetch_length($conn, $sql_hashtag_article); $ii++) {
        //     array_push($article_with_hashtag, mysqli_fetch_assoc($result_hashtag_article)['article_id']);
        // }

        $article_with_hashtag_str = join(", ", $article_with_hashtag);
        // $sql_article_data_all = "SELECT * FROM articles WHERE about!= 'on' AND `id` IN ($article_with_hashtag_str)";
        // $sql_article_data_all = "SELECT * FROM articles WHERE `id` IN ($article_with_hashtag_str)";
        
        $sql_article_data_all = "SELECT * FROM articles WHERE about!= 'on'";
            ?>
            <script>
                console.log("<?=$article_with_hashtag_str?>");
            </script>
            <?php
        if(count($article_with_hashtag) > 0) {
            $sql_article_data_all .=  "AND `id` IN ($article_with_hashtag_str)";
        }
    } else {
        $sql_article_data_all = "SELECT * FROM articles WHERE about != 'on'";
    }
    

    $sql_article_data_all .= " ORDER BY fieldwork_date";
    if(!isset($articleRow)) {
        $sql_article_data_all .= " LIMIT 8";
    } else {
        $sql_article_data_all .= " LIMIT {$articleRow}";
    }





    $result_article_data_all = $conn->query($sql_article_data_all);


    
    if ($result_article_data_all->num_rows > 0) {
        while($rows_article_all = $result_article_data_all->fetch_assoc()) {
            $articleId = $rows_article_all["id"];
            $articleTitle = $rows_article_all["title"];
            $articleComment = $rows_article_all["comment"];
            // $articleImgList = explode(",", $rows_article_all["imgs"]);
            $articleImgList = array();
            $articleImgListVault = explode(",", $rows_article_all["imgs"]);

            for($ai=0; $ai < count($articleImgListVault); $ai++) {
                if($articleImgListVault[$ai] !== "") {
                    array_push($articleImgList, $articleImgListVault[$ai]);
                }
            }

            $article_tag_list = array();

            $sql_get_tags = "SELECT * FROM article_tag_map WHERE article_id = $articleId";
            $result_get_tags = mysqli_query($conn, $sql_get_tags);
            while($row_get_tags = $result_get_tags->fetch_assoc()) {
                $sql_get_tag_names = "SELECT tag_name FROM tags WHERE id = {$row_get_tags['tag_id']}";
                $result_get_tag_names = mysqli_query($conn, $sql_get_tag_names);
                $row_get_tag_names = mysqli_fetch_assoc($result_get_tag_names);
                array_push($article_tag_list, $row_get_tag_names['tag_name']);
            }
            
            echo '
            <li>
                <article class="article">
                    <figure>
                        <a class="overlay '.$articleId.'" onclick="showArticle(this.classList.item(1))">
                            <div class="center">
                                <p>
                                    읽기
                                </p>
                            </div>
                        </a>
                        <a class="'.$articleId.'" onclick="showArticle(this.className)">
                            <img src="/uploads/'.$articleImgList[0].'" alt="" class="cover">
                        </a>
                    </figure>
                    <div class="article_content">
                        <aside class="meta">
                            <p>';
                                foreach($article_tag_list as $tag) {
                                    if($tag !== "") {
                                        echo '<a class="'.$tag.'" onclick="showArticleWithTag(this.className)" class="category">';
                                        echo    "#".$tag." ";
                                        echo '</a>';
                                    }
                                }
            echo            '</p>
                        </aside>
                        <h1 class="article_title">
                            <a class="'.$articleId.'" onclick="showArticle(this.className)">
                                <span class="line">
                                    '.$articleTitle.'
                                </span>
                            </a>
                        </h1>
                        <div class="article_comment">
                            <p>
                                '.$articleComment.'
                            </p>

                        </div>
                    </div>
                </article>
            </li>';
        }
    }
                        





        
?>