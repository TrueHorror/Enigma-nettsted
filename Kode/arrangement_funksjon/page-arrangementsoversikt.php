<?php
/* Template Name: Arrangementsoversikt */
?>

<?php
get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
      require("arr_functions.php");

			echo "<h1>Arrangementer</h1>";

      $sql = "SELECT Arrangement.ArrangementsID as ArrangementsID, AntPlasser, Dato,
			Tid, Sted, Tittel, Type, COUNT(Paameldte.ArrangementsID) as AntPaameldte
			FROM Arrangement LEFT JOIN Paameldte ON Arrangement.ArrangementsID = Paameldte.ArrangementsID
			WHERE Dato >= CURDATE() 
			GROUP BY Arrangement.ArrangementsID ORDER BY Dato";

      $resultat = mysqli_query($dbTilkobling, $sql);

      while($row = mysqli_fetch_array($resultat)) {
        $dato = date('j/n/Y', strtotime($row['Dato']));
        $ledigePlasser = $row['AntPlasser'] - $row['AntPaameldte'];

        echo "<div class='arrangementskort' id='" . arrfarge($row['Type']) . "'>
          <h2>" . $row['Tittel'] . "</h2>
          <p>" . $dato . " " . $row['Tid'] . "</p>
          <p>" . $row['Sted'] . "</p>
          <p>" . $ledigePlasser . " ledige plasser</p>
          <a href='" . site_url() . "/paamelding?arr=" . $row['ArrangementsID'] . "'>Påmelding</a>
          <a href='" . site_url() . "/arrangementsinfo?arr=" . $row['ArrangementsID'] . "'>Les mer</a>
        </div>";
      }

      mysqli_close($dbTilkobling);
     ?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
