<!DOCTYPE html>
<html>
  <head>
    <title>Ny bruker</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  	<header>
  		<nav></nav>
  	</header>
  	<main>	
	  	<form autocomplete="off" id="new_member" action="add_member.php" method="post">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <label for="epost">Epost</label><br>
	  		<input type="text" name="epost"><br>

        <label for="fornavn">Fornavn</label><br>
        <input type="text" name="fornavn"><br>         

        <label for="etternavn">Etternavn</label><br>      
        <input type="text" name="etternavn"><br>          

        <label for="tlfnr">Telefonnummer</label><br>        
        <input type="text" name="tlfnr"><br>              

        <label for="tskjorte">T-skjorte størreles</label><br>    
        <select name='tskjorte'>
                  <option value='XS'>XS</option>
                  <option value='S'>S</option>
                  <option value='M'>M</option>
                  <option value='L'>L</option>
                  <option value='XL'>XL</option>
                  <option value='XXL'>XXL</option>
        </select><br>                 

        <label for="studieprog">Studieprogramm</label><br>
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
    session_start();
    if(isset($_SESSION['user'])){
       echo "<a href='admin_panel.php'>Medlemmer</a>";

    }
    ?>
    </main>
    <footer>
    	<p>Her skal det være info generell info om Enigma(Kontaktinfo, linker, "smågodt")</p>
      <?php
      session_start();
      if(isset($_SESSION['user'])){
         echo "<a href='logout.php'>logg ut</a>";

    }
    ?>
    </footer>
  </body>
</html>