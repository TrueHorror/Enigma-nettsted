<?php
/* Template Name: Medlems påmelding */
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) :
    the_post();


    if(isset($_GET['adminlogout'])){
			log_ut();
    }
    
    if(isset($_GET['feil'])){
      if ($_GET['feil'] == "emptyfields"){
        echo "<div class='error-box'>
                <p>Error: Felter ikke fylt ut</p>
                <p>Fyll ut alle feltene!</p> 
              </div>";
      }
      else if ($_GET['feil'] == "emailerror"){
        echo "<div class='error-box'>
                <p>Error: Feil i epost</p>
                <p>Se til att epost er skrevet riktig.</p> 
              </div>";
      }
      else if ($_GET['feil'] == "fornavnerror"){
        echo "<div class='error-box'>
                <p>Error: feil i fornavn</p>
                <p>Kan ikke inneholde talle eller spesialtegn</p> 
              </div>";
      }
      else if ($_GET['feil'] == "etternavnerror"){
        echo "<div class='error-box'>
                <p>Error: feil i etternavn</p>
                <p>Kan ikke inneholde talle eller spesialtegn</p> 
              </div>";
      }
      else if ($_GET['feil'] == "tlfnrerror"){
        echo "<div class='error-box'>
                <p>Error: Feil i tlfonnummer</p>
                <p>kan bare inneholde ni tall</p> 
              </div>";
      }
      else if ($_GET['feil'] == "avgangsaarerror"){
        echo "<div class='error-box'>
                <p>Error: feil i avgangsår</p>
                <p>Kan bare inneholde fire tall</p> 
              </div>";
      }
      else if ($_GET['feil'] == "serverfeil"){
        echo "<div class='error-box'>
                <p>Error: feil med server</p>
                <p>Kontakt admin</p> 
              </div>";
      }
      else if ($_GET['feil'] == "eposttaken"){
        echo "<div class='error-box'>
                <p>Error: Medlemm finnes allerede</p>
                <p>Bruk en ny epost.</p> 
              </div>";
      }

    }
    ?>
    
	  	<form autocomplete="off" id="new_member" action="" method="post">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <label for="epost">Epost</label><br>
	  		<input type="text" name="epost"><br>

        <label for="fornavn">Fornavn</label><br>
        <input type="text" name="fornavn"><br>         

        <label for="etternavn">Etternavn</label><br>      
        <input type="text" name="etternavn"><br>          

        <label for="tlfnr">Telefonnummer</label><br>        
        <input type="text" name="tlfnr"><br>              

        <label for="tskjorte">T-skjorte størrelse</label><br>    
        <select name='tskjorte'>
                  <option value='XS'>XS</option>
                  <option value='S'>S</option>
                  <option value='M'>M</option>
                  <option value='L'>L</option>
                  <option value='XL'>XL</option>
                  <option value='XXL'>XXL</option>
        </select><br>                 

        <label for="studieprog">Studieprogram</label><br>
        <select name='studieprog'>
                  <option value='infosys'>Informasjonssystemer</option>
                  <option value='digme'>Digitale mediser og design</option>
                  <option value='itbdes'>Informatikk</option>
                  <option value='dataing'>Data Ingeniør</option>
                  <option value='master'>Master in Applied Computer Science</option>
                  <option value='aarstud'>Årsstudium</option>
        </select><br>

        <label for="avgangsaar">Avgangsår</label><br>
        <input type="text" name="avgangsaar"><br>

        <label for="betaling">Betaling</label><br>
        <input type="radio" name="betaling" value="Kontant">Kontant<br>
        <input type="radio" name="betaling" value="Vipps">Vipps<br>
        <input type="radio" name="betaling" value="Bankoverføring">Bankoverføring<br>
                   
	  		<input type="submit" name="create_member" value="Registrer"></input>
      </form>

    <?php  
    // End of the loop.
    endwhile;
    if (isset($_POST['create_member'])) {


      require('db-connection.php');
    
      $epost = $_POST['epost'];
      $fornavn = $_POST['fornavn'];
      $etternavn = $_POST['etternavn'];
      $tlfnr = $_POST['tlfnr'];
      $tskjorte = $_POST['tskjorte'];
      $studieprog = $_POST['studieprog'];
      $avgangsaar = $_POST['avgangsaar'];
      $betaling = $_POST['betaling'];
    
      if (empty($epost) || empty($fornavn) || empty($etternavn) || empty($tlfnr) || empty($avgangsaar)) {
        go_to_page("bli-medlem?feil=emptyfields");
        
      }
      else if (!filter_var($epost, FILTER_VALIDATE_EMAIL)) {
        go_to_page("bli-medlem?feil=emailerror");
      }
      else if (preg_match("/^[a-ZA-Z ]*$/", $fornavn)) {
        go_to_page("bli-medlem?feil=fornavnerror");
      }
      else if (preg_match("/^[a-ZA-Z ]*$/", $etternavn)) {
        go_to_page("bli-medlem?feil=etternavnerror");
      }
      else if (preg_match("/^[0-9]{9}*$/", $tlfnr)) {
        go_to_page("bli-medlem?feil=tlfnrerror");
      }
      else if (preg_match("/^[0-9]{4}*$/", $avgangsaar)) {
        go_to_page("bli-medlem?feil=avgangsaarerror");
      }
      else {
    
        $sql = "SELECT epost FROM medlemmer WHERE epost=?";
    
        $stmt = mysqli_stmt_init($connection);
    
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          go_to_page("bli-medlem?feil=serverfeil");
        }
        else {
          mysqli_stmt_bind_param($stmt, "s", $epost);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
    
          $result = mysqli_stmt_num_rows($stmt);
    
          if ($result > 0) {
            go_to_page("bli-medlem?feil=eposttaken");
          }
          else {
    
            $sql = "INSERT INTO medlemmer (epost, fornavn, etternavn, tlfnr, tskjorte, studieprog, avgangsaar, betaling) VALUES ('". $epost ."', '". $fornavn ."', '". $etternavn ."', '". $tlfnr ."', '". $tskjorte ."', '". $studieprog ."', ". $avgangsaar .", '". $betaling ."')";
    
            if (mysqli_query($connection, $sql)) {

              
              $to      = $epost;
              $subject = "Velkommen!";
              $message = "Hei!" . "\r\n" .
                    "Velkommen til Enigma.";
              $headers = "From: enigma@hiof.no" . "\r\n" .
                      "Reply-To: enigma@hiof.no" . "\r\n" .
                      "X-Mailer: PHP/" . phpversion();
    
              mail($to, $subject, $message, $headers);
    
              go_to_page("hjem");
              
              }
              else{
                go_to_page("bli-medlem?feil=serverfeil");
              }
    
          }	
    
        }
    
      }
    
    }
    
    ?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>