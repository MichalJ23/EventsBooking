<?php
session_start();
include "../../config/config.php";
if (isset($_SESSION['id']) && isset($_SESSION['login'])) {

    $id = $_GET["id"];
    $sql = "DELETE FROM `events` WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php?msg=Data deleted successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
} else {
    header("Location: ../index.php");
    exit();
}
