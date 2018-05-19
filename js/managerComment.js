$("tbody").on("click","input[name='show']",function(){
    var isShow=confirm("是否展示？");
    if(isShow){
        var commentID=$(this.parentNode.parentNode).attr("commentID");
        var data=new FormData();
        data.append("commentID",commentID);
        data.append("action","update");
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                //parent.window.refreshFrame();
                history.go(0);
            }
        };
        xhr.open("post","commentAction.php",true);
        xhr.send(data);
    }
});

$("tbody").on("click","input[name='del']",function(){
    var isDel=confirm("是否删除？");
    if(isDel ){
        var commentID=$(this.parentNode.parentNode).attr("commentID");
        var data=new FormData();
        data.append("commentID",commentID);
        data.append("action","delete");
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                //document.frames("content").document.location.reload();
                //refreshFrame();
                history.go(0);
            }
        };
        xhr.open("post","commentAction.php",true);
        xhr.send(data);
    }
});