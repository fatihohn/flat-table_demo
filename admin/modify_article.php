<?php
    include '../bbps_db_conn.php';   


    // $sessionUser = $_SESSION['username'];
    $sessionUser = "tmp_name";
    // $sql_user_data = "SELECT * FROM user_data WHERE username= '$sessionUser'";
    // $result_user_data = $conn->query($sql_user_data);
    // $rows_user_data = mysqli_fetch_assoc($result_user_data);
    
    // $username = $rows_get_user['username'];
    $username = $sessionUser;


    $q = intval($_GET["q"]);

    $sql_article_data = "SELECT * FROM articles WHERE id = $q";
    $result_article_data = $conn->query($sql_article_data);
    $rows_article = mysqli_fetch_assoc($result_article_data);

    $title = $rows_article["title"];
    $address = $rows_article["table_address"];
    // $imgList = explode(",", $rows_article["imgs"]);

    $imgs = $rows_article["imgs"];
    
    $comment = $rows_article["comment"];
    $comment = htmlspecialchars($comment);
    $content = $rows_article["content"];
    $content = htmlspecialchars($content);
    $photographer = $rows_article["photographer"];
    $words = $rows_article["words"];
    $flag = $rows_article["flag"];
    $about = $rows_article["about"];

    $article_tag_list = array();

    $sql_get_tags = "SELECT * FROM article_tag_map WHERE article_id = $q";
    $result_get_tags = mysqli_query($conn, $sql_get_tags);
    while($row_get_tags = $result_get_tags->fetch_assoc()) {
        $sql_get_tag_names = "SELECT tag_name FROM tags WHERE id = {$row_get_tags['tag_id']}";
        $result_get_tag_names = mysqli_query($conn, $sql_get_tag_names);
        $row_get_tag_names = mysqli_fetch_assoc($result_get_tag_names);
        array_push($article_tag_list, $row_get_tag_names['tag_name']);
    }






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head_new_article.php'?>
    <!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <!-- <script type="text/javascript" src="../trix-master/dist/attachments.js"></script> -->
