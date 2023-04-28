<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="write_style.css">
</head>
<body>
<?php
session_start();
$URL = "dash_login.php";
if (!isset($_SESSION['userid'])) {
    ?>

    <script>
        alert("로그인이 필요합니다.");
        location.replace("<?php echo $URL ?>");
    </script>
    <?php
}
?>

<form method="post" action="write_action.php">
    <!-- method를 get -> post로 바꿔야됨!! -->
    <div class="navi">
        <div>
            <a href="../main/index.html" class="dashboard__bar__item--btn">Simple is the Best</a>
        </div>
    </div>
    <div class="note">
        <div class="sidebar">
            <div class="sidebar_line">

            </div>
        </div>
      <div class="item">
          <table>
              <tr>
                <td>작성자 : </td>
                <td><input type="hidden" name="name"
                           value="<?= $_SESSION['userid'] ?>"><?= $_SESSION['userid'] ?> </td>
              </tr>
              <tr>
                  <td>제 목 : </td>
                  <td>
                      <input type="text" name="title" required size="40" placeholder="제목을 입력해주세요">
                  </td>
              </tr>
              <tr>
                  <td>내 용 : </td>
                  <td><textarea name="content" cols=30% rows=10% required placeholder="내용을 입력해주세요"></textarea></td>
              </tr>
          </table>
          <input id="send" type="submit" value="확인">
      </div>
    </div>
</form>
</body>

</html>