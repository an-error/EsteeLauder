<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/18
 * Time: 12:13
 */



$pName=$categories=$brand=$img=$img0=$img1=$img2=$img3=$text="";
$collection=array();
$arrErr=array();
$file=$_FILES['pic'];
$imgsDirectory=array();
$sqlArr=array();
$post=$_POST;


//取出数据库的值
$id=$_POST['id'];
include("conn.php");
$sql="select * from production where id=".$id;
$statement=$db->query($sql);
$result=$statement->fetch(PDO::FETCH_ASSOC);

function upload($name,$tmpName){
    $fileName=$name;
    $fileTmp=$tmpName;
    move_uploaded_file($fileTmp,'../img/'.$fileName);
    return '../img/'.$fileName;
}

/*function setImg($imgSrc){
    return "<img src='".$imgSrc."'/>";
}*/

if($post['flag']==1){
    if($file['error']==0){
        $tmp=upload($file['name'],$file['tmp_name']);
        if($tmp!=$result['img']){
            $sqlArr[]="img='".$tmp."'";
        }
    }else{
        $arrErr['file']="图片上传失败！或者主图未上传！";
    };

    if($_FILES['files']['error']==0){
        if($_FILES['img0']){
            $tmp=upload($_FILES['img0']['name'],$_FILES['img0']['tmp_name']);
            if($tmp!=$result['img0']){
                $sqlArr[]="img0='".$tmp."'";
            }
        }
        if($_FILES['img1']){
            $tmp=upload($_FILES['img1']['name'],$_FILES['img1']['tmp_name']);
            if($tmp!=$result['img0']){
                $sqlArr[]="img1='".$tmp."'";
            }
        }
        if($_FILES['img2']) {
            $tmp=upload($_FILES['img2']['name'],$_FILES['img2']['tmp_name']);
            if($tmp!=$result['img2']){
                $sqlArr[]="img2='".$tmp."'";
            }
        }
        if($_FILES['img3']){
            $tmp=upload($_FILES['img3']['name'],$_FILES['img3']['tmp_name']);
            if($tmp!=$result['img3']){
                $sqlArr[]="img3='".$tmp."'";
            }
        }
    };

}

if($post['pName']!=$result['name']){
    if($_POST['pName']==""){
        $arrErr['pName']="请输入商品名称！";
    }else{
        $pName=$_POST['pName'];
        $sqlArr[]="name='".$pName."'";
    }
}

if($_POST['categories']!=$result['categories']){
    if($_POST['categories']==""){
        $arrErr['categories']="请选择商品分类！";
    }else{
        $categories=$_POST['categories'];
        $sqlArr[]="categories='".$categories."'";
    }
}

if($_POST['production']!=$result['text']){
    if($_POST['productionText']!=""){
        $text=$_POST['productionText'];
        $sqlArr[]="text='".$text."'";
    }
}

if($_POST['brand']!=$result['brand']){
    $brand=$_POST['brand'];
    $sqlArr[]="brand='".$brand."'";
}

if($_POST['size']!=$result['size']){
    $size=$_POST['size'];
    $sqlArr[]="size='".$size."'";
}

$collection['error']=$arrErr;
$collection['id']=$id;

if(empty($arrErr)){
    if(!empty($sqlArr)){
        $sql="update production set ";
        $sqlArr=join(" , ",$sqlArr);
        //$sqlArr=implode(' , ',$sqlArr);
        $sql.=$sqlArr." where id=".$id;
        $statement=$db->prepare($sql);
        $result=$statement->execute() or die ( '程序运行出错,出错信息:' . print_r( $db->errorInfo(),TRUE ) );
        if($result){
            $collection['success']= "编辑成功！";
        }else{
            $collection['fail']="编辑不成功！";
        }
        $collection['id']=$db->lastInsertId();
    }
    $collection['success']= "编辑成功！";
}

echo json_encode($collection);


/*echo $pName; echo $categories;echo $brand;echo $img;echo $img0;
echo $img1;echo $img2;echo $img3;echo $text;*/



