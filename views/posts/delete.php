<?php
require_once '../../core/includes.php';

if (!empty($_POST['project_id']) ){

    $p = new Post;
    $p->delete();

}

exit();
