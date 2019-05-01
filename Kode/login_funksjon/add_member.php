<?php
if (isset($_POST['create_member'])) {


	require('db_connection.php');

	$epost = $_POST['epost'];
	$fornavn = $_POST['fornavn'];
	$etternavn = $_POST['etternavn'];
	$tlfnr = $_POST['tlfnr'];
	$tskjorte = $_POST['tskjorte'];
	$studieprog = $_POST['studieprog'];
	$avgangsaar = $_POST['avgangsaar'];
	$betaling = $_POST['betaling'];

	if (empty($epost) || empty($fornavn) || empty($etternavn) || empty($tlfnr) || empty($avgangsaar)) {
		header("Location: paamelding.php?error=emptyfields");
		exit();
	}
	else if (!filter_var($epost, FILTER_VALIDATE_EMAIL)) {
		header("Location: paamelding.php?error=emailerror");
		exit();
	}
	else if (preg_match("/^[a-ZA-Z ]*$/", $fornavn)) {
		header("Location: paamelding.php?error=fornavnerror");
		exit();
	}
	else if (preg_match("/^[a-ZA-Z ]*$/", $etternavn)) {
		header("Location: paamelding.php?error=etternavnerror");
		exit();
	}
	else if (preg_match("/^[0-9]{9}*$/", $tlfnr)) {
		header("Location: paamelding.php?error=tlfnrerror");
		exit();
	}
	else if (preg_match("/^[0-9]{4}*$/", $avgangsaar)) {
		header("Location: paamelding.php?error=avgangsaarerror");
		exit();
	}
	else {

		$sql = "SELECT epost FROM medlemmer WHERE epost=?";

		$stmt = mysqli_stmt_init($connection);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: paamelding.php?error=sqlerror");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "s", $epost);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);

			$result = mysqli_stmt_num_rows($stmt);

			if ($result > 0) {
				header("Location: paamelding.php?error=eposttaken");
				exit();
			}
			else {

				$sql = "INSERT INTO medlemmer (epost, fornavn, etternavn, tlfnr, tskjorte, studieprog, avgangsaar, betaling) VALUES ('". $epost ."', '". $fornavn ."', '". $etternavn ."', '". $tlfnr ."', '". $tskjorte ."', '". $studieprog ."', ". $avgangsaar .", '". $betaling ."')";

				if (mysqli_query($connection, $sql)) {

					$to      = $epost;
					$subject = "Velkommen!";
					$message = "Hei!" . "\r\n" .
								"Velkommen til Enigma.";
					$headers = "From: enigma@hiof.no" . "\r\n" .
					    		"Reply-To: enigma@hiof.no" . "\r\n" .
					    		"X-Mailer: PHP/" . phpversion();

					mail($to, $subject, $message, $headers);

  					header("Location: paamelding.php?newmember=success");
					exit();	
		  		
	  			}
	  			else{
	  			
	  				header("Location: paamelding.php?error=sqlerror");
					exit();
	  			}

			}	

		}

	}

}
else {
	header("Location: paamelding.php");
	exit();	
}
?>