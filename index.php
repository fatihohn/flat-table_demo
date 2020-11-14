<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'?>
    
</head>
<body>
    <?php include 'header.php'?>
    <?php
    include_once 'bbps_db_conn.php';

    $scrollTag = $_GET['q'];
    $hashTag = $_GET['tag'];

    // $rows_article_all = mysqli_fetch_assoc($result_article_data_all);
    if(isset($hashTag)) {
        $hashTag = mysqli_real_escape_string($conn, $hashTag);
        // $sql_get_hashtag_id = "SELECT * FROM tags WHERE tag_name = '$hashTag' LIMIT 1";
        // $result_get_hashtag_id = mysqli_query($conn, $sql_get_hashtag_id);
        $sql_get_hashtag_id = "SELECT * FROM tags WHERE tag_name = ? LIMIT 1";
        $stmt = mysqli_stmt_init($conn);
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
    $result_article_data_all = $conn->query($sql_article_data_all);


    // $sql_article_data_flag = $sql_article_data_all." WHERE flag = flag";
    $sql_article_data_flag = "SELECT * FROM articles WHERE about != 'on' AND flag = 'on'";
    $result_article_data_flag = $conn->query($sql_article_data_flag);




    ?>
    <?php
    if($scrollTag !== "") {
    ?>
        <script>
            var scrollTag = "<?=$scrollTag?>";
        </script>
    <?php
    } else {
        ?>
        <script>
            var scrollTag = "";
        </script>
        <?php
    }

    if($hashTag !== "") {
        ?>
            <script>
                var hashTag = "<?=$hashTag?>";
            </script>
        <?php
        } else {
            ?>
            <script>
                var hashTag = "";
            </script>
            <?php
        }
    ?>
    <script>
        var isIndex = "yes";
    </script>
    <?php include 'nav.php'?>

    <div id="overlay" class="overlay"></div>
    <!-- @yield ('content') -->
    <aside class="intro">
        <div class="intro_slide">
            <!--대표 평상 이미지 목록-->
                <div class="intro_slide_imgs" style="visibility:hidden; height:0;">
                    <?php
                    if ($result_article_data_flag->num_rows > 0) {
                        while($rows_article_flag = $result_article_data_flag->fetch_assoc()) {
                            $frontArticleTitle = $rows_article_flag["title"];
                            $frontArticleId = $rows_article_flag["id"];
                            $frontArticleImg = explode(",", $rows_article_flag["imgs"])[0];

                            echo '<img class="slide_img_src" title="'.$frontArticleTitle.'" src="/uploads/'.$frontArticleImg.'" alt="'.$frontArticleId.'">';
                        }
                    }
                    ?>



                    <!-- <img class="slide_img_src" title="성보주택 평상" src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt=""> -->
                    <!-- <img class="slide_img_src" title="못골 고개에는 평상이 없다" src="https://www.doongdoong.org/se2/upload/c_modify_20200706093011525244320FUN_4974_001.jpg" alt=""> -->
                    <!-- <img class="slide_img_src" title="우물물은 시원하다" src="https://www.doongdoong.org/se2/upload/c_modify_20200706093043948349794IMG_0913.JPG" alt=""> -->
                </div>
                <!--대표 평상 이미지 목록 끝-->
            <div class="intro_slide_img"><!--배경 이미지 넣기-->
                <div class="intro_slide_btn prev_btn">
                    <a>
                        <img src="../static/img/prev_btn.png" alt="prev_btn">
                    </a>
                </div>
                <div class="intro_slide_btn next_btn">
                    <a>
                        <img src="../static/img/next_btn.png" alt="next_btn">
                    </a>
                </div>
                <div class="intro_slide_btn down_btn">
                    <a>
                        <img src="../static/img/down_btn.png" alt="down_btn">
                    </a>
                </div>
                <header class="intro_slide_title">
                    <h1 class="slide_title">
                        <!-- <a href="./article.php?q="> -->
                        <a>
                            <!-- 못골에는 평상이 없더라 -->
                        </a>
                    </h1>
                    <!-- <a href="./article.php?q=" class="slide_enter button"> -->
                    <a class="slide_enter button">
                        <p>
                            평상 살펴보기
                        </p>
                    </a>
                </header>
            </div>
        </div>
    </aside>
    <div class="spacer"></div>
    <aside class="tagline">
        <div class="container group">
            <div class="col-1">
                <h1>
                    동두천<em>의</em>
                    평상
                </h1>
            </div>
            <div class="col-2">
                <h2>변방평상</h2>
                <p>
                    평상을 이용하는 사람들의 문화를 관찰합니다.<br>
                    평상이 품은 역사와 특유의 문화를 배웁니다.
                </p>
            </div>
        </div>
    </aside>
        <!-- 평상 리스트 -->
    <section class="front_main">
        <div class="main">
            <div class="container group">
                <header class="container_header">
                    <img src="../static/img/flat_table_icon.svg" alt="flat_table_icon">
                    <h1>평상들</h1>
                    <?php
                    if(isset($hashTag) && $hashTag !== "null") {
                        echo "<h2>#".$hashTag."</h2>";
                    }
                    ?>
                </header>
                <nav class="container_nav group">
                    <div class="filter_container">
                        <div class="filter_search filter_list">
                            <!-- <form action="" class="tag_search"></form> -->
                            <input type="text" class="tag_search">
                            <button class="tag_search_btn">검색</button>
                        </div>
                        <!-- 태그 검색으로 대체 -->
                        <!-- <div class="filter_list">
                            <a href="#" class="action">
                                구분
                                <span>+</span>
                            </a>
                            <div class="collapseable-lined"></div>
                            <div class="list collapseable">
                                <div class="scroller">
                                    <div class="link">
                                        <a href="#">sample</a>
                                    </div>
                                    <div class="link">
                                        <a href="#">sample</a>
                                    </div>
                                    <div class="link">
                                        <a href="#">sample</a>
                                    </div>
                                    <div class="link">
                                        <a href="#">sample</a>
                                    </div>
                                    <div class="link">
                                        <a href="#">sample</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- 태그 검색으로 대체 -->
                    </div>
                </nav>
                <div class="collection group">
                    <ul>
                        <?php
                        if ($result_article_data_all->num_rows > 0) {
                            while($rows_article_all = $result_article_data_all->fetch_assoc()) {
                                $articleId = $rows_article_all["id"];
                                $articleTitle = $rows_article_all["title"];
                                $articleComment = $rows_article_all["comment"];
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
                                // $articleTags = ["임시", "태그", "골목"];

                                // echo '<img class="slide_img_src" title="'.$frontArticleTitle.'" src="/uploads/'.$frontArticleImg.'" alt="'.$frontArticleTitle.'">';
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
                                                    // <a class="'.$articleId.'" onclick="showArticle(this.className)" class="category">
                                                    //     종류
                                                    // </a>
                                                    // <a class="'.$articleId.'" onclick="showArticle(this.className)" class="category">
                                                    //     무엇
                                                    // </a>
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
                        <!-- <li>
                            <article class="article">
                                <figure>
                                    <a href="/admin_article.php" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/admin_article.php">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/admin_article.php" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/admin_article.php">
                                            <span class="line">
                                                성보주택 평상
                                            </span>
                                        </a>
                                    </h1>
                                    <div class="article_comment">
                                        <p>
                                            자전거 거치대를 개조해 만든 평상. 자전거 거치대를 개조해 만든 평상. 자전거 거치대를 개조해 만든 평상. 자전거 거치대를 개조해 만든 평상. 자전거 거치대를 개조해 만든 평상. 자전거 거치대를 개조해 만든 평상. 자전거 거치대를 개조해 만든 평상. 자전거 거치대를 개조해 만든 평상. 자전거 거치대를 개조해 만든 평상.
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'?>

    <script src="../static/js/main.js"></script>
</body>
</html>