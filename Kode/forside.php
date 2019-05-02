<?php
/* Template Name: Forside */
?>

<?php
the_content();
get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

    <div class="grid-container">
      <div class="intro">
				<h2>HIØ Enigma</h2>
        <p>Enigma er linjeforeniningen for IT-avdelingen på Høgskolen i Østfold.
          Enigma arrangerer bedriftspresentasjoner, LAN og andre aktiviteter for
          studenter på IT-avdelingen og resten av Høgskolen.</p>
      </div>
      <div class="introbilde">
        <img src="wp-content/themes/twentysixteen-child/Bilder/lan.jpg"/>
      </div>
      <div class="arrangementer-forside">
				<h2>Kommende arrangementer</h2>
    		<?php
          require("arr_functions.php");

          $sql = "SELECT Arrangement.ArrangementsID as ArrangementsID, AntPlasser, Dato, Tid, Sted, Tittel, Type, COUNT(Paameldte.ArrangementsID) as AntPaameldte
          FROM Arrangement LEFT JOIN Paameldte ON Arrangement.ArrangementsID = Paameldte.ArrangementsID
					WHERE Dato >= CURDATE()
          GROUP BY Arrangement.ArrangementsID ORDER BY Dato LIMIT 5";

          $resultat = mysqli_query($dbTilkobling, $sql);

          while($row = mysqli_fetch_array($resultat)) {
            $dato = date('j/n/Y', strtotime($row['Dato']));
            $ledigePlasser = $row['AntPlasser'] - $row['AntPaameldte'];

            echo "<a href='" . site_url() . "/arrangementsinfo?arr=" . $row['ArrangementsID'] . "'><p class='ettArrangement' id='" . arrfarge($row['Type']) . "'>"  . $dato . " " . $row['Tid'] . " | " . $row['Tittel'] . "</p></a>";
          }

          mysqli_close($dbTilkobling);
         ?>
       </div>
       <div class="facebook">
         <a href="https://www.facebook.com/HIOF.Enigma/" target="_blank"><img src="wp-content/themes/twentysixteen-child/Bilder/facebook.png"/></a>
       </div>
			 <div class="makerspace">
         <a href="http://makerspace.hiof.no/" target="_blank"><img src="wp-content/themes/twentysixteen-child/Bilder/makerspace.png"/></a>
       </div>
       <div class="medlem">
         <a href="<?php echo site_url(); ?>/bli-medlem"><img src="wp-content/themes/twentysixteen-child/Bilder/blimedlem.png"/></a>
       </div>
       <div class="hiof">
         <a href="https://www.hiof.no/" target="_blank"><img src="wp-content/themes/twentysixteen-child/Bilder/hiof.png"/></a>
       </div>

     </div>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
