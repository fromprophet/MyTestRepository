<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/1/001
 * Time: 14:23
 */
header("content-type:text/html;charset=utf-8");
session_start ();
$preUser = $_SESSION["username"];
//echo $preUser;
$gameTime = $_POST["gameTime"];
$firstCount = $_POST["firstCount"];
$secondCount = $_POST["secondCount"];
$thirdCount = $_POST["thirdCount"];
$gameGrade = $_POST["gameGrade"];
$con = new mysqli("localhost","root","lbxjhbs151221","gamecontent");
$gameSql = "insert into admin(userName,gameTime,firstCount,secondCount,thirdCount,gameGrade) values ('$preUser','$gameTime','$firstCount','$secondCount','$thirdCount','$gameGrade')";
$gameRes = $con->query($gameSql);
$userSql = "select * from user where userName='$preUser'";
$userRes = $con->query($userSql);
$userRow = $userRes->fetch_object();
$userGameProperty = (int)$userRow->gameProperty;
$userGameCount = (int)$userRow->gameCount;
echo $userGameProperty;
echo $userGameCount;
//$userGameProperty += (int)$gameGrade;
//$userGameCount += 1;
//echo $userGameProperty;
//echo $userGameCount;
$updateSql = "UPDATE user SET gameProperty=gameProperty+'$gameGrade',gameCount=gameCount+1 WHERE userName='$preUser'";
$updateUserRes = $con->query($updateSql);
if ($gameRes && $updateUserRes){
    echo "<script>
        alert(\"成功录入\");
        window.location.href = 'welcome.php';
        
    </script>";

}
else {
    echo "<script>alert(\"失败录入\");</script>";
}
?>