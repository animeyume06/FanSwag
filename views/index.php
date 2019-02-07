<?php

        require_once("../core/includes.php");


        $u = new User;
        $user = $u->get_by_id($_SESSION['user_logged_in']);


        // unique html head vars
        $title = 'Home Page';
        require_once("../elements/html_head.php");
        require_once("../elements/nav.php");
?>

        <div class="container-fluid px-0">


            <!-- BANNER -->
            <div id="banner">
                <div id="banner-overlay">
                    <div id="banner-container">

                        <img src="/assets/images/fan-swag-logo-combination.png" alt="Fan Swag Logo">

                        <p class="mt-3">A Community for fan-based swag designers</p>

                    </div><!-- #banner-container -->
                </div><!-- #banner-overlay -->
            </div><!-- #banner-->


            <!-- CONTENT -->
            <div class="container">


                <div class="post-search-wrapper row">


                    <!-- POST BUTTON -->
                    <span class="add-post-btn-wrapper">

                        <a class="black-fill-btn btn" href="/posts/index.php">POST</a>

                    </span>


                    <!-- SEARCH BAR -->
                    <span class="search-container">
                        <form id="search-form" action="/" method="post">
                            <div class="search-form-group">
                                <input id="search-input" type="text" placeholder="Search..." name="search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </span>

                </div><!-- .post-search-wrapper -->

                <div id="project-feed" class="row my-5">

                    <?php

                    $p = new Post;
                    $projects = $p->get_all();

                    foreach($projects as $project){
                    ?>


                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 project project-post" data-projectID="<?=$project['id']?>">

                        <div class="project-post-wrapper white">
                            <img class="project-img" src="/assets/files/<?=$project['projectimg']?>" alt="Preview User Post">

                            <div class="project-hover d-none">

                                <?php

                                if ($project['user_id'] == $_SESSION['user_logged_in']){

                                 ?>

                                <div class="trash-edit-wrapper">
                                    <a class="trash-edit-link delete-link" data-projectID="<?=$project['id']?>" aria-hidden="true"><i class="fas fa-trash-alt"></i></a>

                                    <br>

                                    <a class="trash-edit-link" href="/posts/edit.php?id=<?=$project['id']?>" aria-hidden="true"><i class="fas fa-edit"></i></a>
                                </div><!-- .trash-edit-wrapper -->

                                <?php } ?>

                                <!-- TRIGGER MODAL -->
                                <a href=".project-view-container-<?=$project['id']?>" data-toggle="modal" data-target=".project-view-container-<?=$project['id']?>">
                                    <div class="project-overlay-link">
                                        <div class="title-username-wrapper white">
                                            <h5><?= $project['inspiration'] ?></h5>
                                            <span class="small-profilepic-wrapper" class="pr-2">
                                                <img class="sm-profilepic" src="/assets/files/<?=!empty(trim($project['profilepic'])) ? $project['profilepic'] : 'placeholder-user2.png' ?>" alt="Profile Pic">
                                            </span>
                                            <small class="white"><?=$project['username']?></small>
                                        </div><!-- .title-username-wrapper -->

                                        <span class="white pr-like-counter-wrapper">
                                            <i class="fas fa-heart"></i>
                                            <span class="likes-count">
                                                <?=$project['like_count']?>
                                            </span>
                                        </span><!-- .float-right -->
                                    </div><!-- .project-overlay-link -->
                                </a>

                            </div><!-- .project-hover -->
                        </div><!-- .project-post-wrapper -->


                        <!-- MODAL -->
                        <div class="modal fade project-view-container-<?=$project['id']?>" tabindex="-1" role="dialog" aria-labelledby="project-view-container" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered mx-auto" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>

                                        <h3 class="yellow modal-title large-font"><?=$project['name']?></h3>

                                        <h4 class="white lato-font mdm-font">Inspired by: <span class="bold"><?=$project['inspiration']?></span></h4>

                                    </div><!-- modal-header-->

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="project-view-img-wrapper col-md-6">
                                                <img src="/assets/files/<?=$project['projectimg']?>" alt="Project Picture Large">
                                            </div><!-- #project-view-img-wrapper -->


                                            <div class="col-md-6 project-view-info-wrapper">

                                                <?php

                                                if ($project['user_id'] == $_SESSION['user_logged_in']){

                                                 ?>

                                                <div class="delete-edit-links-wrapper">
                                                    <small>
                                                        <a class="delete-edit-link" href="/posts/edit.php?id=<?=$project['id']?>" aria-hidden="true">Edit</a> /
                                                        <a class="delete-edit-link" href="/posts/delete_refresh.php?id=<?=$project['id']?>" aria-hidden="true">Delete</a>
                                                    </small>
                                                </div><!-- .delete-edit-links -->

                                                <?php } ?>

                                                <small class="grey">Designed by:</small><br>

                                                <div class="profilepic-username-wrapper">
                                                    <span class="md-profilepic-wrapper">
                                                        <img class="md-profilepic" src="/assets/files/<?=!empty(trim($project['profilepic'])) ? $project['profilepic'] : 'placeholder-user2.png' ?>" alt="Profile Pic">
                                                    </span>
                                                    <a class="orange" href="users/index.php?user_id=<?=$project['user_id']?>">
                                                        <?=$project['username']?>
                                                    </a>
                                                </div><!-- #profilepic-username-wrapper -->

                                                <p class="my-5">
                                                    <?=$project['about']?>
                                                </p>

                                                <small>
                                                    <span class="orange"><i class="fas fa-heart"></i></span>
                                                    <span class="likes-count grey">
                                                        <?=$project['like_count']?>
                                                    </span>
                                                    <span class="grey">
                                                         likes
                                                    </span>
                                                </small>

                                                <?php
                                                $like_class = 'far';
                                                $like_text = 'Like it?';

                                                if ( !empty($project['like_id']) ){
                                                    $like_class = 'fas';
                                                    $like_text = 'Liked it!';
                                                }

                                                ?>


                                                <p class="my-5">
                                                    <?php

                                                    if( empty($_SESSION['user_logged_in']) ){ // User is not logged in
                                                    ?>

                                                    Like it?

                                                    <a class="orange signin-like" href="/signin.php">
                                                        <i class="far fa-heart"></i>
                                                    </a>

                                                    <?php }else{ ?>

                                                    <span class="like-btn-text">
                                                        <?=$like_text?>
                                                    </span>

                                                    <span class="orange like-btn">
                                                        <i class="<?=$like_class?> like-icon fa-heart"></i>
                                                    </span>

                                                    <?php
                                                    }
                                                    ?>

                                                </p>

                                            </div><!-- #project-view-info-wrapper -->
                                        </div><!-- .row -->
                                    </div><!-- .modal-body -->


                                </div><!-- .modal-content -->
                            </div><!-- .modal-dialog -->
                        </div><!-- .project-view-container -->

                    </div><!-- .project-post -->

                    <?php } ?>

                </div><!-- #project-feed -->
            </div><!-- .container -->
        </div><!-- .container-fluid -->

<?php require_once("../elements/footer.php");
