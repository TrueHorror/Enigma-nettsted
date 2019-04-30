<!DOCTYPE html>
<html>
  <head>
    <title>Page Title</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    
  	<header>
  		<nav></nav>
  	</header>
  	<main>	
	  	<form autocomplete="off" id="admin_login_form" action="db_functions.php" method="post">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
	  		<label for="brukernavn">Brukernavn</label><br>
	  		<input class="admin_input" type="text" name="brukernavn"><br>

	  		<label for="passord">Passord</label><br>
	  		<input class="admin_input" type="password" name="passord"><br>

	  		<input type="submit" name="login_btn" value="loginn"></input>
	  	</form>
    </main>
    <footer>
    	<p>Her skal det være info generell info om Enigma(Kontaktinfo, linker, "smågodt")</p>
    </footer>
  </body>
</html>
