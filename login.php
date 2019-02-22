<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/28/028
 * Time: 16:24
 */
header("content-type:text/html;charset=utf-8");
session_start();
$userName = $_POST["userName"];
$password = $_POST["userPassword"];
$con=new mysqli("localhost","root","lbxjhbs151221","gamecontent");//连接mysql 数据库
$dbuserName = null;
$dbPassword = null;
$selSql = "select * from user where userName='$userName'";
$res = $con->query($selSql);
$row = $res->fetch_object();
if ($row->userName == $userName){
    if ($row->userPassword == $password){
        //echo "<script>alert('正确登录');</script>";
        $_SESSION["username"] = $userName;
        $_SESSION["code"]=mt_rand(0, 100000);//给session附一个随机值，防止用户直接通过调用界面访问welcome.php
        echo "<script>window.location.href = \"welcome.php\";</script>";
    }
    else{
        echo "<script>alert('密码错误');history.back();</script>";
    }
}
else{
    echo "<script>alert('用户不存在');history.back();</script>";
}
mysqli_close($con);
?>




