<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>欢迎登录界面</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/icommon.css">
    <link rel="stylesheet" type="text/css" href="css/welcome.css">
    <script src="js/prefixfree.min.js"></script>
    <script src="js/welcome.js"></script>
</head>
<body>
<?php
header("content-type:text/html;charset=utf-8");
session_start ();
$preUser = $_SESSION["username"];
//echo $preUser;
if (isset ( $_SESSION ["code"] )) {//判断code存不存在，如果不存在，说明异常登录

    //echo $preUser;//显示登录用户名
    $con=new mysqli("localhost","root","lbxjhbs151221","gamecontent");
    $searchSql = "select * from user where userName='$preUser'";
    $res = $con->query($searchSql);
    $row = $res->fetch_object();
    $currUserName = $row->userName;
    $currGender = $row->userGender;
    $currTel = $row->userTel;
    $currProperty = $row->gameProperty;
    $currCount = $row->gameCount;
    $currRegistTime = $row->registTime;

    $gameSql = "select * from admin where userName='$preUser'";
    $list = array();
    $gameRes = $con->query($gameSql);
    while($gameRow = $gameRes->fetch_array()){
        $list[] = $gameRow;
    }
    //echo $list;
//    $currGameTime = $gameRow->gameTime;
//    $currFirstCount = $gameRow->firstCount;
//    $currSecondCount = $gameRow->secondCount;
//    $currThirdCount = $gameRow->thirdCount;
//    $currGameGrade = $gameRow->gameGrade;
}
?>

<div class="page">
    <section class="demo">
        <div class="admin-panel clearfix">
            <div class="slidebar">
                <ul>
                    <li><a href="#userinfo" id="targeted">用户信息</a></li>
                    <li><a href="#games">游戏菜单</a></li>
                    <li><a href="#friends">好友</a></li>
                    <li><a href="#histories">历史战绩</a></li>
                    <li><a href="#tops">排行榜</a></li>
                </ul>
            </div>
            <div class="main">
                <div class="mainContent clearfix">
                    <div id="userinfo">
                        <h2 class="header">用户信息</h2>
                        <div class="usercontent">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td class="col-md-4">用户名</td>
                                    <td class="col-md-8"><?echo $currUserName ?></td>
                                </tr>
                                <tr>
                                    <td class="col-md-4">性别</td>
                                    <td class="col-md-8"><?echo $currGender ?></td>
                                </tr>
                                <tr>
                                    <td class="col-md-4">联系方式</td>
                                    <td class="col-md-8"><?echo $currTel ?></td>
                                </tr>
                                <tr>
                                    <td class="col-md-4">游戏局数</td>
                                    <td class="col-md-8"><?echo $currCount ?></td>
                                </tr>
                                <tr>
                                    <td class="col-md-4">资产</td>
                                    <td class="col-md-8"><?echo $currProperty ?></td>
                                </tr>
                                <tr>
                                    <td class="col-md-4">注册时间</td>
                                    <td class="col-md-8"><?echo $currRegistTime ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div id="games">
                        <h2 class="header">游戏菜单</h2>
                        <div class="gamelist">
                            <table class="table">
                                <tr>
                                    <td rowspan="2" class="col-md-3 gameicon">
                                        <img src="images/icon_basic.png" />
                                    </td>
                                    <td class="col-md-7"><b>挖矿游戏</b></td>
                                    <td rowspan="2" class="col-md-2"><a href="gamecontent.html" id="gamestart">开始游戏</a></td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">你有三次挖矿的机会，能否赚钱就在现在！</td>
                                </tr>
                                <tr>
                                    <td rowspan="2" class="col-md-3 gameicon">
                                        <img src="images/icon_basic.png" />
                                    </td>
                                    <td class="col-md-7"><b>挖矿游戏</b></td>
                                    <td rowspan="2" class="col-md-2"><a href="gamecontent.html" id="gamestart">开始游戏</a></td>
                                </tr>
                                <tr>
                                    <td class="col-md-6">你有三次挖矿的机会，能否赚钱就在现在！</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div id="friends"><h2 class="header">好友</h2></div>
                    <div id="histories">
                        <h2 class="header">历史战绩</h2>
                        <div class="gameHistory">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td class="col-md-1">用户名</td>
                                    <td class="col-md-3">游戏时间</td>
                                    <td class="col-md-2">第一次成绩</td>
                                    <td class="col-md-2">第二次成绩</td>
                                    <td class="col-md-2">第三次成绩</td>
                                    <td class="col-md-2">总成绩</td>
                                </tr>
                                </thead>
                                <tbody id="gameHistroies">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="tops"><h2 class="header">排行榜</h2></div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>

        var histories = document.getElementById('gameHistroies');
        console.log(histories);
        var list = new Array();
        list = <?php echo json_encode($list); ?>;
        console.log(list[0][1]);
        if (list != null){

            for (i = 0;i < list.length;i++){
                var newtr = document.createElement('tr');
                var newUserName = document.createElement('td');
                newUserName.className = 'col-md-1';
                newUserName.innerHTML = list[i][0];
                console.log(newtr);
                newtr.appendChild(newUserName);
                var newGameTime = document.createElement('td');
                newGameTime.className = 'col-md-3';
                newGameTime.innerHTML = list[i][1];
                newtr.appendChild(newGameTime);
                var newFirstCount = document.createElement('td');
                newFirstCount.className = 'col-md-2';
                newFirstCount.innerHTML = list[i][2];
                newtr.appendChild(newFirstCount);
                var newSecondCount = document.createElement('td');
                newSecondCount.className = 'col-md-2';
                newSecondCount.innerHTML = list[i][3];
                newtr.appendChild(newSecondCount);
                var newThirdCount = document.createElement('td');
                newThirdCount.className = 'col-md-2';
                newThirdCount.innerHTML = list[i][4];
                newtr.appendChild(newThirdCount);
                var newGameGrade = document.createElement('td');
                newGameGrade.className = 'col-md-2';
                newGameGrade.innerHTML = list[i][5];
                newtr.appendChild(newGameGrade);
                histories.appendChild(newtr);
            }

        }

</script>





</body>
</html>