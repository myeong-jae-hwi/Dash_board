<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dash_style.css">
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
//    $result = $connect->query($query);
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
                    <?php
                    while ($rows = mysqli_fetch_assoc($result)) { //result set에서 레코드(행)를 1개씩 리턴
                    ?>
        <div class="item">
            <div class="grab"></div>
                            <table>
                                <tr>
                                    <td>
                                        NO.
                                    </td>
                                    <td>
                                        <?php echo $total ?>
                                    </td>
                                    <td style="float: right">
                                        작성자
                                    </td>
                                    <td>
                                        <?php echo $rows['id'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        title.
                                    </td>
                                    <td>
                                            <?php echo $rows['title'] ?>
                                    </td?
                                </tr>
                                <tr>
                                    <td style="float: right">
                                        내용.
                                    </td>
                                    <td>
                                        <?php echo $rows['id'] ?>
                                    </td>
                                </tr>
                                <tr>

                                </tr>
                            </table>
        </div>
                        <?php
                        $total--;
                    }
                    ?>
    </div>

</div>
<script>
    let activeItem = null;

    const getCoordinates = (e) => {
        let x = e.clientX;
        let y = e.clientY;
        return { x, y };
    };

    document.addEventListener("mousedown", (e) => {
        if (e.target.classList.contains("grab")) {
            activeItem = e.target.parentNode;

            // The activeItem contains the active item.
            activeItem.style.zIndex = 1;

            // The activeItem contains the z-index of the activeItem.
            const items = document.querySelectorAll(".item");
            items.forEach((item) => {
                if (item !== activeItem) {
                    item.style.zIndex = 0;
                }
            });

            const coordinates = getCoordinates(e);
            activeItem.x = coordinates.x - activeItem.offsetLeft;
            activeItem.y = coordinates.y - activeItem.offsetTop;
        }
    });

    document.addEventListener("mouseup", () => {
        activeItem = null;
    });

    document.addEventListener("mousemove", (e) => {
        if (activeItem) {
            e.preventDefault();

            const coordinates = getCoordinates(e);
            const container = document.querySelector("#container");
            const containerRect = container.getBoundingClientRect();

            let left = coordinates.x - activeItem.x;
            let top = coordinates.y - activeItem.y;
            let right = left + activeItem.offsetWidth;
            let bottom = top + activeItem.offsetHeight;

            if (left < containerRect.left) {
                left = containerRect.left;
                right = left + activeItem.offsetWidth;
            } else if (right > containerRect.right) {
                right = containerRect.right;
                left = right - activeItem.offsetWidth;
            }

            if (top < containerRect.top) {
                top = containerRect.top;
                bottom = top + activeItem.offsetHeight;
            } else if (bottom > containerRect.bottom) {
                bottom = containerRect.bottom;
                top = bottom - activeItem.offsetHeight;
            }

            activeItem.style.left = `${left}px`;
            activeItem.style.top = `${top}px`;
        }
    });

</script>

</body>

</html>