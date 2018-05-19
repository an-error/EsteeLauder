<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/24
 * Time: 21:16
 */

$id=$_REQUEST['id'];
include("conn.php");
/*$sql="select * from productionattr where pid='".$id."'";
$attr=$db->query($sql);
$attr=$attr->fetchAll(PDO::FETCH_ASSOC);

print_r($attr);*/

$sql="select distinct pid from productionattr";
$result=$db->query($sql);
$result=$result->fetchAll(PDO::FETCH_ASSOC);
$pid=array();
for($i=0;$i<sizeof($result);$i++){
    $pid[]=$result[$i]['pid'];
}

if(in_array($id,$pid)){
    $sql="update productionattr set isDelete=1 where pid='".$id."'";
    $statement=$db->prepare($sql);
    $result0=$statement->execute() or die ( '程序运行出错,出错信息:' . print_r( $db->errorInfo(),TRUE ) );
}

$sql="update production set isDelete=1 where id='".$id."'";
$statement=$db->prepare($sql);
$result1=$statement->execute() or die ( '程序运行出错,出错信息:' . print_r( $db->errorInfo(),TRUE ) );

echo "<script>alert('删除成功！');location.href='productionList.php'</script>";

/*$sql="delete from productionattr where pid='".$id."'";
$statement=$db->prepare($sql);
$statement->execute();


*/