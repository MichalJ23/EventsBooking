<?php
session_start();
include "../config/config.php";

if (isset($_SESSION['id']) && isset($_SESSION['login'])) {

?>
    <!DOCTYPE html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--<link rel="stylesheet" href="../css/cms.css">-->
        <title>Panel administratora</title>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Panel administratora</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav justify-content-end">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Uczestnicy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="events/index.php">Wydarzenia</a>
                            </li>
                            <?php
                            if ($_SESSION['isAdmin'] == 0) {
                                echo '<li class="nav-item">';
                                echo '<a class="nav-link" onclick="return alert(\'Nie masz uprawnień administratora!\');">Pracownicy</a>';
                                echo '</li>';
                            } else {
                                echo '<li class="nav-item">';
                                echo '<a class="nav-link" href="employees/index.php">Pracownicy</a>';
                                echo '</li>';
                            }
                            ?>
                            <li class="nav-item">
                                <a href="../logout.php" class="nav-link ml-auto">&#9919 Wyloguj</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="d-flex justify-content-center">
            <h3 class="text-center">Uczesnicy wydarzenia</h3>
        </div>
        <div class="container">
            <?php
            if (isset($_GET["msg"])) {
                $msg = $_GET["msg"];
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
            }
            ?>
            <a href="add-new.php" class="btn btn-dark mb-3">Dodaj</a>

            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Imię</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">Email</th>
                        <th scope="col">Płeć</th>
                        <th scope="col">Wydarzenie</th>
                        <th scope="col">Akcja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT participants.id, participants.first_name, participants.last_name, participants.email, participants.gender, events.title
                    FROM participants
                    LEFT JOIN events ON participants.event_id = events.id";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["id"] ?></td>
                            <td><?php echo $row["first_name"] ?></td>
                            <td><?php echo $row["last_name"] ?></td>
                            <td><?php echo $row["email"] ?></td>
                            <td><?php echo $row["gender"] ?></td>
                            <td><?php echo $row["title"] ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                <a href="delete.php?id=<?php echo $row["id"] ?>" class="link-dark" onclick="return confirm('Czy na pewno chcesz usunąć ten rekord?');"><i class="fa-solid fa-trash fs-5"></i></a>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div class="container">
                <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                    <div class="col-md-4 d-flex align-items-center">
                        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                            <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
                        </a>
                        <span class="mb-3 mb-md-0 text-muted">© 2023 Michał Jóźwiak</span>
                    </div>
                </footer>
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