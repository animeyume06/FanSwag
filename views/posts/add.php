<?php require_once '../../core/includes.php';

if( !empty($_POST['project-name']) && !empty($_POST['project-inspiration']) && !empty($_POST['project-comments'])){

    // Add new post to db
    $p = new Post;
    $p->add();

    header("Location: /index.php");
    exit();

}

header("Location: /");
exit();
