<<<<<<< HEAD
<?php
    include_once '../bbps_db_conn.php';
    
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
    $q = $rows_article["id"];

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
            <img src="/static/img/flat_table_icon.svg" alt="flat_table_icon">
            <h1>평상으로부터</h1>
        </header>
        <div class="main">
            <div class="article_container container">
                <div class="article_pics about_pics">
                    <?php
                        if (count($imgList) > 0) {
                            foreach ($imgList as $imgSrc) {
                                echo '
                                <figure>
                                    <img src="/uploads/'.$imgSrc.'" alt="image">
                                </figure>
                                ';
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
                                관리:
                            </span>
                            <a href="modify_article.php?q=<?=$q?>">수정</a>
                            <a href="delete_article.php?q=<?=$q?>">삭제</a>
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
                    
                    if(articleImgs[m].childNodes[1].width > articleImgs[m].childNodes[1].height) {
                        articleImgs[m].style.maxWidth = "96.5%";
                        articleImgs[m].style.height = "auto";
                        articleImgs[m].childNodes[1].style.height = "auto";
                        articleImgs[m].childNodes[1].style.width = "100%";
                        articleImgs[m].style.margin = "10px 0.75%";
                    } else {
                        articleImgs[m].style.maxWidth = "47.5%";
                        articleImgs[m].style.height = "auto";
                        articleImgs[m].childNodes[1].style.height = "auto";
                        articleImgs[m].childNodes[1].style.width = "100%";
                        articleImgs[m].style.margin = "10px 0.5%";
                        articleImgs[m].style.display = "inline-flex";
                    }
                } else if(window.innerWidth <= 1080 && window.innerWidth >= 720) {
                    if(m > 0 && document.querySelectorAll(".article_pics_mobile figure").length < document.querySelectorAll(".article_pics figure").length - 1) {
                        replaceImg(articleImgs[m]);
                        if(articleImgs[m].childNodes[1].width >= articleImgs[m].childNodes[1].height) {
                            document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "96.5%";
                            document.querySelectorAll(".mobile_img")[m-1].style.width = "96.5%";
                            document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
                            document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100%";
                            document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
                            document.querySelectorAll(".mobile_img")[m-1].style.margin = "10px 0.25%";
                        } else {
                            document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "47.5%";
                            document.querySelectorAll(".mobile_img")[m-1].style.width = "47.5%";
                            document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
                            document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100%";
                            document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
                            document.querySelectorAll(".mobile_img")[m-1].style.margin = "10px 0.5%";
                            document.querySelectorAll(".mobile_img")[m-1].style.display = "inline-flex";
                        }
                    }
                    
                } else if(window.innerWidth < 720) {
                    if(m > 0 && document.querySelectorAll(".article_pics_mobile figure").length < document.querySelectorAll(".article_pics figure").length - 1) {
                        replaceImg(articleImgs[m]);
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
=======
<?php
    include_once '../bbps_db_conn.php';
    
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
    $q = $rows_article["id"];

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
            <img src="/static/img/flat_table_icon.svg" alt="flat_table_icon">
            <h1>평상으로부터</h1>
        </header>
        <div class="main">
            <div class="article_container container">
                <div class="article_pics about_pics">
                    <?php
                        if (count($imgList) > 0) {
                            foreach ($imgList as $imgSrc) {
                                echo '
                                <figure>
                                    <img src="/uploads/'.$imgSrc.'" alt="image">
                                </figure>
                                ';
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
                                관리:
                            </span>
                            <a href="modify_article.php?q=<?=$q?>">수정</a>
                            <a href="delete_article.php?q=<?=$q?>">삭제</a>
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
                    
                    if(articleImgs[m].childNodes[1].width > articleImgs[m].childNodes[1].height) {
                        articleImgs[m].style.maxWidth = "96.5%";
                        articleImgs[m].style.height = "auto";
                        articleImgs[m].childNodes[1].style.height = "auto";
                        articleImgs[m].childNodes[1].style.width = "100%";
                        articleImgs[m].style.margin = "10px 0.75%";
                    } else {
                        articleImgs[m].style.maxWidth = "47.5%";
                        articleImgs[m].style.height = "auto";
                        articleImgs[m].childNodes[1].style.height = "auto";
                        articleImgs[m].childNodes[1].style.width = "100%";
                        articleImgs[m].style.margin = "10px 0.5%";
                        articleImgs[m].style.display = "inline-flex";
                    }
                } else if(window.innerWidth <= 1080 && window.innerWidth >= 720) {
                    if(m > 0 && document.querySelectorAll(".article_pics_mobile figure").length < document.querySelectorAll(".article_pics figure").length - 1) {
                        replaceImg(articleImgs[m]);
                        if(articleImgs[m].childNodes[1].width >= articleImgs[m].childNodes[1].height) {
                            document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "96.5%";
                            document.querySelectorAll(".mobile_img")[m-1].style.width = "96.5%";
                            document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
                            document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100%";
                            document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
                            document.querySelectorAll(".mobile_img")[m-1].style.margin = "10px 0.25%";
                        } else {
                            document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "47.5%";
                            document.querySelectorAll(".mobile_img")[m-1].style.width = "47.5%";
                            document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
                            document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100%";
                            document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
                            document.querySelectorAll(".mobile_img")[m-1].style.margin = "10px 0.5%";
                            document.querySelectorAll(".mobile_img")[m-1].style.display = "inline-flex";
                        }
                    }
                    
                } else if(window.innerWidth < 720) {
                    if(m > 0 && document.querySelectorAll(".article_pics_mobile figure").length < document.querySelectorAll(".article_pics figure").length - 1) {
                        replaceImg(articleImgs[m]);
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
>>>>>>> 6d27977a6626c0a78d809950b3da69ae39cf26fe
</html>