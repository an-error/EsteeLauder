<?php
    include("module.php");
    include("conn.php");
    $statement=$db->query("select * from production");
    $statement=$statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
    <style>
        .tab{
            display:block;
            margin:auto;
            margin-top:50px;
            height:auto;
            border:none;
            table-layout:fixed;
        }

        .tab td,.tab th{
            border-collapse: collapse;
            border:1px solid #dfe0e1;
            text-align:center;
            height:40px;
            word-break:keep-all;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;

        }
        fieldset{
            display:block;
            margin:30px auto;
            width:90%;

        }
    </style>
</head>

<body>

    <fieldset>
        <legend>商品列表</legend>
        <table border="1" width="1100px" class="tab">
            <thead>
            <tr>
                <td width="100px">账号</td>
                <td width="150px">商品名称</td>
                <td width="100px">分类</td>
                <td width="100px">品牌</td>
                <td width="230px">图片</td>
                <td width="100px">规格</td>
                <td width="250px">操作</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach($statement as $row):?>
                <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['categories']?></td>
                    <td><?php echo $row['brand']?></td>
                    <td><?php echo $row['img']?></td>
                    <td><?php echo $row['size']?></td>
                    <td><input type="button" name="edit" value="编辑" onclick="editProduction(<?php echo $row['id']?>)"/>
                        <input type="button" name="see" value="查看"  onclick="seeProduction(<?php echo $row['id']?>)"/>
                        <input type="button" name="del" value="删除" onclick="delProduction(<?php echo $row['id']?>)" /></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </fieldset>


    <script>
        function editProduction(id){
            location.href="editProduction.php?id="+id;
        }

        function  delProduction(id){
            var go=confirm("是否确定删除该商品？删除之后不可撤回！！");
            if(go){
                location.href="delProduction.php?id="+id;
            }
        }

        function seeProduction(id){
            location.href="seeProduction.php?id="+id;
        }
    </script>
</body>
</html>