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
        if (navigation.classList.contains("active")) {
            hideNav();
        } else {
            showNav();
        }
    });
}
manageNav();

function showReadArticle() {
    let articles = document.querySelectorAll(".article");
    for (let j = 0; j < articles.length; j++) {
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
function goToList() {
    let goToListBtn = document.querySelector(".go_to_list");
    let pageHeight = window.innerHeight;

    let menuBtn = document.querySelector(".menu");
    let navigation = document.getElementById("nav");
    let overlay = document.getElementById("overlay");


    if (isIndex === "yes") {
        if(hashTag == "") {
            if (scrollTag !== "") {
                if (window.pageYOffset == 0) {
                    window.scrollBy(0, pageHeight);
                }
                // window.scrollBy(0, pageHeight);
            }
            goToListBtn.addEventListener("click", function() {
                if (navigation.classList.contains("active")) {
                    navigation.classList.remove("active");
                    overlay.classList.remove("active");
                    menuBtn.classList.remove("active");
                }
                if (window.pageYOffset == 0) {
                    window.scrollBy(0, pageHeight);
                }
            });
        } else {
            if (scrollTag !== "") {
                if (window.pageYOffset == 0) {
                    window.scrollBy(0, pageHeight);
                }
                // window.scrollBy(0, pageHeight);
            }
            goToListBtn.addEventListener("click", function() {
                // window.scrollBy(0, pageHeight);
                // var indexURL = "index.php?q=ok&tag=null";
                var indexURL = "index.php?q=ok";
                location.href = indexURL;
                console.log(indexURL);
            });
        }
    } else {
        goToListBtn.addEventListener("click", function() {
            // window.scrollBy(0, pageHeight);
            // var indexURL = "index.php?q=ok&tag=null";
            var indexURL = "index.php?q=ok";
            location.href = indexURL;
            console.log(indexURL);
        });
    }
}
goToList();



function scrollDown() {
    let downBtn = document.querySelector(".down_btn");
    let pageHeight = window.innerHeight;
    if (downBtn) {
        downBtn.addEventListener("click", function() {
            window.scrollBy(0, pageHeight);
        });
    }
}
// function scrollDown() {
//     // let currentLocation = window.location.href.split("/");
//     // let downBtn = document.querySelector(".down_btn");
//     let downBtn = document.querySelectorAll(".down_btn");
//     let pageHeight = window.innerHeight;
//     let menuBtn = document.querySelector(".menu");
//     let navigation = document.getElementById("nav");
//     let overlay = document.getElementById("overlay");


//     if (downBtn) {
//     //     downBtn.addEventListener("click", function() {
//     //         window.scrollBy(0, pageHeight);
//     //     });

//         if (scrollTag !== "scroll_down") {
//             downBtn.forEach((btn) => {
//                 btn.addEventListener("click", function() {

//                 // if (currentLocation[currentLocation.length - 1] == "") {
//                     window.scrollBy(0, pageHeight);
//                     if (navigation.classList.contains("active")) {
//                         navigation.classList.remove("active");
//                         overlay.classList.remove("active");
//                         menuBtn.classList.remove("active");
//                     }
//                 });
//             });
//         } else {
//             window.scrollBy(0, pageHeight);
//             scrollTag = FALSE;
//         }
//     }
// }
scrollDown();

function opacityByScroll() {
    let scrollPosition = window.pageYOffset;
    let pageHeight = window.innerHeight;
    let slideImg = document.querySelector(".intro_slide_img");
    if (slideImg) {
        slideImg.style.opacity = 1 - scrollPosition / pageHeight;
    }
}
// window.onscroll = function() {
//     opacityByScroll();
//     // console.log("scroll");
// };

function setIntroImg() {
    let introSlide = document.querySelector(".intro_slide_img");
    let slideImgSrc = document.querySelectorAll(".slide_img_src");
    let prevBtn = document.querySelector(".prev_btn");
    let nextBtn = document.querySelector(".next_btn");
    let introTitleHeader = document.querySelector(".intro_slide_title");
    let introTitle = document.querySelector(".slide_title a");
    let introEnter = document.querySelector(".slide_enter.button");
    if (prevBtn && nextBtn) {
        prevBtn.classList.add(slideImgSrc.length - 1);
        nextBtn.classList.add("1");
        for (let i = 0; i < slideImgSrc.length; i++) {
            slideImgSrc[i].classList.add(i);
        }
        introSlide.style.backgroundImage = "url('" + slideImgSrc[0].src + "')";
        // setTimeout(() => {
        //     showIntroTitle(slideImgSrc[0]);

        // }, 800);

        // setTimeout(function() {
        //     if (slideImgSrc[0]) {
        //         showIntroTitle(slideImgSrc[0]);
        //     }
        // }, 600);
        slideImgSrc[0].onload = function() {
            showIntroTitleFast(slideImgSrc[0]);
        }
        prevBtn.onclick = function() {
            if (prevBtn.classList.item(2)) {
                // showPrevImg(prevBtn.classList.item(2));
                // setTimeout(function() {
                    showPrevImg(prevBtn.classList.item(2), showIntroTitle);
                // }, 600);
            }
        }
        nextBtn.onclick = function() {
            if (nextBtn.classList.item(2)) {
                // showNextImg(nextBtn.classList.item(2));
                // setTimeout(function() {
                    showNextImg(nextBtn.classList.item(2), showIntroTitle);
                // }, 600);
            }
        }
        setInterval(function() {
            setTimeout(function() {
                if (nextBtn.classList.item(2)) {
                    // showNextImg(nextBtn.classList.item(2));
                    showNextImg(nextBtn.classList.item(2), showIntroTitle);
                }
            // }, 600);
            }, 600);
        }, 10000);

        function showNextImg(srcNumber, callback) {
            let nextImg = document.querySelector(".slide_img_src." + CSS.escape(srcNumber));
            if (nextImg) {
                hideIntroTitle();

                introSlide.style.backgroundImage = "url('" + nextImg.src + "')";
                prevBtn.classList.remove(prevBtn.classList.item(2));
                nextBtn.classList.remove(nextBtn.classList.item(2));
                if (srcNumber > 0 && srcNumber < slideImgSrc.length - 1) {
                    prevBtn.classList.add(parseInt(srcNumber) - 1);
                    nextBtn.classList.add(parseInt(srcNumber) + 1);
                } else if (srcNumber == "0") {
                    prevBtn.classList.add(slideImgSrc.length - 1);
                    nextBtn.classList.add(parseInt(srcNumber) + 1);
                } else if (srcNumber == slideImgSrc.length - 1) {
                    prevBtn.classList.add(parseInt(srcNumber) - 1);
                    nextBtn.classList.add("0");
                }
                // setTimeout(() => {
                //     showIntroTitle(nextImg);
                // }, 800);

                // setTimeout(function() {
                //     showIntroTitle(nextImg);
                // }, 600);
                setTimeout(function() {
                    callback(nextImg);
                }, 600);
            }
        }

        function showPrevImg(srcNumber, callback) {
            let prevImg = document.querySelector(".slide_img_src." + CSS.escape(srcNumber));
            if (prevImg) {
                hideIntroTitle();

                introSlide.style.backgroundImage = "url('" + prevImg.src + "')";
                prevBtn.classList.remove(prevBtn.classList.item(2));
                nextBtn.classList.remove(nextBtn.classList.item(2));
                if (srcNumber > 0 && srcNumber < slideImgSrc.length - 1) {
                    prevBtn.classList.add(parseInt(srcNumber) - 1);
                    nextBtn.classList.add(parseInt(srcNumber) + 1);
                } else if (srcNumber == "0") {
                    prevBtn.classList.add(slideImgSrc.length - 1);
                    nextBtn.classList.add(parseInt(srcNumber) + 1);
                } else if (srcNumber == slideImgSrc.length - 1) {
                    prevBtn.classList.add(parseInt(srcNumber) - 1);
                    nextBtn.classList.add("0");
                }
                // setTimeout(() => {
                //     showIntroTitle(prevImg);
                // }, 800);


                // setTimeout(function() {
                //     showIntroTitle(prevImg);
                // }, 600);
                setTimeout(function() {
                    callback(prevImg);
                }, 600);
            }
        }

        function showIntroTitle(imgSrc) {
            // setTimeout(function() {
            //     introTitleHeader.classList.add("active");
            // }, 100);
            // setTimeout(function() {
            // }, 600);
            if (imgSrc.alt !== "") {
                // introTitle.classList.add(imgSrc.alt);
                // introEnter.classList.add(imgSrc.alt);
                // // setTimeout(function() {
                // //     introTitle.innerHTML = imgSrc.title;
                // //     introTitleHeader.classList.add("active");
                // // }, 600);
                
                
                // addIntroTitleActive(addIntroTitleClass);
                setTimeout(function() {
                    addIntroTitleClass(addIntroTitleActive);
                    // addIntroTitleActive(addIntroTitleClass);
                }, 600);
            }
        
            
            
            function addIntroTitleClass(callback) {
                    introTitle.classList.add(imgSrc.alt);
                    introEnter.classList.add(imgSrc.alt);
                callback();
            }
            function addIntroTitleActive() {
                    introTitleHeader.classList.add("active");
                    introTitle.innerHTML = imgSrc.title;
            }
        }
        function showIntroTitleFast(imgSrc) {
            if (imgSrc.alt !== "") {
                    addIntroTitleClass(addIntroTitleActive);
            }
            function addIntroTitleClass(callback) {
                    introTitle.classList.add(imgSrc.alt);
                    introEnter.classList.add(imgSrc.alt);
                callback();
            }
            function addIntroTitleActive() {
                    introTitleHeader.classList.add("active");
                    introTitle.innerHTML = imgSrc.title;
            }
        }

        function hideIntroTitle() {
            // setTimeout(function() {
            //     // introTitleHeader.classList.add("active");
            //     introTitleHeader.classList.remove("active");
            // }, 100);
            introTitle.classList.remove(introTitle.classList.item(introTitle.classList.length - 1));
            introEnter.classList.remove(introEnter.classList.item(introEnter.classList.length - 1));
            introTitleHeader.classList.remove("active");
        }
    }
}
setIntroImg();

// (function() {
var showArticle;
showArticle = function(id) {
    location.href = "./article.php?q=" + id;
}
if (document.querySelector(".slide_enter.button")) {
    document.querySelector(".slide_enter.button").addEventListener("click", function() {
        if (this.classList.item(2)) {
            showArticle(this.classList.item(2));
        }
    });
}
if (document.querySelector(".slide_title a")) {
    document.querySelector(".slide_title a").addEventListener("click", function() {
        if (this.classList.item(0)) {
            showArticle(this.classList.item(0));
        }
    });
}

// })();

var showArticleWithTag;
showArticleWithTag = function(tag) {
    if(tag.trim() !== "") {
        location.href = "index.php?q=ok&tag=" + tag.trim();
    }
}

var tagSearchInput, tagSearchBtn;
tagSearchBtn = document.querySelector(".tag_search_btn");
tagSearchInput = document.querySelector(".tag_search");
if(tagSearchInput && tagSearchBtn) {
    tagSearchInput.addEventListener("keyup", function(e) {
        if ((e.code == "Enter" || e.keycode == 13) && tagSearchInput.value) {
            showArticleWithTag(tagSearchInput.value);
        }
    })
    tagSearchBtn.onclick = function() {
        if (tagSearchInput.value) {
            showArticleWithTag(tagSearchInput.value);
        }
    }
}



var showMoreArticles;
showMoreArticles = function(scrollTag, hashTag, row, callback) {
    // console.log(scrollTag + " : " + hashTag + " : " + row);

    var articleContainer = document.querySelector(".collection.group ul");
    var articleGetter = new XMLHttpRequest();
    if(scrollTag !== "" && hashTag !== "") {
        articleGetter.open("POST", "article_getter.php?q=" + scrollTag + "&tag=" + hashTag + "&row=" + row, true);
    } else if(scrollTag !== "" && hashTag == "") {
        articleGetter.open("POST", "article_getter.php?q=" + scrollTag + "&row=" + row, true);
    } else if(scrollTag == "" && hashTag == "") {
        articleGetter.open("POST", "article_getter.php?row=" + row, true);
    }
    articleGetter.send();
    articleGetter.onreadystatechange = function() {
        if (articleGetter.readyState == 4 && articleGetter.status == 200) {
            articleContainer.innerHTML =  articleGetter.responseText;
            showReadArticle();
        }

        callback();
    }

}




















//end FRONT





function shareBtnClick() {
    // let shareBtn = document.getElementById("share_btn");
    let shareBtn = document.querySelectorAll(".share_btn");

    function shareThings() {
        let urlBox = document.createElement('input');
        let currentUrl = window.location.href;

        document.body.appendChild(urlBox);
        urlBox.value = currentUrl;
        urlBox.select();
        document.execCommand('copy');
        document.body.removeChild(urlBox);
        alert("링크가 복사되었습니다.")
    }
    let sb;
    for (sb = 0; sb < shareBtn.length; sb++) {
        if (shareBtn) {
            shareBtn[sb].addEventListener("click", shareThings);
        }
    }
}
shareBtnClick();


function showExMap(address) {
    var naverMapURL;
    if(window.innerWidth > 720) {
        naverMapURL = "https://map.naver.com/v5/search/" + address;
    } else {
        naverMapURL = "https://m.map.naver.com/search2/search.nhn?query=" + address + "&sm=hty&style=v5";
    }

    var kakaoMapURL = "https://map.kakao.com/link/to/" + address;

    // var googleMapURL = "https://www.google.com/maps/place/" + placeLat + "," + placeLng;

    window.open(naverMapURL, "exNaverMap", "width=1200, height=800");
    // window.open(kakaoMapURL, "exKakaoMap", "width=1200, height=800");
    // window.open(googleMapURL, "exGoogleMap", "width=600, height=800");

    console.log(address + " : " + naverMapURL);
}

// //ARTICLE
// function organizePics() {
//     let articleImgs = document.querySelectorAll(".article_pics figure");
//     let mobileImgs = document.querySelector(".article_pics_mobile");
//         for(let m=0; m < articleImgs.length; m++) {
//             articleImgs[m].style.display = "block";
//             articleImgs[m].childNodes[1].style.width = "100%";
//             if(window.innerWidth > 1080) {
//                 if(mobileImgs.childNodes.length > 0) {
//                     for(let n=0; n < mobileImgs.childNodes.length; n++) {
//                         mobileImgs.childNodes[n].remove();
//                     }
//                 }

//                 if(articleImgs[m].childNodes[1].width > articleImgs[m].childNodes[1].height) {
//                     articleImgs[m].style.maxWidth = "96.5%";
//                     articleImgs[m].style.height = "auto";
//                     articleImgs[m].childNodes[1].style.height = "auto";
//                     articleImgs[m].childNodes[1].style.width = "100%";
//                     articleImgs[m].style.margin = "10px 0.75%";
//                 } else {
//                     articleImgs[m].style.maxWidth = "47.5%";
//                     articleImgs[m].style.height = "auto";
//                     articleImgs[m].childNodes[1].style.height = "auto";
//                     articleImgs[m].childNodes[1].style.width = "100%";
//                     articleImgs[m].style.margin = "10px 0.5%";
//                     articleImgs[m].style.display = "inline-flex";
//                 }
//             } else if(window.innerWidth <= 1080 && window.innerWidth >= 720) {
//                 if(m > 0 && document.querySelectorAll(".article_pics_mobile figure").length < document.querySelectorAll(".article_pics figure").length - 1) {
//                     replaceImg(articleImgs[m]);
//                     if(articleImgs[m].childNodes[1].width >= articleImgs[m].childNodes[1].height) {
//                         document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "96.5%";
//                         document.querySelectorAll(".mobile_img")[m-1].style.width = "96.5%";
//                         document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
//                         document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100%";
//                         document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
//                         document.querySelectorAll(".mobile_img")[m-1].style.margin = "10px 0.25%";
//                     } else {
//                         document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "47.5%";
//                         document.querySelectorAll(".mobile_img")[m-1].style.width = "47.5%";
//                         document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
//                         document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100%";
//                         document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
//                         document.querySelectorAll(".mobile_img")[m-1].style.margin = "10px 0.5%";
//                         document.querySelectorAll(".mobile_img")[m-1].style.display = "inline-flex";
//                     }
//                 }

//             } else if(window.innerWidth < 720) {
//                 if(m > 0 && document.querySelectorAll(".article_pics_mobile figure").length < document.querySelectorAll(".article_pics figure").length - 1) {
//                     replaceImg(articleImgs[m]);
//                     document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "100% !important";
//                     document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
//                     document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100% !important";
//                     document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
//                     document.querySelectorAll(".mobile_img")[m-1].style.margin = "0 0 20px 0 !important";
//                     document.querySelectorAll(".mobile_img")[m-1].style.display = "block";

//                 }
//             }

//         }
//         function replaceImg(imgSrc) {
//             let imgUrl = imgSrc.childNodes[1].src;
//             let mobileImgWrap = document.createElement("figure");
//             mobileImgWrap.className = "mobile_img";
//             mobileImgWrap.style.width = "100%";
//             mobileImgWrap.style.margin = "0 0 20px 0";
//             document.querySelector(".article_pics_mobile").appendChild(mobileImgWrap);
//             let mobileImg = document.createElement("img");
//             mobileImg.src = imgUrl;
//             mobileImg.style.width = "100%";
//             mobileImgWrap.appendChild(mobileImg);
//         }
//     }
//     let picControl = setInterval(organizePics, 200);
//     organizePics();
//     setTimeout(function() {
//         organizePics();
//     }, 300);

//     window.addEventListener("resize", function() {
//         setTimeout(function() {
//             if(window.innerWidth > 1080) {
//                 setTimeout(() => {
//                     clearInterval(picControl);
//                     organizePics();
//                 }, 200);
//             } else {
//                 organizePics();
//             }
//         }, 300);
//     });
// //end ARTICLE