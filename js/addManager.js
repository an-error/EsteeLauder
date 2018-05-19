function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}


document.getElementsByName("submit")[0].onclick=function() {
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
    xhr.open('post','addManagerCheck.php',true);
    xhr.send(formData);


    return false;
}
