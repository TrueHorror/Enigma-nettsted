<?php
	$user = $_GET['user'];


	require('db_conection.php');

	$sql = "DELETE FROM medlemmer WHERE epost = '" . $user . "';";
	$result = mysqli_query($connection, $sql);  

	if ($result) {
	    header('Location: admin_panel.php');
	    exit();

	} else {
	    echo "Error deleting user: " . mysqli_error($connection);
	}
?>