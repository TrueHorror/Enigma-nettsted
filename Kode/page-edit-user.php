<?php
/* Template Name: edit-user */
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) :
		the_post();
		
  		//session_start();
		if(!isset($_SESSION['user'])){
		   go_to_page();

		}

			require('db-connection.php');
			
		    
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

  				go_to_page("admin-panel");
		  		
	  		}
	  		else{
	  			
	  			echo "Wrong in sql: " . mysqli_error($connection);
				}
	  	
	  	}
	  	else {

	  		$sql = "SELECT * FROM medlemmer WHERE epost = '" . $user . "';";
		    $result = mysqli_query($connection, $sql);
		  	
		    echo "<form autocomplete='off' id='edit_user_form' action='' method='post'>";
		  

		    while ($row = mysqli_fetch_array($result)) {
				    		
		    echo "
		  			
		  				<p>
							<input name='bruker_id' type='hidden' value='". $row['Bruker_ID'] ."'>
							<label for='epost'>Epost</label><br>
			  				<input class='edit_input' type='text' name='epost' value='". $row['epost'] ."'>
			  			</p>
						<p>
							<label for='fornavn'>Fornavn</label><br>						
		  					<input class='edit_input' type='text' name='fornavn' value='". $row['fornavn'] ."'>
		  				</p>
		  				<p>
						  <label for='etternavn'>Etternavn</label><br>	  
						  <input class='edit_input' type='text' name='etternavn' value='". $row['etternavn'] ."'>
		  				</p>
		  				<p>
						  <label for='tlfnr'>Telefonnummer</label><br>	  
						  <input class='edit_input' type='text' name='tlfnr' value='". $row['tlfnr'] ."'>
		  				</p>
		  				<p>
						  	<label for='tskjorte'>T-skjorte størrelse</label><br>	  
								<select name='tskjorte'>";
								?>
								<option <?php if ($row['tskjorte'] == "XS") echo "selected"; ?> value='XS'>XS</option>
								<option <?php if ($row['tskjorte'] == "S") echo "selected";  ?> value='S'>S</option>
								<option <?php if ($row['tskjorte'] == "M") echo "selected";  ?> value='M'>M</option>
								<option <?php if ($row['tskjorte'] == "L") echo "selected";  ?> value='L'>L</option>
								<option <?php if ($row['tskjorte'] == "XL") echo "selected";  ?> value='XL'>XL</option>
								<option <?php if ($row['tskjorte'] == "XXL") echo "selected";  ?> "value='XXL'>XXL</option>
								<?php
			echo "		
							</select><br>
		  				</p>
						<p>
						  	<label for='epost'>Epost</label><br>
		  					<select name='studieprog'>
							    <option value='infosys'>Informasjonssystemer</option>
							    <option value='digme'>Digitale mediser og design</option>
							    <option value='itbdes'>Informatikk</option>
							    <option value='dataing'>Data Ingeniør</option>
							    <option value='master'>Master in Applied Computer Science</option>
							    <option value='aarstud'>Årsstudium</option>
							</select>
		  				</p>
		  				<p>
						  <label for='epost'>Epost</label><br>	  
						  <input class='edit_input' type='number' name='avgangsaar' value='". $row['avgangsaar'] ."'>
		  				</p>
		  				<p>
						  <label for='epost'>Epost</label><br>	  
						  <input class='edit_input' type='text' name='betaling' value='". $row['betaling'] ."'>
		  				</p>
		  				<p> 
						  <input type='submit' name='edit' value='Bekreft'></input>
		  				</p>";
	  	
	    	} 

	    	echo "</form>";
	  	}


    	 	
	?>
  	<a href="<?php echo site_url() ?>/admin-panel">Avbryt redigering</a>
		<?php
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>