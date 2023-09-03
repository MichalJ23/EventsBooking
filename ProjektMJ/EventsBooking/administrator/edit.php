<?php
session_start();

include "../config/config.php";

if (isset($_SESSION['id']) && isset($_SESSION['login'])) {

    $id = $_GET["id"];

    if (isset($_POST["submit"])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $event_id = $_POST['event_id'];

        $sql = "UPDATE `participants` SET `first_name`='$first_name',`last_name`='$last_name',`email`='$email',`gender`='$gender', `event_id`='$event_id' WHERE id = $id";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: index.php?msg=Data updated successfully");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }

    // Zapytanie do bazy danych
    $sql2 = "SELECT id, title FROM events WHERE isActive=1";
    $resultEvents = mysqli_query($conn, $sql2);

?>




    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>PHP CRUD Application</title>
    </head>

    <body>
        <br>
        <div class="container">
            <div class="text-center mb-4">
                <h3>Edycja informacji o uczestniku</h3>
                <p class="text-muted">Naciśnij przycisk ,,Aktualizuj" po edycji</p>
            </div>

            <?php
            $sql = "SELECT * FROM `participants` WHERE id = $id LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width:50vw; min-width:300px;">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Imię:</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name'] ?>">
                        </div>

                        <div class="col">
                            <label class="form-label">Nazwisko:</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name'] ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label>Płeć:</label>
                        &nbsp;
                        <input type="radio" class="form-check-input" name="gender" id="male" value="Mężczyzna" <?php echo ($row['gender'] == 'mężczyzna') ? "checked": ""; ?>>
                        <label for="male" class="form-input-label">Mężczyzna</label>
                        &nbsp;
                        <input type="radio" class="form-check-input" name="gender" id="female" value="Kobieta" <?php echo ($row['gender'] == 'kobieta') ? "checked" : ""; ?>>
                        <label for="female" class="form-input-label">Kobieta</label>
                    </div>

                    <div class="form-group">
                        <label for="event_id">Wybierz wydarzenie</label>
                        <select class="form-control" id="event_id" name="event_id">
                            <?php
                            while ($eventRow = mysqli_fetch_assoc($resultEvents)) {
                                $selected = ($eventRow["id"] == $row["event_id"]) ? 'selected' : '';
                                echo '<option value="' . $eventRow["id"] . '" ' . $selected . '>' . $eventRow["title"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <br>
                    <div>
                        <button type="submit" class="btn btn-success" name="submit">Aktualizuj</button>
                        <a href="index.php" class="btn btn-danger">Anuluj</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    </body>

    </html>

<?php
} else {
    header("Location: ../index.php");
    exit();
}
?>