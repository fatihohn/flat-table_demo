<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'admin_head.php'?>
    <!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script type="text/javascript" src="../trix-master/dist/attachments.js"></script>
</head>
<body>
    <?php include 'admin_header.php'?>
    <?php include 'admin_nav.php'?>

    <div id="overlay" class="overlay"></div>
    <!-- @yield ('content') -->
    <form action="/new_article" method="post" enctype="multipart/form-data">
    <section class="article_main">
        <div class="main">
            <div class="article_container container">
                    <header class="article_header">
                        <input type="text" name="title" placeholder="제목" required/>
                        <div class="article_info">
                            <p class="article_address">
                                <!-- {{-- 경기도 동두천시 상봉암동 153-15 --}} -->
                                <input type="text" name="address" placeholder="주소" required />
                            </p>
                            <p class="category">
                                <!-- <a href="#">
                                    주민모임형
                                </a> -->
                                <input type="text" id="hashtags" placeholder="태그" autocomplete="off">
                                <div class="tag-container"></div>
                                <input id="category_container" type="hidden" name="category" value="" />
                            </p>
                        </div>
                    </header>
                
                <!-- <div class="article_pics"> -->
                <div id="file-list-display" class="article_pics">
                    <div class="locked" draggable="false">
                        이미지 등록
                        <input id="file-input" type="file" accept="image/jpg, image/jpeg, image/png" multiple="">
                    </div>
                    
                    
                    <input id="file-container" type="hidden" name="images" value="">
                </div>
                <div class="article_text">
                    <div class="article_comment">
                        <!-- <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo temporibus consequuntur quibusdam quos! Maxime quam dicta quas, fugit velit eaque rem consequuntur, labore distinctio amet odio asperiores veritatis odit nesciunt?
                        </p> -->
                            <textarea name="comment" id="article_comment_input" cols="40" rows="5" style="width:100%;">요약</textarea>
                        
                    </div>
                    <div class="article_text_spacer"></div>
                    <div class="article_cont">
                        <!-- <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque?
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque?
                        </p> -->
                        <div class="admin_editor trix-content">
                            <input id="x" type="hidden" name="content">
                            <trix-editor input="x"></trix-editor>
                        </div>
                    </div>
                    <footer class="article_footer">
                        <div class="article_auth">
                            <p class="photo">
                                사진
                                <span>
                                    <!-- 박상환 -->
                                    <input type="text" name="photography">
                                </span>
                            </p>
                            <p class="words">
                                글
                                <span>
                                    <!-- 이경렬 -->
                                    <input type="text" name="words">
                                </span>
                            </p>
                        </div>
                        <!-- <div class="article_share">
                            <span>
                                공유:
                            </span>
                            <a href="">Facebook</a>
                            <a href="">Tweeter</a>
                        </div> -->
                        <input type="submit">
                    </footer>
                </div>
                <div class="article_pics_mobile"></div>
            </div>
        </div>
    </section>
