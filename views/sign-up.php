<?php  require_once("../core/includes.php");

    // unique html head vars
    $title = 'Sign Up Page';
    require_once("../elements/html_head.php");
    require_once("../elements/nav.php");
?>

        <div class="container-fluid px-0">

            <!-- CONTENT -->
            <div class="container">


                <div id="signup-wrapper-responsive" class="yellow my-5">

                    <h3>Create an Account</h3>

                    <!-- Display error message is entered email already exists -->
                    <?= !empty($_GET['signup_error']) ? !empty($_SESSION['create_acc_msg']) ? $_SESSION['create_acc_msg'] : '' : '' ?>

                    <form class="bold" action="/users/add.php" method="post">

                        <div class="form-group">
                            <label>Username:</label>
                            <input class="form-control-borderless form-control" type="text" name="username" required>
                        </div><!-- .form-group -->

                        <div class="form-group">
                            <label>Email:</label>
                            <input class="form-control-borderless form-control" type="email" name="email" required>
                        </div><!-- .form-group -->

                        <div class="form-group">
                            <label>Password:</label>
                            <input class="form-control-borderless form-control" type="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label>Country:</label>
                            <select class="form-control form-control-borderless select-control" data-role="country-selector" name="country" value="" required>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Date of Birth:</label>

                            <div class="row">

                                <div class="col-sm-4">
                                    <select class="form-control form-control-borderless select-control mb-3" name="bday-month" required>
                                        <option selected="true" disabled="disable" value="">Month</option>
                                        <option>Jan</option>
                                        <option>Feb</option>
                                        <option>Mar</option>
                                        <option>Apr</option>
                                        <option>May</option>
                                        <option>Jun</option>
                                        <option>Jul</option>
                                        <option>Aug</option>
                                        <option>Sept</option>
                                        <option>Oct</option>
                                        <option>Nov</option>
                                        <option>Dec</option>
                                    </select>
                                </div><!-- .col-sm-4 -->

                                <div class="col-sm-4">
                                    <select class="form-control form-control-borderless select-control mb-3" name="bday-day" required>

                                          <option selected="true" disabled="disable" value="">Day</option>

                                          <?php for ($i = 1; $i <= 31; $i++) : ?>

                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                        <?php endfor; ?>

                                    </select>
                                </div><!-- .col-sm-4 -->

                                <div class="col-sm-4">

                                    <select class="form-control form-control-borderless select-control mb-3" name="bday-year" required>

                                        <option selected="true" disabled="disable" value="">Year</option>

                                        <?php

                                        $currentYear = time();
                                        for ($y = 1940; $y <= date('o', $currentYear); $y++) : ?>

                                        <option value="<?php echo $y; ?>"><?php echo $y; ?></option>

                                                                                                                              <?php endfor; ?>
                                                                                                                          </select>

                                </div><!-- .col-sm-4 -->
                            </div><!-- .row -->
                        </div><!-- .form-group -->

                        <input class="btn orange-fill-btn my-3" type="submit" value="Let's Go">

                    </form>

                    <a class="yellow yellow-link" href="signin.php">I already have an account</a>

                </div><!-- #signup-wrapper -->




                <div class="row my-5">

                    <div id="logo-column" class="col-md-6 my-auto">
                        <div class="my-auto text-center">
                            <img id="symbol-logo" class="mb-5" src="/assets/images/fan-swag-logo-symbol.png" alt="Fan Swag Icon Logo">

                            <h1 id="signup-h1" class="grey">Join the Community</h1>

                            <h2 id="signup-h2" class="bold">show off your <span class="orange">swag</span></h2>
                        </div><!-- .my-auto -->
                    </div><!-- .col-md-6 -->

                    <div id="form-column" class="col-md-6 my-auto">

                        <div id="signup-wrapper" class="yellow">

                            <h3>Create an Account</h3>

                            <!-- Display error message is entered email already exists -->
                            <?= !empty($_GET['signup_error']) ? !empty($_SESSION['create_acc_msg']) ? $_SESSION['create_acc_msg'] : '' : '' ?>

                            <form class="bold" action="/users/add.php" method="post">

                                <div class="form-group">
                                    <label>Username:</label>
                                    <input class="form-control-borderless form-control" type="text" name="username" required>
                                </div><!-- .form-group -->

                                <div class="form-group">
                                    <label>Email:</label>
                                    <input class="form-control-borderless form-control" type="email" name="email" required>
                                </div><!-- .form-group -->

                                <div class="form-group">
                                    <label>Password:</label>
                                    <input class="form-control-borderless form-control" type="password" name="password" required>
                                </div>

                                <div class="form-group">
                                    <label>Country:</label>
                                    <select class="form-control form-control-borderless select-control" data-role="country-selector" name="country" value="" required>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Date of Birth:</label>

                                    <div class="row">

                                        <div class="col-sm-4">
                                            <select class="form-control form-control-borderless select-control mb-3" name="bday-month" required>
                                                <option selected="true" disabled="disable" value="">Month</option>
                                                <option>Jan</option>
                                                <option>Feb</option>
                                                <option>Mar</option>
                                                <option>Apr</option>
                                                <option>May</option>
                                                <option>Jun</option>
                                                <option>Jul</option>
                                                <option>Aug</option>
                                                <option>Sept</option>
                                                <option>Oct</option>
                                                <option>Nov</option>
                                                <option>Dec</option>
                                            </select>
                                        </div><!-- .col-sm-4 -->

                                        <div class="col-sm-4">
                                            <select class="form-control form-control-borderless select-control mb-3" name="bday-day" required>

                                                                                                                                                      <option selected="true" disabled="disable" value="">Day</option>

                                                                                                                                                      <?php for ($i = 1; $i <= 31; $i++) : ?>

                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                                <?php endfor; ?>

                                            </select>
                                        </div><!-- .col-sm-4 -->

                                        <div class="col-sm-4">

                                            <select class="form-control form-control-borderless select-control mb-3" name="bday-year" required>

                                                <option selected="true" disabled="disable" value="">Year</option>

                                                <?php

                                                $currentYear = time();
                                                for ($y = 1940; $y <= date('o', $currentYear); $y++) : ?>

                                                <option value="<?php echo $y; ?>"><?php echo $y; ?></option>

                                                                                                                                      <?php endfor; ?>
                                                                                                                                  </select>

                                        </div><!-- .col-sm-4 -->
                                    </div><!-- .row -->
                                </div><!-- .form-group -->

                                <input class="btn orange-fill-btn my-3" type="submit" value="Let's Go">

                            </form>

                            <a class="yellow yellow-link" href="signin.php">I already have an account</a>

                        </div><!-- #signup-wrapper -->


                    </div><!-- .col-md-6 -->

                </div><!-- .row -->




            </div><!-- .container -->


        </div><!-- .container-fluid -->

<?php require_once("../elements/footer.php");
