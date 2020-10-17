<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>평상도록</title> -->

    <!-- Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> -->

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="/css/layout.css?after" type="text/css" media="all" /> -->
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- <div class="header">
        <div class="title header-margin">
            <div class="box actions">
                <a class="menu x">
                    <span class="line top"></span>
                    <span class="line middle"></span>
                    <span class="line bottom"></span>
                </a>
            </div>
            <div class="box links home-btn">
                <a href="/">
                    평상도록
                </a>
            </div>
        </div>
        @yield ('intro')
    </div> -->
    <!-- <nav id="nav" class="nav fixed">
        <ul class="nav_group">
            <li class="nav_item">
                <mark>.flat tables</mark>
                <a href="/list">
                    평상들
                </a>
            </li>
            <li class="nav_item">
                <mark>.about us</mark>
                <a href="/about">
                    평상으로부터
                </a>
            </li>
            @yield ('nav_item')
        </ul>
    </nav> -->
    <div id="overlay" class="overlay"></div>
    <!-- @yield ('content') -->
    <aside class="intro">
        <div class="intro_slide">
            <!--대표 평상 이미지 목록-->
                <div class="intro_slide_imgs" style="visibility:hidden; height:0;">
                    <img class="slide_img_src" title="성보주택 평상" src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="">
                    <img class="slide_img_src" title="못골 고개에는 평상이 없다" src="https://www.doongdoong.org/se2/upload/c_modify_20200706093011525244320FUN_4974_001.jpg" alt="">
                    <img class="slide_img_src" title="우물물은 시원하다" src="https://www.doongdoong.org/se2/upload/c_modify_20200706093043948349794IMG_0913.JPG" alt="">
                </div>
                <!--대표 평상 이미지 목록 끝-->
            <div class="intro_slide_img"><!--배경 이미지 넣기-->
                <div class="intro_slide_btn prev_btn">
                    <a>
                        <img src="/static/img/prev_btn.png" alt="prev_btn">
                    </a>
                </div>
                <div class="intro_slide_btn next_btn">
                    <a>
                        <img src="/static/img/next_btn.png" alt="next_btn">
                    </a>
                </div>
                <div class="intro_slide_btn down_btn">
                    <a>
                        <img src="/static/img/down_btn.png" alt="down_btn">
                    </a>
                </div>
                <header class="intro_slide_title">
                    <h1 class="slide_title">
                        <a href="/article">
                            못골에는 평상이 없더라
                        </a>
                    </h1>
                    <a href="/article" class="slide_enter button">
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
                    <img src="/static/img/flat_table_icon.svg" alt="flat_table_icon">
                    <h1>평상들</h1>
                </header>
                <nav class="container_nav group">
                    <div class="filter_container">
                        <div class="filter_list">
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
                        </div>
                    </div>
                </nav>
                <div class="collection group">
                    <ul>
                        <li>
                            <article class="article">
                                <figure>
                                    <a href="/article" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article">
                                            <span class="line">
                                                성보주택 평상
                                            </span>
                                        </a>
                                    </h1>
                                    <div class="article_comment">
                                        <p>
                                            자전거 거치대를 개조해 만든 평상.
                                        </p>

                                    </div>
                                </div>
                            </article>
                        </li>
                        <li>
                            <article class="article">
                                <figure>
                                    <a href="/article" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article">
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
                        </li>
                        <li>
                            <article class="article">
                                <figure>
                                    <a href="/article" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article">
                                            <span class="line">
                                                성보주택 평상
                                            </span>
                                        </a>
                                    </h1>
                                    <div class="article_comment">
                                        <p>
                                            자전거 거치대를 개조해 만든 평상.
                                        </p>

                                    </div>
                                </div>
                            </article>
                        </li>
                        <li>
                            <article class="article">
                                <figure>
                                    <a href="/article" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article">
                                            <span class="line">
                                                성보주택 평상
                                            </span>
                                        </a>
                                    </h1>
                                    <div class="article_comment">
                                        <p>
                                            자전거 거치대를 개조해 만든 평상.
                                        </p>

                                    </div>
                                </div>
                            </article>
                        </li>
                        <li>
                            <article class="article">
                                <figure>
                                    <a href="/article" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article">
                                            <span class="line">
                                                성보주택 평상
                                            </span>
                                        </a>
                                    </h1>
                                    <div class="article_comment">
                                        <p>
                                            자전거 거치대를 개조해 만든 평상.
                                        </p>

                                    </div>
                                </div>
                            </article>
                        </li>
                        <li>
                            <article class="article">
                                <figure>
                                    <a href="/article" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article">
                                            <span class="line">
                                                성보주택 평상
                                            </span>
                                        </a>
                                    </h1>
                                    <div class="article_comment">
                                        <p>
                                            자전거 거치대를 개조해 만든 평상.
                                        </p>

                                    </div>
                                </div>
                            </article>
                        </li>
                        <li>
                            <article class="article">
                                <figure>
                                    <a href="/article" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article">
                                            <span class="line">
                                                성보주택 평상
                                            </span>
                                        </a>
                                    </h1>
                                    <div class="article_comment">
                                        <p>
                                            자전거 거치대를 개조해 만든 평상.
                                        </p>

                                    </div>
                                </div>
                            </article>
                        </li>
                        <li>
                            <article class="article">
                                <figure>
                                    <a href="/article" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article">
                                            <span class="line">
                                                성보주택 평상
                                            </span>
                                        </a>
                                    </h1>
                                    <div class="article_comment">
                                        <p>
                                            자전거 거치대를 개조해 만든 평상.
                                        </p>

                                    </div>
                                </div>
                            </article>
                        </li>
                        <li>
                            <article class="article">
                                <figure>
                                    <a href="/article" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article">
                                            <span class="line">
                                                성보주택 평상
                                            </span>
                                        </a>
                                    </h1>
                                    <div class="article_comment">
                                        <p>
                                            자전거 거치대를 개조해 만든 평상.
                                        </p>

                                    </div>
                                </div>
                            </article>
                        </li>
                        <li>
                            <article class="article">
                                <figure>
                                    <a href="/article" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article">
                                            <span class="line">
                                                성보주택 평상
                                            </span>
                                        </a>
                                    </h1>
                                    <div class="article_comment">
                                        <p>
                                            자전거 거치대를 개조해 만든 평상.
                                        </p>

                                    </div>
                                </div>
                            </article>
                        </li>
                        <li>
                            <article class="article">
                                <figure>
                                    <a href="/article" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article">
                                            <span class="line">
                                                성보주택 평상
                                            </span>
                                        </a>
                                    </h1>
                                    <div class="article_comment">
                                        <p>
                                            자전거 거치대를 개조해 만든 평상.
                                        </p>

                                    </div>
                                </div>
                            </article>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <script>
        function scrollDown() {
            let downBtn = document.querySelector(".down_btn");
            let pageHeight = window.innerHeight;
            downBtn.addEventListener("click", function() {
                window.scrollBy(0, pageHeight);
            });
        }
        scrollDown();
        function opacityByScroll() {
            let scrollPosition = window.pageYOffset;
            let pageHeight = window.innerHeight;
            let slideImg = document.querySelector(".intro_slide_img");
            slideImg.style.opacity = 1 - scrollPosition/pageHeight;
        }
        window.onscroll = function() {
            opacityByScroll();
        };
        function setIntroImg() {
            let introSlide = document.querySelector(".intro_slide_img");
            let slideImgSrc = document.querySelectorAll(".slide_img_src");
            let prevBtn = document.querySelector(".prev_btn");
            let nextBtn = document.querySelector(".next_btn");
            let introTitleHeader = document.querySelector(".intro_slide_title");
            let introTitle = document.querySelector(".slide_title a");
            prevBtn.classList.add(slideImgSrc.length-1);
            nextBtn.classList.add("1");
            for(let i = 0; i < slideImgSrc.length; i++) {
                slideImgSrc[i].classList.add(i);
            }
            introSlide.style.backgroundImage = "url('"+slideImgSrc[0].src+"')";
            // setTimeout(() => {
            //     showIntroTitle(slideImgSrc[0]);
                
            // }, 800);
            setTimeout(function() {
                showIntroTitle(slideImgSrc[0]);
            }, 600);
            prevBtn.onclick = function() {
                showPrevImg(prevBtn.classList.item(2));
            }
            nextBtn.onclick = function() {
                showNextImg(nextBtn.classList.item(2));
            }
            setInterval(function() {
                setTimeout(function() {
                    showNextImg(nextBtn.classList.item(2));
                }, 600);
            }, 20000);
            function showNextImg(srcNumber) {
                let nextImg = document.querySelector(".slide_img_src."+CSS.escape(srcNumber));
                hideIntroTitle();
                
                introSlide.style.backgroundImage = "url('"+nextImg.src+"')";
                prevBtn.classList.remove(prevBtn.classList.item(2));
                nextBtn.classList.remove(nextBtn.classList.item(2));
                if(srcNumber > 0 && srcNumber < slideImgSrc.length -1) {
                    prevBtn.classList.add(parseInt(srcNumber)-1);
                    nextBtn.classList.add(parseInt(srcNumber)+1);
                } else if(srcNumber == "0") {
                    prevBtn.classList.add(slideImgSrc.length-1);
                    nextBtn.classList.add(parseInt(srcNumber)+1);
                } else if(srcNumber == slideImgSrc.length -1) {
                    prevBtn.classList.add(parseInt(srcNumber)-1);
                    nextBtn.classList.add("0");
                }
                // setTimeout(() => {
                //     showIntroTitle(nextImg);
                // }, 800);
                setTimeout(function() {
                    showIntroTitle(nextImg);
                }, 600);
            }
            function showPrevImg(srcNumber) {
                let prevImg = document.querySelector(".slide_img_src."+CSS.escape(srcNumber));
                hideIntroTitle();
                
                introSlide.style.backgroundImage = "url('"+prevImg.src+"')";
                prevBtn.classList.remove(prevBtn.classList.item(2));
                nextBtn.classList.remove(nextBtn.classList.item(2));
                if(srcNumber > 0 && srcNumber < slideImgSrc.length -1) {
                    prevBtn.classList.add(parseInt(srcNumber)-1);
                    nextBtn.classList.add(parseInt(srcNumber)+1);
                } else if(srcNumber == "0") {
                    prevBtn.classList.add(slideImgSrc.length-1);
                    nextBtn.classList.add(parseInt(srcNumber)+1);
                } else if(srcNumber == slideImgSrc.length -1) {
                    prevBtn.classList.add(parseInt(srcNumber)-1);
                    nextBtn.classList.add("0");
                }
                // setTimeout(() => {
                //     showIntroTitle(prevImg);
                // }, 800);
                setTimeout(function() {
                    showIntroTitle(prevImg);
                }, 600);
            }
            
            function showIntroTitle(imgSrc) {
                introTitleHeader.classList.add("active");
                introTitle.innerHTML = imgSrc.title;
            }
            function hideIntroTitle() {
                introTitleHeader.classList.remove("active");
            }
        }
        setIntroImg();
        
    </script>

    <!-- <footer class="footer">
        <div class="container">
            <div class="column">
                <p>
                    <a href="https://www.facebook.com/3355inmun/">삼삼오오청년인문실험</a>
                </p>
            </div>
            <div class="column">
                <p>
                    <a href="https://doongdoong.org">변방의북소리 둥둥</a>
                </p>
            </div>
            <div class="column">
                <p>
                    <a href="https://github.com/fatihohn">구석진개발자</a>
                </p>
            </div>
            <div class="column">
                <p class="copyright">
                    © 변방평상 2020
                </p>
            </div>
        </div>
    </footer> -->
                
    <!-- <script>
        // function manageNav() {
        //     let menuBtn = document.querySelector(".menu");
        //     let navigation = document.getElementById("nav");
        //     let overlay = document.getElementById("overlay");
        //     function showNav() {
        //         navigation.classList.add("active");
        //         overlay.classList.add("active");
        //         menuBtn.classList.add("active");
        //     }
        //     function hideNav() {
        //         navigation.classList.remove("active");
        //         overlay.classList.remove("active");
        //         menuBtn.classList.remove("active");
        //     }
        //     menuBtn.addEventListener("click", function() {
        //         if(navigation.classList.contains("active")) {
        //             hideNav();
        //         } else {
        //             showNav();
        //         }
        //     });
        // }
        // manageNav();
        // function showReadArticle() {
        //     let articles = document.querySelectorAll(".article");
        //     for(let j=0; j < articles.length; j++) {
        //         articles[j].onmouseover = function() {
        //             articles[j].childNodes[3].style.background = "rgb(240, 230, 210)";
        //             articles[j].childNodes[1].childNodes[1].style.opacity = "1";
        //             articles[j].childNodes[1].childNodes[1].style.visibility = "visible";
        //             articles[j].childNodes[1].childNodes[1].style.display = "initial";
        //         }
        //         articles[j].onmouseout = function() {
        //             articles[j].childNodes[3].style.background = "#fff";
        //             articles[j].childNodes[1].childNodes[1].style.opacity = "0";
        //             articles[j].childNodes[1].childNodes[1].style.visibility = "hidden";
        //             articles[j].childNodes[1].childNodes[1].style.display = "none";
        //         }
        //     }
        // }
        // showReadArticle();
    </script> -->
    <script src="static/js/main.js"></script>
</body>
</html>