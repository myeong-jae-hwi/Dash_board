<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../profile/log_style.css">
</head>

<body>
<div class="paper">
    <div class="lines">
        <li>
            login
        </li>
        <div class="text">
            <form method='post' action='main_login_action.php'>
                <ul>
                    <li>
                        <label>ID :</label>
                        <input type="text" name="id" autofocus required>
                    </li>
                    <li>
                        <label>PW :</label>
                        <input type="password" name="pw" required>
                    </li>
                </ul>

                <div class="button">
                    <input type="submit" value="login">
                    <input type="reset" value="sign up">
                </div>
            </form>
        </div>
    </div>
    <div class="holes hole-top"></div>
    <div class="holes hole-middle"></div>
    <div class="holes hole-bottom"></div>
</div>
</body>

</html>