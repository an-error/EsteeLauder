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

$sql="select  pid  from ordergoods GROUP by pid order by count(*) desc LIMIT 15";
$production=array();
$pidArr=$db->query($sql);
$pidArr=$pidArr->fetchAll(PDO::FETCH_ASSOC);
foreach($pidArr as $pid){
    $sql="select * from production where id='".$pid['pid']."'";
    $temp=$db->query($sql);
    $temp=$temp->fetch(PDO::FETCH_ASSOC);
    preg_match('#[a-zA-Z\s+\d/.]*#',$temp['name'],$matches);
    $temp['name']=substr($temp['name'],strlen($matches[0]));
    $sql="select * from productionattr where pid='".$temp['id']."'";
    $statement=$db->query($sql);
    $attr=$statement->fetchAll(PDO::FETCH_ASSOC);
    $temp['attr']=$attr;
    $production[] = $temp;

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
    <link href="../style/hot.css" rel="stylesheet"/>
</head>

<body>

    <div class="container main">
        <?php foreach($rows as $row):?>
        <div class="row row-margin">
            <div class="col-md-4 position" index="<?php echo $row[0]['id']?>">
                <img src="<?php echo $row[0]['img']?>" onclick="loadDetails(<?php echo $row[0]['id']?>)"/>
                <p><?php echo $row[0]['name']?></p>
                <div class="hover">
                    <div class="attr-content">
                    <div class="attr">
                        <?php if($row[0]['attr'][0]['colour_num']!=='#ffffff'):?>
                            <?php foreach($row[0]['attr'] as $c):?>
                                <?php if($c['stock']>0):?>
                                <span class="color" style="background-color: <?php echo $c['colour_num']?>" onclick="colour(<?php echo $c['price']?>,<?php echo $c['stock']?>,<?php echo "'".$c['colour_name']."'"?>,<?php echo "'".$c['colour_num']."'"?>,this)"></span>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endif;?>
                    </div>
                    <?php if((sizeof($row[0]['attr'])==1 && $row[0]['attr'][0]['stock']>0)||(sizeof($row[0]['attr'])>1) ):?>
                    <span class="price"><?php if( sizeof($row[0]['attr'])==1){ echo '￥'.$row[0]['attr'][0]['price'];}?></span>
                <input name="addToCart" type="button" value="加入购物车" index="<?php echo $row[0]['id']?>" colour_num="<?php if( sizeof($row[0]['attr'])==1){ echo $row[0]['attr'][0]['colour_num'];}?>" />
                <?php endif;?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 position" index="<?php echo $row[1]['id']?>">
                <img src="<?php echo $row[1]['img']?>" onclick="loadDetails(<?php echo $row[1]['id']?>)"/>
                <p><?php echo $row[1]['name']?></p>
                <div class="hover">
                    <div class="attr-content">
                        <div class="attr">
                            <?php if($row[1]['attr'][0]['colour_num']!=='#ffffff'):?>
                                <?php foreach($row[1]['attr'] as $c):?>
                                    <?php if($c['stock']>0):?>
                                        <span class="color" style="background-color: <?php echo $c['colour_num']?>" onclick="colour(<?php echo $c['price']?>,<?php echo $c['stock']?>,<?php echo "'".$c['colour_name']."'"?>,<?php echo "'".$c['colour_num']."'"?>,this)"></span>
                                    <?php endif;?>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>
                        <?php if((sizeof($row[1]['attr'])==1 && $row[1]['attr'][0]['stock']>0)||(sizeof($row[1]['attr'])>1) ):?>
                            <span class="price"><?php if( sizeof($row[1]['attr'])==1){ echo '￥'.$row[1]['attr'][0]['price'];}?></span>
                            <input name="addToCart" type="button" value="加入购物车" index="<?php echo $row[1]['id']?>" colour_num="<?php if( sizeof($row[1]['attr'])==1){ echo $row[1]['attr'][0]['colour_num'];}?>" />
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 position" index="<?php echo $row[2]['id']?>">
                <img src="<?php echo $row[2]['img']?>" onclick="loadDetails(<?php echo $row[0]['id']?>)"/>
                <p><?php echo $row[2]['name']?></p>
                <div class="hover">
                    <div class="attr-content">
                        <div class="attr">
                            <?php if($row[2]['attr'][0]['colour_num']!=='#ffffff'):?>
                                <?php foreach($row[2]['attr'] as $c):?>
                                    <?php if($c['stock']>0):?>
                                        <span class="color" style="background-color: <?php echo $c['colour_num']?>" onclick="colour(<?php echo $c['price']?>,<?php echo $c['stock']?>,<?php echo "'".$c['colour_name']."'"?>,<?php echo "'".$c['colour_num']."'"?>,this)"></span>
                                    <?php endif;?>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>
                        <?php if((sizeof($row[2]['attr'])==1 && $row[2]['attr'][0]['stock']>0)||(sizeof($row[2]['attr'])>1) ): ?>
                            <span class="price"><?php if( sizeof($row[2]['attr'])==1){ echo '￥'.$row[2]['attr'][0]['price'];}?></span>
                            <input name="addToCart" type="button" value="加入购物车" index="<?php echo $row[2]['id']?>" colour_num="<?php if( sizeof($row[2]['attr'])==1){ echo $row[2]['attr'][0]['colour_num'];}?>" />
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>

<?php include("footer.php")?>

    <script src="../js/hot.js"></script>
</body>
</html>
