<?php
//  启动会话，这步必不可少
session_start();
//  判断是否登陆
if (isset($_SESSION["username"]) && $_SESSION["logged"] === true) {
    echo "您已经成功登陆".$_SESSION["username"];
} else {
    //  验证失败，将 $_SESSION["admin"] 置为 false
    $_SESSION["logged"] = false;
    die("您无权访问");
}
?>