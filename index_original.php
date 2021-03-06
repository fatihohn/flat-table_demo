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
                        <a href="/article.php">
                            못골에는 평상이 없더라
                        </a>
                    </h1>
                    <a href="/article.php" class="slide_enter button">
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
                        <!-- 태그 검색 기능으로 변경 -->
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
                        <!-- 태그 검색 기능으로 변경 -->
                    </div>
                </nav>
                <div class="collection group">
                    <ul>
                        <li>
                            <article class="article">
                                <figure>
                                    <a href="/article.php" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article.php">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article.php" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article.php">
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
                                    <a href="/article.php" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article.php">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article.php" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article.php">
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
                                    <a href="/article.php" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article.php">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article.php" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article.php">
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
                                    <a href="/article.php" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article.php">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article.php" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article.php">
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
                                    <a href="/article.php" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article.php">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article.php" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article.php">
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
                                    <a href="/article.php" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article.php">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article.php" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article.php">
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
                                    <a href="/article.php" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article.php">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article.php" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article.php">
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
                                    <a href="/article.php" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article.php">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article.php" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article.php">
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
                                    <a href="/article.php" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article.php">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article.php" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article.php">
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
                                    <a href="/article.php" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article.php">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article.php" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article.php">
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
                                    <a href="/article.php" class="overlay">
                                        <div class="center">
                                            <p>
                                                읽기
                                            </p>
                                        </div>
                                    </a>
                                    <a href="/article.php">
                                        <img src="https://www.doongdoong.org/uploads/thumbs/1593343384.jpeg" alt="" class="cover">
                                    </a>
                                </figure>
                                <div class="article_content">
                                    <aside class="meta">
                                        <p>
                                            <a href="/article.php" class="category">
                                                종류
                                            </a>
                                        </p>
                                    </aside>
                                    <h1 class="article_title">
                                        <a href="/article.php">
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

    <?php include 'footer.php'?>

    <script src="static/js/main.js"></script>
</body>
</html>