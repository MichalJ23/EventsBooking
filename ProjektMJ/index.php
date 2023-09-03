<?php
global $config_file;
$config_file = 'EventsBooking/config/config.php';

if (file_exists($config_file)) {
    if (is_writable($config_file)) {
        header("Location: instalator.php");
    } else {
        echo "<p>Zmień uprawnienia do pliku <code>" . $config_file . "</code><br>np. <code>chmod o+w " . $config_file . "</code></p>";
        echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
    }
} else {
    echo "<p>Stwórz plik <code>" . $config_file . "</code><br>np. <code>touch " . $config_file . "</code></p>";
    echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
}

function form_install_1()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $config_file = 'EventsBooking/config/config.php';

        $host = $_POST['host'];
        $user = $_POST['user'];
        $password = $_POST['passwd'];
        $dbname = $_POST['dbname'];
        $admin_login = $_POST['login'];
        $admin_password = $_POST['password'];

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

        $link = mysqli_connect($host, $user, $password, $dbname);
        if (file_exists("sql/sql.php")) {
            include("sql/sql.php");
            echo "Tworzę tabele bazy: " . $dbname . ".<br>\n";
            mysqli_select_db($link, $dbname) or die(mysqli_error($link));
            for ($i = 0; $i < count($create); $i++) {
                echo "<p>" . $i . ". <code>" . $create[$i] . "</code></p>\n";
                mysqli_query($link, $create[$i]);
            }
        }

        if (file_exists("sql/insert.php")) {
            include("sql/insert.php");
            echo "<p>Wstawiam dane do tabel bazy: " . $dbname . ".</p>\n";
            mysqli_select_db($link, $dbname) or die(mysqli_error($link));
            for ($i = 0; $i < count($insert); $i++) {
                echo "<p>" . $i . ". <code>" . $insert[$i] . "</code></p>\n";
                mysqli_query($link, $insert[$i]);
            }
        }
        echo "Zakończono konfigurację!\n";
        echo '<button class="btn btn-info" onClick="window.location.href=\'EventsBooking/index.php\'">Przejdź do strony głównej</button>';
    } else {
        echo '
        <form method="POST" action="">
            <label for="host">Adres serwera:</label>
            <input type="text" name="host" id="host" required><br>

            <label for="user">Nazwa użytkownika:</label>
            <input type="text" name="user" id="user" required><br>

            <label for="passwd">Hasło:</label>
            <input type="password" name="passwd" id="passwd"><br>

            <label for="dbname">Nazwa bazy danych:</label>
            <input type="text" name="dbname" id="dbname" required><br>
            
            <h2>Konto admina:</h2>
            <label for="admin-login">Login:</label>
            <input type="text" name="admin-login" id="admin-login" required><br>
            <label for="admin-password">Hasło:</label>
            <input type="password" name="admin-password" id="admin-password" required><br>

            <input type="submit" value="Zapisz">
        </form>
        ';
    }
}
