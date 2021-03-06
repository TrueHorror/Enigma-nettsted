<?php
/* Template Name: Nyttarrangement */
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

    $sqlType = "SELECT * FROM Arrangementstype;";

    if (ISSET($_POST['lagreNytt'])) {
      $tittel = $_POST['tittel'];
      $dato = konverterDato($_POST['dato']);
      $tid = $_POST['tid'];
      $sted = $_POST['sted'];
      $antPlasser = $_POST['antPlasser'];
      $arrType = $_POST['arrType'];
      $beskrivelse = $_POST['beskrivelse'];

      $sql = "INSERT INTO Arrangement(Tittel, Dato, Tid, Sted, AntPlasser, Type, Beskrivelse, Opprettet) VALUES
      ('" . $tittel . "','" . $dato . "','" . $tid . "', '" . $sted . "'," . $antPlasser . ", '" . $arrType . "', '" . $beskrivelse . "', CURRENT_TIMESTAMP);";

      if(mysqli_query($dbTilkobling, $sql)) {
        echo "<h2>" . $tittel . " er lagt til</h2>
        <a href='" . site_url() . "/arrangementsoversikt-admin'>Til arrangementsoversikt</a>";
      }
      else {
        echo "<p>Det oppsto en feil, vennligst prøv igjen.</p>";
      }
    }

    else if (ISSET($_POST['lagreRediger'])) {
      $arrId = $_POST['arrId'];
      $tittel = $_POST['tittel'];
      $dato = konverterDato($_POST['dato']);
      $tid = $_POST['tid'];
      $sted = $_POST['sted'];
      $antPlasser = $_POST['antPlasser'];
      $arrType = $_POST['arrType'];
      $beskrivelse = $_POST['beskrivelse'];

      $sql = "UPDATE Arrangement SET Tittel='" . $tittel . "', Dato='" . $dato . "', Tid='" . $tid . "', Sted='" . $sted .
      "', AntPlasser=" . $antPlasser . ", Type='" . $arrType . "', Beskrivelse='" . $beskrivelse . "' WHERE ArrangementsID = " . $arrId . ";";

      if(mysqli_query($dbTilkobling, $sql)) {
        echo "<h2>" . $tittel . " er oppdatert</h2>
        <a href='" . site_url() . "/arrangementsoversikt-admin'>Til arrangementsoversikt</a>";
      }
      else {
        echo "<p>Det oppsto en feil, vennligst prøv igjen.</p>";
      }
    }

    else {
      if(ISSET($_GET['arr'])) {
        $arrId = $testarrangement[$_GET['arr']];

        $sql = "SELECT * FROM Arrangement WHERE ArrangementsID = " . $_GET['arr'] . ";";
        $resultat = mysqli_query($dbTilkobling, $sql);

        while($row = mysqli_fetch_array($resultat)) {
          echo "<a href='" . site_url() . "/arrangementsoversikt-admin' class='avbrytlink'>Avbryt</a>
					<h1>Rediger arrangement</h1>
					<div class='paamelding-arrangement'>
	          <form action='' method='post'>
	            <p>
	              <label for='tittel'>Tittel</label>
	              <input type='text' name='tittel' id='tittel' size='40' value='" . $row['Tittel'] . "'/>
	            </p>
	            <p>
	              <label for='dato'>Dato</label>
	              <input type='text' name='dato' id='dato' value='" . $row['Dato'] . "'/>
	            </p>
	            <p>
	              <label for='tid'>Tid</label>
	              <input type='text' name='tid' id='tid' value='" . $row['Tid'] . "'/>
	            </p>
	            <p>
	              <label for='sted'>Sted</label>
	              <input type='text' name='sted' id='sted' value='" . $row['Sted'] . "'/>
	            </p>
	            <p>
	              <label for='antPlasser'>Antall plasser</label>
	              <input type='number' name='antPlasser' id='antPlasser' value='" . $row['AntPlasser'] . "'/>
	            </p>
	            <p>
	              <label for='beskrivelse'>Beskrivelse</label><br>
	              <textarea name='beskrivelse' cols='40' rows='10' id='beskrivelse'>" . $row['Beskrivelse'] . "</textarea>
	            </p>
	            <p>
	            <input type='hidden' name='arrId' value='" . $row['ArrangementsID'] . "'>
	              <label for='arrType'>Arrangementstype</label>
	              <select name='arrType'>";

	              $arrType = $row['Type'];
	              $resultatType = mysqli_query($dbTilkobling, $sqlType);

	              while($row = mysqli_fetch_array($resultatType)) {
	                if ($row['Typekode'] == $arrType) {
	                  echo "<option value='" . $row['Typekode'] . "' selected>" . $row['Typenavn'] . "</option>";
	                }
	                else {
	                  echo "<option value='" . $row['Typekode'] . "'>" . $row['Typenavn'] . "</option>";
	                }
	              }

	              echo "</select><br><br>
	              <input type='submit' name='lagreRediger' value='Lagre'/>
	            </form>
						</div>";
        }
      }

      else {
        echo "<a href='" . site_url() . "/arrangementsoversikt-admin' class='avbrytlink'>Avbryt</a>
				<h1>Nytt arrangement</h1>
				<div class='paamelding-arrangement'>
	        <form action='' method='post'>
	          <p>
	            <label for='tittel'>Tittel</label>
	            <input type='text' name='tittel' id='tittel'/>
	          </p>
	          <p>
	            <label for='dato'>Dato</label>
	            <input type='date' name='dato' id='dato'/>
	          </p>
	          <p>
	            <label for='tid'>Tid</label>
	            <input type='text' name='tid' id='tid'/>
	          </p>
	          <p>
	            <label for='sted'>Sted</label>
	            <input type='text' name='sted' id='sted'/>
	          </p>
	          <p>
	            <label for='antPlasser'>Antall plasser</label>
	            <input type='number' name='antPlasser' id='antPlasser'/>
	          </p>
	          <p>
	            <label for='arrType'>Arrangementstype</label>
	            <select name='arrType'>";

	            $resultatType = mysqli_query($dbTilkobling, $sqlType);

	            while($row = mysqli_fetch_array($resultatType)) {
	              echo "<option value='" . $row['Typekode'] . "'>" . $row['Typenavn'] . "</option>";
	            }

	            echo "</select>
	          </p>
	          <p>
	            <label for='beskrivelse'>Beskrivelse</label><br>
	            <textarea name='beskrivelse' cols='40' rows='10' id='beskrivelse'></textarea>
	          </p>
	          <input type='submit' name='lagreNytt' value='Lagre'/>
	        </form>
				</div>";
      }
    }

    mysqli_close($dbTilkobling);
  ?>
</main><!-- .site-main -->

<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
