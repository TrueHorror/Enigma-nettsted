<?php
	$user = $_GET['user'];

	session_start();
	if(!isset($_SESSION['user'])){
	   header("Location: admin-login.php");

	}
	require('db-connection.php');

	$sql = "DELETE FROM medlemmer WHERE epost = '" . $user . "';";
	$result = mysqli_query($connection, $sql);  

	if ($result) {
	    header('Location: admin-panel.php');
	    exit();

	} else {
	    echo "Error deleting user: " . mysqli_error($connection);
	}
?>