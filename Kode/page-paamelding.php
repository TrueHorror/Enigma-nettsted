<?php
/* Template Name: Paamelding */
the_content();
?>
<?php
get_header();

    require("arr_functions.php");

    if (ISSET($_GET['arr'])) {

      $sql = "SELECT * FROM Arrangement WHERE ArrangementsID = " . $_GET['arr'] . ";";
      $resultat = mysqli_query($dbTilkobling, $sql);

      while($row = mysqli_fetch_array($resultat)) {
        $dato = date('j/n/Y', strtotime($row['Dato']));

        echo "<a href='<?php echo site_url(); ?>/arrangementsoversikt' class='avbrytlink'>Avbryt</a>
        <h1>Påmelding: " . lcfirst($row['Tittel']) . "</h1>
        <strong><p>" . $dato . " " . $row['Tid'] . "</p></strong>";
      }
    }
    mysqli_close($dbTilkobling);
  ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

    <div class="paamelding-arrangement">
      <form action='<?php echo site_url(); ?>/bekreft' method='post'>
        <input type='hidden' name='arrId' value='<?php echo $_GET['arr']; ?>'>
        <p>
          <label for='navn'>Navn</label>
          <input type='text' name='navn' id='navn'/>
        </p>
        <p>
          <label for='epost'>E-post</label>
          <input type='email' name='epost' id='epost'/>
        </p>
        <p>
          <label for='erMedlem'>Er du medlem av Enigma?</label><br>
          <input type='radio' name='erMedlem' id='erMedlem' value='1'> Ja
          <input type='radio' name='erMedlem' id='erMedlem' value='0'> Nei
        </p>
        <p>
          <label for='kommentar'>Har du noen spørsmål eller kommentarer?</label><br>
          <textarea name='kommentar' cols='40' rows='5' id='kommentar'></textarea>
        </p>
        <input type='submit' name='submit' value='Neste'/>
      </form>
    </div>


</main><!-- .site-main -->

<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
