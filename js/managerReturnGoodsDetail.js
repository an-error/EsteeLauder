$("img").each(function(){
    if($(this).attr("src")===""){
        $(this).css("display","none");
    }
});

$(".return-img-content").on("click","img",function(){
    $(".return-img-content").find("div").html("<img src='"+this.getAttribute('src')+"'/>");
    $(".return-img-content").find("div").css("display","block");
});

$(".return-img-content div").mouseleave(function(){
    $(this).css("display","none");
})


$(".content").on("click","input[name='access']",function(){
    var data=new FormData();
    data.append("access",this.value);
    var returnID=this.parentNode.parentNode.getAttribute("returnID");
    data.append("returnID",returnID);
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){

            //parent.window.refreshFrame();
            //parent.location.reload();
            history.go(0);
        }
    };
    xhr.open("post","managerReturnGoodsAccess.php",true);
    xhr.send(data);
})

$(".content").on("click","input[name='display-back']",function(){
    $(".display-back").css("display","block");
    $(this).attr("name","to-back");
})

$(".content").on("click","input[name='to-back']",function(){
    var delivery=document.getElementsByName('express')[0].value;
    if(delivery===""){
        alert("请输入快递单号");
    }else{
        var data=new FormData();
        var returnID=document.getElementsByClassName("content")[0].getAttribute("returnID");
        data.append("returnID",returnID);
        data.append("delivery",delivery);
        data.append("access","退回");
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                //parent.window.refreshFrame();
                //parent.location.reload();
                history.go(0);
            }
        };
        xhr.open("post","managerReturnGoodsAccess.php",true);
        xhr.send(data);
    }
});

$(".content").on("click","input[name='confirm']",function(){
    var isReceiver=confirm("是否确认收货？");
    if(isReceiver){
        var data=new FormData();
        var returnID=document.getElementsByClassName("content")[0].getAttribute("returnID");
        data.append("returnID",returnID);
        data.append("access","退款");
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                //parent.location.reload();
                history.go(0);
            }
        };
        xhr.open("post","managerReturnGoodsAccess.php",true);
        xhr.send(data);
    }

})