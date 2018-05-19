$(function(){
    $("select").each(function(){
        var value=$(this).attr('option');
        if(value!=="已签收" && value!=="已评价" && value!=="待付款" && value!=="交易失败"){
            $(this).val(value);
        }else{
            this.options.length=0;
            var option=$("<option></option>").text(value);
            $(this).append(option);
            $(this).val(value);

        }

    })
})

$("table").on("change","select",function(e){
    var data=new FormData();
    var option=this.value;
    data.append("option",option);
    var orderID=e.target.parentNode.parentNode.getAttribute("orderID");
    data.append("orderID",orderID);

    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.readyState===4){

        }
    };
    xhr.open("post","updateStatus.php",true);
    xhr.send(data);

})

$("table").on("click",".toDetail",function(e){
    var orderID=e.target.parentNode.parentNode.getAttribute("orderID");
    location.href="orderDetail.php?orderID="+orderID;
})