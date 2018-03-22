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
$sql="select name from production where id='14'"/*.$id*/;
$result=$db->query($sql);
$result=$result->fetch();
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <!--<script src="../module/jscolor-2.0.4/jscolor.js"></script>-->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.css" type="text/css"/>
    <script  type="text/javascript" src="https://cdn.bootcss.com/bootstrap-colorpicker/2.5.1/js/bootstrap-colorpicker.js"></script>
    <style>
        #content{
            width:980px;
            height:auto;
            margin:40px;
        }
        input[type='text'],input[type="number"]{
            border:none;
            display:inline-block;
            width:200px;
            height:30.4px;

        }

        .tab{
            display:block;
            margin:auto;
            margin-top:50px;
            height:auto;
            border:none;

        }

        .tab td,.tab th{
            border-collapse: collapse;
            border-color:rgba(170,161,161,1.00);
            text-align:center;
            height:30px;
        }
        tfoot td{
            border:none;
            display:inline-block;
            margin-top:30px;
        }

        .buttonContent{
            margin:30px;
        }

        .buttonContent input{
            display:inline-block;
            margin-left:30px;
        }

    </style>
</head>

<body>
    <fieldset id="content">
        <legend><?php echo $result['name']?></legend><!--
        <p>色号：<input name="color1" type="text" class="jscolor color" onchange="setSKU(<?php /*echo $result['name']*/?>)"/></p>
        <p>sku:<input type="text" readonly="readonly" name="sku"/></p>-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="form1">
            <table border="1" width="930px" class="tab">
                <caption>商品属性</caption>
                <thead>
                <tr>
                    <th width="100px"></th>
                    <th width="200px">色号</th>
                    <th width="200px">库存</th>
                    <th width="200px">价格</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td><input type="radio" /></td>
                    <td><input type="text" class="jscolor color" /></td>
                    <td><input type="number" min="0" /></td>
                    <td><input type="number" min="0"/></td>
                </tr>
                </tbody>

            </table>
            <div class="buttonContent">
            <input type="button" value="增添一行" id="appendRow"/>
            <input type="button" value="删除" id="delRow"/>
            </div>
        </form>

    </fieldset>





<script>



    $('.jscolor').colorpicker();
    $('#appendRow').on('click',function(){
        var html='<tr><td width="100px"><input type="radio" /></td>' +
            '<td width="200px"><input  type="text" class="jscolor" /></td>' +
            '<td width="200px"><input type="number" min="0"/></td>' +
            '<td width="200px"><input type="number" min="0"/></td></tr>';
        $("table:first tbody").append(html);
        $('.jscolor').colorpicker();
    });

    $("input[type='number").keypress()


    /* function setSKU(proName){
         var value=document.getElementsByName('color1')[0].value;
         document.getElementsByName('sku')[0].value=proName+value+"";
     }*/
</script>
</body>
</html>
