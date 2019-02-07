<div class="wrapper">

    <!-- SIDEBAR -->
    <nav id="sidebar">

        <a id="dismiss" class="btn">
            <i class="orange fas fa-times"></i>
        </a>

        <ul class="list-unstyled components">
            <li class="pt-5">
                <a href="/index.php">Home</a>
            </li>
            <hr class="nav-divider">

            <?php

            // CHECK IF USER IS LOGGED IN
            if ( $_SESSION['user_logged_in']){

                $u = new User;
                $user = $u->get_by_id($_SESSION['user_logged_in']);

            ?>

            <li>
                <a href="/users/index.php">My Profile</a>
            </li>
            <hr class="nav-divider">
            <li>
                <a href="/posts/index.php">Make A Post</a>
            </li>
            <hr class="nav-divider">
            <li>
                <a href="/users/logout.php">Logout</a>
            </li>

            <?php }else{ ?>

            <li>
                <a href="/signin.php">Sign In</a>
            </li>
            <hr class="nav-divider">
            <li>
                <a href="sign-up.php">Join</a>
            </li>
            <hr class="nav-divider">

            <?php } ?>
        </ul>

    </nav><!-- #sidebar -->

    <div id="content">

        <div class="overlay"></div>

        <!-- HEADER -->
        <nav id="header" class="navbar navbar-expand-lg">

            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn">
                    <i class="orange fas fa-bars"></i>
                </button>

                <a class="mx-auto" href="/index.php"><img id="header-logo" src="/assets/files/fan-swag-logo-wordmark.png" alt="Fan Swag Logo Wordmark"></a>

                <span class="signin-join-wrapper">

                    <?php

                    // CHECK IF USER IS LOGGED IN
                    if ( $_SESSION['user_logged_in']){

                        $u = new User;
                        $user = $u->get_by_id($_SESSION['user_logged_in']);

                    ?>

                    <a data-toggle="dropdown" class="dropdown-toggle header-links yellow" href="/" aria-expanded="true">
                        Welcome, <?=$user['username']?>
                    </a>

                    <div id="dropdown-signedin" class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item yellow bignoodle-font" href="/users/">My Profile</a>
                        <a class="dropdown-item yellow bignoodle-font" href="/users/logout.php">Logout</a>
                    </div><!-- #dropdown-signedin -->


                    <?php }else{ ?>

                    <a data-toggle="dropdown" id="dropdown-signin" class="dropdown-toggle yellow header-links" href="/" aria-expanded="true">Sign In</a>

                    <ul class="dropdown-menu dropdown-menu-right login-form">
                        <li>
                            <form id="dropdown-signin-form" action="/users/signin.php" method="post">

                                <div class="form-group">
                                    <label class="bignoodle-font">Username:</label>
                                    <input type="text" name="username" class="form-control form-control-borderless" required>
                                </div><!-- .form-group -->

                                <div class="form-group">
                                    <label class="bignoodle-font">Password:</label>
                                    <input type="password" name="password" class="form-control form-control-borderless" required>
                                </div><!-- .form-group -->

                                <input type="submit" class="btn orange-fill-btn mt-3" value="Log In">
                            </form>
                        </li>
                    </ul>

                    <a id="join-btn" class="black header-links" href="sign-up.php">Join</a>
                </span>

                <?php } ?>

            </div><!-- .container-fluid -->

        </nav>
