<?php
$connect = mysqli_connect("localhost", "root", "", "dash") or die("fail");

$id = $_POST['name'];                   //Writer
$pw = $_POST['pw'];                     //Password
$title = $_POST['title'];               //Title
$content = $_POST['content'];           //Content
$date = date('Y-m-d H:i:s');            //Date

$URL = 'guestbook.php';                   //return URL


$query = "INSERT INTO guestbook (number, title, content, date, hit, id, password) 
        values(null,'$title', '$content', '$date', 0, '$id', '$pw')";


$result = $connect->query($query);
if ($result) {
    ?> <script>
        alert("<?php echo "방명록이 등록되었습니다." ?>");
        location.replace("<?php echo $URL ?>");
    </script>
    <?php
} else {
    echo "방명록 등록에 실패하였습니다.";
}

mysqli_close($connect);
?>