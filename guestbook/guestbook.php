<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="guest_style.css">
</head>
<body>
<div class="dashboard">
    <ul class="dashboard__bar">
        <li id="view_site" class="dashboard__bar__item">
            <a href="../main/index.html" class="dashboard__bar__item--btn"><i class="fas fa-home"></i><i>Simple
                    is the Best</i></a>
        </li>
        <li id="profile" class="dashboard__bar__item">
            <a href="#profile" class="dashboard__bar__item--btn"><i class="fas fa-portrait"></i>Profile</a>
            <div class="dashboard__submenu">
                <a href="../guestbook/guest_register.php">Sign-up</a>
                <a href="../guestbook/guest_login.php">Log-in</a>
            </div>
        </li>
        <li id="Menu" class="dashboard__bar__item">
            <a href="#Menu" class="dashboard__bar__item--btn"><i class="fas fa-portrait"></i>Menu</a>
            <div class="dashboard__submenu">
                <a href="../dashboard/dashboard.php">Dashboard</a>
                <a href="../guestbook/guestbook.php">Guestbook</a>
            </div>
        </li>
        <li id="k-mozzi" class="dashboard__bar__item">
            <a href="#k-mozzi" class="dashboard__bar__item--btn"><i class="fas fa-portrait"></i>k-mozzi</a>
            <div class="dashboard__submenu">
                <a href="https://k-mozzi.tistory.com/" target="_blank">Blog</a>
                <a href="https://github.com/k-mozzi" target="_blank">Github</a>
            </div>
        </li>
    </ul>
</div>
<div id="real_dash">
    <?php
    $connect = mysqli_connect('localhost', 'root', '', 'dash') or die("connect failed");
    $query = "select * from guestbook order by number desc";    //역순 출력
    $result = mysqli_query($connect, $query);
    //$result = $connect->query($query);
    $total = mysqli_num_rows($result);  //result set의 총 레코드(행) 수 반환

    session_start();

    if (isset($_SESSION['userid'])) {
        ?><div style="float:left"><b><?php echo $_SESSION['userid']; ?></b>님 반갑습니다.</div>
        <button onclick="location.href='guest_logout_action.php'" style="float:right; font-size:1rem; cursor: pointer">로그아웃</button>
        <br/>
        <?php
    } else {
        ?>

        <?php
    }
    ?>
    <p style="font-size:1.5rem; text-align:center"><b>방명록</b></p>
    <table align=center>
        <thead align="center">
        <tr>
            <td width="50" align="center">번호</td>
            <td width="500" align="center">제목</td>
            <td width="100" align="center">작성자</td>
            <td width="200" align="center">날짜</td>
            <td width="50" align="center">조회수</td>
        </tr>
        </thead>

        <tbody>
        <?php
        while ($rows = mysqli_fetch_assoc($result)) { //result set에서 레코드(행)를 1개씩 리턴
            if ($total % 2 == 0) {
                ?>
                <tr class="even">
                <!--배경색 진하게-->
            <?php } else {
                ?>
                <tr>
                <!--배경색 그냥-->
            <?php } ?>
            <td width="50" align="center"><?php echo $total ?></td>
            <td width="500" align="center">
                <a href="guest_read.php?number=<?php echo $rows['number'] ?>" style="text-decoration: none; color: black">
                    <?php echo $rows['title'] ?>
            </td>
            <td width="100" align="center"><?php echo $rows['id'] ?></td>
            <td width="200" align="center"><?php echo $rows['date'] ?></td>
            <td width="50" align="center"><?php echo $rows['hit'] ?></td>
            </tr>
            <?php
            $total--;
        }
        ?>
        </tbody>
    </table>

    <div class=text>
        <font style="cursor: pointer" onClick="location.href='guest_write.php'"><b>인사하기</b></font>
    </div>
</div>
</body>

</html>