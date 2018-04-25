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


//print_r($_FILES['pic']);


function upload($name,$tmpName){
    $fileName=$name;
    $fileTmp=$tmpName;
    move_uploaded_file($fileTmp,'../img/'.$fileName);
    return '../img/'.$fileName;
}

function setImg($imgSrc){
    return "<img src='".$imgSrc."'/>";
}

if($file['error']==0){
    $img=upload($file['name'],$file['tmp_name']);

}else{
    $arrErr['file']="图片上传失败！或者主图未上传！";
};

if($_FILES['files']['error']==0){
    if($_FILES['img0']){
        $img0=upload($_FILES['img0']['name'],$_FILES['img0']['tmp_name']);
    }
    if($_FILES['img1']){
        $img1=upload($_FILES['img1']['name'],$_FILES['img1']['tmp_name']);
    }
    if($_FILES['img2']) {
        $img2=upload($_FILES['img2']['name'],$_FILES['img2']['tmp_name']);
    }
    if($_FILES['img3']){
        $img3=upload($_FILES['img3']['name'],$_FILES['img3']['tmp_name']);
    }
};

if($_POST['pName']==""){
    $arrErr['pName']="请输入商品名称！";
}else{
    $pName=$_POST['pName'];
}

if($_POST['categories']==""){
    $arrErr['categories']="请选择商品分类！";
}else{
    $categories=$_POST['categories'];
}

if($_POST['productionText']!=""){
    $text=$_POST['productionText'];
}

if($_POST['size']!=""){
    $size=$_POST['size'];
}else{
    $arrErr['size']="请填写规格大小！";
}

$brand=$_POST['brand'];
$collection['error']=$arrErr;

if(empty($arrErr)){
    include("conn.php");
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    $statement=$db->prepare("insert into production(name,categories,brand,size,img,img0,img1,img2,img3,text)
                        value(:pName,:categories,:brand,:size,:img,:img0,:img1,:img2,:img3,:text)");
    $statement->execute(array(':pName'=>$pName,':categories'=>$categories,':brand'=>$brand,':size'=>$size,':img'=>$img, 'img0'=>$img0,'img1'=>$img1,'img2'=>$img2,'img3'=>$img3,':text'=>$text))
                or die ( '程序运行出错,出错信息:' . print_r( $db->errorInfo(),TRUE ) );

    $collection['id']=$db->lastInsertId();
}
echo json_encode($collection);


/*echo $pName; echo $categories;echo $brand;echo $img;echo $img0;
echo $img1;echo $img2;echo $img3;echo $text;*/



