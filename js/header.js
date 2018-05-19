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

//dropdown click
$(".dropdown-content ul ").on("click","li a",function(){
    location.href="main.php?categories="+$(this).text();
})


//退出
function exit(){

    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){
            location.href="index.php";
        }
    };
    xhr.open("get","exit.php",true);
    xhr.send();
}


function block(){
    $('.dropdown-content').css("display","block");
}


$(".dropdown").hover(function(){
    $('.dropdown-content').hover(function(){
        $('.dropdown-content').css('display','block')
    },function(){
        $('.dropdown-content').css('display','none');
    });
});


function load(target){
    location.href="main.php?categories="+target;
}

//login
$('.close-button').click(function(){
    $('.background').css('display','none');
});

//注册
$(".register-link").click(function(){
    var formData=new FormData();
    //$(".register-link").css("display","none");
    toRegister();
    formData.append('register','true');
});

$(".login-link").click(function(){
    var formData=new FormData();
    //$(".register-link").css("display","none");
    toLogin();
    formData.append('login','true');
});


function clearError(){
    $("#login-content .error").each(function(){
        $(this).html("");
    })
}
function toRegister(){
    clearError();
    $("#login-content span").each(function(){
        $(this).css("display","none");
    });
    document.getElementsByClassName('register-link')[0].style.display="none";
    document.getElementsByClassName('login-link')[0].style.display="block";
    document.getElementById('user').style.display="none";
    document.getElementById('phone').style.display="block";
    document.getElementById('email').style.display="block";
    document.getElementById('password2').style.display="block";
    document.getElementById("login-pop").style.height="450px";
    document.getElementsByName('submit')[0].value="注册";
}

function toLogin(){
    clearError();
    $("#login-content span").each(function(){
        $(this).css("display","block");
    });
    document.getElementsByClassName('register-link')[0].style.display="block";
    document.getElementsByClassName('login-link')[0].style.display="none";
    document.getElementById('user').style.display="block";
    document.getElementById('phone').style.display="none";
    document.getElementById('email').style.display="none";
    document.getElementById('password2').style.display="none";
    document.getElementById("login-pop").style.height="350px";
    document.getElementsByName('submit')[0].value="登录";
}

//login or select

function action(isLogin){
    if(isLogin){
        document.getElementById("userSelect").style.display="block";
    }else{
        document.getElementsByClassName('background')[0].style.display="block";
    }
}



$("#userSelect ").mouseleave(function(){
    $("#userSelect").css("display","none");
});

$("#iconSearch").click(function(){
    $("#search").css("visibility","visible");
});

$("#search").mouseleave(function(){
    $("#search").css("visibility","hidden");
});

document.getElementsByName("submit")[0].onclick=function(){

    var form=document.getElementsByTagName("form")[0];
    var formData=new FormData(form);
    if(document.getElementsByName('submit')[0].value==="登录"){
        formData.append("login","true");
    }
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){
            $("#login-content span").each(function(){
                $(this).css("display","block");
            });
            var result=JSON.parse(this.responseText);
            if(result['error'].length!==0){
                clearError();
                if(result['error']['user']){
                    document.getElementsByClassName('user-login')[0].innerHTML=result['error']['user'];
                }
                if(result['error']['password']){
                    document.getElementsByClassName('password')[0].innerHTML=result['error']['password'];
                }

                if(result['error']['phone']){
                    document.getElementsByClassName('phone')[0].innerHTML=result['error']['phone'];
                }

                if(result['error']['email']){
                    document.getElementsByClassName('email')[0].innerHTML=result['error']['email'];
                }

                if(result['error']['password2']){
                    document.getElementsByClassName('password2')[0].innerText=result['error']['password2'];
                }

            }

            if(result['success']){
                alert(result['success']);
                document.getElementsByClassName('background')[0].style.display="none";
                location.reload();
            }

            if(result['register']){
                toRegister();
                formData.append('register','true');
            }

            if(result['fail']){
                alert(result['fail']);
                var background=document.getElementsByClassName('background')[0];
                background.style.display="none";
            }
        }
    };
    xhr.open("post","userLoginCheck.php",true);
    xhr.send(formData);
};

//购物车
$("#cart").click(function(){
    $("#shopping").css("display","block");
});

$("#shopping").on("blur","input[type='number']",function(){
    var stock=this.parentNode.parentNode.parentNode.parentNode.getAttribute('stock');
    if(this.value>6 && stock>6){
        this.value="6";
    }
    if(this.value<0){
        this.value="1";
    }

    if(this.value>stock && stock<6){
        this.value=stock;
    }
});


$("#shopping").mouseleave(function(){
    $("#shopping").css("display","none");
});




$("#shopping").on("click",".cart-area i",function(e){
    var node=e.target;
    var parent=node.parentNode.parentNode.parentNode.parentNode;
    var sku=parent.getAttribute('sku');
    var data=new FormData();
    data.append('id',sku);
    var xhr=new XMLHttpRequest();

    xhr.onreadystatechange=function(){
        if(this.readyState===4){
            parent.style.display="none";
            var result=JSON.parse(this.responseText);
            document.getElementById('cart-total').innerText=result['total'];
            document.getElementById('shopping').innerHTML=result['html'];
        }
    };
    xhr.open("post","delSession.php",true);
    xhr.send(data);


});



$("#shopping").on("change",".cart-area",function(e){
    var node=e.target;
    var parent=node.parentNode.parentNode.parentNode.parentNode;

    var data=new FormData();
    data.append('sku',parent.getAttribute('sku'));
    data.append("count",node.value);

    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){
            var result=JSON.parse(this.responseText);
            document.getElementById('cart-total').innerText=result['total'];
        }
    };
    xhr.open("post","countChange.php",true);
    xhr.send(data);
});




function toCount(){
    var is_login=$("#shopping").attr('is_login');
    if(is_login){
        location.href="settleAccounts.php";
    }else{
        document.getElementsByClassName("background")[0].style.display="block";
    }
}

//搜索
document.getElementById("search").onkeydown=function(){
    if(event.keyCode=='13'){
        if(this.value) {
            location.href="search2.php?search="+this.value;
        }
    }
}