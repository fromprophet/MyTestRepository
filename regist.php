<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/30/030
 * Time: 17:45
 */
header("content-type:text/html;charset=utf-8");
date_default_timezone_set("PRC");
$userName = $_POST["userName"];
$password = $_POST["userPassword"];
$gender = $_POST["userGender"];
$tel = $_POST["userTel"];
$registTime = (string)date("Y-m-d H:i:s",intval(time()));
$con=new mysqli("localhost","root","lbxjhbs151221","gamecontent");
$insSql = "insert into user(userName,userPassword,userGender,userTel,gameProperty,gameCount,registTime) values ('$userName','$password','$gender','$tel',0,0,'$registTime')";
$insRes = $con->query($insSql);
if ($insRes) {
    echo "<script>
        alert('注册成功');
        window.location.href = 'login.html';
        </script>";


//    $tableName = $userName;
//    echo $tableName;
//    $createSql = "create table $tableName(
//	userName varchar(16) primary key,
//	gameTime varchar(30) not null,
//	firstCount decimal(5) not null,
//	secondCount decimal(5) not null,
//	thirdCount decimal(5) not null
//) ";
//    echo $createSql;
//    //$registRes = $con->query($createSql);
//    if (mysqli_query($con,$createSql)){
//        echo "<script>
//        alert('注册成功');
//        window.location.href = 'login.html';
//    </script>";
//    }
}

else{
    echo "<script>
        alert('注册失败');
        history.back();
    </script>";
}
?>