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
    <script type="text/javascript" src="/trix-master/dist/trix.js"></script>
    <script type="text/javascript" src="/trix-master/dist/attachments.js"></script>
    <!-- <script type="text/javascript" src="/js/image_uploader.js"></script> -->
</head>


<body>
    <section id="sc">
        <div class="contEditor">
            <button name="cancel"><a href = "javascript:history.back()"  class="cancel_btn">취소</a></button>
            <center>
                <h3>판매글 작성</h3>
            </center>
            <form class="createForm" action="create_product_action.php" method="POST" enctype="multipart/form-data">
                <input class="createGrid2" name="wi_id" type="hidden" value="<?=$wi_id?>" />
                <p>
                    <div class="createInput">
                        <!-- <label class="createGrid1">제목</label> -->
                        <input class="createGrid2" name="title" placeholder="제목" required />
                    </div>
                </p>
                <!-- <p>
                    <div class="createInput">
                        <label class="createGrid1">상품이미지</label>
                       
                    </div>
                </p> -->
                <p>
                    <div class="createInput">
                        <!-- <ul id="file-list-display"> -->
                        <ul >
                            <li>
                                이미지 등록
                                <input id="file-input" type="file" accept="image/jpg, image/jpeg, image/png" multiple="">
                            </li>
                            <div id="file-list-display"></div>
                            <!-- 여기에 업로드 된 이미지들이 들어감 & 드래그 순서변경 기능 필요 -->
                        </ul>
                        <div>
                            <b>* 상품 이미지는 640x640에 최적화 되어 있습니다.</b>
                            - 이미지는 상품등록 시 정사각형으로 잘려서 등록됩니다.<br>
                            - 이미지를 클릭 할 경우 원본이미지를 확인할 수 있습니다.<br>
                            - 이미지를 클릭 후 이동하여 등록순서를 변경할 수 있습니다.<br>
                            - 큰 이미지일경우 이미지가 깨지는 경우가 발생할 수 있습니다.<br>
                            최대 지원 사이즈인 640 X 640 으로 리사이즈 해서 올려주세요.(개당 이미지 최대 10M)
                        </div>
                        
                    </div>
                </p>
                <p>
                    <div class="createInput">
                        <div class="admin_editor trix-content">
                            <input id="x" type="hidden" name="content">
                            <trix-editor input="x"></trix-editor>
                        </div>
                    </div>
                </p>
                <p>
                    <input type="submit">   
                </p>
            </form>   
        </div>
    </section>

    <script>
        (function () {
            var fileInput = document.getElementById('file-input');
            var fileListDisplay = document.getElementById('file-list-display');
            
            var fileList = [];//전송용
            var newFileList = [];//디스플레이->저장용
            var renderFileList, sendFile, sendFileList;
            
            fileInput.addEventListener('change', function (evnt) {
                fileList = [];
                for (var i = 0; i < fileInput.files.length; i++) {
                    fileList.push(fileInput.files[i]);
                }

            // //기존 코드(concurrent)

            //     // //파일 전송 forEach
            //     // fileList.forEach(function (file) {
            //     //     sendFile(file);
            //     // });

            //     //파일 전송 for of
            //     for (const file of fileList) {
            //         sendFile(file);
            //     };

            //     //화면 표시->promise async await program needed
            //     // renderFileList();
            //     setTimeout(() => {
            //         renderFileList();
            //     }, 300);//...임시방편
            //     //callback method needed-> async&await method 구현
            //     //fileList.forEach(sendFile())->renderFileList()

            // //기존 코드 끝

            
            // //Promise phrase
            
            async function myFetch() {
                let response = await sendFileList();

                if (!response) {
                    // throw new Error(`HTTP error! status: ${response.status}`);
                } else {
                    // let myBlob = await response.blob();

                    // let objectURL = URL.createObjectURL(myBlob);
                    // let image = document.createElement('img');
                    // image.src = objectURL;
                    // document.body.appendChild(image);
                    return renderFileList();
                }
            }

            myFetch()
            .catch(e => {
            console.log('There has been a problem with your fetch operation: ' + e.message);
            });


            //     (function () {
            //         function showRenderedFileList() {
            //             return new Promise(resolve => {
            //                 setTimeout(() => {
            //                 // resolve('resolved');
            //                 resolve(
            //                     renderFileList()
            //                 );
            //                 }, 100);
            //             });
            //         }

            //         async function asyncCall() {
            //         // console.log('calling');
            //             fileList.forEach(function (file) {
            //                 sendFile(file);
            //             });
            //         // const result = await showRenderedFileList();
            //         // console.log(result);
            //         await showRenderedFileList();
            //         // return result;
            //         // expected output: "resolved"
            //         }
            //     })();
            // //promise phrase end

            });

            renderFileList = async function () {
                fileListDisplay.innerHTML = '';
                newFileList.forEach(function (newFileName) {
                    var fileDisplayEl = document.createElement('li');
                fileDisplayEl.innerHTML = '<img src="../uploads/' + newFileName + '">';
                fileListDisplay.appendChild(fileDisplayEl);
                });
            };
            
            sendFileList = async function() {
                //파일 전송
                // fileList.forEach(function (file) {
                //     sendFile(file);
                // });
                for (const file of fileList) {
                    sendFile(file);
                };
            };

            sendFile = async function (file) {
                var formData = new FormData();
                var request = new XMLHttpRequest();
                formData.append('file', file);
                request.open("POST", './upload_image.php');
                request.send(formData);
                
                request.onreadystatechange = function() { // 요청에 대한 콜백
                    if (request.readyState === request.DONE) { // 요청이 완료되면
                        if (request.status === 200 || request.status === 201) {
                            newFileList.push(request.responseText); // 바뀐 이름 stack
                        } else {
                            console.error(request.responseText);
                        }
                    }
                };
            };

        })();
    </script>
    <!-- <script>
        (function () {

            function createFormData(file) {
                var data = new FormData()
                data.append("Content-Type", file.type)
                data.append("file", file)
                return data
            }
        })();
    </script> -->



    <!-- <script>
        (function() {
            var IMGHOST = "/upload_image.php"
        
            document.querySelector("#image_uploader").addEventListener("change", function(event) {
                console.log(event)
                if (event.attachment.file) {
                    uploadFileAttachment(event.attachment)
                }
            })
        
            function uploadFileAttachment(attachment) {
                uploadFile(attachment.file, setProgress, setAttributes)
        
                function setProgress(progress) {
                    attachment.setUploadProgress(progress)
                }
        
                function setAttributes(attributes) {
                    attachment.setAttributes(attributes)
                }
            }
        
            function uploadFile(file, progressCallback, successCallback) {
                var formData = createFormData(file)
                var xhr = new XMLHttpRequest()
        
                xhr.open("POST", IMGHOST, true)
        
                xhr.upload.addEventListener("progress", function(event) {
                    var progress = event.loaded / event.total * 100
                    progressCallback(progress)
                })
        
                xhr.addEventListener("load", function(event) {
                    var attributes = {
                        url: xhr.responseText,
                        // href: xhr.responseText + "?content-disposition=attachment"
                    }
                    successCallback(attributes)
                })
        
                xhr.send(formData)
            }

            function createFormData(file) {
                var data = new FormData(document.getElementById("#image_uploader"))
                data.append("Content-Type", file.type)
                data.append("file", file)
                return data
            }
        })();
    </script> -->
