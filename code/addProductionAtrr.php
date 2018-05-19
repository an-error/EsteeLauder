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
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
$sql="select name from production where id='".$id."'";
$result=$db->query($sql);
$result=$result->fetch();
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
        <legend><?php echo $result['name']?></legend>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="form1">
            <table border="1" width="930px" class="tab">
                <caption>商品属性</caption>
                <thead>
                <tr>
                    <th width="100px"></th>
                    <th width="200px">色号</th>
                    <th width="200px">名称</th>
                    <th width="200px">库存</th>
                    <th width="200px">价格</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td><input type="radio" /></td>
                    <td><input type="text" class="jscolor color" /></td>
                    <td><input type="text" /></td>
                    <td><input type="number" min="0" /></td>
                    <td><input type="number" min="0"/></td>
                </tr>
                </tbody>

            </table>
            <div class="buttonContent">
            <input type="button" value="增添一行" id="appendRow"/>
            <input type="button" value="删除" id="delRow" onclick="del()"/>
            <input type="button" value="提交"  name="submit" />
            </div>
        </form>

    </fieldset>
<script src="../js/addProductionAttr.js"></script>
</body>
</html>
