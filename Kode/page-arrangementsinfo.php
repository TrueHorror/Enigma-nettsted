<?php
/* Template Name: Arrangementsinfo */
?>
<?php
get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

  <?php
  require("arr_functions.php");

  if (ISSET($_GET['arr'])) {
    $antPaameldte = 0;

    $sqlJoin = "SELECT * FROM Arrangement JOIN Paameldte ON Arrangement.ArrangementsID = Paameldte.ArrangementsID WHERE Arrangement.ArrangementsID = " . $_GET['arr'] . ";";
    $resultatJoin = mysqli_query($dbTilkobling, $sqlJoin);

    while($row = mysqli_fetch_array($resultatJoin)) {
      $antPaameldte++;
    }

    $sql = "SELECT * FROM Arrangement WHERE ArrangementsID = " . $_GET['arr'] . ";";
    $resultat = mysqli_query($dbTilkobling, $sql);

    while($row = mysqli_fetch_array($resultat)) {

      $arrId = $testarrangement[$_GET['arr']];
      $ledigePlasser = $row['AntPlasser'] - $antPaameldte;
			$dato = date('j/n/Y', strtotime($row['Dato']));

      echo "<h1>" . $row['Tittel'] . "</h1>
      <p>" . $dato . " " . $row['Tid'] . "</p>
      <p>" . $ledigePlasser . " ledige plasser</p>
      <p>" . $row['Beskrivelse'] . "</p>
      <a href='" . site_url() . "/paamelding?arr=" . $_GET['arr'] . "' class='knapp'>Påmelding</a>";
    }
  }
  mysqli_close($dbTilkobling);
  ?>

</main><!-- .site-main -->

<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