</body>

</html>
<!-- <div>
    <ul>
        <li>
            이미지 등록
            <input id="image_uploader" type="file" accept="image/jpg, image/jpeg, image/png" multiple="">
        </li>
    </ul>
    <div>
        <b>* 상품 이미지는 640x640에 최적화 되어 있습니다.</b>
        - 이미지는 상품등록 시 정사각형으로 잘려서 등록됩니다.<br>
        - 이미지를 클릭 할 경우 원본이미지를 확인할 수 있습니다.<br>
        - 이미지를 클릭 후 이동하여 등록순서를 변경할 수 있습니다.<br>
        - 큰 이미지일경우 이미지가 깨지는 경우가 발생할 수 있습니다.<br>
        최대 지원 사이즈인 640 X 640 으로 리사이즈 해서 올려주세요.(개당 이미지 최대 10M)
    </div>
    <div>
        <div>
            <button type="button">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEQAAABACAYAAACjgtGkAAAAAXNSR0IArs4c6QAAAolJREFUeAHl20tSxCAQANCJW12ql3DtKTxE9GQ6h/AU7j2EutT12J1qUowhCZ/+AFLFgIEU9pvApjPDAcrpdLqH5gHqJ9TjMAzf0HZfIO4rCHKEegP1FeJ+u6Co36H9oIGRJtJQn80fDIwdDQ6DCxcmXEIftW6hdv2kBDBwV/ygxQyCf/wHlC2MBUjvKHsYQZBeUWIwVkF6Q4nF2ATpBSUFYxekdZRUjCiQVlFyMKJBWkPJxUgCaQWlBCMZpHaUUowskFpRODCyQWpD4cIoAqkFhROjGMQahRuDBcQKRQKDDUQbRQqDFUQLRRKDHUQaRRpDBEQKRQNDDIQbRQtDFIQLRRNDHKQURRtDBSQXxQJDDSQVxQpDFSQWxRJDHWQPxRrDBGQNBa9DcYlnzLXO6cVpROnjLJWptOa0DDwNfi75i9a+htYMA/8HMxBcnFCeoIsQWBDm2SWepyvKH+51COVl5+VCX0jo2nyDdMcMxDtA8enAJwMr9kcag65+Mfk2PAx8c2c6Myh08/dT1EFCGO7MgDH/oDV5aUcVZAvDbQ5rFDWQGIwaUFRAUjCsUcRBcjAsUURBSjCsUMRAODAsUERAODG0UdhBJDA0UVhBJDG0UNhANDA0UFhANDGkUYpBLDAkUYpALDGkULJBasCQQMkCqQmDGyUZpEYMTpQkkJoxuFCiQVrA4ECJAmkJoxRlF6RFjBKUTZCWMXJRVkF6wMhBCSaqesJAFEpzHKGLOSDMBY0QI6Y8FmUBQhNdFt7lRqYf+S7ubuiCh4IxIcpjCOVsy9CER7oBb3xxSSTod1H2YpxB9iZ2oUFBbMU6gWxN6AnCj2UtZneG3MFk3FddbhMfwvUDZwoaHH4B+xHVOFecBB4AAAAASUVORK5CYII=" width="34" height="32" alt="닫기 버튼 아이콘">
            </button>
            <div>
                <div>
                    상품이미지
                </div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
</div> -->