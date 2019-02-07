<?php  require_once("../../core/includes.php");

if( empty($_SESSION['user_logged_in']) ){ // User is not logged in

    // Bring user to login form
    header("Location: /signin.php");
    exit();

}

$u = new User;
$user = $u->get_by_id($_SESSION['user_logged_in']);


// unique html head vars
$title = 'New Post Page';
require_once("../../elements/html_head.php");
require_once("../../elements/nav.php");

?>

        <div class="container-fluid px-0">

            <!-- CONTENT -->
            <div class="container">

                <!-- POSTING FORM -->

                <div class="my-5">



                        <!-- UPLOAD IMAGES -->

                            <form id="post-form" class="mt-2" action="/posts/add.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">

                                        <h3>Images</h3>

                                        <div id="project-preview-wrapper" class="d-flex">

                                            <div class="form-group my-auto mx-auto">

                                                <div class="text-center">
                                                    <img id="img-preview" class="mx-auto" src="/assets/files/<?=!empty(trim($post['projectimg'])) ? $post['projectimg'] : 'project-placeholder-img.png' ?>" alt="Project Placeholder Image">


                                                    <div class="text-center mt-3">
                                                        <input id="file-with-preview" class="inputfile" type="file" name="fileToUpload" onchange="previewProjectFile()" required>
                                                        <label for="file-with-preview">Upload Picture</label>
                                                    </div><!-- .text-center -->

                                                </div><!-- .text-center -->



                                            </div><!-- form-group -->
                                        </div><!-- .d-flex -->

                                    </div><!-- col-md-6 -->


                                    <!-- PROJECT INFO -->
                                    <div class="col-md-6">
                                        <form action="/posts/add.php" method="post">
                                            <h3>Tell us about your project:</h3>

                                            <div class="form-group">
                                                <label class="form-label">Title:</label>
                                                <input type="text" name="project-name" class="form-control-border form-control" required>
                                            </div><!-- .form-group -->

                                            <div class="form-group">
                                                <label class="form-label">Inspired By:</label><br>
                                                <small class="grey">Name of a TV Show? Movie? Game? Etc.</small>
                                                <input type="text" name="project-inspiration" class="form-control-border form-control" required>
                                            </div><!-- .form-group -->

                                            <div class="form-group">

                                                <label class="form-label">Comments:</label><br>
                                                <small class="grey">What was your process? What was the most difficult thing? Any tips? Etc.</small>

                                                <textarea name="project-comments" class="form-control-border form-control" onkeyup="countChar(this)" required></textarea>

                                                <div class="text-right">
                                                    <small class="grey">
                                                        <span id="charNum">500</span> characters remaining
                                                    </small>
                                                </div><!-- .text-right -->
                                            </div><!-- .form-group -->


                                    </div><!-- .col-md-6 -->
                                </div><!-- .row -->

                                <div class="text-center">
                                    <input type="submit" name="submit-project" class="black-fill-btn" value="SUBMIT">
                                </div><!-- .text-center -->

                            </form>

                        </div><!-- card -->



                    </div><!-- .container -->


                </div><!-- .container-fluid -->

<?php require_once("../../elements/footer.php");
