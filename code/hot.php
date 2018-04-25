<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/27
 * Time: 9:11
 */
include('module.php');
include("conn.php");
include("minHeader.php");

$sql="select  pid  from ordergoods GROUP by pid LIMIT 15";
$statement=$db->query($sql);
$temp=$statement->fetchAll(PDO::FETCH_ASSOC);

$production=array();
foreach ($temp as $t){
    $sql="select * from production where id='".$t['pid']."'";
    $statement=$db->query($sql);
    $production[]=$statement->fetch(PDO::FETCH_ASSOC);
}


for($i=0,$j=0;$i<sizeof($production);$i++){
    if($i%3==0 && $i!=0){
        $j++;
    }

    $rows[$j][]=$production[$i];

}

//print_r($rows);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
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
</head>

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
    window.onload=function(){
        var img=document.getElementsByTagName("img");
        for(var i=0;i<img.length;i++){
            if(img[i].getAttribute('src')===""){
                img[i].style.cssText="display:none";
            }

        }
    };

    function loadDetails(id){
        location.href="details.php?id="+id;
    }
</script>
</body>
</html>
