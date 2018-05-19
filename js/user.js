$("#order .nav").on("click","li",function(e){
    var map=[];
    map['已完成']="已评价";
    map['待评价']="已签收";
    map['待发货']="待发货";
    map['待收货']="已发货";
    map['待付款']="待付款";
    map['退款']="交易失败";

    var data=new FormData();
    data.append("status",map[e.target.innerText]);

    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){
            document.getElementsByClassName('show')[0].innerHTML=this.responseText;
        }
    };
    xhr.open("post","showOrder.php",true);
    xhr.send(data);
});

$(".show").on("click",".order-content input[name='rePay']",function(){
    var pay=confirm("是否支付？");
    if(pay){
        var data=new FormData();
        data.append("option",'待发货');
        var temp=this.parentNode.parentNode.getElementsByTagName('h4')[0].innerText;
        var orderID=temp.split("：")[1];
        data.append('orderID',orderID);
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                location.href="order.php?id="+orderID;
            }
        };
        xhr.open("post","updateStatus.php",true);
        xhr.send(data);
    }

})

$(".show").on("click",".order-content input[name='confirm']",function(){
    var temp=confirm("是否确认收货？");
    if(temp){
        var data=new FormData();
        data.append("option",'已签收');
        var temp=this.parentNode.parentNode.getElementsByTagName('h4')[0].innerText;
        var orderID=temp.split("：")[1];
        data.append('orderID',orderID);
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                //document.getElementsByClassName('order-tip')[3].click();
                //$("#comment").trigger("click");
                //location.href="comment.php?orderID="+orderID+"&"
                location.reload();
            }
        };
        xhr.open("post","updateStatus.php",true);
        xhr.send(data);
    }
});

$(".show").on("click",".order-content input[name='comment']",function(){
    var parent=this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
    var temp=parent.getElementsByClassName("orderID")[0].innerText;
    var sku=parent.getAttribute('sku');
    var orderID=temp.split("：")[1];
    sku=sku.replace(/\#/g,"%23");
    sku=sku.replace(/\+/g,"%2B");
    location.href="comment.php?orderID="+orderID+"&sku="+sku;
});

$(".show").on("click",".order-content input[name='return']",function(){
    console.log(this);
    var parent=this.parentNode;
    var temp=parent.getElementsByTagName("h4")[0].innerText;
    var orderID=temp.split("：")[1];
    location.href="return.php?orderID="+orderID;
});



$(".displayToBlock").click(function(){
    $("#order").css("display","none");
    $("#userInformation").css("display","block");
});

$(".displayOrder").click(function(){
    $("#userInformation").css("display","none");
    $("#order").css("display","block");

});

$("#userInformation input[name='password']").focus(function(){
    $("#userInformation .password2").css("display","block");
});




document.getElementsByName("revise")[0].onclick=function(){
    var form=document.getElementById('userInformation').getElementsByTagName('form')[0];
    var formData=new FormData(form);
    var id=form.getAttribute('ID');
    formData.append('id',id);
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){
            var result=JSON.parse(this.responseText);
            var i=document.getElementById('userInformation').getElementsByTagName('i');
            if(result['error']){
                var error=result['error'];
                if(error['phone']){
                    i[0].innerText=error['phone'];
                }
                if(error['email']){
                    i[1].innerText=error['email'];
                }
                if(error['password']){
                    i[2].innerText=error['password'];
                }
                if(error['password2']){
                    i[3].innerText=error['password2'];
                }
            }
            if(result['success']){
                location.reload();
            }
        }
    };
    xhr.open("post","userInformationCheck.php",true);
    xhr.send(formData);

}
