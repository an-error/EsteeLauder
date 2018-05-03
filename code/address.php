<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/2
 * Time: 14:51
 */

include("conn.php");
include("module.php");
include("minHeader.php");
session_start();
/*if(preg_match( "/^1[34578]{1}\d{9}$/", $_SESSION['user'])){
    $phone=$_SESSION['user'];

}else if(preg_match( "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ ", $$_SESSION['user'] )){
    $email=$_SESSION['user'];
}*/

$sql="select * from address where uid='".$_SESSION['id']."'";
$statement=$db->query($sql);
$address=$statement->fetchAll(PDO::FETCH_ASSOC);
$addressCount=sizeof($address);
echo $_REQUEST['just'];
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>

        body{
            background:#EEEEEE;
        }
       fieldset span{
            display:inline-block;
            width:100px;
            height:40px;
            text-align: right;
        }
/*
        .address-area input{
            height:30px;
            padding-left:10px;
        }

        .address-area{
            border:1px solid #dfe0e1 ;
            width:600px;
            height:100px;
            margin:50px auto;
            padding:40px auto;
        }
*/
        /*#receiver{
            width:1000px;
            height:500px;
            margin:auto;

        }*/

        #addReceiver{
            width:600px;
            height:600px;
            box-shadow: 0 0 30px  #cfcfd0;
            position:absolute;
            top:140px;
            left:33%;
            padding:20px;
            background-color: white;
        }

       /* a{ color:#006600; text-decoration:none;}
        a:hover{color:#990000;}*/
        .info select{
            border:1px solid #dfe0e1;
            background:#FFFFFF;
            width:120px;height:30px;
        }
        .info{
            margin:30px;
            text-align:center;
        }
        .info #show{ color:#EEEEEE; }
        .bottom{ text-align:right; font-size:12px; color:#CCCCCC; width:1000px;}

        select option:hover{
            background-color: #88c7ee;
        }

        legend{
            font-size:20px;
            text-align: left;
        }
        legend span{
            margin-right:10px;
            font-size:16px;
            color: #bdbdbd;
        }

        legend span:nth-child(3){
            width:80px;
        }

        legend span:nth-child(2){
            font-size:20px;
            width:120px;
            color:black;

        }

        textarea{
            width:400px;
            height:50px;
        }

        .address-text {
            line-height: 30px;
            margin-bottom: 20px;
        }

        hr{
            display:block;
            margin-bottom: 40px;
        }


        input[type='radio']{
            margin-right:18px;
        }



        .backOrTo{
            position:absolute;
            right:70px;
            bottom:40px;
        }

        .backOrTo input{
            width:80px;
            height:30px;
            color:white;
            border:none;
            margin-right:20px;
        }

        input[name="toAccount"]{
            width:120px;
            background-color: #265a88;

        }




        input[name='address-back']:hover{
            background-color: #265a88;
        }

        .error{
            color:red;
            font-size:12px;
            width:180px;
            height:20px;
        }


        .addAddress{
            display:none;
        }

        #selectAddress {
            margin:50px auto;
        }

        #addReceiver{
            display:none;
        }

        .address-area{
            width:800px;
            height:250px;
            background-color: white;
            margin:100px 200px;
            padding:20px;
            position:relative;
        }

        .address-area p i{
            font-size:22px;
            display:inline-block;
            margin-right:20px;
        }

        .address-area p{
            display:block;
            margin:20px auto;
            line-height: 30px;
        }

        .address-area p:nth-child(1) i{
            font-size:15px;
        }

        .delAddress:hover{
            color: #ff2938;
        }

        .address-active{
            box-shadow: 0 0 10px grey;
        }

        .toSelect input{
            width:150px;
            height:35px;
            border:none;
            color:white;
            display:block;
            margin-bottom: 20px;
        }

        .toSelect{
            position:fixed;
            right:250px;
            top:300px;
        }

        .toSelect input[name='toAccount2']{
            background-color: #265a88;
            position:absolute;
            top:100px;
        }

        .toSelect input[name="addReceiver"]:hover{
            background-color: #265a88;
        }

        .toSelect input[name='back']{
            background-color: #265a88;
        }



    </style>
</head>

