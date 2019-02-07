<?php
require_once '../../core/includes.php';

$p = new Post;

$p->delete_refresh();
header("Location: /");
exit();
