<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>

<div class="navi">
    <div>
        <a href="../main/index.html" class="dashboard__bar__item--btn">게시판</a>
    </div>
</div>
<div id="real_dash">
    <?php
    $connect = mysqli_connect('localhost', 'root', '', 'dash') or die("connect failed");
    $query = "select * from board order by number desc";    //역순 출력
    $result = mysqli_query($connect, $query);
    //$result = $connect->query($query);
    $total = mysqli_num_rows($result);  //result set의 총 레코드(행) 수 반환

    session_start();

    if (isset($_SESSION['userid'])) {
        ?>
        <div style="float:bottom"><b><?php echo $_SESSION['userid']; ?></b>님 반갑습니다.</div>
        <button onclick="location.href='logout_action.php'" style="float:right; font-size:1rem; cursor: pointer">
            Logout
        </button>
        <br/>
        <?php
    } else {
        ?>

        <?php
    }
    ?>
</div>
<div class="note">
    <div class="sidebar">
        <div class="sidebar_line">
            <button id="create" onClick="location.href='dash_write.php'">Writing
                <img src="../main/image/curser2.png">
            </button>
        </div>
    </div>
    <div id="container">
        <!--            --><?php
        //            while ($rows = mysqli_fetch_assoc($result)) { //result set에서 레코드(행)를 1개씩 리턴
        //            ?>
        <div class="item <?php $total ?>">
            <div class="grab"></div>
            <!--                <table>-->
            <!--                    <tr>-->
            <!--                        <td>-->
            <!--                            NO.-->
            <!--                        </td>-->
            <!--                        <td>-->
            <!--                            --><?php //echo $total ?>
            <!--                        </td>-->
            <!--                        <td style="float: right">-->
            <!--                            조회수.-->
            <!--                        </td>-->
            <!--                        <td>-->
            <!--                            --><?php //echo $rows['hit'] ?>
            <!--                        </td>-->
            <!--                    </tr>-->
            <!--                    <tr>-->
            <!--                        <td>-->
            <!--                            title.-->
            <!--                        </td>-->
            <!--                        <td>-->
            <!--                            <a href="dash_read.php?number=--><?php //echo $rows['number'] ?><!--"-->
            <!--                               style="text-decoration: none; color: black">-->
            <!--                                --><?php //echo $rows['title'] ?>
            <!--                        </td?-->
            <!--                    </tr>-->
            <!--                    <tr>-->
            <!--                        <td style="float: right">-->
            <!--                            작성자.-->
            <!--                        </td>-->
            <!--                        <td>-->
            <!--                            --><?php //echo $rows['id'] ?>
            <!--                        </td>-->
            <!--                    </tr>-->
            <!--                    <tr>-->
            <!---->
            <!--                    </tr>-->
            <!--                </table>-->
        </div>
        <!--                --><?php
        //                $total--;
        //            }
        //            ?>
    </div>

</div>
<script>
    const container = document.getElementById('container');
    const object = document.querySelector('.item');
    const grab = document.querySelector('.grab');


    let isDragging = false;
    let initialX;
    let initialY;
    let xOffset = 0;
    let yOffset = 0;

    document.addEventListener('mousedown', dragStart);
    document.addEventListener('mousemove', drag);
    document.addEventListener('mouseup', dragEnd);

    function dragStart(e) {
        // 마우스 클릭한 위치가 객체 위에 있는지 확인
        if (e.target === grab) {
            isDragging = true;
            initialX = e.clientX - xOffset;
            initialY = e.clientY - yOffset;
        }
    }

    function dragEnd() {
        isDragging = false;
    }

    function drag(e) {
        if (isDragging) {
            e.preventDefault();

            currentX = e.clientX - initialX;
            currentY = e.clientY - initialY;

            // 객체의 위치와 크기를 가져옴
            const rect = object.getBoundingClientRect();
            const containerRect = container.getBoundingClientRect();

            // 객체의 위치가 컨테이너 안에 있도록 보정
            const maxX = containerRect.width - rect.width;
            const maxY = containerRect.height - rect.height;
            const newX = Math.max(0, Math.min(maxX, currentX));
            const newY = Math.max(0, Math.min(maxY, currentY));

            xOffset = newX;
            yOffset = newY;

            setTranslate(newX, newY, object);
        }
    }

    function setTranslate(xPos, yPos, el) {
        el.style.transform = `translate3d(${xPos}px, ${yPos}px, 0)`;
    }

</script>
</body>

</html>