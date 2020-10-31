<?php
    include '../bbps_db_conn.php';   


    // $sessionUser = $_SESSION['username'];
    $sessionUser = "tmp_name";
    // $sql_user_data = "SELECT * FROM user_data WHERE username= '$sessionUser'";
    // $result_user_data = $conn->query($sql_user_data);
    // $rows_user_data = mysqli_fetch_assoc($result_user_data);
    
    // $username = $rows_get_user['username'];
    $username = $sessionUser;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'?>
    <!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <!-- <script type="text/javascript" src="../trix-master/dist/attachments.js"></script> -->
</head>
<body>
    <?php include 'header.php'?>
    <?php include 'nav.php'?>

    <div id="overlay" class="overlay"></div>
    <!-- @yield ('content') -->
    <form action="new_article_action.php" method="post" enctype="multipart/form-data">
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
                                <!-- <input type="text" id="hashtags" placeholder="태그" autocomplete="off"> -->
                                <!-- <div class="tag-container"></div>
                                <input id="category_container" type="hidden" name="categories" value="" /> -->

                                <div class="tag_container">
                                    <div class="tag_list_wrap"></div>
                                    <div class="tag_input_wrap">
                                        <div class="tag_input">
                                            <input id="tags" type="text" placeholder="연관태그를 입력해주세요. (최대 5개)" value="">
                                            <input id="tag_vault" type="hidden" name="tag_vault" value="">
                                        </div>
                                    </div>
                                    <!-- <div class="tag_finder_wrap">
                                        <ul class="tag_finder">
                                            <li class="tag_finder_item">
                                                <button type="button" class="tag_finder_btn">#SDK빔프로젝터</button>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>
                            </p>
                        </div>
                    </header>
                
                <!-- <div class="article_pics"> -->
                <div id="file-list-display" class="article_pics">
                    <div class="locked" draggable="false">
                        이미지 등록
                        <input id="file-input" type="file" accept="image/jpg, image/jpeg, image/png" multiple="">
                    </div>
                    
                    <img src="" id="image_to_compress" style="display: none;">
                        <canvas id="canvas" height="2400" width="2400" style="display: none;"></canvas>
                    <input id="file-container" type="hidden" name="imgs" value="">
                </div>
                <div class="article_text">
                    <div class="article_comment">
                        <!-- <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo temporibus consequuntur quibusdam quos! Maxime quam dicta quas, fugit velit eaque rem consequuntur, labore distinctio amet odio asperiores veritatis odit nesciunt?
                        </p> -->
                            <textarea name="comment" id="article_comment_input" cols="40" rows="5" style="width:100%;" placeholder="요약" required></textarea>
                        
                    </div>
                    <div class="article_text_spacer"></div>
                    <div class="article_cont trix-content">
                        <!-- <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque?
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius quae sequi aperiam, adipisci exercitationem! Facere, doloribus neque quasi rem exercitationem dignissimos temporibus illum modi dolore labore fugit totam cumque?
                        </p> -->
                        <div class="admin_editor">
                            <input id="x" type="hidden" name="content">
                            <trix-editor input="x" placeholder="내용" required></trix-editor>
                        </div>
                    </div>
                    <footer class="article_footer">
                        <div class="article_auth">
                            <p class="photo">
                                사진
                                <span>
                                    <input type="text" name="photographer">
                                </span>
                            </p>
                            <p class="words">
                                글
                                <span>
                                    <input type="text" name="words" required>
                                </span>
                            </p>
                        </div>
                        <div class="article_flag">
                            <p class="flag">
                                <span>
                                    <label for="flag">
                                        <input id="flag" type="checkbox" name="flag">
                                        대표평상
                                    </label>
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
                        <input type="hidden" name="about" value="no">
                        <input type="hidden" name="username" value="<?=$username?>">
                        <input class="article_submit" type="submit">
                    </footer>
                </div>
                <div class="article_pics_mobile"></div>
            </div>
        </div>
    </section>
