<?php
session_start();
include "config/config.php";

if (isset($_POST['uname']) && isset($_POST['psw'])) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['psw']);

	$sql = "SELECT * FROM users WHERE login='$uname' AND password='$pass'";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
		if ($row['login'] === $uname && $row['password'] === $pass) {
			$_SESSION['login'] = $row['login'];
			$_SESSION['name'] = $row['name'];
			$_SESSION['id'] = $row['id'];
            $_SESSION['isAdmin'] = $row['isAdmin'];
			header("Location: administrator/index.php");
			exit();
		} else {
			header("Location: index.php?error=Zły login lub hasło");
			exit();
		}
	} else {
		header("Location: index.php?error=Zły login lub hasło");
		exit();
	}
}
