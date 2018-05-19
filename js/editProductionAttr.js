$("table").on("change","input[type='number']",function(){
    console.log("input值:"+this.value);
    if(this.value<0){
        this.value=0;
    }
});


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