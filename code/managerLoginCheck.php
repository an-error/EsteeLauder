<?php
if (isset($_POST["submit"]) && $_POST["submit"] == "登陆") {


    $id = $_POST["id"];
    $password = $_POST["password"];


    if ($id == "" || $password == "") {
        echo "<script>alert('请输入管理员账号或密码！'); history.go(-1);</script>";
    } else {

        include("conn.php");
        $sql = "select id,password,name from manager where id=" . $id;
        $result = $db->query($sql);

        $result = $result->fetch(PDO::FETCH_ASSOC);
        if ($result['password'] == $_POST['password']) {
            session_start();
            $_SESSION['name'] = $result['name'];
            echo "<script>window.location.href='managerIndex.php' ;</script>";
        } else {
            echo "<script>alert('账户或者密码不正确！');history.go(-1);</script>";
        }

        //query返回一个可以直接使用的多维数组。


    }
} else {
    echo "<script>alert('提交不成功！');history.go(-1);</script>";
}

        		
