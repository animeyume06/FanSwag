<?php  require_once("../../core/includes.php");

if( empty($_SESSION['user_logged_in']) ){ // User is not logged in

    // Bring user to login form
    header("Location: /signin.php");
    exit();

}

$u = new User;

if( !empty($_POST) ){ // Form was submitted
    $u->edit();
    header('Location: /users/index.php');
    exit();
}

$user = $u->get_by_id($_SESSION['user_logged_in']);

// unique html head vars
$title = 'Edit Profile Page';
require_once("../../elements/html_head.php");
require_once("../../elements/nav.php");

?>

        <div class="container-fluid px-0">

            <!-- CONTENT -->
            <div class="container">

                <h1 class="mt-5">Edit Profile</h1>

                <form class="my-5" method="post" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">
                                <div id="lg-profilepic-wrapper" class="mx-auto">
                                    <img id="lg-profilepic" src="/assets/files/<?=!empty(trim($user['profilepic'])) ? $user['profilepic'] : 'placeholder-user2.png' ?>" alt="Profile Pic">
                                </div><!-- #lg-profilepic-wrapper -->

                                <div class="text-center mt-3">
                                    <input id="file-with-preview" class="inputfile" type="file" name="fileToUpload" onchange="previewProfileFile()">
                                    <label for="file-with-preview">Change Picture</label>
                                </div><!-- .text-center -->
                            </div><!-- .form-group -->

                        </div><!-- .col-md-4 -->

                        <div class="col-md-8">

                            <div class="form-group">

                                <h3>About Me</h3>

                                <small class="grey">
                                    Tell others about yourself. What's your favourite series? What do you prefer to design? Do you have a website?
                                </small>

                                <?php

                                $bio = $user['profileabout'];
                                $placeholderBio = "Hi, there! Thanks for visiting my page.";

                                ?>

                                <textarea name="bio" class="form-control form-control-border mt-2"><?php if(!empty($bio)){

                                    echo "$bio";

                                }else{

                                    echo "$placeholderBio";

                                } ?></textarea>

                                <hr class="my-5 dark-hr">

                            </div><!-- .form-group -->

                            <h3>Account Settings</h3>

                            <div class="form-group">
                                <label>Email:</label>
                                <input class="form-control form-control-border" type="email" name="email" value="<?= $user['email'] ?>">
                            </div><!-- .form-group -->

                            <div class="form-group">
                                <label>Country:</label>
                                <select class="form-control form-control-border select-control" data-role="country-selector" name="country" value="<?= $user['country'] ?>" required>
                                </select>
                            </div><!-- .form-group -->

                            <div class="form-group">
                                <label>Date of Birth:</label>

                                <div class="row">

                                    <div class="col-sm-4">
                                        <select class="form-control form-control-border select-control" name="bday-month" required>

                                            <?php

                                            $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');

                                            foreach ($months as $month){

                                                echo '<option '.($user['bmonth'] == $month ? 'selected' : '').'>'.$month.'</option>';

                                            }

                                            ?>

                                        </select>
                                    </div><!-- .col-sm-4 -->

                                    <div class="col-sm-4">
                                        <select class="form-control form-control-border select-control" name="bday-day" required>

                                                                                                                                <option selected="true" disabled="disable" value="" required>Day</option>

                                            <?php

                                                foreach (range(1, 31) as $date) {
                                                    echo '<option '.($user['bday'] == $date ? 'selected' : '').'>'.$date.'</option>';
                                                }

                                            ?>

                                        </select>
                                    </div><!-- .col-sm-4 -->

                                    <div class="col-sm-4">

                                        <select class="form-control form-control-border select-control" name="bday-year" required>

                                            <option selected="true" disabled="disable" value="">Year</option>

                                            <?php

                                            $currentYear = time();

                                            foreach (range(1940, date('o', $currentYear)) as $year) {
                                                echo '<option '.($user['byear'] == $year ? 'selected' : '').'>'.$year.'</option>';
                                            }

                                            ?>
                                                                                                                              </select>

                                    </div><!-- .col-sm-4 -->
                                </div><!-- .row -->
                            </div><!-- .form-group -->

                            <hr class="my-5 dark-hr">

                            <div class="form-group">

                                <a id="change-password-link" data-toggle="collapse" href="#change-password" role="button" aria-expanded="false" aria-controls="change-password">
                                    <h3>
                                        Change Password <i class="fas fa-caret-down"></i>
                                    </h3>
                                </a>

                                <div id="change-password" class="collapse mt-4">

                                    <input class="form-control form-control-border" type="password" name="password" value="" placeholder="Type New Password Here">

                                </div><!-- #change-password -->

                            </div><!-- .form-group -->

                            <input class="black-fill-btn my-5" type="submit" value="SAVE CHANGES">

                        </div><!-- .col-md-8 -->

                    </div><!-- .row -->

                </form>

            </div><!-- .container -->

        </div><!-- .container-fluid -->

<?php require_once("../../elements/footer.php");
