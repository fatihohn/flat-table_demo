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
    <!-- @yield ('content') -->
    <section class="article_main">
        <div class="main">
            <div class="article_container container">
                <header class="article_header">
                    <h2>
                        <!-- 성보주택 평상 -->
                        <?=$title?>
                    </h2>
                    <div class="article_info">
                        <p class="article_address" onclick="showExMap(this.innerHTML)"><?=$address?></p>
                        <p class="category">
                            <!-- <a href="#">
                                주민모임형
                            </a> -->
                            <?php
                            foreach($article_tag_list as $tag) {
                                echo '<a class="'.$tag.'" onclick="showArticleWithTag(this.className)" class="category">';
                                echo    "#".$tag." ";
                                echo '</a>';
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
                            // while($rows_article_flag = $result_article_data_flag->fetch_assoc()) {
                            //     $frontArticleTitle = $rows_article_flag["title"];
                            //     $frontArticleId = $rows_article_flag["id"];
                            //     $frontArticleImg = explode(",", $rows_article_flag["imgs"])[0];
    
                            //     echo '<img class="slide_img_src" title="'.$frontArticleTitle.'" src="/uploads/'.$frontArticleImg.'" alt="'.$frontArticleId.'">';
                            // }
                        }
                    ?>
                    <!-- <figure>
                        <img src="https://www.doongdoong.org/se2/upload/c37_202008090731431935073975%25EC%2588%2598%25EC%25A0%2595%25EB%2590%25A8_Copy%2Bof%2BHUN_DSC_1089.jpg" alt="">
                    </figure> -->
                    <!-- <figure>
                        <img src="https://www.doongdoong.org/se2/upload/c37_202008090733272041502992%25EC%2588%2598%25EC%25A0%2595%25EB%2590%25A8_FUN_4279_001.jpg" alt="">
                    </figure>
                    <figure>
                        <img src="https://www.doongdoong.org/se2/upload/c37_20200809073306970504637%25EC%2588%2598%25EC%25A0%2595%25EB%2590%25A8_FUN_4580_001.jpg" alt="">
                    </figure>
                    <figure>
                        <img src="https://www.doongdoong.org/se2/upload/c37_202008090733501338812052%25EC%2588%2598%25EC%25A0%2595%25EB%2590%25A8_Copy%2Bof%2BHUN_DSC_1180.jpg" alt="">
                    </figure> -->
                </div>
                <div class="article_text">
                    <div class="article_comment">
                        <p>
                            <?=$comment?>
                            <!-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo temporibus consequuntur quibusdam quos! Maxime quam dicta quas, fugit velit eaque rem consequuntur, labore distinctio amet odio asperiores veritatis odit nesciunt? -->
                        </p>
                    </div>
                    <div class="article_text_spacer"></div>
                    <div class="article_cont trix-content">
                        <?=$content?>
                        <!-- <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque?
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque?
                        </p> -->
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
            for(let m=0; m < articleImgs.length; m++) {
                articleImgs[m].style.display = "block";
                articleImgs[m].childNodes[1].style.width = "100%";
                if(window.innerWidth > 1080) {
                    if(mobileImgs.childNodes.length > 0) {
                        for(let n=0; n < mobileImgs.childNodes.length; n++) {
                            mobileImgs.childNodes[n].remove();
                        }
                    }
                    
                    // articleImgs[m].style.maxWidth = "96.5%";
                        if(articleImgs[m].querySelector("img").width*1.2 > articleImgs[m].querySelector("img").height) {
                        // articleImgs[m].style.height = "auto";
                        // articleImgs[m].childNodes[1].style.height = "auto";
                        // articleImgs[m].childNodes[1].style.width = "100%";
                        // articleImgs[m].style.margin = "10px 0.75%";
                        articleImgs[m].classList.add("hori");
                    } else {
                        // articleImgs[m].style.maxWidth = "47.5%";
                        // articleImgs[m].style.height = "auto";
                        // articleImgs[m].childNodes[1].style.height = "auto";
                        // articleImgs[m].childNodes[1].style.width = "100%";
                        // articleImgs[m].style.margin = "10px 0.5%";
                        // articleImgs[m].style.display = "inline-flex";
                        if(articleImgs[m].classList.contains("hori")) {
                            articleImgs[m].classList.remove("hori");
                        }
                        articleImgs[m].classList.add("verti");
                    }
                } else if(window.innerWidth <= 1080 && window.innerWidth >= 720) {
                    if(m > 0 && document.querySelectorAll(".article_pics_mobile figure").length < document.querySelectorAll(".article_pics figure").length - 1) {
                        replaceImg(articleImgs[m]);
                        // if(articleImgs[m].childNodes[1].width*1.2 >= articleImgs[m].childNodes[1].height) {
                        if(articleImgs[m].querySelector("img").width*1.2 > articleImgs[m].querySelector("img").height) {
                            // document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "96.5%";
                            // document.querySelectorAll(".mobile_img")[m-1].style.width = "96.5%";
                            // document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
                            // document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100%";
                            // document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
                            // document.querySelectorAll(".mobile_img")[m-1].style.margin = "10px 0.25%";
                            document.querySelectorAll(".mobile_img")[m-1].classList.add("hori");
                            document.querySelectorAll(".mobile_img img")[m-1].classList.add("hori");
                        } else {
                            // document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "47.5%";
                            // document.querySelectorAll(".mobile_img")[m-1].style.width = "47.5%";
                            // document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
                            // document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100%";
                            // document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
                            // document.querySelectorAll(".mobile_img")[m-1].style.margin = "10px 0.5%";
                            // document.querySelectorAll(".mobile_img")[m-1].style.display = "inline-flex";

                            if(document.querySelectorAll(".mobile_img")[m-1].classList.contains("hori")) {
                                document.querySelectorAll(".mobile_img")[m-1].classList.remove("hori");
                                document.querySelectorAll(".mobile_img img")[m-1].classList.remove("hori");
                            }
                            // document.querySelectorAll(".mobile_img")[m-1].classList.add("verti");
                            // document.querySelectorAll(".mobile_img img")[m-1].classList.add("verti");
                        }
                    }
                    
                } else if(window.innerWidth < 720) {
                    if(m > 0 && document.querySelectorAll(".article_pics_mobile figure").length < document.querySelectorAll(".article_pics figure").length - 1) {
                        replaceImg(articleImgs[m]);
                        if(document.querySelectorAll(".mobile_img")[m-1].classList.contains("hori") || document.querySelectorAll(".mobile_img img")[m-1].classList.contains("hori")) {
                            document.querySelectorAll(".mobile_img")[m-1].classList.remove("hori");
                            document.querySelectorAll(".mobile_img img")[m-1].classList.remove("hori");
                        }
                        if(document.querySelectorAll(".mobile_img")[m-1].classList.contains("verti") || document.querySelectorAll(".mobile_img img")[m-1].classList.contains("verti")) {
                            document.querySelectorAll(".mobile_img")[m-1].classList.remove("verti");
                            document.querySelectorAll(".mobile_img img")[m-1].classList.remove("verti");
                        }
                        document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "100% !important";
                        document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
                        document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100% !important";
                        document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
                        document.querySelectorAll(".mobile_img")[m-1].style.margin = "0 0 20px 0 !important";
                        document.querySelectorAll(".mobile_img")[m-1].style.display = "block";
                        
                    }
                }
                
            }
            function replaceImg(imgSrc) {
                let imgUrl = imgSrc.childNodes[1].src;
                let mobileImgWrap = document.createElement("figure");
                mobileImgWrap.className = "mobile_img";
                mobileImgWrap.style.width = "100%";
                mobileImgWrap.style.margin = "0 0 20px 0";
                document.querySelector(".article_pics_mobile").appendChild(mobileImgWrap);
                let mobileImg = document.createElement("img");
                mobileImg.src = imgUrl;
                mobileImg.style.width = "100%";
                mobileImgWrap.appendChild(mobileImg);
            }
        }
        let picControl = setInterval(organizePics, 200);
        organizePics();
        setTimeout(function() {
            organizePics();
        }, 300);
        
        window.addEventListener("resize", function() {
            setTimeout(function() {
                if(window.innerWidth > 1080) {
                    setTimeout(() => {
                        clearInterval(picControl);
                        organizePics();
                    }, 200);
                } else {
                    organizePics();
                }
            }, 300);
        });
    </script>
</body>
</html>