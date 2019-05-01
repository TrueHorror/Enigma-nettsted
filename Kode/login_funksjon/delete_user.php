<?php
	$user = $_GET['user'];

	session_start();
	if(!isset($_SESSION['user'])){
	   header("Location: admin_login.php");

	}
	require('db_connection.php');

	$sql = "DELETE FROM medlemmer WHERE epost = '" . $user . "';";
	$result = mysqli_query($connection, $sql);  

	if ($result) {
	    header('Location: admin_panel.php');
	    exit();

	} else {
	    echo "Error deleting user: " . mysqli_error($connection);
	}
?>