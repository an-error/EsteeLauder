document.getElementsByName("toAccount")[0].onclick=function(){
    var isPay=confirm("是否支付？");
    var data=new FormData();
    data.append("isPay",isPay);
    var text=document.getElementsByTagName("textarea")[0].value;
    data.append('text',text);
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){
            document.getElementById("shopping").innerHTML="";
            location="order.php"
        }
    };
    xhr.open("post","addOrder.php",true);
    xhr.send(data);
}

$("#cart").click(function(){
    $("#shopping").css("display","none");
})