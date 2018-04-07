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
            width:800px;
        }

        #appendRow,#delRow{
            display:inline-block;
            margin-left:30px;
        }

        .buttonContent input[name="cancel"]{
            display:inline-block;
            margin-left:500px;
        }

        .buttonContent input[name="edit"]{
            display:inline-block;
            margin-left:20px;
        }


    </style>
</head>

<body>
    <fieldset id="content">
        <legend><?php echo $name['name']?></legend><!--
        <p>色号：<input name="color1" type="text" class="jscolor color" onchange="setSKU(<?php /*echo $result['name']*/?>)"/></p>
        <p>sku:<input type="text" readonly="readonly" name="sku"/></p>-->
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
            <input type="button" value="增添一行" id="appendRow"/>
            <input type="button" value="删除" id="delRow" onclick="del()"/>
            <input type="button" value="取消"  name="cancel" onclick="location.href='productionList.php'"/>
            <input type="button" value="编辑"  name="edit" />
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

    //增添一行
    $('#appendRow').on('click',function(){
        setSKU();
        var html='<tr><td width="100px"><input type="radio" /></td>' +
            '<td><input type="text" disabled name="sku"/></td>'+
            '<td width="200px"><input  type="text" class="jscolor " name="jscolor" /></td>' +
            '<td><input type="text"  name="colour_name"</td>'+
            '<td width="200px"><input type="number" min="0" name="stock"/></td>' +
            '<td width="200px"><input type="number" min="0" name="price"/></td></tr>';
        $("table:first tbody").append(html);
        $('.jscolor').colorpicker();
    });

   function del(){
       var radioArr=$('input[type="radio"]:checked');
       if(radioArr.size()===0){
           alert("请选定要删除的行！");
       }else{
           radioArr.each(function(){
               $(this).parent().parent().remove();
           })
       }
   }


   function getData(){
        //注意：js 值覆盖问题
       var dataArr=[0];
       var table=document.getElementsByTagName('table')[0];
       for(var i=1;i<table.rows.length;i++){
           var data=[0];
           for(var j=1;j<table.rows[0].cells.length;j++){
               data[j-1]=table.rows[i].cells[j].getElementsByTagName("input")[0].value;
           }
           if(data[1]!==""){
               if(data[0]===""){
                   data[0]=document.getElementsByTagName('legend')[0].innerText+"_"+data[1];
               }
               dataArr[i-1]=data;
           }
       }
       return dataArr;
   }

   document.getElementsByName("edit")[0].onclick=function(){
       var go=confirm("是否编辑？编辑之后不可撤回！");
       if(go){
           var data=getData();
           var form=document.getElementsByTagName("form")[0];
           var formData=new FormData(form);
           formData.append("data",data);
           var name=document.getElementsByTagName("legend")[0].innerText;
           formData.append("name",name);
           var xhr=new XMLHttpRequest();
           xhr.onreadystatechange=function(){
               if(this.readyState===4){
                   var result=JSON.parse(this.responseText);
                   console.log(result);
                   if(result['error']!==""){
                       alert(result['error']);
                   }else{
                       location.href="productionList.php";
                   }
               }
           };
           xhr.open("post","editProductionAtrrCheck.php",true);
           xhr.send(formData);
       }




   }



    /* function setSKU(proName){
         var value=document.getElementsByName('color1')[0].value;
         document.getElementsByName('sku')[0].value=proName+value+"";
     }*/
</script>
</body>
</html>
