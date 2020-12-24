<?php
    include_once 'bbps_db_conn.php';
    
    // $q = intval($_GET["q"]);

    $sql_article_data = "SELECT * FROM articles WHERE about = 'on' ORDER BY id DESC LIMIT 1";
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

    // // $sql_article_data_flag = $sql_article_data_all." WHERE flag = flag";
    // $sql_article_data_flag = "SELECT * FROM articles WHERE flag = flag";
    // $result_article_data_flag = $conn->query($sql_article_data_flag);




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
    <section class="article_main about_main">
        <header class="container_header articles_header">
            <img src="static/img/flat_table_icon.svg" alt="flat_table_icon">
            <h1>평상으로부터</h1>
        </header>
        <div class="main">
            <div class="article_container container">
                <div class="article_pics about_pics">
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
                        <div class="article_auth">
                            <p>
                                변방평상
                                <span>
                                    박상환, 온동훈, 이경렬    
                                </span>
                            </p>
                        </div>
                        <div class="article_share">
                            <span>
                                공유:
                            </span>
                            <!-- <a href="">Facebook</a>
                            <a href="">Tweeter</a> -->
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
            document.querySelector(".article_pics").style.textAlign = "center";
            for(let m = 0; m < articleImgs.length; m++) {
                if(m === 0) {
                    articleImgs[m].style.display = "block";
                    articleImgs[m].style.width = "96.5% !important";
                    // articleImgs[m].style.margin = "0 0 20px 5px !important";
                    articleImgs[m].style.margin = "12px";
                } else {
                    articleImgs[m].querySelector("img").style.width = "100%";
                    if(window.innerWidth > 1080) {
                        if(document.querySelectorAll(".mobile_img").length > 0) {
                            document.querySelectorAll(".mobile_img").forEach(function(mobileImg) {
                                mobileImg.remove();
                            });
                        }
                        articleImgs[m].classList.add(getImgOrientation(articleImgs[m].querySelector("img")));
                        if(articleImgs[m].classList.contains("verti")) {
                            articleImgs[m].style.display = "inline-block";
                        } else {
                            articleImgs[m].style.display = "block";
                            articleImgs[m].style.margin = "12px";
                        }
                    } else {
                        replaceImg(articleImgs[m]);
                    }
                }
            }

            function replaceImg(figure) {
                let img = figure.querySelector("img");
                let imgUrl = img.src;
                let imgOrientation = getImgOrientation(img);
                let mobileImgWrap = document.createElement("figure");
                let mobileImg = document.createElement("img");
                figure.style.display = "none";
                mobileImg.src = imgUrl;
                if(window.innerWidth >= 720) {
                    mobileImg.style.width = "96.5%";
                    mobileImg.classList.add(imgOrientation);
                    mobileImgWrap.classList.add("mobile_img", imgOrientation);
                    if(imgOrientation == "hori") {
                        mobileImgWrap.style.margin = "12px";
                    } else {
                        mobileImgWrap.style.margin = "0";
                    }
                } else {
                    mobileImg.style.width = "100%";
                    mobileImgWrap.classList.add("mobile_img");
                    mobileImgWrap.style.margin = "0 0 20px 0";
                }
                mobileImgWrap.style.width = "100%";
                mobileImgWrap.appendChild(mobileImg);
                if(document.querySelectorAll(".mobile_img").length + 1 < articleImgs.length) {
                    document.querySelector(".article_pics_mobile").style.textAlign = "center";
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

        window.onload = function() {
            organizePics();
        }

        window.onresize = function() {
            organizePics();
        }
    </script>
</body>
</html>