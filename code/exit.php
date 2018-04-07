<?php
/**
 * Created by PhpStorm.
 * User: LC
 * Date: 2018/3/30
 * Time: 16:11
 */

session_start();
$_SESSION=[];       //$_SESSION不可以通过unset删除，否则用户不能再使用$_SESSION，即不能再注册

if(ini_get('session.use_cookies')){
    $params=session_get_cookie_params();
    setcookie(session_name(),'',time()-1);

}


session_destroy();
//
//print_r($_SESSION);

//会话资源删除并不会重置PHPSESSID,PHPSESSID标志此次开启浏览器直至关闭浏览器的活动编号