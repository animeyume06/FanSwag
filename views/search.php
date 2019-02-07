<?php require_once '../core/includes.php';

$p = new Post;
$posts = $p->get_all();

echo json_encode($posts);
exit();
