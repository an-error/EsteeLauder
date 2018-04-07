function toRGB(color){
    var rgb=color.split(",");
    var r=parseInt(rgb[0].split("(")[1]).toString(16);
    var g=parseInt(rgb[1]).toString(16);
    var b=parseInt(rgb[2].split(")")[0]).toString(16);

    //var result="#"+((r<<16)+(g<<8)+b).toString(16);
    if(r.length<2){
        r='0'+r.toString(16);
    }
    if(g.length<2){
        g='0'+g.toString(16);
    }
    if(b.length<2){
        b='0'+b.toString(16);
    }
    return  "#"+r+g+b;
}