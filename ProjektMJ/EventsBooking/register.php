<?php
include "config/config.php";

// Pobierz ID wydarzenia z adresu URL, jeśli istnieje
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : '';

$selected_event = null; // Inicjalizuj zmienną $selected_event

if (!empty($event_id)) {
    // Pobierz dane o wydarzeniu na podstawie przekazanego ID
    $sql2 = "SELECT id, title, date, description FROM events WHERE isActive=1 AND id='$event_id'";
    $resultSelectedEvent = mysqli_query($conn, $sql2);
    $selected_event = mysqli_fetch_assoc($resultSelectedEvent);
}

if (isset($_POST["submit"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $event_id = $_POST['event_id'];

    $sql = "INSERT INTO `participants`(`id`, `first_name`, `last_name`, `email`, `gender`, `event_id`) VALUES (NULL,'$first_name','$last_name','$email','$gender', '$event_id')";

    $result = mysqli_query($conn, $sql);

    $to = $_POST['email']; // Wpisz tutaj docelowy adres e-mail
    $subject = 'Potwierdzenie zapisania się na wydarzenie';

    // Pobierz dane z formularza
    $name = $_POST['first_name'];
    $email = $_POST['email'];
    $message = "Gratulacje! Udało Ci się zapisać na galę";

    // Utwórz treść wiadomości
    $emailContent = "Imię: $name\n";
    $emailContent .= "Email: $email\n";
    $emailContent .= "Wiadomość: $message\n";

    // Ustaw nagłówki wiadomości
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Wyślij wiadomość e-mail
    if (mail($to, $subject, $emailContent, $headers)) {
        echo 'Wiadomość została wysłana.';
    } else {
        echo 'Wysłanie wiadomości nie powiodło się.';
    }

    if ($result) {
        header("Location: thank_you.php");
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

// Pobierz dostępne wydarzenia
$sql2 = "SELECT id, title FROM events WHERE isActive=1";
$resultEvents = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Zapisy na wydarzenie</title>
</head>

<body class="bg-dark text-white">
<br>
<div class="container">
    <div class="text-center mb-4">
        <h3>Zapisz się na wydarzenie</h3>
        <p class="text-muted">Uzupełnij pola i kliknij przycisk ,,Zapisz się"</p>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Imię:</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Albert" required>
                </div>

                <div class="col">
                    <label class="form-label">Nazwisko:</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Einstein" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
            </div>

            <div class="form-group mb-3">
                <label>Płeć:</label>
                &nbsp;
                <input type="radio" class="form-check-input" name="gender" id="male" value="Mężczyzna">
                <label for="male" class="form-input-label">Mężczyzna</label>
                &nbsp;
                <input type="radio" class="form-check-input" name="gender" id="female" value="Kobieta">
                <label for="female" class="form-input-label">Kobieta</label>
            </div>

            <div class="form-group">
                <label>Data wydarzenia:</label>
                <input type="text" class="form-control" value="<?php echo $selected_event['date']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="event_id">Wydarzenie:</label>
                <input type="text" class="form-control" value="<?php echo $selected_event['title']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Opis wydarzenia:</label>
                <textarea class="form-control" rows="5" readonly><?php echo $selected_event['description']; ?></textarea>
            </div>

            <input type="hidden" name="event_id" value="<?php echo $selected_event['id']; ?>">

            <br>
            <div>
                <button type="submit" class="btn btn-success" name="submit">Zapisz się</button>
                <button type="reset" class="btn btn-danger">Anuluj</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
