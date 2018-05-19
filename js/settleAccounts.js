$("#shopping-cart").on("blur","input[type='number']",function(){
    var stock=this.parentNode.parentNode.parentNode.parentNode.getAttribute('stock');
    if(this.value>=6 && stock>=6){
        this.value="6";
    }else if(this.value<0){
        this.value="1";
    }else if(this.value>stock && stock<6){
        this.value=stock;
    }
    $(this).val(this.value);
    console.log(this.value);
});



function toContinue(isLogin){
    if(isLogin){
        location.href="address.php";
    }else{
        document.getElementsByClassName('background')[0].style.display="block";
    }
}

$(".del").click(function(e){
    {
        var node=e.target;
        var parent=node.parentNode.parentNode.parentNode.parentNode;
        var sku=parent.getAttribute('sku');
        //console.log(sku);
        //location.href="delSession.php?id='"+sku+"'";
        var data=new FormData();
        data.append('id',sku);
        var xhr=new XMLHttpRequest();
        //var url="delSession.php?id='"+sku+"'";

        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                parent.style.display="none";
                var result=JSON.parse(this.responseText);
                document.getElementById('total').innerText=result['total'];
                if(result['total']===0){
                    document.getElementById('account').style.display="none";
                    history.go(0);
                }

            }
        };
        xhr.open("post","delSession.php",true);
        xhr.send(data);


    }
});

$("#shopping-cart").on("change",".cart-block",function(e){
    var node=e.target;
    var parent=node.parentNode.parentNode.parentNode.parentNode;

    var data=new FormData();
    data.append('sku',parent.getAttribute('sku'));
    data.append("count",node.value);

    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){
            var result=JSON.parse(this.responseText);
            document.getElementById('total').innerText=result['total'];
            node.value=result['count'];
        }
    };
    xhr.open("post","countChange.php",true);
    xhr.send(data);
});

$("#cart").click(function(){
    $("#shopping").css("display","none");
});

document.getElementById("continueShopping").onclick=function(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){

        }
    };
    xhr.open("post","delSession.php",true);
    xhr.send();
}