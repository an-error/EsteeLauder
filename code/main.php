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

function majorTake($categories){
    global $db;
    $sql="select minor from categories where major='".$categories."'";
    $result=$db->query($sql);
    $result=$result->fetchAll(PDO::FETCH_ASSOC);

    $production=array();
    foreach($result as $row){
        $sql="select id,name,img from production where categories='".$row['minor']."' and isDelete is null";
        $temp=$db->query($sql);
        $temp=$temp->fetchAll(PDO::FETCH_ASSOC);
        foreach($temp as $t) {
            preg_match('#[a-zA-Z\s+\d/.]*#',$t['name'],$matches);
            $t['name']=substr($t['name'],strlen($matches[0]));
            $sql="select * from productionattr where pid='".$t['id']."'";
            $statement=$db->query($sql);
            $attr=$statement->fetchAll(PDO::FETCH_ASSOC);
            $t['attr']=$attr;
            $production[] = $t;
        }
    }
    return $production;
}


$categories=$_REQUEST['categories'];
if($categories==='face'){
    $production=majorTake("面部");
}else if($categories==='lips'){
    $production=majorTake("唇部");
}else if($categories==='eyes'){
    $production=majorTake("眼部");
}else{
    $categories=$_REQUEST['categories'];
    $production=array();
    $sql="select id,name,img from production where categories='".$categories."' and isDelete is null";
    $temp=$db->query($sql);
    $temp=$temp->fetchAll(PDO::FETCH_ASSOC);
    foreach($temp as $t) {
        preg_match('#[a-zA-Z\s+\d/.]*#',$t['name'],$matches);
        $t['name']=substr($t['name'],strlen($matches[0]));
        $sql="select * from productionattr where pid='".$t['id']."'";
        $statement=$db->query($sql);
        $attr=$statement->fetchAll(PDO::FETCH_ASSOC);
        $t['attr']=$attr;
        $production[] = $t;
    }
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
    <link href="../style/main.css" rel="stylesheet"/>
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
                            <?php if($row[1]['attr']):?>
                                <?php foreach($row[1]['attr'] as $c):?>
                                    <?php if($c['stock']>0):?>
                                        <span class="color" style="background-color: <?php echo $c['colour_num']?>" onclick="colour(<?php echo $c['price']?>,<?php echo $c['stock']?>,<?php echo "'".$c['colour_name']."'"?>,<?php echo "'".$c['colour_num']."'"?>,this)"></span>
                                    <?php endif;?>
                                <?php endforeach;?>
                            <?php endif;?>
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
                            <?php if($row[2]['attr']):?>
                                <?php foreach($row[2]['attr'] as $c):?>
                                    <?php if($c['stock']>0):?>
                                        <span class="color" style="background-color: <?php echo $c['colour_num']?>" onclick="colour(<?php echo $c['price']?>,<?php echo $c['stock']?>,<?php echo "'".$c['colour_name']."'"?>,<?php echo "'".$c['colour_num']."'"?>,this)"></span>
                                    <?php endif;?>
                                <?php endforeach;?>
                            <?php endif;?>
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

    <script src="../js/main.js"></script>
</body>
</html>
