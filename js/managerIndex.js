$( function () {
    $( '#myTab a:last' ).tab( 'show' );
} );

$('.dropdown-toggle').click(function(){
    $('.dropdown-menu').css("display","block");
});

$('#collapseOne').on('hide',function(){
    $(this).css("display","none");
});

$(".icon-logout").click(function(){
    var isExit=confirm("是否退出？");
    if(isExit){
        location.href="managerLogin.php";
    }

});

document.getElementsByName("search")[0].onkeydown=function(){
    if(event.keyCode=='13'){
        if(this.value) {

            var frame=document.getElementById("frame-content");
            frame.src="search.php?search="+this.value;
        }
    }
};


$("#nav li").click(function(){
    if($(this).find(".secondary").length!==0 || $(this.parentNode).hasClass('secondary')){
        console.log($(this.parentNode).hasClass('secondary'));
        var secondary=$(this).find(".secondary");
        if(secondary.css("display")==="none"){
            $(".secondary").css("display","none");
            secondary.css("display","block");
        }else{
            secondary.css("display","none");
        }

    }else{
        $(".secondary").css("display","none");
    }
    event.stopPropagation();
})
