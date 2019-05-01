<!DOCTYPE html>
<html>
  <head>
    <title>Admin login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    
  	<header>
  		<nav></nav>
  	</header>
  	<main>	
	  	<form autocomplete="off" id="admin_login_form" action="login_function.php" method="post">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
	  		<label for="brukernavn">Brukernavn</label><br>
	  		<input class="admin_input" type="text" name="brukernavn"><br>

	  		<label for="passord">Passord</label><br>
	  		<input class="admin_input" type="password" name="passord"><br>

	  		<input type="submit" name="login_btn" value="loginn"></input>
	  	</form>
      <?php
      if (isset($_GET['error'])) {

        if ($_GET['error'] == "emptyfields") {
          echo "<div>
                <h4>Error: ". $_GET['error'] ."</h4>
                <p>Fyll i tekstfeltene.</p> 
              </div>";
          
        }
        else if ($_GET['error'] == "sqlerror") {
          echo "<div>
                  <p>Error: ". $_GET['error'] ."</p>
                  <p>feil i sql.</p> 
                </div>";
         
        }
        else if ($_GET['error'] == "wrongpassword") {
          echo "<div>
                  <p>Error: ". $_GET['error'] ."</p>
                  <p>Feil passord.</p> 
                </div>";
         
        }
        else if ($_GET['error'] == "nouser") {
          echo "<div>
                  <h4>Error: ". $_GET['error'] ."</h4>
                  <p>finner ikke bruker</p> 
                </div>";

        }

      } 
      ?>
    </main>
    <footer>
    	<p>Her skal det være info generell info om Enigma(Kontaktinfo, linker, "smågodt")</p>
    </footer>
  </body>
</html>
