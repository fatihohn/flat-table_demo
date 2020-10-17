//INDEX
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
//end INDEX

//FRONT
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
//end FRONT



