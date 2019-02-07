<?php
// For functionality like checking if a user is an admin before page is loaded

date_default_timezone_set('America/Vancouver');


if( empty($_SESSION['user_logged_in']) ){ //if not logged in

    $user_id = (int)$_GET['user_id'];

    // Allowed logged out functionality
    $allowed_urls = array(
        '/',
        '/index.php',
        '/signin.php',
        '/sign-up.php',
        '/search.php',
        '/users/index.php?user_id='.$user_id

    );

    $allowed = false;

    foreach($allowed_urls as $allowed_url){
        if( $_SERVER['REQUEST_URI'] == $allowed_url ){
            $allowed = true;
            break;
        }
    }

    if( $allowed === false ){
        header("Location: /");
    }

}else{ //user is logged in

    //set user's timezone
    $u = new User;
    $user = $u->get_by_id($_SESSION['user_logged_in']);

    date_default_timezone_set($user['timezone']); // the timezone will adjust to the user's timezone when logged in

}
