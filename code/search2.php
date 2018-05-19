<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/19
 * Time: 14:56
 */

include("conn.php");
include("module.php");
include("minHeader.php");
$search=$_REQUEST['search'];
$sql="select * from production where name like  '%".$search."%' and  isDelete is null";
$statement=$db->query($sql);
$production=$statement->fetchAll();

$rows=array();
for($i=0,$j=0;$i<sizeof($production);$i++){
    if($i%3==0 && $i!=0){
        $j++;
    }

    $rows[$j][]=$production[$i];

}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
</head>
<style>

    *{
        margin:0;
        padding:0;
    }
    .row img{
        width:300px;
        height:400px;
    }

    .row-margin{
        margin-bottom: 40px;
    }
    .main{
        margin-top:100px;
    }
</style>
<body>

<div class="container main">
    <?php foreach($rows as $row):?>
        <div class="row row-margin">
            <div class="col-md-4"><img src="<?php echo $row[0]['img']?>" onclick="loadDetails(<?php echo $row[0]['id']?>)"/></div>
            <div class="col-md-4"><img src="<?php if($row[1]){echo $row[1]['img'];} ?>" onclick="loadDetails(<?php echo $row[1]['id']?>)"/></div>
            <div class="col-md-4"><img src="<?php if($row[2]){echo $row[2]['img'];}?>" onclick="loadDetails(<?php echo $row[2]['id']?>)"/></div>
        </div>
    <?php endforeach;?>
</div>

<script>
    $(function(){
        $("img").each(function(){
            if($(this).attr("src")===""){
                $(this).css("display","none");
            }
        })
    })

    function loadDetails(id){
        location.href="details.php?id="+id;
    }
</script>
</body>
</html>

