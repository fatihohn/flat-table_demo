<?php
//$_SESSION에서 USER DATA 불러오기
$wi_id="tmp";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product-Uploader-test</title>


    <link rel="stylesheet" type="text/css" href="/trix-master/dist/trix.css">
    <link rel="stylesheet" type="text/css" href="/css/uploader.css">
    <script type="text/javascript" src="/trix-master/dist/trix.js"></script>
    <script type="text/javascript" src="/trix-master/dist/attachments.js"></script>
    <!-- <script type="text/javascript" src="/js/image_uploader.js"></script> -->
    <!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
</head>


<body>
    <section id="sc">
        <div class="contEditor">
            <button name="cancel"><a href = "javascript:history.back()"  class="cancel_btn">취소</a></button>
            <center>
                <h3>판매글 작성</h3>
            </center>
            <form class="createForm" action="new_product_action.php" method="POST" enctype="multipart/form-data">
                <input class="createGrid2" name="wi_id" type="hidden" value="<?=$wi_id?>" />
                
                <!-- <p>
                    <div class="createInput">
                        <label class="createGrid1">상품이미지</label>
                       
                    </div>
                </p> -->
                <p>
                    <div class="createInput">
                        <ul id="file-list-display" class="image-list">
                            <li class="locked" draggable="false">
                                이미지 등록
                                <input id="file-input" type="file" accept="image/jpg, image/jpeg, image/png" multiple="">
                            </li>
                        </ul>
                        
                        <input id="file-container" type="hidden" name="images" value="">
                    </div>
                </p>
                <p>
                    <div class="createInput">
                        <!-- <label class="createGrid1">제목</label> -->
                        <input class="createGrid2" name="title" placeholder="제목" required />
                    </div>
                </p>
                <p>
                    <div class="category_wraper">
                        <div class="category_selector">
                            <div class="category_level group0">
                                <ul class="group0_ul">
                                    <li class="group0_li">
                                        <button type="button" class="category_btn group0_btn">여성의류</button>
                                    </li>
                                    <li class="group0_li">
                                        <button type="button" class="category_btn group0_btn">패션잡화</button>
                                    </li>
                                    <li class="group0_li">
                                        <button type="button" class="category_btn group0_btn">남성의류</button>
                                    </li>
                                    <li class="group0_li">
                                        <button type="button" class="category_btn group0_btn">디지털/가전</button>
                                    </li>
                                    <li class="group0_li">
                                        <button type="button" class="category_btn group0_btn">도서/티켓/취미/애완</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="category_level group1">중분류 선택</div>
                            <div class="category_level group2">소분류 선택</div>
                        </div>
                        <h3 class="category_selected">선택한 카테고리 : <b></b></h3>
                        <input type="hidden" name="categories" value="1">
                    </div>
                </p>
                <p>
                    <div class="createInput">
                        <!-- <div class="admin_editor trix-content">
                            <input id="x" type="hidden" name="content">
                            <trix-editor input="x"></trix-editor>
                        </div> -->
                        <textarea name="detail" id="detail-input" cols="60" rows="20"></textarea>
                    </div>
                </p>
                <p>
                    <input type="hidden" name="price" value="1">
                    <input type="hidden" name="model_info" value="iphone8">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="location" value="seoul">
                    <input type="hidden" name="tag" value="real">
                    <input type="submit">   
                </p>
            </form>   
        </div>
    </section>

    <script>
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
                var prodImgs = document.querySelectorAll(".product_img");
                for(const pImg of prodImgs) {
                    pImg.remove();
                }
                    // console.log(newFileList);
                    newFileList.forEach(function (newFileName, index) {
                        var fileDisplayEl = document.createElement('li');
                    fileDisplayEl.innerHTML = '<img src="/uploads/' + newFileName + '">';
                    fileDisplayEl.setAttribute("class", 'product_img');
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
                request.open("POST", '/upload_image.php');
                request.send(formData);
                request.onreadystatechange = function() { // 요청에 대한 콜백
                    if (request.readyState === request.DONE) { // 요청이 완료되면
                        if (request.status === 200 || request.status === 201) {
                            newFileList.push(request.responseText); // 바뀐 이름 stack
                            // console.log(newFileList.length + ':' + sentFileList.length);
                            if(newFileList.length === sentFileList.length) {
                                renderFileList();
                                resetInputValue("file-container", newFileList);
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
            draggable: ".product_img",
            onEnd:function (evt) {
                var sortedImgs = document.querySelectorAll(".product_img");
                newFileList = [];
                for(let pImg of sortedImgs) {
                    let pImgSrc = pImg.firstChild.src;
                    let pImgDir = pImgSrc.split("/")[4];
                    
                    newFileList.push(pImgDir);
                    resetInputValue("file-container", newFileList);
                }
            }
        });

        //fill form input
        resetInputValue = function(id, val) {
            document.getElementById(id).value = val;
        }
    </script>
</body>

</html>