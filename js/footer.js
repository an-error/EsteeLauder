$(".second").eq(2).find("li").click(function(){
    console.log("hi");
    $(".weixin img").css("display","block");
});


$(".weixin img").mouseleave(function(){
    $(".weixin img").css("display","none");
})

$("button[name='to-subscribe']").click(function(){
    var email= $("input[name='subscribe']").val();
    console.log(email);
    if(email){
        var regExp=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        var result=regExp.test(email);
        if(result){
            confirm("谢谢订阅！");
        }
    }
})
