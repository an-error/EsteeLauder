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
    <link href="../style/herStories.css" rel="stylesheet"/>
</head>

<body>

    <video id="myVideo" src="../video/0.blv" type="video/blv"  width="768px" height="432px"  controls  loop autoplay></video>
    <img src="../img/20180504213105.png" id="logo-video"/>

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

<div>
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
