<!DOCTYPE html>
<html>
  <head>
    <title>Edit user</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  	<?php
  		session_start();
		if(!isset($_SESSION['user'])){
		   header("Location: admin_login.php");

		}

	  	require('db_connection.php');
		    
	  	$user = $_GET['user'];

	  	if (isset($_POST['edit'])) {

	  		$epost = $_POST['epost'];
	  		$fornavn = $_POST['fornavn'];
	  		$etternavn = $_POST['etternavn'];
	  		$tlfnr = $_POST['tlfnr'];
	  		$tskjorte = $_POST['tskjorte'];
	  		$studieprog = $_POST['studieprog'];
	  		$avgangsaar = $_POST['avgangsaar'];
	  		$betaling = $_POST['betaling'];
	  		$bruker_id = $_POST['bruker_id']; 




	  		$update_sql = "UPDATE medlemmer SET epost = '" . $epost . "', fornavn = '" . $fornavn . "', etternavn = '" . $etternavn . "', tlfnr = '" . $tlfnr . "', tskjorte = '" . $tskjorte . "', studieprog = '" . $studieprog . "', avgangsaar = " . $avgangsaar . ", betaling = '" . $betaling . "' WHERE Bruker_ID =" . $bruker_id . ";";
	  		
	  		if (mysqli_query($connection, $update_sql)) {
  				echo "OK";

  				header("Location: admin_panel.php");
            	exit();
		  		
	  		}
	  		else{
	  			
	  			echo "Wrong in sql: " . mysqli_error($connection);
	  		}
	  		


	  	
	  	}
	  	else {


	  		$sql = "SELECT * FROM medlemmer WHERE epost = '" . $user . "';";
		    $result = mysqli_query($connection, $sql);
		  	
		    echo "
		    	<form autocomplete='off' id='edit_user_form' action='' method='post'>
		  	
		    	<table>
	  				<tr>
		  				<th>Epost</th>
		  				<th>Fornavn</th>
		  				<th>Etternavn</th>
		  				<th>Tlf nummer</th>
		  				<th>t-skjorte størrelse</th>
		  				<th>Studieprogramm</th>
		  				<th>Avgangsår</th>
		  				<th>Betaling</th>
		  				<th>REDIGER</th>
		  			</tr>";

		    while ($row = mysqli_fetch_array($result)) {
				    		
		    echo "
		  			<tr>
		  				<td>
		  					<input name='bruker_id' type='hidden' value='". $row['Bruker_ID'] ."'>
			  				<input class='edit_input' type='text' name='epost' value='". $row['epost'] ."'>
			  			</td>
		  				<td>
		  					<input class='edit_input' type='text' name='fornavn' value='". $row['fornavn'] ."'>
		  				</td>
		  				<td>
		  					<input class='edit_input' type='text' name='etternavn' value='". $row['etternavn'] ."'>
		  				</td>
		  				<td>
		  					<input class='edit_input' type='text' name='tlfnr' value='". $row['tlfnr'] ."'>
		  				</td>
		  				<td>
		  					<input class='edit_input' type='text' name='tskjorte' value='". $row['tskjorte'] ."'>
		  				</td>
		  				<td>
		  					<select name='studieprog'>
							    <option value='infosys'>Informasjonssystemer</option>
							    <option value='digme'>Digitale mediser og design</option>
							    <option value='itbdes'>Informatikk</option>
							    <option value='dataing'>Data Ingeniør</option>
							    <option value='master'>Master in Applied Computer Science</option>
							    <option value='aarstud'>Årsstudium</option>
							</select>
		  				</td>
		  				<td>
		  					<input class='edit_input' type='number' name='avgangsaar' value='". $row['avgangsaar'] ."'>
		  				</td>
		  				<td>
		  					<input class='edit_input' type='text' name='betaling' value='". $row['betaling'] ."'>
		  				</td>
		  				<td>
		  					<input type='submit' name='edit' value='Bekreft'></input>
		  				</td>
		  				
		  			</tr>";
	  	
	    	} 

	    	echo "</table>
	    	 	</form>";
	  	}


    	 	
	?>
  	<a href="admin_panel.php">Avbryt redigering</a>
  	<footer>
    	<p>Her skal det være info generell info om Enigma(Kontaktinfo, linker, "smågodt")</p>
    </footer>
  </body>
</html>