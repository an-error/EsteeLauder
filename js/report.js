var bar = {
    title: {
        text: '商品销售量',
        left: 'center',
        top: 20,
        textStyle: {
            color: '#ccc'
        }
    },
    xAxis: {
        type: 'category',
        data: []
    },
    yAxis: {
        type: 'value'
    },
    series: [{
        data: [],
        type: 'bar'
    }]
};


var line = {

    title: {
        text: '2018年月份销售额',
        left: 'center',
        top: 20,
        textStyle: {
            color: '#ccc'
        }
    },

    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: []
    },
    yAxis: {
        type: 'value'
    },
    series: [{
        data: [],
        type: 'line',
        areaStyle: {}
    }]
};

var pie = {
    backgroundColor: 'white',

    title: {
        text: '各分类占销售总额的比率',
        left: 'center',
        top: 20,
        textStyle: {
            color: '#ccc'
        }
    },

    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },

    visualMap: {
        show: false,
        min: 80,
        max: 600,
        inRange: {
            colorLightness: [0, 1]
        }
    },
    series : [
        {
            name:'',
            type:'pie',
            radius : '55%',
            center: ['50%', '50%'],
            data:'',
            roseType: 'radius',
            label: {
                normal: {
                    textStyle: {
                        color: '#8B8B83'
                    }
                }
            },
            labelLine: {
                normal: {
                    lineStyle: {
                        color: '#8B8B83'
                    },
                    smooth: 0.2,
                    length: 10,
                    length2: 20
                }
            },
            itemStyle: {
                normal: {
                    color: '#c23531',
                    shadowBlur: 200,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            },

            animationType: 'scale',
            animationEasing: 'elasticOut',
            animationDelay: function (idx) {
                return Math.random() * 200;
            }
        }
    ]
};



function makeCharts(option,container,x,y){
    var myChart=echarts.init(document.getElementById(container));
    option.xAxis.data=x;
    option.series[0].data=y;
    myChart.setOption(option);
}

function makePie(data){
    var myChart=echarts.init(document.getElementById("pie"));
    pie.series[0].data=data.sort(function (a, b) { return a.value - b.value; });
    myChart.setOption(pie);
}

var xhr=new XMLHttpRequest();
xhr.onreadystatechange=function(){
    if(this.readyState===4){
        var data=JSON.parse(this.responseText);
        makeCharts(bar,"bar",data['bar']['key'],data['bar']['value']);
        makeCharts(line,"line",data['line']['month'],data['line']['value']);
        makePie(data['pie']);
    }
};
xhr.open("post","reportData.php",true);
xhr.send();

