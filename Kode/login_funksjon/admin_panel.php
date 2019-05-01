<!DOCTYPE html>
<html>
  <head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  	<?php
  		session_start();
		if(!isset($_SESSION['user'])){
		   header("Location: admin_login.php");

		}

  		require('db_connection.php');
  		

  		$sql = "SELECT * FROM medlemmer;";
	    $result = mysqli_query($connection,$sql);

	    echo "<table>
  				<tr>
	  				<th>Epost</th>
	  				<th>Fornavn</th>
	  				<th>Etternavn</th>
	  				<th>Tlf nummer</th>
	  				<th>t-skjorte størrelse</th>
	  				<th>Studieprogramm</th>
	  				<th>Avgangsår</th>
	  				<th>Betaling</th>
	  				<th>EDIT</th>
	  				<th>SLETT</th>
	  			</tr>";

	    while ($row = mysqli_fetch_array($result)) {

	    echo "
	  			<tr>
	  				<td>" . $row['epost'] . "</td>
	  				<td>" . $row['fornavn'] . "</td>
	  				<td>" . $row['etternavn'] . "</td>
	  				<td>" . $row['tlfnr'] . "</td>
	  				<td>" . $row['tskjorte'] . "</td>
	  				<td>" . $row['studieprog'] . "</td>
	  				<td>" . $row['avgangsaar'] . "</td>
	  				<td>" . $row['betaling'] . "</td>
	  				<td><a href='edit_user.php?user=" . $row['epost'] . "'>EDIT</a></td>
	  				<td><a onClick=\"return confirm('Vill du virkelig slette personen?')\" href='delete_user.php?user=" . $row['epost'] . "'>SLETT</a></td>

	  			</tr>";
  	
    	} 
    	 echo "</table>";
	?>
  	<a href="paamelding.php">Legg til bruker</a>
  	<a href="../arrangement_funksjon/arrangementsoversikt_admin.php">Arrangementoversikt</a>
  	<a href="../arrangement_funksjon/nyttarrangement.php">Legg til nytt arrangement</a>
  	<footer>
    	<p>Her skal det være info generell info om Enigma(Kontaktinfo, linker, "smågodt")</p>
    	<a href="logout.php">logg ut</a>
    </footer>
  </body>
</html>