<body>






    <div id="addReceiver">

        <fieldset>
            <legend><span>1.购物车</span>&lt;<span>2.订单提交</span>&lt;<span>3.付款</span></legend>
            <form >
                <p><span>姓名：</span><input type="text" name="address-username"/><span class="error address-user"></span></p>
                <p><span>手机号码：</span><input type="text" name="address-phone"/><span class="error address-phone"></span></p>
                <div class="info">
                    <div>
                        <select id="s_province" name="s_province"></select>  
                        <select id="s_city" name="s_city" ></select>  
                        <select id="s_county" name="s_county"></select>
                        <script class="resources library" src="area.js" type="text/javascript"></script>

                        <script type="text/javascript">_init_area();</script>
                    </div>
                    <div id="show"></div>
                </div>
                <span class="address-text">详细地址：</span><textarea name="text"></textarea><span class="error address"></span>
                <p><span>邮政编码：</span><input type="text" name="postalcode"/><span class="error postalcode"></span></p>
            </form>


            <hr/>

            <p><input type="radio" checked="checked"/>顺丰速运</p>

            <div class="backOrTo">

            <input type="button" value="返回"  name="address-back"/>
            <input type="button" value="<?php if($_REQUEST['just']){echo '提交';}else{ echo '去付款';}?>"  name="toAccount" just="<?php echo $_REQUEST['just']?>"/>
            </div>

        </fieldset>


    </div>

    <div id="selectAddress">
        <?php if($address):?>

                <?php foreach($address as $a):?>


                <div class="address-area" addressID="<?php echo $a['id'];?>">
                    <p><i class="iconfont icon-guanbi pull-right delAddress"></i></p>
                    <p><i class="iconfont icon-user"></i><span><?php echo $a['name']?></span></p>
                    <p><i class="iconfont icon-phone"></i><?php echo $a['phone']?></p>
                    <p><i class="iconfont icon-shouhuodizhi"></i><?php echo $a['address']?></p>
                </div>
                <?php endforeach;?>

        <?php endif;?>

        <div class="toSelect">
            <?php if($addressCount<4):?>
            <input type="button" value="添加收件人" name="addReceiver"/>
           <?php endif;?>
            <?php if($addressCount>0 ):?>
            <input type="button" value="去付款" name="toAccount2" style="visibility: <?php if($_REQUEST['just']){echo 'hidden';}?>" />
            <?php endif;?>
            <?php if($_REQUEST['just']):?>
                <input type="button" value="返回" name="back" onclick="history.back();"/>
            <?php endif;?>
        </div>


    </div>






    <script type="text/javascript">
        /*var Gid  = document.getElementById ;
        var showArea = function(){
            Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" +
                Gid('s_city').value + " - 县/区" +
                Gid('s_county').value + "</h3>"
        }*/
        //Gid('s_county').setAttribute('onchange','showArea()');
    </script>

    <script>
        $(".info").change(function(){
            var address=$("#s_province").val()+$("#s_city").val()+$("#s_county").val();
            $('textarea').val(address);
        });

        function getData(formData){

            formData.append("username",$("input[name='address-username']").val());
            formData.append("phone",$("input[name='address-phone']").val());
            formData.append("address",$("textarea").val());
            formData.append("postalcode",$("input[name='postalcode']").val());
            return formData;
        }


        document.getElementsByName('toAccount')[0].onclick=function(){

            var formData=new FormData();
            var just=document.getElementsByName('toAccount')[0].getAttribute('just');
            formData.append('just',just);
            formData=getData(formData);
            var xhr=new XMLHttpRequest();
            xhr.onreadystatechange=function(){
                if(this.readyState===4){
                    var result=JSON.parse(this.responseText);
                    if(result['error']){
                        if(result['error']['username']){
                            document.getElementsByClassName('address-user')[0].innerText=result['error']['username'];
                        }
                        if(result['error']['phone']){
                            document.getElementsByClassName('address-phone')[0].innerText=result['error']['phone'];
                        }
                        if(result['error']['address']){
                            document.getElementsByClassName('address')[0].innerText=result['error']['address'];
                        }
                        if(result['error']['postalcode']){
                            document.getElementsByClassName('postalcode')[0].innerText=result['error']['postalcode'];
                        }
                    }
                    if(result['success']){
                        if(!result['just']){
                            location.href="account.php";
                        }else{
                            location.reload();
                        }

                    }
                }
            };
            xhr.open("post","addressCheck.php",true);
            xhr.send(formData);
        };


        function clear(){
            $(".address-area").each(function(){
                if($(this).hasClass("address-active")){
                    $(this).removeClass("address-active");
                }
            })
        }

        var checked=0;
        $(".address-area").click(function(e){
            if(e.target.nodeName==="DIV"){
                clear();
                $(e.target).addClass("address-active");
                checked=e.target.getAttribute("addressID");
            }

        });

        var del=[];
        $(".delAddress").click(function(e){
            var isDel=confirm("是否删除此地址？");
            if(isDel){
                var parent=e.target.parentNode.parentNode;
                del.push(parent.getAttribute("addressID"));
                if(checked===parent.getAttribute("addressID")){
                    checked=0;
                }
                parent.style.display="none";
            }
            var data=new FormData();
            data.append('del',del);
            var xhr=new XMLHttpRequest();
            xhr.open("post","delAndToAccount.php",true);
            xhr.send(data);

        });



        $("input[name='addReceiver']").click(function(){
            $(".address-area").each(function(){
                $(this).css("display","none");
            });

            $(".toSelect").css("display","none");

            $("#addReceiver").css("display","block");
        });

        $("input[name='address-back']").click(function(){
            $("#addReceiver").css("display","none");
            $(".address-area").each(function(){
                $(this).css("display","block");
            });

            $(".toSelect").css("display","block");
        });


        document.getElementsByName("toAccount2")[0].onclick=function(){
            if(checked===0){
                alert("请选择收件人！");
            }else{
                var data=new FormData();
                data.append('del',del);
                data.append('checked',checked);
                var xhr=new XMLHttpRequest();
                xhr.onreadystatechange=function(){
                    if(this.readyState===4){
                        location.href="account.php";
                    }
                };
                xhr.open("post","delAndToAccount.php",true);
                xhr.send(data);
            }


        };
        $("#cart").click(function(){
            $("#shopping").css("display","none");
        })

    </script>
</body>
</html>
