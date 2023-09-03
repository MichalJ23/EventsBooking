<?php
session_start();
include "../../config/config.php";

function deleteUser($conn, $user_id) {
    $sql = "DELETE FROM `users` WHERE `id` = $user_id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        return true; // Zwracamy true, jeśli usunięcie powiodło się
    } else {
        return false; // Zwracamy false, jeśli wystąpił błąd
    }
}

if (isset($_SESSION['id']) && isset($_SESSION['login'])) {
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        if (deleteUser($conn, $delete_id)) {
            header("Location: index.php?msg=User deleted successfully");
        } else {
            echo "Failed to delete user.";
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
