<?php
/* Template Name: Arrangmentsoversikt_admin */
?>
<?php
get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
  <?php
  session_start();
    if(!isset($_SESSION['user'])){
       header("Location: admin_login.php");

    }
    require("arr_functions.php");

    if (ISSET($_GET['arr'])) {
      $sqlPaameldteDelete = "DELETE from Paameldte WHERE ArrangementsID = " . $_GET['arr'] . ";";
      $sqlDelete = "DELETE from Arrangement WHERE ArrangementsID = " . $_GET['arr'] . ";";

      mysqli_query($dbTilkobling, $sqlPaameldteDelete);



              if(mysqli_query($dbTilkobling, $sqlDelete)) {
                echo "<h2>Arrangementet er slettet</h2>";
              }
              else {
                echo mysqli_error($dbTilkobling);
                echo "<p>Det oppsto en feil, vennligst prøv igjen. " . mysqli_error($dbTilkobling) . "</p>";
              }

    }

    echo "<h2>Oversikt over arrangementer</h2>
		<table class='arrangementer'>
			<thead>
	      <tr>
	        <th>Tittel</th>
	        <th>Plasser igjen</th>
	        <th>Tid</th>
	        <th>Sted</th>
	        <th>Opprettet</th>
	        <th>Handlinger</th>
	      </tr>
			</thead>
			<tbody>";

      $sql = "SELECT Arrangement.ArrangementsID as ArrangementsID, AntPlasser, Tittel, Dato, Tid, Sted, Opprettet, COUNT(Paameldte.ArrangementsID) as AntPaameldte
      FROM Arrangement LEFT JOIN Paameldte ON Arrangement.ArrangementsID = Paameldte.ArrangementsID
      GROUP BY Arrangement.ArrangementsID ORDER BY Opprettet DESC";

      $resultat = mysqli_query($dbTilkobling, $sql);

      while($row = mysqli_fetch_array($resultat)) {
        $dato = date('j/n/Y', strtotime($row['Dato']));
        $opprettet = date('j/n/Y H:i', strtotime($row['Opprettet']));
        $ledigePlasser = $row['AntPlasser'] - $row['AntPaameldte'];

        echo "<tr>
          <td><a href='" . site_url() . "/arrangementsinfo-admin?arr=" . $row['ArrangementsID'] . "' class='understrek'><strong>" . $row['Tittel'] . "</strong></a></td>
          <td>" . $ledigePlasser . "</td>
          <td>" . $dato . " " . $row['Tid'] . "</td>
          <td>" . $row['Sted'] . "</td>
          <td>" . $row['Opprettet'] . "</td>
          <td><a onClick=\"return confirm('Vil du virkelig slette arrangementet?')\" id='slett' href='" . site_url() . "/arrangementsoversikt-admin?arr=" . $row['ArrangementsID'] . "' class='table-button'>Slett</a>
              <a  href='" . site_url() . "/nyttarrangement?arr=" . $row['ArrangementsID'] . "' class='table-button'>Rediger</a></td>
        </tr>";
      }

    echo "</tbody>
		</table>";

    mysqli_close($dbTilkobling);
   ?>
   <a href='<?php echo site_url();?>/nyttarrangement' class='opprett'>Opprett nytt arrangement</a>

 </main><!-- .site-main -->

 <?php get_sidebar( 'content-bottom' ); ?>

 </div><!-- .content-area -->

 <?php get_sidebar(); ?>
 <?php get_footer(); ?>
