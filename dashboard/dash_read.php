<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="read_style.css">
</head>
<body>
<?php
$connect = mysqli_connect('localhost', 'root', '', 'dash');
$number = $_GET['number'];  // GET 방식 사용
session_start();
$query = "select title, content, date, hit, id from board where number = $number";
$result = $connect->query($query);
$rows = mysqli_fetch_assoc($result);

$hit = "update board set hit = hit + 1 where number = $number";
$connect->query($hit);

if (isset($_SESSION['userid'])) {
    ?><b><?php echo $_SESSION['userid']; ?></b>님 반갑습니다.
    <button onclick="location.href='logout_action.php'" style="float:right; font-size:15.5px;">로그아웃</button>
    <br />
    <?php
} else {
    ?>
    <button onclick="location.href='dash_login.php'" style="float:right; font-size:15.5px;">로그인</button>
    <br />
    <?php
}
?>

<table class="read_table" align=center>
    <tr>
        <td colspan="4" class="read_title"><?php echo $rows['title'] ?></td>
    </tr>
    <tr>
        <td class="read_id">작성자</td>
        <td class="read_id2"><?php echo $rows['id'] ?></td>
        <td class="read_hit">조회수</td>
        <td class="read_hit2"><?php echo $rows['hit'] + 1 ?></td>
    </tr>


    <tr>
        <td colspan="4" class="read_content" valign="top">
            <?php echo $rows['content'] ?></td>
    </tr>
</table>

<div class="read_btn">
    <button class="read_btn1" onclick="location.href='dashboard.php'">목록</button>&nbsp;&nbsp;
    <?php
    if (isset($_SESSION['userid']) and $_SESSION['userid'] == $rows['id']) { ?>
        <button class="read_btn1" onclick="location.href='dash_modify.php?number=<?= $number ?>'">수정</button>&nbsp;&nbsp;
                                                                                                          <!-- 여기서부터 추가됨 -->
        <button class="read_btn1" a onclick="ask();">삭제</button>

        <script>
            function ask() {
                if (confirm("게시글을 삭제하시겠습니까?")) {
                    window.location = "dash_delete.php?number=<?= $number ?>"
                }
            }
        </script>
        <!-- 여기까지 -->
    <?php } ?>

</div>
</body>

</html>