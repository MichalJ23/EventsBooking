<?php
function form_install_1()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $config_file = 'EventsBooking/config/config.php';
        $insert = 'sql/insert.php';

        $host = $_POST['host'];
        $user = $_POST['user'];
        $password = $_POST['passwd'];
        $dbname = $_POST['dbname'];


        $admin_name = $_POST['admin-name'];
        $admin_login = $_POST['admin-login'];
        $admin_password = $_POST['admin-password'];

        $config = "<?php\n";
        $config .= "\$host = '{$host}';\n";
        $config .= "\$user = '{$user}';\n";
        $config .= "\$password = '{$password}';\n";
        $config .= "\$dbname = '{$dbname}';\n";
        $config .= "\$conn = mysqli_connect(\$host, \$user, \$password, \$dbname);\n";
        $config .= "if (!\$conn) {
            echo 'Connection with database failed!';
        }";
        $config .= "?>";

        $file = fopen($config_file, "w");
        if (!$file) {
            echo "Nie mogę zapisać do pliku ($config_file)";
            exit;
        }

        if (!fwrite($file, $config)) {
            echo "Nie mogę zapisać do pliku ($config_file)";
            exit;
        }

        fclose($file);

        echo "<p>Krok 2 zakończony: Plik konfiguracyjny utworzony</p>";

        $insertArray = array();
        $insertSQL = "\$insert[] = \"INSERT INTO `users` (`login`, `password`, `name`, `isAdmin`) VALUES
        ('{$admin_login}', '{$admin_password}', '{$admin_name}', 1);\";";

        $insertArray[] = $insertSQL;

        $insertFile = fopen($insert, "a") or die("Nie można otworzyć pliku! Zmień uprawnienia dla pliku sql/insert.php i odśwież stronę");
        $adataAsString = implode("\n", $insertArray);
        fwrite($insertFile, $adataAsString);
        fclose($insertFile);

        $link = mysqli_connect($host, $user, $password, $dbname);
        if (file_exists("sql/sql.php")) {
            include("sql/sql.php");
            //echo "Tworzę tabele bazy: " . $dbname . ".<br>\n";
            mysqli_select_db($link, $dbname) or die(mysqli_error($link));
            for ($i = 0; $i < count($create); $i++) {
                echo "<p>" . $i . ". <code>" . $create[$i] . "</code></p>\n";
                mysqli_query($link, $create[$i]);
            }
        }

        if (file_exists("sql/insert.php")) {
            include("sql/insert.php");
            //echo "<p>Wstawiam dane do tabel bazy: " . $dbname . ".</p>\n";
            mysqli_select_db($link, $dbname) or die(mysqli_error($link));
            for ($i = 0; $i < count($insert); $i++) {
                echo "<p>" . $i . ". <code>" . $insert[$i] . "</code></p>\n";
                mysqli_query($link, $insert[$i]);
            }
        }
        echo "Zakończono konfigurację!\n";
        echo "<br>";
        echo "Usuń plik instalator.php oraz zmień uprawnienia do pliku config.php!";
        echo "<br>";
        echo '<button class="btn btn-info" onClick="window.location.href=\'EventsBooking/index.php\'">Przejdź do strony głównej</button>';

    } else {
        echo '
        <h1>Instalator projektu</h1>
        <form method="POST" action="">
            <h2>Ustawienia bazy danych:</h2>
            <label for="host">Adres serwera:</label>
            <input type="text" name="host" id="host" required><br>
    
            <label for="user">Nazwa użytkownika:</label>
            <input type="text" name="user" id="user" required><br>

            <label for="passwd">Hasło:</label>
            <input type="password" name="passwd" id="passwd"><br>

            <label for="dbname">Nazwa bazy danych:</label>
            <input type="text" name="dbname" id="dbname" required><br>
            
            <h2>Konto admina:</h2>
            <label for="admin-name">Imię i nazwisko:</label>
            <input type="text" name="admin-name" id="admin-name" required><br>
            <label for="admin-login">Login:</label>
            <input type="text" name="admin-login" id="admin-login" required><br>
            <label for="admin-password">Hasło:</label>
            <input type="password" name="admin-password" id="admin-password" required><br>

            <input type="submit" value="Zapisz">
        </form>
        ';
    }
}

form_install_1();
