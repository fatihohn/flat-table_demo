<?php
    include_once 'bbps_db_conn.php';
    
    $q = intval($_GET["q"]);

    $sql_article_data = "SELECT * FROM articles WHERE id = $q";
    $result_article_data = $conn->query($sql_article_data);
    $rows_article = mysqli_fetch_assoc($result_article_data);

    $title = $rows_article["title"];
    $address = $rows_article["table_address"];
    $imgList = explode(",", $rows_article["imgs"]);
    $comment = $rows_article["comment"];
    $content = $rows_article["content"];
    // $content = htmlspecialchars($content);
    $photographer = $rows_article["photographer"];
    $words = $rows_article["words"];

    $fieldwork_date = date_create($rows_article["fieldwork_date"]);
    $fieldwork_date = date_format($fieldwork_date, 'Y/m/d');

    // // $sql_article_data_flag = $sql_article_data_all." WHERE flag = flag";
    // $sql_article_data_flag = "SELECT * FROM articles WHERE flag = flag";
    // $result_article_data_flag = $conn->query($sql_article_data_flag);

    $article_tag_list = array();

    $sql_get_tags = "SELECT * FROM article_tag_map WHERE article_id = $q";
    $result_get_tags = mysqli_query($conn, $sql_get_tags);
    while($row_get_tags = $result_get_tags->fetch_assoc()) {
        $sql_get_tag_names = "SELECT tag_name FROM tags WHERE id = {$row_get_tags['tag_id']}";
        $result_get_tag_names = mysqli_query($conn, $sql_get_tag_names);
        $row_get_tag_names = mysqli_fetch_assoc($result_get_tag_names);
        array_push($article_tag_list, $row_get_tag_names['tag_name']);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'?>
</head>
<body>
    <?php include 'header.php'?>
    <?php include 'nav.php'?>

    <div id="overlay" class="overlay"></div>
    <section class="article_main">
        <div class="main">
            <div class="article_container container">
                <header class="article_header">
                    <h2>
                        <?=$title?>
                    </h2>
                    <div class="article_info">
                        <p class="article_address" onclick="showExMap(this.innerHTML)"><?=trim($address)?></p>
                        <p class="category">
                            <?php
                            foreach($article_tag_list as $tag) {
                                if($tag !== "") {
                                    echo '<a class="'.$tag.'" onclick="showArticleWithTag(this.className)" class="category">';
                                    echo    "#".$tag." ";
                                    echo '</a>';
                                }
                            }
                            ?>
                        </p>
                    </div>
                    
                </header>
                <div class="article_pics">
                    <?php
                        if (count($imgList) > 0) {
                            foreach ($imgList as $imgSrc) {
                                if($imgSrc !== "") {
                                    echo '
                                    <figure>
                                        <img src="/uploads/'.$imgSrc.'" alt="image">
                                    </figure>
                                    ';
                                }
                            }
                        }
                    ?>
                </div>
                <div class="article_text">
                    <div class="article_comment">
                        <p>
                            <?=$comment?>
                        </p>
                    </div>
                    <div class="article_text_spacer"></div>
                    <div class="article_cont trix-content">
                        <?=$content?>
                    </div>
                    <footer class="article_footer">
                        <div class="article_date">
                            <p class="fieldwork_date">
                                현지조사
                                <span>
                                    <?=$fieldwork_date?>
                                </span>
                            </p>
                        </div>
                        <div class="article_auth">
                            <p class="photo">
                                사진
                                <span>
                                    <?=$photographer?>
                                </span>
                            </p>
                            <p class="words">
                                글
                                <span>
                                    <?=$words?>
                                </span>
                            </p>
                        </div>
                        <div class="article_share">
                            <span>
                                공유:
                            </span>
                            <!-- <a href="">Facebook</a> -->
                            <!-- <a href="">Tweeter</a> -->
                            <a class="share_btn">Link</a>
                        </div>
                    </footer>
                </div>
                <div class="article_pics_mobile"></div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'?>

    <script src="/static/js/main.js"></script>
    <script>
        function organizePics() {
            let articleImgs = document.querySelectorAll(".article_pics figure");
            let mobileImgs = document.querySelector(".article_pics_mobile");
            for(let m = 0; m < articleImgs.length; m++) {
                articleImgs[m].style.display = "block";
                if(m === 0) {
                    articleImgs[m].style.width = "96.5% !important";
                    articleImgs[m].style.margin = "0 0 20px 5px !important";
                } else {
                    articleImgs[m].querySelector("img").style.width = "100%";
                    if(window.innerWidth > 1080) {
                        if(document.querySelectorAll(".mobile_img").length > 0) {
                            document.querySelectorAll(".mobile_img").forEach(function(mobileImg) {
                                mobileImg.remove();
                            });
                        }
                        articleImgs[m].querySelector("img").onload = function() {
                            articleImgs[m].classList.add(getImgOrientation(this));
                        }
                        } else {
                            if(document.querySelectorAll(".mobile_img").length + 1 <= articleImgs.length) {
                                replaceImg(articleImgs[m]);
                            }
                        }
                }
                
            }
            function replaceImg(imgSrc) {
                let img;
                img = imgSrc.querySelector("img");
                imgSrc.style.display = "none";
                let imgUrl = img.src;
                let imgOrientation = getImgOrientation(img);
                let mobileImgWrap = document.createElement("figure");
                let mobileImg = document.createElement("img");
                img.onload = function() {
                    mobileImg.src = imgUrl;
                    mobileImg.style.width = "100%";
                    if(window.innerWidth >= 720) {
                        mobileImg.classList.add(imgOrientation);
                        mobileImgWrap.classList.add("mobile_img", imgOrientation);
                    } else {
                        mobileImgWrap.classList.add("mobile_img");
                    }
                    mobileImgWrap.style.width = "100%";
                    mobileImgWrap.style.margin = "0 0 20px 0";
                    mobileImgWrap.appendChild(mobileImg);
                    document.querySelector(".article_pics_mobile").appendChild(mobileImgWrap);
                }
            }
        }

        function getImgOrientation(img) {
            let orientation;

            if(img.width*1.2 > img.height) {
                orientation = "hori";
            } else {
                orientation = "verti";
            }

            return orientation;
        }
        organizePics();
        window.onresize = function() {
            organizePics();
        }
        // // let picControl = setInterval(organizePics, 200);
        // // organizePics();
        // // setTimeout(function() {
        // //     organizePics();
        // // }, 300);
        
        // window.addEventListener("resize", function() {
        //     // setTimeout(function() {
        //     //     if(window.innerWidth > 1080) {
        //     //         setTimeout(() => {
        //     //             clearInterval(picControl);
        //     //             organizePics();
        //     //         }, 200);
        //     //     } else {
        //     //         organizePics();
        //     //     }
        //     // }, 300);
        // });
    </script>
</body>
</html>