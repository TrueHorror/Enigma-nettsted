<?php
/* Template Name: admin-panel */

get_header(); 

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) :
	  the_post();

		  //session_start();
		if(!isset($_SESSION['user'])){
			go_to_page("hjem");
		
		}
		
		if(isset($_GET['user'])){
			delete_member($_GET['user']);
		}

		if(isset($_GET['adminlogout'])){
			log_ut();
		}

  		require('db-connection.php');
  		

  		$sql = "SELECT * FROM medlemmer;";
		$result = mysqli_query($connection,$sql);
		  ?>
		  	<div class="admin-links">
				<a href="<?php echo site_url() ?>/admin-panel?adminlogout=yes">logg ut</a>
				<a href="<?php echo site_url() ?>/bli-medlem">Legg til medlem</a>
				<a href="<?php echo site_url() ?>/arrangementsoversikt-admin">Arrangementoversikt</a>
				<a href="<?php echo site_url() ?>/nyttarrangement">Legg til nytt arrangement</a>
			</div>
			<h2>Medlemmer</h2>
			<?php
			echo "<table class='medlemmer'>
				<thead>
					<tr>
						<th>Epost</th>
						<th>Fornavn</th>
						<th>Etternavn</th>
						<th>Tlf nummer</th>
						<th>t-skjorte størrelse</th>
						<th>Studieprogramm</th>
						<th>Avgangsår</th>
						<th>Betaling</th>
						<th>Handlinger</th>
						
					</tr>
				</thead>";

	    while ($row = mysqli_fetch_array($result)) {

		echo "
			<tbody>
	  			<tr>
	  				<td>" . $row['epost'] . "</td>
	  				<td>" . $row['fornavn'] . "</td>
	  				<td>" . $row['etternavn'] . "</td>
	  				<td>" . $row['tlfnr'] . "</td>
	  				<td>" . $row['tskjorte'] . "</td>
	  				<td>" . $row['studieprog'] . "</td>
	  				<td>" . $row['avgangsaar'] . "</td>
	  				<td>" . $row['betaling'] . "</td>
	  				<td><a class='table-button' href='" . site_url() . "/rediger-bruker?user=" . $row['epost'] . "'>EDIT</a>
	  				<a class='table-button' onClick=\"return confirm('Vill du virkelig slette personen?')\" href='?user=" . $row['epost'] . "'>SLETT</a></td>

				</tr>
			</tbody>";
  	
    	} 
		 echo "</table>";
		 
		// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>