</head>
<body>
    <?php include 'header.php'?>
    <?php include 'nav.php'?>

    <div id="overlay" class="overlay"></div>
    <!-- @yield ('content') -->
    <form action="modify_article_action.php" method="post" enctype="multipart/form-data">
    <section class="article_main">
        <div class="main">
            <div class="article_container container">
                    <header class="article_header">
                        <input id="title" type="text" name="title" placeholder="제목" value="<?=$title?>" required/>
                        <div class="article_info">
                            <p class="article_address">
                                <!-- {{-- 경기도 동두천시 상봉암동 153-15 --}} -->
                                <input id="address" type="text" name="address" placeholder="주소" value="<?=$address?>" required />
                            </p>
                            <!-- <p class="category"> -->
                                <!-- <a href="#">
                                    주민모임형
                                </a> -->
                                <!-- <input type="text" id="hashtags" placeholder="태그" autocomplete="off">
                                <div class="tag-container"></div>
                                <input id="category_container" type="hidden" name="categories" value="" />
                            </p> -->
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
                    
                    
                    <input id="file-container" type="hidden" name="imgs" value="<?=$imgs?>">
                </div>
                <div class="article_text">
                    <div class="article_comment">
                        <!-- <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo temporibus consequuntur quibusdam quos! Maxime quam dicta quas, fugit velit eaque rem consequuntur, labore distinctio amet odio asperiores veritatis odit nesciunt?
                        </p> -->
                            <textarea name="comment" id="article_comment_input" cols="40" rows="5" style="width:100%;" required><?=$comment?></textarea>
                        
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
                            <input id="x" value="<?=$content?>" type="hidden" name="content">
                            <trix-editor input="x" required></trix-editor>
                        </div>
                    </div>
                    <footer class="article_footer">
                        <div class="article_auth">
                            <p class="photo">
                                사진
                                <span>
                                    <input id="photographer" type="text" name="photographer" value="<?=$photographer?>">
                                </span>
                            </p>
                            <p class="words">
                                글
                                <span>
                                    <input id="words" type="text" name="words" value="<?=$words?>" required>
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
                        <input id="about_input" type="hidden" name="about" value="no">
                        <input type="hidden" name="username" value="<?=$username?>">
                        <input type="hidden" name="id" value="<?=$q?>">
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
            flagInput = document.querySelector("#flag");
            aboutInput = document.querySelector("#about");
            flagVal = "<?=$flag?>";
            aboutVal = "<?=$about?>";
            if(flagVal == "on") {
                flagInput.checked = true;
                aboutInput.checked = false;
            }
            if(aboutVal == "on") {
                aboutInput.checked = true;
                flagInput.checked = false;
            }
            aboutInput.disabled = true;

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
                } else if(aboutInput.checked == true && aboutInput.disabled !== true) {
                    flagInput.checked = false;
                    flagInput.disabled = true;
                }
            };
        })();
    </script>
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

            var articleTagList = "<?=join(",",$article_tag_list)?>";
            articleTagList = articleTagList.split(",");//to javascript array
               

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
                                    console.log(finder.responseText);
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

            if(articleTagList.length > 0) {
                articleTagList.forEach((tag) => {
                    addTags(tag);
                    tagListWrap.appendChild(tagListUl);
                    renderTagList(addTagDelBtn);
                    limitInput(); 
                });
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
                checkStrLen(40, titleInput);
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
        //image related
        (function () {
            var fileList = [];//전송 준비용
            var newFileList = [];//디스플레이->저장용
            var sentFileList = [];//전송 확인용
            newFileList = "<?=$imgs?>";//디스플레이->저장용
            newFileList = newFileList.toString();
            newFileList = newFileList.split(",");
            sentFileList = "<?=$imgs?>";//전송 확인용
            sentFileList = sentFileList.toString();
            sentFileList = sentFileList.split(",");
            // var inputFileList = [];//입력된 모든 파일
            var inputFileList = newFileList.slice(0, newFileList.length);//입력된 모든 : 초기 로딩 속도 개선파일: newFileList 복제
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
                renderFileList();
                // renderFileList("thumbs");//기존 이미지는 thumbs 폴더에서 불러오기: 초기 로딩 속도 개선
                // renderFileList("uploads");
                
                sendFileList = function() {
                    // console.log(inputFileList);
                    // console.log(sentFileList);
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
                    var compressRate, maxQuality, anchorSize, imgQuality, percentage;
                    console.log("file loaded");
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
                        console.log(file.size);
                        // percentage = 95/(file.size/100000000 + 100);
                        // console.log(percentage*100);
                    reader.addEventListener("load", function () {
                        console.log("loading image");
                        if(reader.result.startsWith("data:image")) {
                            imgSource.src = reader.result;
                            imgSource.onload = function () {
                                console.log("image loaded");

                                // var imgRes = imgSource.width + imgSource.height;
                                // var canvasRes = canvas.width * 2;
                                //     // compressRate = ((imgRes/canvasRes)*(1000000/file.size) + 100)/(file.size/80000 + 100);
                                //     compressRate = ((imgRes/canvasRes)*(1000000/file.size) + 100)/(file.size/1000000 + 100);
                                //     if(compressRate > 1) {
                                //         percentage = 0.95;
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



                                    // // // compressRate = ((imgRes/canvasRes)*(1000000/file.size) + 100)/(file.size/80000 + 100);
                                    // // compressRate = ((imgRes/canvasRes)*(1000000/file.size) + 100)/(file.size/1000000 + 100);
                                    // if(compressRate > 1) {
                                    //     percentage = 0.95;
                                    // } else {
                                    //     percentage = compressRate;
                                    // }






                                    // console.log(imgRes);
                                    // console.log(compressRate);
                                    // console.log(canvasRes);
                                    console.log("imgQuality: "+imgQuality);
                                    console.log("originalImgQuality: "+originalImgQuality);
                                    console.log("imgResRt: "+Math.floor(1000*Math.pow(imgResRt/8, 4))/1000);
                                    console.log("percentage: "+percentage*100 + "%");


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
                                ctx.drawImage(imgSource, 0, 0, imgSource.width, imgSource.height,0, 0, canvas.width, canvas.height);
                                console.log("img drawn on canvas");
                                canvas.toBlob(function(blob) {
                                    var fileNameBody;
                                    fileNameBody = file.name.split(".");
                                    fileNameBody.pop();
                                    fileNameBody.join();
                                    var compressedImg = new File([blob], fileNameBody + ".jpg", {lastModified: file.lastModified, type: "image/jpeg"});//blob->file
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
                        request.open("POST", './upload_image.php?q='+'<?=$wi_id?>');
                        request.send(formData);
                        request.onreadystatechange = function() { // 요청에 대한 콜백
                            if (request.readyState === request.DONE) { // 요청이 완료되면
                                if (request.status === 200 || request.status === 201) {
                                    console.log("got server response data");
                                    pushToNewFileList(afterPushToNewFileList);
                                    
                                    function afterPushToNewFileList() {
                                        // renderFileList("uploads");
                                        renderFileList();
                                        resetInputValue("file-container", newFileList);
                                        resetCanvas(imgSource,  canvas);
                                        sentFileList.push(file.name);
                                        console.log(file.size);

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
                        canvas.width = 2000;
                        canvas.height = 2000;
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
                                
                // ////<<<<<<<<ORIGINAL CODE>>>>>>>>>>>>////
                //     sendFile = function (file) {
                //         var formData = new FormData();
                //         var request = new XMLHttpRequest();
                //         formData.append('file', file);
                //         request.open("POST", './upload_image.php');
                //         request.send(formData);
                //         request.onreadystatechange = function() { // 요청에 대한 콜백
                //             if (request.readyState === request.DONE) { // 요청이 완료되면
                //                 if (request.status === 200 || request.status === 201) {
                //                     newFileList.push(request.responseText); // 바뀐 이름 stack
                //                     // console.log(newFileList.length + ':' + sentFileList.length);
                //                     // if(newFileList.length === sentFileList.length) {
                //                         renderFileList();
                //                         resetInputValue("file-container", newFileList);
                //                     // }
                //                 } else {
                //                     console.error(request.responseText);
                //                 }
                //             }
                //         };
                //     };
                // ////<<<<<<<<ORIGINAL CODE>>>>>>>>>>>>////
            




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
            setThumbImg("article_img_figure");
        })();
        


    </script>



<!-- 

    <script>
        //file transfer, render list
        var fileList = [];//전송 준비용
        var newFileList = [];//디스플레이->저장용
        var sentFileList = [];//전송 확인용
        newFileList = "<?//=$imgs?>";//디스플레이->저장용
        newFileList = newFileList.toString();
        newFileList = newFileList.split(",");
        sentFileList = "<?//=$imgs?>";//전송 확인용
        sentFileList = sentFileList.toString();
        sentFileList = sentFileList.split(",");
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
            renderFileList();
            


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
        setThumbImg("article_img_figure");




    </script> -->
</body>
</html>