<?php

/* Template Name: page-admin-login
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) :
      the_post();
      if(isset($_SESSION['user'])){
        go_to_page("admin-panel");
  
      }
      ?>

      	
	  	<form autocomplete="off" id="admin_login_form" action="" method="post">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
	  		<label for="brukernavn">Brukernavn</label><br>
	  		<input class="admin_input" type="text" name="brukernavn" autocomplete="off"><br>

	  		<label for="passord">Passord</label><br>
	  		<input class="admin_input" type="password" name="passord" autocomplete="off"><br>

	  		<button type="submit" name="login_btn">Loginn</button>
	  	</form>

<?php

if (isset($_POST['login_btn'])) {
  require('db-connection.php');
  
  $username = $_POST['brukernavn'];
  $password = $_POST['passord'];

  if (empty($username) || empty($password) ) {
    echo "<div>
                  <p>Error:</p>
                  <p>feil i login.</p> 
                </div>";
  }
  else {

    //melk = brukernavn og potetgull = passord
    $sql = "SELECT * FROM admin_cred WHERE melk=?;";
    $statement = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
      echo "<div>
                  <p>Error:</p>
                  <p>feil i sql.</p> 
                </div>";
    }
    else {

      mysqli_stmt_bind_param($statement, "s", $username);
      mysqli_stmt_execute($statement);
      $result = mysqli_stmt_get_result($statement);

      if ($row = mysqli_fetch_assoc($result)) {
        $pwCheck = password_verify($password, $row['potetgull']);
        
        if ($pwCheck == false) {
          echo "<div>
                  <p>Error: Sql error</p>
                  <p>Sql error.</p> 
                </div>";

        }
          else if ($pwCheck == true) {
            session_start();
            $_SESSION['user'] = $row['melk'];
            
            go_to_page("admin-panel");
            //echo "<script type='text/javascript'>window.location.href='". home_url() ."/admin-panel'</script>";

          }
        
        else {
          echo "<div>
                  <p>Error: Passordet er feil</p>
                  <p>Feil passord.</p> 
                </div>";
        }



      }
      else {
        echo "<div>
                  <h4>Error: Ingen bruker</h4>
                  <p>finner ikke bruker</p> 
                </div>";

      }

    }
  }
}
?>
		<?php	// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

