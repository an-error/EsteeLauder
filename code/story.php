<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/4/23
 * Time: 16:07
 */
include("module.php");
include("minHeader.php");
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <style>
        #myVideo{
            position:relative;
            left:28%;
            top:280px;
        }

        #logo-video{
            position:absolute;
            top:170px;
            left:26%;
            width:200px;
            height:80px;
        }

        #container{
            width:1200px;
            height:auto;
            margin:auto;
            position:relative;
        }

        #logo-story{
            position:relative;
            left:320px;
        }
        hr{
            margin-top:400px;
            clear:both;
        }
        .row img{
            float:left;
        }

        .row {
            margin-bottom: 40px;
        }

        .estee{
            position:relative;
            left:13%;
        }

        #story{
            margin-top:70px;
        }
        .estee  p{
            position:absolute;
            top:100px;
            left:58%;
            font-size:30px;
            color:white;
            font-family: STLiti;
        }

        #story textarea{
            width:900px;
            height:270px;
            display:block;
            margin:40px auto;
            font-family: STLiti;
            font-size:20px;
            border:none;
        }
        #story textarea:nth-child(2){
            width:1200px;
            height:500px;
        }

        .hepburn {
            position:relative;
        }

        .hepburn>div{
            position:absolute;
            top:400px;
            left:700px;
            width:400px;
            height:100px;
            color:black;
        }

        .hepburn p{
            color:black;
            width:150px;
            font-size:30px;
            font-family: STLiti;
        }

        .hepburn span{
            display:block;
            padding-left:70px;
        }



    </style>
</head>

<body>

    <video id="myVideo" src="../video/0.blv" type="video/blv"  width="768px" height="432px"  controls  loop autoplay></video>
    <img src="../image/ee_logo_lg.png" id="logo-video"/>

    <hr/>
    <div id="container">
        <img src="../image/ee_logo_lg.png" id="logo-story"/>
        <div class="row">
            <img src="../image/es_quote_confidence-breeds-beauty-v2.jpg"/>
            <img src="../image/041918_3_minutes_with_karlie_kloss_hero.jpg"/>
        </div>
        <div class="row">
            <img src="../image/0e75b230e9b8a9dc47cf18b9e0b1beff_800_532.jpeg"/>
            <img src="../image/es_quote_women-share-a-common-language.jpg"/>
        </div>

        <div id="story">
            <div class="estee">
                <img src="../image/5_hero.jpg"/>
                <p>estee lauder</p>
                <textarea>
                    雅诗兰黛夫人一直认为“每一个女人都可以永远拥有美丽和时尚”。由此，她将自己的生活品位和对时尚的敏感度融入雅诗兰黛品牌中，不但重塑了美国化妆品行业的面貌，更影响了全球的化妆品市场。
                    尽管业绩斐然，雅诗兰黛品牌始终坚持创造这个美丽事业时的初衷——为每个女性带来美丽。坚信科学研发的力量；保持积极向上的精神状况；体验护肤品带来的改变；保持与人良好的交流，这些精神至今仍是品牌为女性带来的指引与启迪。
                    1995年，雅诗兰黛夫人正式退休。正如她之前一直强调的，她的蓝色美容帝国将永远是一个拥有爱和灵魂的公司：“我的家族将继续致力于传承美的信念与使命”。
                </textarea>
            </div>
            <div>
                <img src="../image/4_hero.jpg"/>
                <textarea>
                    雅诗兰黛公司于第二次世界大战以后，诞生于纽约。雅诗·门泽尔1907年出生在纽约皇后区一个匈牙利犹太移民家庭，父亲家里的第九个孩子。雅诗的叔叔是一位药剂师，平日喜欢在实验室里调制各种化学制剂。上世纪30年代，雅诗从叔叔那里获约著名大百货公司“SAKS第五大道”让自己开设专卖柜台，雅诗兰黛作为高档美容护肤品品牌的知名度从此直线上升。
                    上世纪60年代雅诗兰黛开始大举拓展国际市场，先后进入英国、加拿大、澳大利亚、德国、法国和日本。雅诗兰黛的专柜大多设立在高档百货店内，如伦敦的哈罗德、巴黎的老佛爷等。越是时尚昂贵的地方，就越合兰黛夫人的心意。
                    此外，公司还不断扩充自己的产品线，1964年推出男用香水和美容护肤产品，1968年建立倩碧（Clinique）实验室，研制生产经过抗敏试验，不含香精的美容护肤产品。1990年，为适应全球环保潮流，雅诗兰黛成立Origin有限公司，该公司研制的产品突出纯天然植物配方，不经动物实验，所有包装都可以回收利用。
                    1985年，雅诗兰黛的年销售收入突破10亿美元。1995年公司在纽约证交所挂牌上市。雅诗兰黛产品在世界130个国家和地区销售，2004年财年公司的净销售收入为57.9亿美元，是名副其实的化妆品帝国。EsteeLauder、La Mer、Clinique、Origins、MAC等品牌都属于雅诗兰黛旗下，占据了美国知名化妆品品牌的半壁江山。
                    雅诗兰黛仍然保持着浓厚的家族色彩，最高管理层中有4人是家族成员。2004年4月，一手创建雅诗兰黛的兰黛夫人在曼哈顿的家中去世，享年97岁。兰黛夫人在1998年被《时代》周刊评为20世纪最有影响力的20位商业奇才之一，并且是惟一的女性。
                    兰黛夫人1946年创办公司时，就怀有一种不可动摇的信念，那就是：“每个女人都可以美丽”。到2004年她去世的时候，这一简单理念几乎改变了化妆品世界的面貌，在美国，雅诗兰黛已经是时尚完美的典型代表。
                </textarea>
            </div>
            <div class="hepburn">
                <img src="../image/091114_ee31_note_from_audrey_hepburn_img1.jpg"/>
                    <div>
                       <p >“我的一天从你而始，由你而终”</p>
                        <span>——奥黛丽·赫本，1992</span>
                    </div>
            </div>

        </div>
    </div>
<?php include("footer.php")?>
</body>
</html>
