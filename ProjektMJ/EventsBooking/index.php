<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>

<body>
    <div class="login">
        <h1>Zaloguj się do panelu administratora</h1>
        <?php if (isset($_GET['error'])) { ?>
     		        <p class="error" style="color: red; font-size:20px;"><?php echo $_GET['error']; ?></p>
     	        <?php } ?>
        <form action="login.php" method="post">
            <div class="container">
                <label for="uname"><b>Login</b></label>
                <input type="text" placeholder="Wpisz login" name="uname" required>

                <label for="psw"><b>Hasło</b></label>
                <input type="password" placeholder="Wpisz hasło" name="psw" required>
                

                <button type="submit">Zaloguj</button>
                <br>
            </div>
        </form>
    </div>
</body>

</html>