<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
        #preview,
        .img,
        img {
            width: 200px;
            height: 200px;
        }

        #preview {
            border: 1px solid #000;
        }
    </style>
</head>

<body>
<div id="preview"></div>
<input type="file" onchange="preview(this)" />
<!--<script type="text/javascript">
    function preview(file) {
        var prevDiv = document.getElementById('preview');
        if (file.files && file.files[0]) {
            var reader = new FileReader();
            reader.onload = function(evt) {
                prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
            }
            reader.readAsDataURL(file.files[0]);
        } else {
            prevDiv.innerHTML = '<div class="img" ' +
                'style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(' +
                'sizingMethod=scale,src=\'' + file.value + '\'"></div>';
        }
    }
</script>-->
<script>
function uploadMulFile(uploadFile) {
var fileLength = 0;
var reader = new FileReader();
reader.readAsDataURL(uploadFile[fileLength]);

reader.onload = function(e) {
if(e.target.result) {
console.log("完成" + uploadFile[fileLength].name);
fileLength++;
if(fileLength < uploadFile.length) {
reader.readAsDataURL(uploadFile[fileLength]);
} else {
//do something
}
}
};
}
</script>
</body>
</html>