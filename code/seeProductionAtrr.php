<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/21
 * Time: 20:49
 */
include("module.php");

include("conn.php");
$id=$_REQUEST['id'];
//商品属性集合
$sql="select * from productionAttr where pid='".$id."'";
$statement=$db->query($sql);
$result=$statement->fetchAll(PDO::FETCH_ASSOC);
//商品名称
$sql="select name from production where id='".$id."'";
$statement=$db->query($sql);
$name=$statement->fetch(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.css" type="text/css"/>
    <script  type="text/javascript" src="https://cdn.bootcss.com/bootstrap-colorpicker/2.5.1/js/bootstrap-colorpicker.js"></script>

    <link href="../style/addProductionAttr.css" rel="stylesheet"/>
</head>

<body>
    <fieldset id="content">
        <legend><?php echo $name['name']?></legend>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="form1">
            <table border="1" width="1030px" class="tab">
                <caption>商品属性</caption>
                <thead>
                <tr>
                    <th width="100px"></th>
                    <th width="200px">sku</th>
                    <th width="200px">色号</th>
                    <th width="200px">名称</th>
                    <th width="200px">库存</th>
                    <th width="200px">价格</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach($result as $row):?>
                <tr>
                    <td><input type="radio" /></td>
                    <td><input type="text" disabled value="<?php echo $row['sku']?>" name="sku"/></td>
                    <td><input type="text" class="jscolor color" value="<?php echo $row['colour_num']?>" name="jscolor"/></td>
                    <td><input type="text" value="<?php echo $row['colour_name']?>" name="colour_name"</td>
                    <td><input type="number" min="0" value="<?php echo $row['stock']?>" name="stock"/></td>
                    <td><input type="number" min="0" value="<?php echo $row['price']?>" name="price"/></td>
                </tr>
                <?php endforeach;?>
                </tbody>

            </table>
            <div class="buttonContent">

            <input type="button" value="返回"  name="cancel" onclick="history.go(-2);"/>

            </div>
        </form>

    </fieldset>

<script>



    $('.jscolor').colorpicker();        //启动颜色选择器

    //添加sku
    function setSKU(){
            var sku=$("tr:last td input[name='sku']").val();
            var jscolor=$("tr:last td input[name='jscolor']").val();
            if(sku==="" && jscolor!==""){
                var pname=$('legend').text();
                $("tr:last td input[name='sku']").val(pname+"_"+jscolor);
            }
    }


</script>
</body>
</html>
