<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/13
 * Time: 15:18
 */


include("conn.php");



if($_POST['status']=="apply"){

    $sql="select total,uid from esteelauder.order where id='".$_REQUEST['orderID']."'";
    $statement=$db->query($sql);
    $result=$statement->fetch(PDO::FETCH_ASSOC);

    function upload($name,$tmpName){
        $fileName=$name;
        $fileTmp=$tmpName;
        move_uploaded_file($fileTmp,'../img/'.$fileName);
        return '../img/'.$fileName;
    }

    $img0=$img1=$img2="";
    if($_FILES['error']==0){
        if($_FILES['img0']){
            if($_FILES['img0']['error']==0){
                $img0=upload($_FILES['img0']['name'],$_FILES['img0']['tmp_name']);
            }
        }

        if($_FILES['img1']){
            if($_FILES['img1']['error']==0){
                $img1=upload($_FILES['img1']['name'],$_FILES['img1']['tmp_name']);
            }
        }

        if($_FILES['img2']){
            if($_FILES['img2']['error']==0){
                $img2=upload($_FILES['img2']['name'],$_FILES['img2']['tmp_name']);
            }
        }
    }



    $price=intval($_POST['price']);

    if(empty($_POST['price'])){
        $price=$result['total'];
    }else if($_POST['price']>$result['total']){
        $error['price']="不能大于付款金额";
    }

    if(empty($_POST['text'])){
        $error['text']="请输入退货原因";
    }

    $status="申请退货";
    if(empty($error)){
        $statement=$db->prepare("insert into returnGoods(orderID,reason,price,text,img0,img1,img2,status)
                                                        value(:orderID,:reason,:price,:text,:img0,:img1,:img2,:status)");
        $statement->execute(array(":orderID"=>$_POST['orderID'],":reason"=>$_POST['reason'],":price"=>$price,":text"=>$_POST['text'],":img0"=>$img0,":img1"=>$img1,":img2"=>$img2,":status"=>$status));


    }


    $collection['error']=$error;

}else if($_POST['status']=="delivery"){
    $sql="update returnGoods set delivery='".$_POST['delivery']."',status='买家已寄出' where id='".$_POST['returnID']."'";
    $statement=$db->prepare($sql);
    $statement->execute();
    $collection['success']=1;
}




echo json_encode($collection);