</form>

    <?php include 'admin_footer.php'?>

    <script src="../static/js/main.js"></script>
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
                        // articleImgs[m].style.display = "inline-flex";
                        articleImgs[m].style.display = "inline-block";
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
                            // document.querySelectorAll(".mobile_img")[m-1].style.display = "inline-flex";
                            document.querySelectorAll(".mobile_img")[m-1].style.display = "inline-block";
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
    <!-- <script>
        //file transfer, render list
        var fileList = [];//전송 준비용
        var newFileList = [];//디스플레이->저장용
        var sentFileList = [];//전송 확인용
        var resetInputValue;
        (function () {
            var fileInput = document.getElementById('file-input');
            var fileListDisplay = document.getElementById('file-list-display');
            var renderFileList, sendFile, sendFileList;
            

            fileInput.addEventListener('change', function (evnt) {
                fileList = [];
                for (var i = 0; i < fileInput.files.length; i++) {
                    fileList.push(fileInput.files[i]);
                }
                sendFileList();

            });

            renderFileList = function () {
                var articleImgs = document.querySelectorAll(".article_img_figure");
                for(const aImg of articleImgs) {
                    aImg.remove();
                }
                    // console.log(newFileList);
                    newFileList.forEach(function (newFileName, index) {
                        var fileDisplayEl = document.createElement('figure');
                    fileDisplayEl.innerHTML = `
                    <img src="../uploads/` + newFileName + '">';
                    fileDisplayEl.setAttribute("class", 'article_img_figure');
                    fileListDisplay.appendChild(fileDisplayEl);
                    });
            };
            
            sendFileList = function() {
                for (const file of fileList) {
                    sendFile(file);
                    sentFileList.push(file.name);
                };
            };

            sendFile = function (file) {
                var formData = new FormData();
                var request = new XMLHttpRequest();
                formData.append('file', file);
                request.open("POST", './upload_image.php');
                request.send(formData);
                request.onreadystatechange = function() { // 요청에 대한 콜백
                    if (request.readyState === request.DONE) { // 요청이 완료되면
                        if (request.status === 200 || request.status === 201) {
                            newFileList.push(request.responseText); // 바뀐 이름 stack
                            // console.log(newFileList.length + ':' + sentFileList.length);
                            if(newFileList.length === sentFileList.length) {
                                renderFileList();
                                resetInputValue("file-container", newFileList);
                                var renderedImgs = document.querySelectorAll(".article_img_figure");
                                if(renderedImgs[newFileList.length - 1].childNodes[1].src) {
                                    organizePics();
                                }
                            }
                        } else {
                            console.error(request.responseText);
                        }
                    }
                };
            };
        })();
        
        //drag&drop sorting
        var imgDisplay = document.getElementById("file-list-display");
        var sortable = new Sortable(imgDisplay, {
            draggable: ".article_img_figure",
            onEnd:function (evt) {
                var sortedImgs = document.querySelectorAll(".article_img_figure");
                newFileList = [];
                for(let aImg of sortedImgs) {
                    let aImgSrc = aImg.childNodes[1].src;
                    let aImgDir = aImgSrc.split("/")[4];
                    
                    newFileList.push(aImgDir);
                    organizePics();
                    resetInputValue("file-container", newFileList);
                }
            }
        });

        //fill form input
        resetInputValue = function(id, val) {
            document.getElementById(id).value = val;
        }
    </script> -->
    <script>
        //file transfer, render list
        var fileList = [];//전송 준비용
        var newFileList = [];//디스플레이->저장용
        var sentFileList = [];//전송 확인용
        var resetInputValue;
        var deleteImg;
        var delBtn;
        var setThumbImg;
        var imgList;

        (function () {
            var fileInput = document.getElementById('file-input');
            var fileListDisplay = document.getElementById('file-list-display');
            var renderFileList, sendFile, sendFileList;
            

            fileInput.addEventListener('change', function (evnt) {
                fileList = [];
                for (var i = 0; i < fileInput.files.length; i++) {
                    fileList.push(fileInput.files[i]);
                }
                sendFileList();

            });

            renderFileList = function () {
                var prodImgs = document.querySelectorAll(".article_img_figure");
                for(const pImg of prodImgs) {
                    pImg.remove();
                }
                    // console.log(newFileList);
                    newFileList.forEach(function (newFileName, index) {
                        if(newFileName !== "") {
                        var fileDisplayEl = document.createElement('figure');
                        fileDisplayEl.innerHTML = `
                        <img src="../uploads/` + newFileName + `"><button type="button" class="article_img_figure_del"></button>`;
                        fileDisplayEl.setAttribute("class", 'article_img_figure ' + newFileName.split(".")[0]);
                        fileListDisplay.appendChild(fileDisplayEl);
                        }
                    });

                //image delete
                delBtn = document.querySelectorAll(".article_img_figure_del");
                for(let i = 0; i < delBtn.length; i++) {
                    delBtn[i].addEventListener("click", function() {
                        var newFileListIdArr = delBtn[i].parentElement.querySelector("img").src.split("/");
                        var newFileListId = newFileListIdArr[newFileListIdArr.length - 1];
                        delete newFileList[newFileList.indexOf(newFileListId)];
                        delBtn[i].parentElement.remove();
                        resetInputValue("file-container", newFileList);
                    });
                }

            };
            
            sendFileList = function() {
                for (const file of fileList) {
                    sendFile(file);
                    sentFileList.push(file.name);
                };
            };

            sendFile = function (file) {
                var formData = new FormData();
                var request = new XMLHttpRequest();
                formData.append('file', file);
                request.open("POST", './upload_image.php');
                request.send(formData);
                request.onreadystatechange = function() { // 요청에 대한 콜백
                    if (request.readyState === request.DONE) { // 요청이 완료되면
                        if (request.status === 200 || request.status === 201) {
                            newFileList.push(request.responseText); // 바뀐 이름 stack
                            // console.log(newFileList.length + ':' + sentFileList.length);
                            // if(newFileList.length === sentFileList.length) {
                                renderFileList();
                                resetInputValue("file-container", newFileList);
                            // }
                        } else {
                            console.error(request.responseText);
                        }
                    }
                };
            };
        })();
        
        //drag&drop sorting
        var imgDisplay = document.getElementById("file-list-display");
        var sortable = new Sortable(imgDisplay, {
            draggable: ".article_img_figure",
            onEnd:function (evt) {
                var sortedImgs = document.querySelectorAll(".article_img_figure");
                newFileList = [];
                for(let pImg of sortedImgs) {
                    // let pImgSrc = pImg.firstChild.src;
                    let pImgSrc = pImg.querySelector("img").src;
                    let pImgSrcArr = pImgSrc.split("/");
                    let pImgDir = pImgSrcArr[pImgSrcArr.length - 1];
                    newFileList.push(pImgDir);
                    resetInputValue("file-container", newFileList);
                }
            }
        });

        //fill form input
        resetInputValue = function(id, val) {
            document.getElementById(id).value = val;
            setThumbImg("article_img_figure");
        }
        //set thumbImg
        setThumbImg = function(cls) {
            imgList = document.querySelectorAll("." + cls);
            var thumbTag = document.createElement('div');
                thumbTag.innerHTML = '대표이미지';
                thumbTag.setAttribute("class", 'thumb_img');
            for(let iii = 1; iii < imgList.length; iii++) {
                if(imgList[iii].querySelector(".thumb_img")) {
                    imgList[iii].querySelector(".thumb_img").remove();
                }
            }
            if(imgList[0]) {
                if(imgList[0].querySelector(".thumb_img")) {
                    imgList[0].querySelector(".thumb_img").remove();
                }
                imgList[0].appendChild(thumbTag);
            }
        }
        


    </script>
</body>
</html>