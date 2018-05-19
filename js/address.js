$(".info").change(function(){
    var address=$("#s_province").val()+$("#s_city").val()+$("#s_county").val();
    $('textarea').val(address);
});

function getData(formData){

    formData.append("username",$("input[name='address-username']").val());
    formData.append("phone",$("input[name='address-phone']").val());
    formData.append("address",$("textarea").val());
    formData.append("postalcode",$("input[name='postalcode']").val());
    return formData;
}


document.getElementsByName('toAccount')[0].onclick=function(){

    var formData=new FormData();
    var just=document.getElementsByName('toAccount')[0].getAttribute('just');
    formData.append('just',just);
    formData=getData(formData);
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){
            var result=JSON.parse(this.responseText);
            if(result['error']){
                if(result['error']['username']){
                    document.getElementsByClassName('address-user')[0].innerText=result['error']['username'];
                }
                if(result['error']['phone']){
                    document.getElementsByClassName('address-phone')[0].innerText=result['error']['phone'];
                }
                if(result['error']['address']){
                    document.getElementsByClassName('address')[0].innerText=result['error']['address'];
                }
                if(result['error']['postalcode']){
                    document.getElementsByClassName('postalcode')[0].innerText=result['error']['postalcode'];
                }
            }
            if(result['success']){
                if(!result['just']){
                    location.href="account.php";
                }else{
                    location.reload();
                }

            }
        }
    };
    xhr.open("post","addressCheck.php",true);
    xhr.send(formData);
};


function clear(){
    $(".address-area").each(function(){
        if($(this).hasClass("address-active")){
            $(this).removeClass("address-active");
        }
    })
}

var checked=0;
$(".address-area").click(function(e){
    if(e.target.nodeName==="DIV"){
        clear();
        $(e.target).addClass("address-active");
        checked=e.target.getAttribute("addressID");
    }

});

var del=[];
$(".delAddress").click(function(e){
    var isDel=confirm("是否删除此地址？");
    if(isDel){
        var parent=e.target.parentNode.parentNode;
        del.push(parent.getAttribute("addressID"));
        if(checked===parent.getAttribute("addressID")){
            checked=0;
        }
        parent.style.display="none";
    }
    var data=new FormData();
    data.append('del',del);
    var xhr=new XMLHttpRequest();
    xhr.open("post","delAndToAccount.php",true);
    xhr.send(data);

});



$("input[name='addReceiver']").click(function(){
    $(".address-area").each(function(){
        $(this).css("display","none");
    });

    $(".toSelect").css("display","none");

    $("#addReceiver").css("display","block");
});

$("input[name='address-back']").click(function(){
    $("#addReceiver").css("display","none");
    $(".address-area").each(function(){
        $(this).css("display","block");
    });

    $(".toSelect").css("display","block");
});


document.getElementsByName("toAccount2")[0].onclick=function(){
    if(checked===0){
        alert("请选择收件人！");
    }else{
        var data=new FormData();
        data.append('del',del);
        data.append('checked',checked);
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.readyState===4){
                location.href="account.php";
            }
        };
        xhr.open("post","delAndToAccount.php",true);
        xhr.send(data);
    }


};
$("#cart").click(function(){
    $("#shopping").css("display","none");
})
