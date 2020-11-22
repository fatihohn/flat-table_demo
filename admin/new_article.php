<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head_new_article.php'?>
    
    <!-- <script>// img/file attachment related
        (function() {
            var HOST = "trix_upload.php";
            var allowedType = []; // 첨부 가능 파일 형식 목록
            var allowedImg = ["image/jpeg", "image/jpg", "image/png"];
            // var allowedFile = ["application/pdf", "application/x-hwp", "application/haansofthwp", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword"];
            var allowedFile = ["application/pdf"];
            allowedType = allowedImg.concat(allowedFile);

            var maxImgFileSize, maxImgFileSizeMb, maxFileSize, maxFileSizeMb, allowedTypeCheck;

            maxFileSize= 20000000;
            maxFileSizeMb = maxFileSize/1000000;
            if(<?=isIE()?> == 1) {
                maxImgFileSize= 5000000;
            } else {
                maxImgFileSize= 15000000;
            }
            maxImgFileSizeMb = maxImgFileSize/1000000;

            
            addEventListener("trix-file-accept", function(event) {//파일 선택창 액션(파일 첨부 전)
                event.preventDefault();
                return false;
                // if(event.file) {
                //     typeCheck(event.file);
                //     if(allowedTypeCheck && allowedFile.indexOf(event.file.type) !== -1) {
                //         if(event.file.size > maxFileSize) {
                //             event.preventDefault();
                //             alert(event.file.name + "의 크기가 너무 큽니다. " + maxFileSizeMb + "MB 이하의 파일을 선택해주세요.");
                //             return false;
                //         }
                //     } else if(allowedTypeCheck && allowedFile.indexOf(event.file.type) == -1) {
                //         if (event.file.size > maxImgFileSize) {
                //             event.preventDefault();
                //             alert(event.file.name + "의 크기가 너무 큽니다. " + maxImgFileSizeMb + "MB 이하의 사진을 선택해주세요.");
                //             return false;
                //         }
                //     } else {
                //         event.preventDefault();
                //         alert(event.file.name + "은 첨부할 수 있는 파일이 아닙니다. 이미지(JPG, PNG)나 문서(PDF) 파일을 선택해주세요.");
                //         return false;
                //     }
                // }
            });

            addEventListener("trix-attachment-add", function(event) {//파일 첨부 후 액션
                if(event.attachment.file) {
                    typeCheck(event.attachment.file);
                    if(allowedTypeCheck && allowedFile.indexOf(event.attachment.file.type) !== -1) {
                        if(event.attachment.file.size <= maxFileSize) {
                            uploadFileAttachment(event.attachment); // 일반 파일(pdf) 업로드
                        } else {
                            return false;
                        }
                    } else if(allowedTypeCheck && allowedFile.indexOf(event.attachment.file.type) == -1) {
                        if (allowedTypeCheck && event.attachment.file.size <= maxImgFileSize) {
                            uploadImgFileAttachment(event.attachment); /// 이미지 파일 업로드
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }
            });

            function typeCheck(obj) { // 첨부 가능 파일 형식 체크
                if (String.prototype.includes) {
                    allowedTypeCheck = allowedType.includes(obj.type);
                } else {
                    allowedTypeCheck = (function() {
                        if(allowedType.indexOf(obj.type) !== -1) {
                            return true;
                        } else {
                            return false;
                        }
                    })();
                }
            }
        
            //case: 일반 파일 업로드
            function uploadFileAttachment(attachment) {
                uploadFile(attachment.file, setProgress, setAttributes);
                
                function setProgress(progress) {
                    attachment.setUploadProgress(progress);
                }
                
                function setAttributes(attributes) {
                    attachment.setAttributes(attributes);
                }
            }
            
            function uploadFile(file, progressCallback, successCallback) {
                var formData = createFormData(file);
                var xhr = new XMLHttpRequest();
                
                xhr.open("POST", HOST, true);
        
                xhr.upload.addEventListener("progress", function(event) {
                    var progress = event.loaded / event.total * 100;
                    progressCallback(progress);
                })
                
                xhr.addEventListener("load", function(event) {
                    var attributes = {
                        url: xhr.responseText,
                        // href: "http://<?//=$file_server?>/files/" + xhr.responseText + "?content-disposition=attachment"
                        href: "http://pyeongsang.net/files/" + xhr.responseText + "?content-disposition=attachment"
                    }
                    successCallback(attributes);
                })
                
                xhr.send(formData);
            }
            
            function createFormData(file) {
                var data = new FormData();
                data.append("Content-Type", file.type);
                data.append("file", file);
                return data;
            }
            //case: 일반 파일 업로드
            
            //case: 이미지 파일 업로드
            function uploadImgFileAttachment(attachment) {
                uploadImgFile(attachment.file, setProgress, setAttributes);
        
                function setProgress(progress) {
                    attachment.setUploadProgress(progress);
                }
        
                function setAttributes(attributes) {
                    attachment.setAttributes(attributes);
                }
            }
        
            function uploadImgFile(file, progressCallback, successCallback) {
                var formData = createImgFormData(file, progressCallback, successCallback);
            }

            function createImgFormData(file, progressCallback, successCallback) {
                var xhr = new XMLHttpRequest();
                var reader = new FileReader();
                var data = new FormData();
                var compressRate, maxQuality, anchorSize, imgQuality, percentage;
                // console.log("file loaded");
                var imgSource = document.createElement('img');
                var canvas = document.createElement('canvas');
                    canvas.setAttribute("class", "canvas");
                    canvas.width = 2000;
                    canvas.height = 2000;
                    canvas.style.display = "none";

                    imgSource.setAttribute("class", "imgSource");
                    imgSource.style.display = "none";

                    // console.log(file.size);
                reader.addEventListener("load", function () {
                    // console.log("loading image");
                    if(reader.result.startsWith("data:image")) {
                        imgSource.src = reader.result;
                        imgSource.onload = function () {
                            // console.log("image loaded");
                            // console.log("compressing...");

                            var imgRes = Math.sqrt(imgSource.width * imgSource.height);
                            var originalImgQuality = Math.sqrt(file.size);
                            var canvasRes = Math.sqrt(canvas.width*canvas.height);
                            var imgResRt = getLogation(imgRes, 2);

                            function getLogation (num, logN) {
                                var logation = Math.sqrt(num);
                                var n = 0;
                                while(n < logN-1) {
                                    logation = Math.sqrt(logation);
                                    n++;
                                }
                                return logation;
                            }

                            anchorSize = 3;
                            if(originalImgQuality > 1000) {
                                maxQuality = 99;
                                imgQuality = ((originalImgQuality*2)/(Math.sqrt(canvasRes * imgRes)/1.5)) * (Math.floor(1000*Math.pow(imgResRt/8, 4))/1000 * anchorSize);
                            } else {
                                maxQuality = 95;
                                imgQuality = 0;
                            }
                            compressRate = maxQuality/(imgQuality + 100);

                            if(compressRate >= 1) {
                                percentage = 0.95;
                            } else {
                                percentage = compressRate;
                            }
                                // console.log("imgQuality: "+imgQuality);
                                // console.log("originalImgQuality: "+originalImgQuality);
                                // console.log("imgResRt: "+Math.floor(1000*Math.pow(imgResRt/8, 4))/1000);
                                // console.log("percentage: "+percentage*100 + "%");

                            var ctx = canvas.getContext("2d");
                            if(imgSource.width > imgSource.height) {
                                canvas.height = canvas.width * (imgSource.height / imgSource.width);
                            } else {
                                canvas.width = canvas.height * (imgSource.width / imgSource.height);
                            }

                            if(imgSource.width > canvas.width || imgSource.height > canvas.height) {
                                imgWidth = canvas.width;
                                imgHeight = canvas.height;
                            } else {
                                imgWidth = imgSource.width;
                                imgHeight = imgSource.height;
                            }

                            canvas.width = imgWidth;
                            canvas.height = imgHeight;
                            ctx.drawImage(imgSource, 0, 0, imgSource.width, imgSource.height, 0, 0, canvas.width, canvas.height);
                            // console.log("img drawn on canvas");
                            canvas.toBlob(function(blob) {
                                var fileNameBody;
                                fileNameBody = file.name.split(".");
                                fileNameBody.pop();
                                fileNameBody.join();
                                var compressedImg;
                                        
                                try {
                                    compressedImg = new File([blob], fileNameBody + ".jpg", {lastModified: file.lastModified, type: "image/jpeg"});//blob->file, (*.*)->(*.jpg)
                                } catch(err) {
                                    compressedImg = blob;
                                    compressedImg.type = "image/jpeg";
                                    compressedImg.name = fileNameBody + ".jpg";
                                    compressedImg.lastModifiedDate = file.lastModifiedDate;
                                }
                                // console.log("file from blob");
                                sendImgToServer(compressedImg);
                                
                            }, "image/jpeg", percentage);
                        }
                    }
                }, false);

                if (file) {
                    reader.readAsDataURL(file);
                }

                function sendImgToServer (file) {
                    data.append("Content-Type", file.type);
                    if(<?//=isIE()?> == 1) {
                        var fileNameBody;
                        fileNameBody = file.name.split(".");
                        fileNameBody.pop();
                        fileNameBody.join();
                        data.append('file', file, fileNameBody + ".jpg");
                    } else {
                        data.append('file', file);
                    }

                    xhr.open("POST", HOST, true);
            
                    xhr.upload.addEventListener("progress", function(event) {
                        var progress = event.loaded / event.total * 100;
                        progressCallback(progress);
                    });
            
                    xhr.addEventListener("load", function(event) {
                        var attributes = {
                            url: xhr.responseText
                        }
                        successCallback(attributes);
                    });
                    xhr.send(data)
                    // console.log("send compressed img to server");

                    resetCanvas(imgSource,  canvas);
                    return data;
                }

                function resetCanvas(img, canvas) {
                    img.remove();
                    canvas.remove();
                    // console.log("reset canvas");
                }
            }
            //case: 이미지 파일 업로드
        })();
    </script> -->

</head>
<body>
    <?php include 'header.php'?>
    <?php
    if($sessionUser && $sessionAdmin == "admin") {
        $username = $sessionUser;
    } else {
        ?>
        <script>
            alert("로그인하세요");
            location.href='index.php';
        </script>
        <?php
    }
    include '../bbps_db_conn.php';   
    ?>
    <?php include 'nav.php'?>

    <div id="overlay" class="overlay"></div>
    <!-- @yield ('content') -->
    <form action="new_article_action.php" method="post" enctype="multipart/form-data">
    <section class="article_main">
        <div class="main">
            <div class="article_container container">
                    <header class="article_header">
                        <input id="title" type="text" name="title" placeholder="제목" required/>
                        <div class="article_info">
                            <p class="article_address">
                                <!-- {{-- 경기도 동두천시 상봉암동 153-15 --}} -->
                                <input id="address" type="text" name="address" placeholder="주소" required />
                            </p>
                            <p class="category">
                                <!-- <a href="#">
                                    주민모임형
                                </a> -->
                                <!-- <input type="text" id="hashtags" placeholder="태그" autocomplete="off"> -->
                                <!-- <div class="tag-container"></div>
                                <input id="category_container" type="hidden" name="categories" value="" /> -->

                                <div class="tag_container">
                                    <div class="tag_input_wrap">
                                        <div class="tag_input">
                                            <input id="tags" type="text" placeholder="연관태그를 입력해주세요. (최대 10개)" value="">
                                            <input id="tag_vault" type="hidden" name="tag_vault" value="">
                                        </div>
                                    </div>
                                    <div class="tag_list_wrap"></div>
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
                    
                        <!-- <img src="" id="image_to_compress" style="display: none;"> -->
                        <!-- <canvas id="canvas" height="2400" width="2400" style="display: none;"></canvas> -->
                        <!-- <canvas id="canvas" height="3000" width="3000" style="display: none;"></canvas> -->
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
                                    <input id="photographer" type="text" name="photographer">
                                </span>
                            </p>
                            <p class="words">
                                글
                                <span>
                                    <input id="words" type="text" name="words" required>
                                </span>
                            </p>
                        </div>
                        <div class="article_fieldwork_date">
                            <p class="fieldwork_date">
                                <span>
                                    <label for="fieldwork_date">
                                        현지조사
                                        <input id="fieldwork_date" type="date" name="fieldwork_date" required>
                                    </label>
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
                            <p class="flag">
                                <span>
                                    <label for="about">
                                        <input id="about" type="checkbox" name="about">
                                        평상으로부터 (소개글)
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
                        <!-- <input type="hidden" name="about" value="no"> -->
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
        (function() {
            var flagVal, aboutVal, flagInput, aboutInput;
            var titleInput, addressInput, tagInput, photographerInput, wordsInput, fieldworkInput;
            titleInput = document.querySelector("#title");
            addressInput = document.querySelector("#address");
            tagInput = document.querySelector("#tags");
            photographerInput = document.querySelector("#photographer");
            wordsInput = document.querySelector("#words");
            fieldworkInput = document.querySelector("#fieldwork_date");


            flagInput = document.querySelector("#flag");
            aboutInput = document.querySelector("#about");
            flagInput.onchange =  function(e) {
                if(flagInput.checked !== true && flagInput.disabled !== true) {
                    aboutInput.disabled = false;
                } else if(flagInput.checked == true && flagInput.disabled !== true) {
                    aboutInput.checked = false;
                    aboutInput.disabled = true;
                }
            };
            aboutInput.onchange =  function(e) {
                if(aboutInput.checked !== true && aboutInput.disabled !== true) {
                    flagInput.disabled = false;

                    titleInput.disabled = false;
                    addressInput.disabled = false;
                    tagInput.disabled = false;
                    photographerInput.disabled = false;
                    wordsInput.disabled = false;
                    fieldworkInput.disabled = false;

                    titleInput.value = "";
                    addressInput.value = "";
                    photographerInput.value = "";
                    wordsInput.value = "";
                    fieldworkInput.value = "";
                } else if(aboutInput.checked == true && aboutInput.disabled !== true) {
                    flagInput.checked = false;
                    flagInput.disabled = true;

                    titleInput.disabled = true;
                    addressInput.disabled = true;
                    tagInput.disabled = true;
                    photographerInput.disabled = true;
                    wordsInput.disabled = true;
                    fieldworkInput.disabled = true;
                    titleInput.value = "평상으로부터";
                    addressInput.value = "소개글";
                    photographerInput.value = "변방평상";
                    wordsInput.value = "변방평상";
                    fieldworkInput.value = "0";
                }
            };
        })();
    </script>
    <script>
        function organizePics() {
        let articleImgs = document.querySelectorAll(".article_pics figure");
        let mobileImgs = document.querySelector(".article_pics_mobile");
            for(let m=0; m < articleImgs.length; m++) {
                    if(mobileImgs.childNodes.length > 0) {
                        for(let n=0; n < mobileImgs.childNodes.length; n++) {
                            mobileImgs.childNodes[n].remove();
                        }
                    }
                    
                    if(articleImgs[m].childNodes[1].width*1.2 > articleImgs[m].childNodes[1].height) {
                        articleImgs[m].classList.add("hori");
                        articleImgs[m].childNodes[1].classList.add("hori");
                    } else {
                        articleImgs[m].classList.add("verti");
                        articleImgs[m].childNodes[1].classList.add("verti");
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
            //    tagFinderBtn = document.querySelectorAll(".tag_finder_btn");

            // document.onkeypress = function(e) {
            //     if(e.keyCode == 13) {
            //         e.preventDefault();
            //     }
            // }


            


            tagInput.onkeypress = function(e) {                 
                // if(e.keyCode == 13) {
                //     e.preventDefault();
                // }
                if(e.code == "Enter" || e.code == "Space" || e.code == "Comma" || e.keycode == 13) {
                    // if(e.keycode == "13" || e.keycode == "32") {
                        e.preventDefault();
                        if(tagInput.value !== "" && !tagList.includes(tagInput.value)) {
                            addTags(tagInput.value);
                            tagListWrap.appendChild(tagListUl);
                            renderTagList(addTagDelBtn);
                            limitInput(); 
                        } else {
                            tagInput.value = "";
                            // if(tagContainer.children[2]) {
                            if(tagContainer.querySelector(".tag_finder_wrap")) {
                                // tagContainer.children[2].remove();
                                tagContainer.querySelector(".tag_finder_wrap").remove();
                            }
                        }
                }
            }

            tagInput.onkeyup = function(e) {
                if(e.code !== "Enter" || e.code !== "Space" || e.code !== "Comma") {
                    if(tagInput.value !== "") {
                        showExistingTags(tagInput.value, selectExistingTag);
                        // showExistingTags(tagInput.value);
                    } else {
                        // tagContainer.children[2].remove();
                        tagContainer.querySelector(".tag_finder_wrap").remove();
                    }
                } 
            }

            addTags = function (val) {
                tagList.push(val);
                tagInput.value = "";
            };

            showExistingTags = function (val, callback) {
            // showExistingTags = function (val) {
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
                                // if(!tagContainer.children[2]) {
                                if(!tagContainer.querySelector(".tag_finder_wrap")) {
                                    tagContainer.appendChild(finderWrap);
                                } else {
                                    // tagContainer.children[2].remove();
                                    tagContainer.querySelector(".tag_finder_wrap").remove();
                                    tagContainer.appendChild(finderWrap);
                                    // tagContainer.children[2].innerHTML = finder.responseText;
                                    tagContainer.querySelector(".tag_finder_wrap").innerHTML = finder.responseText;
                                }
                            } else {
                                // tagContainer.children[2].remove();
                                if(tagContainer.querySelector(".tag_finder_wrap")) {
                                    tagContainer.querySelector(".tag_finder_wrap").remove();
                                }
                            }
                        }
                    callback();
                    }
                })();
            };

            // selectExistingTag = function () {
            //     tagFinderBtn.forEach((btn) => {
            //         btn.onclick = function () {
            //             console.log("clicked");
            //         }
            //     });
            // }
            // selectExistingTag();//////how to trigger this????
            selectExistingTag = function () {
                tagFinderBtn = document.querySelectorAll(".tag_finder_btn");
                tagFinderBtn.forEach((btn) => {
                    btn.onclick = function () {
                        // console.log("clicked");
                        // console.log(btn.innerHTML.slice(1, btn.innerHTML.length));

                        var tagFinderVal = btn.innerHTML.slice(1, btn.innerHTML.length);
                        if(!tagList.includes(tagFinderVal)) {
                            addTags(tagFinderVal);
                            tagListWrap.appendChild(tagListUl);
                            renderTagList(addTagDelBtn);
                            limitInput();
                            tagContainer.querySelector(".tag_finder_wrap").remove();
                        } else {
                            tagInput.value = "";
                            if(tagContainer.querySelector(".tag_finder_wrap")) {
                                tagContainer.querySelector(".tag_finder_wrap").remove();
                            }
                        }
                    }
                });
            }







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
    </script> -->
