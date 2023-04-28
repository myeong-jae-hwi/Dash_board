<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="guest_modify_style.css">
</head>
<body>
<?php
$connect = mysqli_connect('localhost', 'root', '', 'dash') or die("connect failed");
$number = $_GET['number'];
$query = "select title, content, date, id from guestbook where number = $number";
$result = $connect->query($query);
$rows = mysqli_fetch_assoc($result);

$title = $rows['title'];
$content = $rows['content'];
$userid = $rows['id'];

session_start();

$URL = "guestbook.php";

if (!isset($_SESSION['userid'])) {
    ?> <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo $URL ?>");
</script>
<?php   } else if ($_SESSION['userid'] == $userid) {
?>
    <form method="POST" action="guest_modify_action.php">
        <table style="padding-top:50px" align=center width=auto border=0 cellpadding=2>
            <tr>
                <td>
                    <p style="font-size:25px; text-align:center; color:white; margin-top:15px; margin-bottom:15px"><b>방명록 수정하기</b></p>
                </td>
            </tr>
            <tr>
                <td bgcolor=white>
                    <table class="table2">
                        <tr>
                            <td>작성자</td>
                            <td><input type="hidden" name="id" value="<?= $_SESSION['userid'] ?>"><?= $_SESSION['userid'] ?></td>
                        </tr>

                        <tr>
                            <td>제목</td>
                            <td><input type=text name=title size=87 value="<?= $title ?>"></td>
                        </tr>

                        <tr>
                            <td>내용</td>
                            <td><textarea name=content cols=75 rows=15><?= $content ?></textarea></td>
                        </tr>

                    </table>

                    <center>
                        <input type="hidden" name="number" value="<?= $number ?>">
                        <input style="height:26px; width:47px; font-size:16px;" type="submit" value="작성">
                    </center>
                </td>
            </tr>
        </table>
    </form>
<?php   } else {
?> <script>
    alert("권한이 없습니다.");
    location.replace("<?php echo $URL ?>");
</script>
<?php   }
?>
</body>

</html>