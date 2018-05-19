//textarea高度根据内容变换
var textarea=document.getElementsByTagName("textarea")[0];
textarea.style.height=textarea.scrollHeight+'px';


//点击背景时display：
var background=document.getElementById("background");
var loginBackground=document.getElementsByClassName('background')[0];
var shopping=document.getElementById('shopping');
window.onclick=function(e){

    if(e.target===background){
        background.style.display="none";
    }
    if(e.target===loginBackground){
        loginBackground.style.display="none";
    }
    if(e.target===shopping){
        shopping.style.display="none;"
    }


};

function colour(price,stock,name,color){
    $("#price").html("￥"+price);
    $("#name span:first").css('background-color',color);
    $("#name span:last").text(name);
    $("#buy").attr('stock',stock);
    if(stock<=0){
        $("#buy").css("display","none");
        $(".lack").css("display",'block');
    }else{
        $("#buy").css("display","block");
        $(".lack").css("display",'none');
    }
}

$("#name").click(function(){
    $("#color-select").css("display","block");
});



$("#color-select").hover(function(){
    $("#color-select").css('display','block');
},function(){
    $("#color-select").css('display','none');
});



$("input[type='number']").change(function(){
    console.log(this.value);
    var stock=$('#buy').attr('stock');
    console.log("stock:"+stock);
    if(this.value>6 && stock>6){
        this.value="6";
    }
    if(this.value<0){
        this.value="1";
    }

    if(this.value>stock && stock<6){
        this.value=stock;
    }

    var re=/^[0-9]+.?[0-9]*$/;
    if(!re.test(this.value)){
        this.value="1";
    }
});




$("#name").bind('DOMSubtreeModified',function(){
    $("input[name='count']").val("1");
});

//获取加入购物车的数据




function getProductionData(){
    var formData=new FormData();
    var data=[];
    data['title1']=$("#title1").text();
    data['title2']=$("#title2").text();
    data['price']=$("#price").text();
    data['size']=$(".content p:first").text();
    data['img']=$("#main-img").attr("src");
    formData.append("title1",data['title1']);
    formData.append("title2",data['title2']);
    formData.append("price",data['price']);
    formData.append("size",data['size']);
    formData.append("img",data['img']);
    if($("#name").length!==0){
        data['colour_name']=$("#name span").eq(1).text();
        data['colour_num']=$("#name span:first").css("backgroundColor");
        data['colour_num']=toRGB(data['colour_num']);
        data['count']=$("input[name='count']").val();
        data['stock']=$("#buy").attr("stock");
        formData.append("colour_name",data['colour_name']);
        formData.append("colour_num",data['colour_num']);
        formData.append("count",data['count']);
        formData.append("stock",data['stock']);
    }

    return formData;
}

var shoppingHTML="";

//加入购物车
document.getElementsByName("addToCart")[0].onclick=function(){
    var Data;
    if(document.getElementById('name') && document.getElementById('name').getElementsByTagName('span')[1].innerText){
        Data=getProductionData();
    }else if(document.getElementById('name')===null){
        Data=getProductionData();
    }else{
        alert("请选择色号！");
    }

    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){
            var result=JSON.parse(this.responseText);
            var shopping=document.getElementById('shopping');
            shopping.innerHTML=result['html'];
            shopping.style.display="block";
        }
    };
    xhr.open("post","addCart.php",true);
    xhr.send(Data);

};

window.onload=function(){
    if(shoppingHTML!==""){
        document.getElementById('shopping').innerHTML=shoppingHTML;
    }
};


document.getElementsByName('buy')[0].onclick=function(){
    var Data;
    if(document.getElementById('name') && document.getElementById('name').getElementsByTagName('span')[1].innerText){
        Data=getProductionData();
    }else if(document.getElementById('name')===null){
        Data=getProductionData();
    }else{
        alert("请选择色号！");
    }

    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){
            location.href="settleAccounts.php";
        }
    };
    xhr.open("post","toBuy.php",true);
    xhr.send(Data);
};


$(function(){
    $("img").each(function(){
        if($(this).attr('src')===""){
            $(this).css("display","none");
        }
    })
})

$(".comment-content-img").on("click","img",function(){
    $(".comment-content-big-img").each(function(){
        $(this).css("display","none");
    });
    var path=$(this).attr("src");
    var temp="<img src='"+path+"'/>";
    $(this.parentNode).find('.comment-content-big-img').html(temp);
    $(this.parentNode).find('.comment-content-big-img').css("display","block");
});

$(".comment-content-big-img").mouseleave(function(){
    $(this).css("display","none");
})