<!-- 
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

            tagInput.addEventListener("keydown", function(e) {
                var tagFinder = document.querySelector(".tag_finder");
                if(e.keycode == 40 || e.code == "ArrowDown" || e.keycode == 38 || e.code == "ArrowUp") {
                    if(tagFinder) {
                        if(e.keycode == 40 || e.code == "ArrowDown") {
                            e.preventDefault();
                            if(!tagFinder.querySelector(".selected")) {
                                // tagFinder.firstChild.classList.add("selected"); 
                                tagFinder.firstElementChild.classList.add("selected");
                            // } else if(tagFinder.querySelector(".selected") && tagFinder.querySelector(".selected").nextSibling) {
                            } else if(tagFinder.querySelector(".selected") && tagFinder.querySelector(".selected").nextElementSibling) {
                                // tagFinder.querySelector(".selected").nextSibling.classList.add("selected");
                                tagFinder.querySelector(".selected").nextElementSibling.classList.add("selected");
                                tagFinder.querySelector(".selected").classList.remove("selected");
                            } else {
                                tagFinder.querySelector(".selected").classList.remove("selected");
                                tagFinder.firstChild.classList.add("selected");
                            }
                        } else if(e.keycode == 38 || e.code == "ArrowUp") {
                            e.preventDefault();
                            if(!tagFinder.querySelector(".selected")) {
                                // tagFinder.lastChild.classList.add("selected");
                                tagFinder.lastElementChild.classList.add("selected");
                            // } else if(tagFinder.querySelector(".selected") && tagFinder.querySelector(".selected").previousSibling) {
                            } else if(tagFinder.querySelector(".selected") && tagFinder.querySelector(".selected").previousElementSibling) {
                                // tagFinder.querySelector(".selected").previousSibling.classList.add("selected");
                                tagFinder.querySelector(".selected").previousElementSibling.classList.add("selected");
                                tagFinder.querySelectorAll(".selected")[1].classList.remove("selected");
                            } else {
                                tagFinder.querySelector(".selected").classList.remove("selected");
                                // tagFinder.lastChild.classList.add("selected");
                                tagFinder.lastElementChild.classList.add("selected");
                            }
                        }
                        tagInput.value = tagFinder.querySelector(".selected .tag_finder_btn").innerHTML.slice(1, tagFinder.querySelector(".selected .tag_finder_btn").innerHTML.length);
                    }
                }
            });

            

            tagInput.onkeypress = function(e) {       
                if(e.code == "Enter" || e.code == "Space" || e.code == "Comma" || e.keycode == 13) {
                    e.preventDefault();
                    console.log("tag added");
                    if(tagInput.value !== "" && !tagList.includes(tagInput.value)) {
                        addTags(tagInput.value);
                        tagListWrap.appendChild(tagListUl);
                        renderTagList(addTagDelBtn);
                        limitInput(); 
                    } else {
                        tagInput.value = "";
                    }
                    if(tagContainer.querySelector(".tag_finder_wrap")) {
                        tagContainer.querySelector(".tag_finder_wrap").remove();
                    }
                }
            }

            tagInput.onkeyup = function(e) {
                if(e.code !== "Enter" && e.code !== "Space" && e.code !== "Comma" && e.code !== "ArrowDown" && e.code !== "ArrowUp") {
                    if(tagInput.value !== "") {
                        showExistingTags(tagInput.value, selectExistingTag);
                    } else {
                        if(tagContainer.querySelector(".tag_finder_wrap")) {
                            tagContainer.querySelector(".tag_finder_wrap").remove();   
                        }
                    }
                }
            }

            addTags = function (val) {
                tagList.push(val);
                tagInput.value = "";
            }

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
                                if(!tagContainer.querySelector(".tag_finder_wrap") && finder.responseText !== '<ul class="tag_finder"></ul>') {
                                    // console.log(finder.responseText);
                                    tagContainer.appendChild(finderWrap);
                                } else {
                                    tagContainer.querySelector(".tag_finder_wrap").remove();
                                    tagContainer.appendChild(finderWrap);
                                    tagContainer.querySelector(".tag_finder_wrap").innerHTML = finder.responseText;
                                }
                            } else {
                                if(tagContainer.querySelector(".tag_finder_wrap")) {
                                    tagContainer.querySelector(".tag_finder_wrap").remove();
                                }
                            }
                        }
                        callback();
                    }
                })();
            }

            selectExistingTag = function () {
                tagFinderBtn = document.querySelectorAll(".tag_finder_btn");
                tagFinderBtn.forEach((btn) => {
                    btn.onclick = function () {
                        var tagFinderVal = btn.innerHTML.slice(1, btn.innerHTML.length);
                        if(!tagList.includes(tagFinderVal)) {
                            addTags(tagFinderVal);
                            tagListWrap.appendChild(tagListUl);
                            renderTagList(addTagDelBtn);
                            limitInput();
                            tagContainer.querySelector(".tag_finder_wrap").remove();
                        } else {
                            tagInput.value = "";
                        }
                        if(tagContainer.querySelector(".tag_finder_wrap")) {
                            tagContainer.querySelector(".tag_finder_wrap").remove();
                        }
                    }
                });
            }

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
    </script> -->

    <!-- <script>
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

            tagInput.addEventListener("keydown", function(e) {
                var tagFinder = document.querySelector(".tag_finder");
                if(e.keycode == 40 || e.code == "ArrowDown" || e.keycode == 38 || e.code == "ArrowUp") {
                    if(tagFinder) {
                        if(e.keycode == 40 || e.code == "ArrowDown") {
                            e.preventDefault();
                            if(!tagFinder.querySelector(".selected")) {
                                tagFinder.firstElementChild.classList.add("selected");
                            } else if(tagFinder.querySelector(".selected") && tagFinder.querySelector(".selected").nextElementSibling) {
                                tagFinder.querySelector(".selected").nextElementSibling.classList.add("selected");
                                tagFinder.querySelector(".selected").classList.remove("selected");
                            } else {
                                tagFinder.querySelector(".selected").classList.remove("selected");
                                tagFinder.firstElementChild.classList.add("selected");
                            }
                        } else if(e.keycode == 38 || e.code == "ArrowUp") {
                            e.preventDefault();
                            if(!tagFinder.querySelector(".selected")) {
                                tagFinder.lastElementChild.classList.add("selected");
                            } else if(tagFinder.querySelector(".selected") && tagFinder.querySelector(".selected").previousElementSibling) {
                                tagFinder.querySelector(".selected").previousElementSibling.classList.add("selected");
                                tagFinder.querySelectorAll(".selected")[1].classList.remove("selected");
                            } else {
                                tagFinder.querySelector(".selected").classList.remove("selected");
                                tagFinder.lastElementChild.classList.add("selected");
                            }
                        }
                        tagInput.value = tagFinder.querySelector(".selected .tag_finder_btn").innerHTML.slice(1, tagFinder.querySelector(".selected .tag_finder_btn").innerHTML.length);
                    }
                }
            });

            

            tagInput.onkeypress = function(e) {       
                if(e.code == "Enter" || e.code == "Space" || e.code == "Comma" || e.keycode == 13) {
                    e.preventDefault();
                    console.log("tag added");
                    if(tagInput.value !== "" && !tagList.includes(tagInput.value)) {
                        addTags(tagInput.value);
                        tagListWrap.appendChild(tagListUl);
                        renderTagList(addTagDelBtn);
                        limitInput(); 
                    } else {
                        tagInput.value = "";
                    }
                    if(tagContainer.querySelector(".tag_finder_wrap")) {
                        tagContainer.querySelector(".tag_finder_wrap").remove();
                    }
                }
            }

            tagInput.onkeyup = function(e) {
                if(e.code !== "Enter" && e.code !== "Space" && e.code !== "Comma" && e.code !== "ArrowDown" && e.code !== "ArrowUp") {
                    if(tagInput.value !== "") {
                        showExistingTags(tagInput.value, selectExistingTag);
                    } else {
                        if(tagContainer.querySelector(".tag_finder_wrap")) {
                            tagContainer.querySelector(".tag_finder_wrap").remove();   
                        }
                    }
                }
            }

            addTags = function (val) {
                tagList.push(val);
                tagInput.value = "";
            }

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
                                if(!tagContainer.querySelector(".tag_finder_wrap") && finder.responseText !== '<ul class="tag_finder"></ul>') {
                                    // console.log(finder.responseText);
                                    tagContainer.appendChild(finderWrap);
                                } else {
                                    tagContainer.querySelector(".tag_finder_wrap").remove();
                                    tagContainer.appendChild(finderWrap);
                                    tagContainer.querySelector(".tag_finder_wrap").innerHTML = finder.responseText;
                                }
                            } else {
                                if(tagContainer.querySelector(".tag_finder_wrap")) {
                                    tagContainer.querySelector(".tag_finder_wrap").remove();
                                }
                            }
                        }
                        callback();
                    }
                })();
            }

            selectExistingTag = function () {
                tagFinderBtn = document.querySelectorAll(".tag_finder_btn");
                tagFinderBtn.forEach((btn) => {
                    btn.onclick = function () {
                        var tagFinderVal = btn.innerHTML.slice(1, btn.innerHTML.length);
                        if(!tagList.includes(tagFinderVal)) {
                            addTags(tagFinderVal);
                            tagListWrap.appendChild(tagListUl);
                            renderTagList(addTagDelBtn);
                            limitInput();
                            tagContainer.querySelector(".tag_finder_wrap").remove();
                        } else {
                            tagInput.value = "";
                        }
                        if(tagContainer.querySelector(".tag_finder_wrap")) {
                            tagContainer.querySelector(".tag_finder_wrap").remove();
                        }
                    }
                });
            }

            renderTagList = function(callback) {
                var tagListItem = document.createElement("li");
                tagDelBtn = document.querySelectorAll(".tag_del");

                tagListItem.classList.add("tag_list_item");
                tagListUl.classList.add("tag_list");
                if(tagList.length > 0) {
                    tagList.forEach((tags) => {
                        tagListItem.innerHTML = "";
                        tagListItem.innerHTML = '<button type="button" class="tag_element">#' + tags + '</button><button type="button" class="tag_del"></button>';
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
                if(tagList.length > 9) {
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
    </script> -->



    <script>
        // document.querySelector(".trix-button.trix-button--icon.trix-button--icon-attach").disabled = true;
        // document.querySelector("trix-editor").onfocus = function() {
        //     document.querySelector(".trix-button.trix-button--icon.trix-button--icon-attach").disabled = true;
        // }
        // document.querySelector("trix-editor").onfocusout = function() {
        //     document.querySelector(".trix-button.trix-button--icon.trix-button--icon-attach").disabled = true;
        // }
        // document.querySelector("trix-editor").oninput = function() {
        //     document.querySelector(".trix-button.trix-button--icon.trix-button--icon-attach").disabled = true;
        // }
    </script>
    <script> //hashtag related
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

            tagInput.addEventListener("keydown", function(e) {
                var tagFinder = document.querySelector(".tag_finder");
                if(e.key == "ArrowDown" || e.key == "Down" || e.key == "ArrowUp" || e.key == "Up") {
                    if(e.preventDefault) {
                        e.preventDefault();
                    } else {
                        e.returnValue = false;
                    }

                    if(tagFinder) {
                        if(e.key == "ArrowDown" || e.key == "Down") {
                            if(!tagFinder.querySelector(".selected")) {
                                tagFinder.firstElementChild.classList.add("selected");
                            } else if(tagFinder.querySelector(".selected") && tagFinder.querySelector(".selected").nextElementSibling) {
                                tagFinder.querySelector(".selected").nextElementSibling.classList.add("selected");
                                tagFinder.querySelector(".selected").classList.remove("selected");
                            } else {
                                tagFinder.querySelector(".selected").classList.remove("selected");
                                tagFinder.firstElementChild.classList.add("selected");
                            }
                        } else if(e.key == "ArrowUp" || e.key == "Up") {
                            if(!tagFinder.querySelector(".selected")) {
                                tagFinder.lastElementChild.classList.add("selected");
                            } else if(tagFinder.querySelector(".selected") && tagFinder.querySelector(".selected").previousElementSibling) {
                                tagFinder.querySelector(".selected").previousElementSibling.classList.add("selected");
                                tagFinder.querySelectorAll(".selected")[1].classList.remove("selected");
                            } else {
                                tagFinder.querySelector(".selected").classList.remove("selected");
                                tagFinder.lastElementChild.classList.add("selected");
                            }
                        }
                        tagInput.value = tagFinder.querySelector(".selected .tag_finder_btn").value;
                    }
                }

                if(e.key == "Enter" || (e.key == "Spacebar" || e.code == "Space") || e.key == ",") {
                    if(e.preventDefault) {
                        e.preventDefault();
                    } else {
                        e.returnValue = false;
                    }
                }
            });

            

            tagInput.addEventListener("keyup", function(e) {
                if(e.key == "Enter" || (e.code == "Space" || e.key == "Spacebar") || e.key == "," || (e.code == "ArrowDown" || e.key == "Down") || (e.key == "Up" || e.code == "ArrowUp")) {
               
                    if(e.preventDefault) {
                        e.preventDefault();
                    } else {
                        e.returnValue = false;
                    }
                } else {
                    if(tagInput.value !== "") {
                        showExistingTags(tagInput.value, selectExistingTag);
                    } else {
                        if(tagContainer.querySelector(".tag_finder_wrap")) {
                            tagContainer.querySelector(".tag_finder_wrap").remove();   
                        }
                    }
                    
                }

                if(e.key == "Enter" || (e.key == "Spacebar" || e.code == "Space") || e.key == ",") {
                    if(e.preventDefault) {
                        e.preventDefault();
                    } else {
                        e.returnValue = false;
                    }
                    console.log("tag added");
                    console.log(tagList);

                    var tagListCheck;
                    if (String.prototype.includes) {//IE compatibility
                        tagListCheck = tagList.includes(tagInput.value);
                    } else {
                        tagListCheck = (function() {
                            if(tagList.indexOf(tagInput.value) !== -1) {
                                return true;
                            } else {
                                return false;
                            }
                        })();
                    }
                    if(tagInput.value !== "" && !tagListCheck) {
                        addTags(tagInput.value);
                        tagListWrap.appendChild(tagListUl);
                        renderTagList(addTagDelBtn);
                        limitInput(); 
                    } else {
                        tagInput.value = "";
                    }

                    if(tagContainer.querySelector(".tag_finder_wrap")) {
                        tagContainer.querySelector(".tag_finder_wrap").remove();
                    }
                }

                
            });

            addTags = function (val) {
                tagList.push(val);
                tagInput.value = "";
            }

            showExistingTags = function (val, callback) {
                var finderWrap = document.createElement("div");
                var finder = new XMLHttpRequest();

                finder.open("POST", "tag_finder.php?str=" + val, true);
                finder.send();
                finder.onreadystatechange = function() {
                    if (finder.readyState == 4 && finder.status == 200) {
                        finderWrap.classList.add("tag_finder_wrap");
                        finderWrap.innerHTML = finder.responseText;

                        if(val.length > 0) {
                            if(!tagContainer.querySelector(".tag_finder_wrap") && finder.responseText.indexOf(val) == -1) {
                            } else if(tagContainer.querySelector(".tag_finder_wrap") && finder.responseText.indexOf(val) == -1) {
                                tagContainer.querySelector(".tag_finder_wrap").remove();
                            } else {
                                if(tagContainer.querySelector(".tag_finder_wrap")) {
                                    tagContainer.querySelector(".tag_finder_wrap").remove();
                                }
                                tagContainer.appendChild(finderWrap);
                                tagContainer.querySelector(".tag_finder_wrap").innerHTML = finder.responseText;
                            }
                        } else {
                            if(tagContainer.querySelector(".tag_finder_wrap")) {
                                tagContainer.querySelector(".tag_finder_wrap").remove();
                            }
                        }
                    }
                    callback();
                }
            }

            selectExistingTag = function () {
                tagFinderBtn = document.querySelectorAll(".tag_finder_btn");
                tagFinderBtn.forEach(function(btn) {
                    btn.onclick = function () {
                        var tagFinderVal = btn.innerHTML.slice(1, btn.innerHTML.length);
                        var tagFinderValCheck;
                        if (String.prototype.includes) { //IE compatibility 
                            tagFinderValCheck = tagList.includes(tagFinderVal);
                        } else {
                            tagFinderValCheck = (function() {
                                if(tagList.indexOf(tagFinderVal) !== -1) {
                                    return true;
                                } else {
                                    return false;
                                }
                            })();
                        }
                        if(!tagFinderValCheck) {
                            addTags(tagFinderVal);
                            tagListWrap.appendChild(tagListUl);
                            renderTagList(addTagDelBtn);
                            limitInput();
                            tagContainer.querySelector(".tag_finder_wrap").remove();
                        } else {
                            tagInput.value = "";
                        }
                        if(tagContainer.querySelector(".tag_finder_wrap")) {
                            tagContainer.querySelector(".tag_finder_wrap").remove();
                        }
                    }
                });
            }

            renderTagList = function(callback) {
                var tagListItem = document.createElement("li");
                tagDelBtn = document.querySelectorAll(".tag_del");

                tagListItem.classList.add("tag_list_item");
                tagListUl.classList.add("tag_list");
                if(tagList.length > 0) {
                    tagList.forEach(function(tags) {
                        tagListItem.innerHTML = "";
                        tagListItem.innerHTML = '<button type="button" class="tag_element">#' + tags + '</button><button type="button" class="tag_del"></button>';
                        tagListUl.appendChild(tagListItem);
                    });
                }
                setTagVault();

                callback();
            }

            addTagDelBtn = function() {
                tagDelBtn = document.querySelectorAll(".tag_del");
                tagDelBtn.forEach(function(btn) {
                    btn.onclick = function() {
                        var tagStr = btn.previousElementSibling.innerHTML;
                            tagStr = tagStr.slice(1, tagStr.length);
                        var tagIdx = tagList.indexOf(tagStr);
                        tagList.splice(tagIdx, 1)
                        btn.parentElement.remove();
                        limitInput(); 
                        setTagVault();
                    }
                });
            }

            limitInput = function () {
                if(tagList.length >= 5) {
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
        //input check related
        (function () {
            //number check
            var priceInput, checkStrNum;
            var quantityInput, checkStrLen;
            var titleInput;
            var tagInput;
            var addComma;

            tagInput = document.querySelector("#tags");
            tagInput.addEventListener("keydown", function() {
                checkStrLen(9, tagInput);
            });

            titleInput = document.querySelector("#title");
            titleInput.addEventListener("keydown", function() {
                checkStrLen(20, titleInput);
            });

            addressInput = document.querySelector("#address");
            addressInput.addEventListener("keydown", function() {
                checkStrLen(125, addressInput);
            });

            photographerInput = document.querySelector("#photographer");
            photographerInput.addEventListener("keydown", function() {
                checkStrLen(12, photographerInput);
            });

            wordsInput = document.querySelector("#words");
            wordsInput.addEventListener("keydown", function() {
                checkStrLen(12, wordsInput);
            });
            
            addComma = function(input) {
                var inputNum = input.value;
                inputNum = inputNum.split(",");
                let i = 0;
                let outputNum = "";
                while(i < inputNum.length) {
                    outputNum = outputNum.concat(inputNum[i].toString());
                    i++;
                }
                outputNum = parseInt(outputNum);
                nfObject = new Intl.NumberFormat();
                if(!isNaN(outputNum)) {
                    input.value = nfObject.format(outputNum.toString());
                }
            };

            checkStrLen = function (len, input) {
                // console.log(input.value.length + ":" + len);

                if(input.value.toString().match(/[\u3131-\uD79D]/ugi)) {
                    if(input.value.length >= len) {
                        input.addEventListener("input", function() {
                            input.value = input.value.substr(0, len);
                        });
                    } else {
                        input.onkeydown = function(e) {
                            return true;
                        }
                    }
                } else {
                    if(input.value.toString().length >= len) {
                        input.addEventListener("input", function() {
                            input.value = input.value.toString().substr(0, len);
                        });
                    } else {
                        input.onkeydown = function(e) {
                            return true;
                        }
                    }
                }
            };

            checkStrNum = function (regx, input) {
                if(input.value.match(regx)) {
                    // alert("숫자만 입력해주세요");
                    input.value = input.value.replace(regx,'');
                }
            };
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
                        // console.log("not an image");
                        alert(fileInput.files[i].name + "는 올바른 형식의 파일이 아닙니다. JPG나 PNG 파일을 선택해주세요.");
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
                    // console.log("file loaded");
                    // var imgSource = document.querySelector('#image_to_compress');
                    // var canvas = document.getElementById("canvas");
                    var imgSource = document.createElement('img');
                    var canvas = document.createElement('canvas');
                        canvas.setAttribute("class", "canvas");
                        canvas.width = 2000;
                        canvas.height = 2000;
                        canvas.style.display = "none";

                        imgSource.setAttribute("class", "imgSource");
                        imgSource.style.display = "none";
                    //     console.log(file.size/1000000 + "MB");
                    //     // percentage = 74/(file.size/100000000 + 100);
                    //     console.log(percentage*100);
                    reader.addEventListener("load", function () {
                        // console.log("loading image");
                        if(reader.result.startsWith("data:image")) {
                            imgSource.src = reader.result;
                            imgSource.onload = function () {
                                // // var imgRes = Math.round(imgSource.width * imgSource.height)/1000000000;
                                // // var canvasRes = Math.round(Math.pow(canvas.width, 2))/1000000000;
                                // var imgRes = imgSource.width + imgSource.height;
                                // var canvasRes = canvas.width * 2;
                                //     var compressRate = ((imgRes/canvasRes)*(1000000/file.size) + 100)/(file.size/80000 + 100);
                                //     if(compressRate > 1) {
                                //         percentage = 1;
                                //     } else {
                                //         percentage = compressRate;
                                //     }
                                var imgRes = Math.sqrt(imgSource.width * imgSource.height);
                                var originalImgQuality = Math.sqrt(file.size);
                                var canvasRes = Math.sqrt(canvas.width*canvas.height);
                                var imgResRt = logationTwo(imgRes, 2);


                                function logationTwo (num, logN) {
                                    var logation = Math.sqrt(num);
                                    var n = 0;
                                    // for(let n; n < logN; n++) {
                                    //     logation = Math.sqrt(logation);
                                    // }
                                    while(n < logN-1) {
                                        logation = Math.sqrt(logation);
                                        n++;
                                    }
                                    return logation;
                                }


                                // anchorSize = 8;
                                anchorSize = 3;
                                if(originalImgQuality > 1000) {

                                    maxQuality = 99;
                                    // imgQuality = (originalImgQuality/Math.sqrt(canvasRes * imgRes)) * anchorSize;
                                    // imgQuality = (originalImgQuality/Math.sqrt(canvasRes * imgRes)) * (anchorSize*imgResRt/2);
                                    imgQuality = ((originalImgQuality*2)/(Math.sqrt(canvasRes * imgRes)/1.5)) * (Math.floor(1000*Math.pow(imgResRt/8, 4))/1000 * anchorSize);
                                    // imgQuality = ((originalImgQuality*2)/(Math.sqrt(canvasRes * imgRes*30)/1.5)) * (Math.floor(1000*Math.pow(imgResRt/8, 4))/1000);
                                } else {
                                    maxQuality = 95;
                                    imgQuality = 0;
                                }
                                compressRate = maxQuality/(imgQuality + 100);

                                if(compressRate >= 1) {
                                    percentage = 0.95;
                                } else {
                                    percentage = compressRate;
                                }


                                    // console.log(percentage*100);
                                // console.log("image loaded");
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
                                // console.log("img drawn on canvas");
                                canvas.toBlob(function(blob) {
                                    var compressedImg = new File([blob], file.name, {lastModified: file.lastModified, type: "image/jpeg"});//blob->file
                                    // console.log("file from blob");
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
                                    // console.log("got server response data");
                                    pushToNewFileList(afterPushToNewFileList);
                                    
                                    function afterPushToNewFileList() {
                                        renderFileList();
                                        resetInputValue("file-container", newFileList);
                                        resetCanvas(imgSource,  canvas);
                                        sentFileList.push(file.name);
                                        console.log(file.size/1000000 + "MB");

                                        // console.log("fileList:" + fileList.length + ", sentFileList:" + sentFileList.length + ", newFileList:" + newFileList.length + ", inputFileList:" + inputFileList.length);
                                     
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
                        canvas.width = 2000;
                        canvas.height = 2000;
                        // canvas.width = 2400;
                        // canvas.height = 2400;
                        // canvas.width = 3000;
                        // canvas.height = 3000;
                        // canvas.width = 1100;
                        // canvas.height = 1100;
                        // canvas.width = 1200;
                        // canvas.height = 1200;
                        // canvas.width = 640;
                        // canvas.height = 640;
                        reader = "";
                        // console.log("reset canvas");
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