</form>

    <?php include 'footer.php'?>

    <script src="../static/js/main.js"></script>
    <script>
        function organizePics() {
        let articleImgs = document.querySelectorAll(".article_pics figure");
        let mobileImgs = document.querySelector(".article_pics_mobile");
            for(let m=0; m < articleImgs.length; m++) {
                // articleImgs[m].style.display = "block";
                articleImgs[m].style.display = "inline-flex !important";
                // articleImgs[m].style.visibility = "visible";
                // articleImgs[m].style.height = "auto";
                articleImgs[m].style.position = "relative";
                // articleImgs[m].style.display = "flex";
                articleImgs[m].childNodes[1].style.width = "100%";
                // if(window.innerWidth > 1080) {
                    if(mobileImgs.childNodes.length > 0) {
                        for(let n=0; n < mobileImgs.childNodes.length; n++) {
                            mobileImgs.childNodes[n].remove();
                        }
                    }
                    
                    if(articleImgs[m].childNodes[1].width > articleImgs[m].childNodes[1].height) {
                        articleImgs[m].style.maxWidth = "96.5%";
                        articleImgs[m].style.height = "auto";
                        // articleImgs[m].style.height = "100%";//mobile test
                        articleImgs[m].childNodes[1].style.height = "auto";
                        articleImgs[m].childNodes[1].style.width = "100%";
                        articleImgs[m].style.margin = "10px 0.75%";
                    } else {
                        articleImgs[m].style.maxWidth = "47.5%";
                        articleImgs[m].style.height = "auto";
                        // articleImgs[m].style.height = "100%";//mobile test
                        articleImgs[m].childNodes[1].style.height = "auto";
                        articleImgs[m].childNodes[1].style.width = "100%";
                        articleImgs[m].style.margin = "10px 0.5%";
                        // articleImgs[m].style.display = "inline-flex";
                        // articleImgs[m].style.display = "inline-block";
                    }
                // } else if(window.innerWidth <= 1080 && window.innerWidth >= 720) {
                //     if(m > 0 && document.querySelectorAll(".article_pics_mobile figure").length < document.querySelectorAll(".article_pics figure").length - 1) {
                //         replaceImg(articleImgs[m]);
                //         if(articleImgs[m].childNodes[1].width >= articleImgs[m].childNodes[1].height) {
                //             document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "96.5%";
                //             document.querySelectorAll(".mobile_img")[m-1].style.width = "96.5%";
                //             document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
                //             document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100%";
                //             document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
                //             document.querySelectorAll(".mobile_img")[m-1].style.margin = "10px 0.25%";
                //         } else {
                //             document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "47.5%";
                //             document.querySelectorAll(".mobile_img")[m-1].style.width = "47.5%";
                //             document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
                //             document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100%";
                //             document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
                //             document.querySelectorAll(".mobile_img")[m-1].style.margin = "10px 0.5%";
                //             document.querySelectorAll(".mobile_img")[m-1].style.display = "inline-flex";
                //             // document.querySelectorAll(".mobile_img")[m-1].style.display = "inline-block";
                //         }
                //     }
                    
                // } else if(window.innerWidth < 720) {
                //     if(m > 0 && document.querySelectorAll(".article_pics_mobile figure").length < document.querySelectorAll(".article_pics figure").length - 1) {
                //         replaceImg(articleImgs[m]);
                //         document.querySelectorAll(".mobile_img")[m-1].style.maxWidth = "100% !important";
                //         document.querySelectorAll(".mobile_img")[m-1].style.height = "auto";
                //         document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.width = "100% !important";
                //         document.querySelectorAll(".mobile_img")[m-1].childNodes[0].style.height = "auto";
                //         document.querySelectorAll(".mobile_img")[m-1].style.margin = "0 0 20px 0 !important";
                //         document.querySelectorAll(".mobile_img")[m-1].style.display = "block";
                        
                //     }
                // }
                
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
   



   <script>
       //hashtag related
       (function () {
           var tagInput, tagVault;
           var showExistingTags, addTags, renderTagList, addTagDelBtn, limitInput, setTagVault, selectExistingTag;
           var tagListWrap, tagListUl, tagDelBtn, tagContainer, tagFinderBtn;
           var tagList = [];
               tagListWrap = document.querySelector(".tag_list_wrap");
               tagListUl = document.createElement("ul");
               tagInput = document.querySelector("#tags");
               tagVault = document.querySelector("#tag_vault");
               tagContainer = document.querySelector(".tag_container");
               tagFinderBtn = document.querySelectorAll(".tag_finder_btn");

            document.onkeypress = function(e) {
                if(e.keyCode == 13) {
                    e.preventDefault();
                }
            }

            tagInput.onkeypress = function(e) {                 
                if(e.code == "Enter" || e.code == "Space" || e.code == "Comma") {
                    // if(e.keycode == "13" || e.keycode == "32") {
                        e.preventDefault();
                        if(tagInput.value !== "" && !tagList.includes(tagInput.value)) {
                            addTags(tagInput.value);
                            tagListWrap.appendChild(tagListUl);
                            renderTagList(addTagDelBtn);
                            limitInput(); 
                        } else {
                            tagInput.value = "";
                            if(tagContainer.children[2]) {
                                tagContainer.children[2].remove();
                            }
                        }
                }
            }

            tagInput.onkeyup = function(e) {
                if(e.code !== "Enter" || e.code !== "Space" || e.code !== "Comma") {
                    if(tagInput.value !== "") {
                        showExistingTags(tagInput.value, selectExistingTag);
                    } else {
                        tagContainer.children[2].remove();
                    }
                } 
            }

            addTags = function (val) {
                tagList.push(val);
                tagInput.value = "";
            };

            showExistingTags = function (val, callback) {
                (function () {
                    var finderWrap = document.createElement("div");
                    var finder = new XMLHttpRequest();
    
                    finder.open("POST", "tag_finder.php?str=" + val, true);
                    finder.send();
                    finder.onreadystatechange = function() {
                        if (finder.readyState == 4 && finder.status == 200) {
                            finderWrap.classList.add("tag_finder_wrap");
                            finderWrap.innerHTML = finder.responseText;
    
                            if(val.length > 0) {
                                if(!tagContainer.children[2]) {
                                    tagContainer.appendChild(finderWrap);
                                } else {
                                    tagContainer.children[2].remove();
                                    tagContainer.appendChild(finderWrap);
                                    tagContainer.children[2].innerHTML = finder.responseText;
                                }
                            } else {
                                tagContainer.children[2].remove();
                            }
                        }
                    }
                    callback();
                })();
            };

            selectExistingTag = function () {
                tagFinderBtn.forEach((btn) => {
                    btn.onclick = function () {
                        console.log("clicked");
                    }
                });
            }
            // selectExistingTag();//////how to trigger this????








            renderTagList = function(callback) {
                var tagListItem = document.createElement("li");
                tagDelBtn = document.querySelectorAll(".tag_del");

                tagListItem.classList.add("tag_list_item");
                tagListUl.classList.add("tag_list");
                if(tagList.length > 0) {
                    tagList.forEach((tags) => {
                        tagListItem.innerHTML = "";
                        tagListItem.innerHTML = `<button type="button" class="tag_element">#` + tags + `</button>
                                            <button type="button" class="tag_del"></button>`;
                        tagListUl.appendChild(tagListItem);
                    });
                }
                setTagVault();

                callback();
            }

            addTagDelBtn = function() {
                var tagDelBtn = document.querySelectorAll(".tag_del");
                tagDelBtn.forEach((btn) => {
                    btn.onclick = function() {
                        var tagStr = btn.previousElementSibling.innerHTML;
                            tagStr = tagStr.slice(1, tagStr.length);
                        var tagIdx = tagList.indexOf(tagStr);
                        // console.log(tagIdx);
                        tagList.splice(tagIdx, 1)
                        btn.parentElement.remove();
                        limitInput(); 
                        setTagVault();
                    }
                });
            }

            limitInput = function () {
                if(tagList.length > 4) {
                    tagInput.style.visibility = "hidden";
                    tagListWrap.style.maxWidth = "100%";
                } else {
                    tagInput.style.visibility = "visible";
                    tagListWrap.style.maxWidth = "592px";
                }
            }

            setTagVault = function () {
                tagVault.value = tagList.toString();
            }

        })();
    </script>

    <script>
        //file transfer, render list
        var fileList = [];//전송 준비용
        var inputFileList = [];//입력된 모든 파일
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
                var allowedType = ["image/jpeg", "image/jpg", "image/png"];
                fileList = [];
                for (var i = 0; i < fileInput.files.length; i++) {
                    if(allowedType.includes(fileInput.files[i].type)) {
                        fileList.push(fileInput.files[i]);
                        inputFileList.push(fileInput.files[i]);
                    } else {
                        console.log("not an image");
                    }
                }
                sendFileList();
                organizePics();
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
                // for (const file of fileList) {
                //     sendFile(file);
                //     sentFileList.push(file.name);
                // };
                if(inputFileList.length > sentFileList.length) {
                        if(inputFileList[sentFileList.length]) {
                            sendFile(inputFileList[sentFileList.length]);
                        }
                    }
            };


            ///////------------------COMPRESS AND SEND IMAGE----------------------/////
            sendFile = function (file) {
                    var reader = new FileReader();
                    var formData = new FormData();
                    var request = new XMLHttpRequest();
                    var percentage;
                    console.log("file loaded");
                    var imgSource = document.querySelector('#image_to_compress');
                    var canvas = document.getElementById("canvas");
                    // // var imgRes = Math.round(imgSource.width * imgSource.height)/1000000000;
                    // // var canvasRes = Math.round(Math.pow(canvas.width, 2))/1000000000;
                    // var imgRes = imgSource.width + imgSource.height;
                    // var canvasRes = canvas.width * 2;
                    //     console.log(file.size/1000000 + "MB");
                    //     // console.log(Math.round(imgRes));
                    //     console.log(file);
                    //     console.log(Math.round(canvasRes));
                    //     console.log(Math.round(canvasRes/imgRes));
                    //     // percentage = 74/(file.size/100000000 + 100);
                    //     percentage = 99*(Math.round(canvasRes/imgRes))/(file.size/1500000 + 100);
                    //     // percentage = 75/(file.size/5000000 + 100);
                    //     // percentage = 95/(file.size/500000 + 100);
                    //     console.log(percentage*100);
                    reader.addEventListener("load", function () {
                        console.log("loading image");
                        if(reader.result.startsWith("data:image")) {
                            imgSource.src = reader.result;
                            imgSource.onload = function () {
                                // var imgRes = Math.round(imgSource.width * imgSource.height)/1000000000;
                                // var canvasRes = Math.round(Math.pow(canvas.width, 2))/1000000000;
                                var imgRes = imgSource.width + imgSource.height;
                                var canvasRes = canvas.width * 2;
                                    console.log(file.size/1000000 + "MB");
                                    // console.log(Math.round(imgRes));
                                    console.log(file);
                                    console.log(imgRes/canvasRes);
                                    // console.log(Math.round(canvasRes/imgRes));
                                    // console.log(canvasRes/imgRes);
                                    // percentage = 74/(file.size/100000000 + 100);
                                    // percentage = 99*(Math.round(canvasRes/imgRes))/(file.size/1500000 + 100);


                                    // if(imgRes/canvasRes > 2.2) {
                                    //     percentage = 75/(file.size/1000000 + 100);
                                    //     // percentage = ((Math.pow(1-canvasRes/imgRes, 2))*20)/(file.size/1000000 + 100);
                                    // } else if(imgRes/canvasRes > 1.1 && imgRes/canvasRes <= 2.2) {
                                    //     percentage = (30 + (Math.pow(imgRes/canvasRes, 2))*20)/(file.size/100000 + 100);
                                    // } else {
                                    //     // percentage = ((Math.pow(canvasRes/imgRes, 2))*20)/(file.size/100000000 + 100);
                                    //     percentage = 95/(file.size/1000000 + 100);
                                    // } 
                                    
                                    // percentage = (Math.sqrt((imgRes/canvasRes), 2) + 100)/(file.size/5000000 + 100);
                                    var compressRate = ((imgRes/canvasRes)*(100000000/file.size) + 100)/(file.size/100000 + 100);
                                    if(compressRate > 1) {
                                        percentage = 1;
                                    } else {
                                        percentage = compressRate;
                                    }
                                    

                                    // percentage = 75/(file.size/5000000 + 100);
                                    // percentage = 95/(file.size/500000 + 100);
                                    console.log(percentage*100);
                                console.log("image loaded");
                                var ctx = canvas.getContext("2d");
                                if(imgSource.width > imgSource.height) {
                                    canvas.height = canvas.width * (imgSource.height / imgSource.width);
                                } else {
                                    canvas.width = canvas.height * (imgSource.width / imgSource.height);
                                }
                                // var oc = document.createElement('canvas'),octx = oc.getContext('2d');
                                // // oc.width = imgSource.width * percentage;
                                // // oc.height = imgSource.height * percentage;
                                // if(imgSource.width > canvas.width || imgSource.height > canvas.height) {
                                //     oc.width = canvas.width;
                                //     oc.height = canvas.height;
                                // } else {
                                //     oc.width = imgSource.width;
                                //     oc.height = imgSource.height;
                                // }
                                // canvas.width = oc.width;
                                // canvas.height = oc.height;
                                // octx.drawImage(imgSource, 0, 0, oc.width, oc.height);
                                // octx.drawImage(oc, 0, 0, oc.width, oc.height);
                                // ctx.drawImage(oc, 0, 0, oc.width, oc.height,0, 0, canvas.width, canvas.height);
                                


                                if(imgSource.width > canvas.width || imgSource.height > canvas.height) {
                                    imgWidth = canvas.width;
                                    imgHeight = canvas.height;
                                } else {
                                    imgWidth = imgSource.width;
                                    imgHeight = imgSource.height;
                                }
                                canvas.width = imgWidth;
                                canvas.height = imgHeight;
                                ctx.drawImage(imgSource, 0, 0, imgSource.width, imgSource.height,0, 0, canvas.width, canvas.height);
                                console.log("img drawn on canvas");
                                canvas.toBlob(function(blob) {
                                    var compressedImg = new File([blob], file.name, {lastModified: file.lastModified, type: "image/jpeg"});//blob->file
                                    console.log("file from blob");
                                    sendImgToServer(compressedImg);
                                }, "image/jpeg", percentage);
                            }

                        }
                    }, false);
                    if (file) {
                        reader.readAsDataURL(file);
                    }

                    function sendImgToServer(file) {
                        formData.append('file', file);
                        request.open("POST", './upload_image.php');
                        request.send(formData);
                        request.onreadystatechange = function() { // 요청에 대한 콜백
                            if (request.readyState === request.DONE) { // 요청이 완료되면
                                if (request.status === 200 || request.status === 201) {
                                    console.log("got server response data");
                                    pushToNewFileList(afterPushToNewFileList);
                                    
                                    function afterPushToNewFileList() {
                                        renderFileList();
                                        resetInputValue("file-container", newFileList);
                                        resetCanvas(imgSource,  canvas);
                                        sentFileList.push(file.name);
                                        console.log(file.size/1000000 + "MB");

                                        console.log("fileList:" + fileList.length + ", sentFileList:" + sentFileList.length + ", newFileList:" + newFileList.length + ", inputFileList:" + inputFileList.length);
                                     
                                        if(inputFileList.length >= sentFileList.length) {
                                            if(inputFileList[sentFileList.length]) {
                                                sendFile(inputFileList[sentFileList.length]);
                                            }
                                        }
                                    }
                                    function pushToNewFileList (callback) {
                                        newFileList.push(request.responseText); // 바뀐 이름 stack
                                        callback();
                                    }
                                } else {
                                    console.error(request.responseText);
                                }
                            }
                        };
                    }

                    function resetCanvas(img, canvas) {
                        img.src = "";
                        // canvas.width = 2000;
                        // canvas.height = 2000;
                        canvas.width = 2400;
                        canvas.height = 2400;
                        // canvas.width = 1100;
                        // canvas.height = 1100;
                        // canvas.width = 1200;
                        // canvas.height = 1200;
                        // canvas.width = 640;
                        // canvas.height = 640;
                        reader = "";
                        console.log("reset canvas");
                    }
                        

                    
                    
                };
                ///////------------------COMPRESS AND SEND IMAGE----------------------/////
            // sendFile = function (file) {
            //     var formData = new FormData();
            //     var request = new XMLHttpRequest();
            //     formData.append('file', file);
            //     request.open("POST", './upload_image.php');
            //     request.send(formData);
            //     request.onreadystatechange = function() { // 요청에 대한 콜백
            //         if (request.readyState === request.DONE) { // 요청이 완료되면
            //             if (request.status === 200 || request.status === 201) {
            //                 newFileList.push(request.responseText); // 바뀐 이름 stack
            //                 // console.log(newFileList.length + ':' + sentFileList.length);
            //                 // if(newFileList.length === sentFileList.length) {
            //                     renderFileList();
            //                     resetInputValue("file-container", newFileList);
            //                 // }
            //             } else {
            //                 console.error(request.responseText);
            //             }
            //         }
            //     };
            // };
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
                    organizePics();
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