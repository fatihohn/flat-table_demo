<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>평상도록</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/layout.css?after" type="text/css" media="all" />
        @yield ('head')
    </head>
    <body>
        <div class="header">
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
        </div>
    <!-- <div class="flex-center position-ref full-height">
    </div> -->
        <nav id="nav" class="nav fixed">
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
        </nav>
        <div id="overlay" class="overlay"></div>
        @yield ('content')

        <footer class="footer">
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
        </footer>
                    
        <script>
            function manageNav() {
                let menuBtn = document.querySelector(".menu");
                let navigation = document.getElementById("nav");
                let overlay = document.getElementById("overlay");
                function showNav() {
                    navigation.classList.add("active");
                    overlay.classList.add("active");
                    menuBtn.classList.add("active");
                }
                function hideNav() {
                    navigation.classList.remove("active");
                    overlay.classList.remove("active");
                    menuBtn.classList.remove("active");
                }
                menuBtn.addEventListener("click", function() {
                    if(navigation.classList.contains("active")) {
                        hideNav();
                    } else {
                        showNav();
                    }
                });
            }
            manageNav();
            function showReadArticle() {
                let articles = document.querySelectorAll(".article");
                for(let j=0; j < articles.length; j++) {
                    articles[j].onmouseover = function() {
                        articles[j].childNodes[3].style.background = "rgb(240, 230, 210)";
                        articles[j].childNodes[1].childNodes[1].style.opacity = "1";
                        articles[j].childNodes[1].childNodes[1].style.visibility = "visible";
                        articles[j].childNodes[1].childNodes[1].style.display = "initial";
                    }
                    articles[j].onmouseout = function() {
                        articles[j].childNodes[3].style.background = "#fff";
                        articles[j].childNodes[1].childNodes[1].style.opacity = "0";
                        articles[j].childNodes[1].childNodes[1].style.visibility = "hidden";
                        articles[j].childNodes[1].childNodes[1].style.display = "none";
                    }
                }
            }
            showReadArticle();
        </script>


    </body>
</html>