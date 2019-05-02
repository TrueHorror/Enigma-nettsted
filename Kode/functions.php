<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


function my_theme_enqueue_styles() {

    $parent_style = 'twentysixteen-style'; // This is 'twentysixteen-style' for the Twenty Sixteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'enigma-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

function register_session(){
    if(!session_id()) session_start();
}
add_action('init','register_session');

function delete_member($user){

	if(!isset($_SESSION['user'])){
	   go_to_page("admin-login");

	}
	require('db-connection.php');

	$sql = "DELETE FROM medlemmer WHERE epost = '" . $user . "';";
	$result = mysqli_query($connection, $sql);  

	if ($result) {
	    go_to_page("admin-panel");

	} else {
	    echo "Error deleting user: " . mysqli_error($connection);
	}
}

function go_to_page($page = ""){
	echo "<script type='text/javascript'>window.location.href='". home_url() . "/" . $page . "'</script>";
}

function log_ut(){
	$_SESSION = array();

	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	session_destroy();

	go_to_page("hjem");
}
?>