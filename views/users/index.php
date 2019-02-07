<?php  require_once("../../core/includes.php");
$u = new User;

if( !empty($_GET['user_id']) ){
    $userProfile = $u->get_by_id($_GET['user_id']);
}else{

    $userProfile = $u->get_by_id($_SESSION['user_logged_in']);
}


// unique html head vars
$title = 'User Profile Page';
require_once("../../elements/html_head.php");
require_once("../../elements/nav.php");
?>

        <div class="container-fluid px-0">

            <!-- CONTENT -->
            <div class="container">

                <div class="row mt-5 pt-5">

                    <div class="col-md-4">

                        <div id="user-info-wrapper" class="text-center">

                            <div id="lg-profilepic-wrapper" class="mx-auto">


                                <img id="lg-profilepic" src="/assets/files/<?=!empty(trim($userProfile['profilepic'])) ? $userProfile['profilepic'] : 'placeholder-user2.png' ?>" alt="User Profile Pic">



                            </div><!-- #lg-profilepic-wrapper -->

                            <h5 class="orange lato-font mt-3"><?= $userProfile['username'] ?></h5>

                            <br>

                            <p class="mt-3">
                                <i class="fas fa-map-marker-alt"></i> <?= $userProfile['country'] ?>

                                <br><br><br>

                                <span class="bold">Member Since:</span>
                                <br><?= date('M. d, Y', $userProfile['joinedtime'])?>
                            </p>
                        </div><!-- #user-info-wrapper -->

                        <?php
                        if( $_GET['user_id'] != $_SESSION['user_logged_in']){

                        ?>

                        <a href="message.php" class="black-fill-btn-100w btn my-3">Send Message</a>

                        <?php
                        }else{
                        ?>
                        <a href="/users/edit.php" class="black-fill-btn-100w btn my-3">Edit Profile</a>
                        <?php
                        }
                        ?>

                    </div><!-- .col-md-4 -->

                    <div class="col-md-8">
                        <h3>About Me:</h3>
                        <p class="mt-3 mb-5">

                            <?php

                            $bio = $userProfile['profileabout'];
                            $placeholderBio = "Hi, there! Thanks for visiting my page.";

                            if( !empty($bio) ) {

                                echo "$bio";

                            }else{

                                echo "$placeholderBio";

                            }

                            ?>

                        </p>

                        <h3 class="mb-3">Uploads:</h3>


                        <div id="project-feed" class="row mb-5">

                            <?php

                            $p = new Post;
                            $projects = $p->get_by_user_id();

                            foreach($projects as $project){
                            ?>


                            <div class="col-lg-4 col-sm-6 mb-4 project project-post" data-projectID="<?=$project['id']?>">

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
                                                    <span class="pr-2 small-profilepic-wrapper">
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
                                                    <div class="col-md-6 project-view-img-wrapper">
                                                        <img src="/assets/files/<?=$project['projectimg']?>" alt="Project Picture Large">
                                                    </div><!-- .project-view-img-wrapper -->


                                                    <div class="col-md-6 project-view-info-wrapper">

                                                        <?php

                                                        if ($project['user_id'] == $_SESSION['user_logged_in']){

                                                         ?>

                                                        <div class="delete-edit-links-wrapper">
                                                            <small>
                                                                <a class="delete-edit-link" href="/posts/edit.php?id=<?=$project['id']?>" aria-hidden="true">Edit</a> /
                                                                <a class="delete-edit-link" href="/posts/delete_refresh.php?id=<?=$project['id']?>"  aria-hidden="true">Delete</a>
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

                                                    </div><!-- .project-view-info-wrapper -->
                                                </div><!-- .row -->
                                            </div><!-- .modal-body -->


                                        </div><!-- .modal-content -->
                                    </div><!-- .modal-dialog -->
                                </div><!-- .project-view-container -->

                            </div><!-- .project-post -->

                            <?php } ?>

                        </div><!-- #project-feed -->

                    </div><!-- .col-md-8 -->



                </div><!-- .row -->

            </div><!-- .container -->

        </div><!-- .container-fluid -->

<?php require_once("../../elements/footer.php");
