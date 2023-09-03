<?php
session_start();
include "../../config/config.php";
if (isset($_SESSION['id']) && isset($_SESSION['login']) && $_SESSION['isAdmin'] == 1) {

    if (isset($_POST["submit"])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;



        $sql = "INSERT INTO `users`(`id`, `login`, `password`, `name`, `isAdmin`) VALUES (NULL,'$login','$password','$name','$isAdmin')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: index.php?msg=New record created successfully");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Dodaj użytkownika</title>
    </head>

    <body>
    <br>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Dodaj nowego użytkownika</h3>
            <p class="text-muted">Uzupełnij pola i kliknij przycisk "Zapisz"</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="mb-3">
                    <label class="form-label">Login:</label>
                    <input type="text" class="form-control" name="login" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hasło:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nazwa użytkownika:</label>
                    <input type="text" class="form-control" name="name"required>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" name="isAdmin" id="isAdmin">
                    <label class="form-check-label" for="isAdmin">Administrator</label>
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Zapisz</button>
                    <a href="index.php" class="btn btn-danger">Anuluj</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>

    </html>

    <?php
} else {
    header("Location: ../index.php");
    exit();
}
?>
