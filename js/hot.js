$("footer").css("position","relative")
window.onload=function(){
    var img=document.getElementsByTagName("img");
    for(var i=0;i<img.length;i++){
        if(img[i].getAttribute('src')===""){
            img[i].style.cssText="display:none";
        }

    }
};

function loadDetails(id){
    location.href="details.php?id="+id;
}

function colour(price,stock,name,color,obj){
    var hover=obj.parentNode.parentNode;
    hover.getElementsByClassName('price')[0].innerText="￥"+price;
    hover.getElementsByTagName('input')[0].setAttribute("colour_num",color);

}



$(" .attr-content").on("click","input[name='addToCart']",function(){
    if(this.getAttribute("colour_num")===""){
        alert("请选择色号！");
    }else{
        var data=new FormData();
        data.append("pid",this.getAttribute("index"));
        data.append("colour_num",this.getAttribute("colour_num"));
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
        xhr.send(data);
    }
});

$(".container ").on("mouseover mouseout",".col-md-4",function(e){
    if(e.type=="mouseover"){
        $(this).find(".hover").css("display","block");
    }
    if(e.type=="mouseout"){
        $(this).find(".hover").css("display","none");
    }
});

$(".container").on("click",".col-md-4",function(e){
    var id=$(this).attr("index");
    loadDetails(id);
    console.log(e.target);
});

$(".container .col-md-4 .hover").on("click",".attr-content",function(e){
    e.stopPropagation();
    console.log(e.target);
})