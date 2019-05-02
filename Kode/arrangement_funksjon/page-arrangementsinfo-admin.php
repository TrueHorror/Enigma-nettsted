<?php
/* Template Name: Arrangmentsinfo_admin */
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
    $antPaameldte = 0;

    $sqlJoin = "SELECT * FROM Arrangement JOIN Paameldte ON Arrangement.ArrangementsID = Paameldte.ArrangementsID WHERE Arrangement.ArrangementsID = " . $_GET['arr'] . ";";
    $resultatJoin = mysqli_query($dbTilkobling, $sqlJoin);

    while($row = mysqli_fetch_array($resultatJoin)) {
      $antPaameldte++;
    }

    $sqlArr = "SELECT * FROM Arrangement WHERE ArrangementsID = " . $_GET['arr'] . ";";
    $resultatArr = mysqli_query($dbTilkobling, $sqlArr);

    while($row = mysqli_fetch_array($resultatArr)) {

      $arrId = $testarrangement[$_GET['arr']];

      $ledigePlasser = $row['AntPlasser'] - $antPaameldte;

      $dato = date('j/n/Y', strtotime($row['Dato']));
      $opprettet = date('j/n/Y H:i', strtotime($row['Opprettet']));

      echo "<h1>" . $row['Tittel'] . "</h1>
      <p>Opprettet: " . $opprettet . "</p>
      <p>Dato: " . $dato . " " . $row['Tid'] . "</p>
      <p>" . $ledigePlasser . " ledige plasser</p>
      <p>" . $row['Beskrivelse'] . "</p><br>
      <p><strong>Antall påmeldte: " . $antPaameldte . " totalt</strong></p>
      <table>
        <tr>
          <th>Navn</th>
          <th>E-post</th>
          <th>Medlem</th>
          <th>Kommentar</th>
        </tr>";
    }

    $resultatJoin = mysqli_query($dbTilkobling, $sqlJoin);
    while($row = mysqli_fetch_array($resultatJoin)) {
      echo "<tr>
          <td>" . $row['Navn'] . "</td>
          <td>" . $row['Epost'] . "</td>
          <td>" . booleanTilString($row['ErMedlem']) . "</td>
          <td>" . $row['Kommentar'] . "</td>
        </tr>";
    }
  }
  mysqli_close($dbTilkobling);
  ?>
  </table>

  <br>
  <a href='<?php echo site_url(); ?>/arrangementsoversikt-admin'>Tilbake</a>

</main><!-- .site-main -->

<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
