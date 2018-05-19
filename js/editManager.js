function isJson(str) {
    try {
        var obj=JSON.parse(str);
        if(typeof obj === 'object' && obj ){
            return true;
        }else{
            return false;
        }

    } catch(e) {
        console.log('error：'+str+'!!!'+e);
        return false;
    }
    return false;
}



document.getElementsByName("edit")[0].onclick=function() {
    var isEdit=confirm("是否确认编辑？编辑之后不可恢复！");
    if(isEdit===true){
        var formObject=document.getElementById('form1');
        var formData = new FormData(formObject);
        var xhr = new XMLHttpRequest();
        var result;
        xhr.onreadystatechange = function () {

            if (this.readyState === 4) {
                result = this.responseText;
                if (isJson(result)) {
                    result = eval("(" + this.responseText + ")");

                    if (result.length !== 0) {
                        if (result['username']) {
                            document.getElementsByClassName('error')[0].innerHTML = result['username'];
                        }
                        if (result['password']) {
                            document.getElementsByClassName('error')[1].innerHTML = result['password'];
                        }
                        if (result['password2']) {
                            document.getElementsByClassName('error')[2].innerHTML = result['password2'];
                        }
                        if (result['phone']) {
                            document.getElementsByClassName('error')[3].innerHTML = result['phone'];
                        }
                        if (result['IDCard']) {
                            document.getElementsByClassName('error')[4].innerHTML = result['IDCard'];
                        }


                        if (result['email']) {
                            document.getElementsByClassName('error')[5].innerHTML = result['email'];
                        }
                    }
                } else {
                    document.getElementById('return').innerText = result;
                    location.href="managerList.php";

                }
            }
        };
        xhr.open('post','editManagerCheck.php?id=<?php echo $id?>',true);
        xhr.send(formData);


        return false;
    }

};

document.getElementsByName('password')[0].onchange=function(){
    document.getElementById('password2').style.cssText="display:block";
};

document.getElementsByName('cancel')[0].onclick=function(){
    var isCancel=confirm("是否取消此次操作？");
    if(isCancel===true){
        history.go(-1);
    }
};
