<?php  require_once("../core/includes.php");
    // unique html head vars
    $title = 'Sign In';
    require_once("../elements/html_head.php");
    require_once("../elements/nav.php");
?>

        <div class="container-fluid px-0">

            <!-- CONTENT -->
            <div class="container">

                <div class="col-sm-6 mx-auto my-5 py-5">

                    <h1>Sign In</h1>

                    <?= !empty($_SESSION['login_attempt_msg']) ? $_SESSION['login_attempt_msg'] : '' ?>

                    <form action="/users/signin.php" method="post">

                        <div class="form-group">
                            <label>Username:</label>
                            <input class="form-control form-control-border" type="text" name="username">
                        </div><!-- .form-group -->

                        <div class="form-group">
                            <label>Password:</label>
                            <input class="form-control form-control-border" type="password" name="password">
                        </div><!-- .form-group -->

                        <input class="orange-fill-btn mt-3" type="submit" value="Sign In">

                    </form>

                </div><!-- .col-sm-6 -->

            </div><!-- .container -->


        </div><!-- .container-fluid -->

<?php require_once("../elements/footer.php");
