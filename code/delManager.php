<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/17
 * Time: 18:37
 */

    $id=$_REQUEST['id'];
    include("conn.php");
    $statement=$db->prepare("delete from manager where id=:id");
    $result=$statement->execute(array('id'=>$id));
    if($result){
        echo "<script>alert('删除成功');location.href='managerList.php';</script>";
    }else{
        echo "<script>alert('删除失败');location.href='managerList.php';</script>";
    }
