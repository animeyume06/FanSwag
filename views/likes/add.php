<?php require_once '../../core/includes.php';

header('Content-Type: application/json'); //Info coming back is json

$love_data = array(
    'error' => true
);

if( !empty($_POST['project_id']) ){ //Checking to see if project_id was sent

    // Add new love to db
    $l = new Like;
    $like_data = $l->add($like_data);

};

echo json_encode($like_data);

die();
