
window.onload=function(){
    var imgs=document.getElementById("imgs");
    var button=document.getElementById('button');
    var imgUL=imgs.getElementsByTagName("ul")[0];
    var buttonUL=button.getElementsByTagName("ul")[0];
    var pre=document.getElementById("pre");
    var next=document.getElementById("next");
    var index=0;
    function action(index){
        var li=buttonUL.getElementsByTagName("li");
        for(var i=0;i<li.length;i++){
            li[i].getElementsByTagName("span")[0].classList="rest";
        }
        li[index].getElementsByTagName("span")[0].classList="current";
    }

    pre.onclick=function(){
        imgUL.style.left=(parseInt(imgUL.offsetLeft)+1705)+"px";
        index-=1;
        if(parseInt(imgUL.style.left)>-1705){
            imgUL.style.left=-1705*5+"px";
            index=4;
        }
        action(index);
        //console.log(imgUL.offsetLeft);
    };

    next.onclick=function(){
        imgUL.style.left=(parseInt(imgUL.offsetLeft)-1705)+"px";
        index+=1;
        if(parseInt(imgUL.style.left)<-1705*5){
            imgUL.style.left=-1705+"px";
            index=0;
        }
        action(index);
        //console.log(imgUL.offsetLeft);
    };

    var timer;
    function play(){
        timer=setInterval(function(){
            next.onclick();
        },2000);
    }

    play();
    function stop(){
        clearInterval(timer);
    }

    $("#button li a span").click(function(){
        var imgUl=$("#imgs ul")[0];
        var i=this.getAttribute("index");
        console.log("点击："+(i-1));
        imgUl.style.left=-1705*i+"px";
        console.log(imgUl.style.left);
        index=i-1;
        action(i-1);
    });

    $("#wrapper").mouseover(function(){
        $("#pre").css("display","block");
        $("#next").css("display","block");
    });
    $("#wrapper").mouseout(function(){
        $("#pre").css("display","none");
        $("#next").css("display","none");
    });

}