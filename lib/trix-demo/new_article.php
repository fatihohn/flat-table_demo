<?php
//$_SESSION에서 USER DATA 불러오기
$wi_id="tmp";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trix-test</title>


    <link rel="stylesheet" type="text/css" href="/trix-master/dist/trix.css">
    <script type="text/javascript" src="/trix-master/dist/trix.js"></script>
    <script type="text/javascript" src="/trix-master/dist/attachments.js"></script>
</head>


<body>
    <section id="sc">
        <div class="contEditor">
            <button name="cancel"><a href = "javascript:history.back()"  class="cancel_btn">취소</a></button>
            <center>
                <h3>게시물 작성</h3>
            </center>
            <form class="createForm" action="trix_action.php" method="POST" enctype="multipart/form-data">
                <input class="createGrid2" name="wi_id" type="hidden" value="<?=$wi_id?>" />
                <p>
                    <div class="createInput">
                        <!-- <label class="createGrid1">제목</label> -->
                        <input class="createGrid2" name="title" placeholder="제목" required />
                    </div>
                </p>
                <p>
                    <div class="createInput">
                        <!-- <label class="createGrid1">내용</label> -->
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
    <!-- <script>
        //레퍼런스 코드
        (function() {
            var HOST = "localhost/trix-master/upload.php"

            addEventListener("trix-attachment-add", function(event) {
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
                var key = createStorageKey(file)
                var formData = createFormData(key, file)
                var xhr = new XMLHttpRequest()

                xhr.open("POST", HOST, true)

                xhr.upload.addEventListener("progress", function(event) {
                var progress = event.loaded / event.total * 100
                progressCallback(progress)
                })

                xhr.addEventListener("load", function(event) {
                if (xhr.status == 204) {
                    var attributes = {
                    url: HOST + key,
                    href: HOST + key + "?content-disposition=attachment"
                    }
                    successCallback(attributes)
                }
                })

                xhr.send(formData)
            }

            function createStorageKey(file) {
                var date = new Date()
                var day = date.toISOString().slice(0,10)
                var name = date.getTime() + "-" + file.name
                return [ "tmp", day, name ].join("/")
            }

            function createFormData(key, file) {
                var data = new FormData()
                data.append("key", key)
                data.append("Content-Type", file.type)
                data.append("file", file)
                return data
            }
        })();
    </script> -->
</body>

</html>
