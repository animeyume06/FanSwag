<?php

require_once '../../core/includes.php';

// CHECK IF USER FILLED ALL FIELDS PROPERLY
if( !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['country']) && !empty($_POST['bday-month']) && !empty($_POST['bday-day']) && !empty($_POST['bday-year']) ){

    $e = new User;

    // CHECK IF EMAIL ALREADY EXISTS
    $exists = $e->exists();

    if( empty($exists) ){ // User does not exist

        $new_user_id = $e->add();
        $_SESSION['user_logged_in'] = $new_user_id;

        // Redirect to homepage
        header("Location: /");
        exit();

    }else{ // User exists

        $_SESSION['create_acc_msg'] = '<p class="error-message">Sorry, that username already exists.</p>';
        header("Location: /sign-up.php?signup_error=email-exists");
        exit();

    }
}

// Redirect to homepage
header("Location: /");
exit();
