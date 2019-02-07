<?php
class User extends Db {

    function get_all(){

        $sql = "SELECT * FROM 'users'";

        $users = $this->select($sql);

        return $users;

    }

    // QUICK SQL INJECTION (Force value to an integer)
    function get_by_id($id){
        $id = (int)$id;

        $sql = "SELECT * FROM users WHERE id = '$id'";

        $user = $this->select($sql)[0];

        return $user;
    }

    // ADD NEW USER
    function add(){
        $username = trim($this->data['username']);
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        $email = trim($this->data['email']);
        $country = trim($this->data['country']);
        $bmonth = trim($this->data['bday-month']);
        $bday = trim($this->data['bday-day']);
        $byear = trim($this->data['bday-year']);
        $joined_time = time();

        $sql = "INSERT INTO users (username, password, email, country, bmonth, bday, byear, joinedtime) VALUES ('$username', '$password', '$email', '$country', '$bmonth', '$bday', '$byear', '$joined_time')";

        $new_user_id = $this->execute_return_id($sql);

        return $new_user_id;

    }

    // CHECK IF USER'S USERNAME EXISTS IN DATABASE
    function exists(){
        $username = $this->data['username'];

        $sql = "SELECT * FROM users WHERE username = '$username'";

        $user = $this->select($sql);

        return $user;

    }

    // USER LOGS IN
    function login(){

        $_SESSION = array(); //Empty session to start fresh

        // Get the user's details from the db and store it in a variable
        $username = $this->data['username'];
        $sql = "SELECT * FROM users WHERE username = '$username'";

        $user = $this->select($sql)[0];

        // Check if the password from the form matches password from db
        if( password_verify($_POST['password'], $user['password']) ){

            // User is logged in
            $_SESSION['user_logged_in'] = $user['id'];

        }else{ //Login attempt failed

            $_SESSION['login_attempt_msg'] = '<p class="text-danger my-3">Incorrect email and/or password</p>';
            header("Location: /signin.php");
            exit();
        }

    }


    // USER EDITS PROFILE
    function edit(){

        $id = (int)$_SESSION['user_logged_in'];
        $country = (trim($this->data['country']));
        $password = password_hash(trim($this->data['password']), PASSWORD_DEFAULT);
        $email = (trim($this->data['email']));
        $bio = (trim($this->data['bio']));
        $bmonth = (trim($this->data['bday-month']));
        $bday = (trim($this->data['bday-day']));
        $byear = (trim($this->data['bday-year']));

        $profilepic = '';

        if( !empty($_FILES['fileToUpload']['name']) ){

            // Delete user's old profile image
            $old_project_image = trim($this->get_by_id($id)['profilepic']);
            if( !empty($old_project_image) ){
                if( file_exists(APP_ROOT.'/views/assets/files/'.$old_project_image )){
                    unlink( APP_ROOT.'/views/assets/files/'.$old_project_image ); //it is the function that will delete a file or folder in php
                }
            }

            $util = new Util;
            $fileuploadArr = $util->file_upload(); // file_upload will upload the file to the array $_FILES
            $profilepic = $fileuploadArr['filename'];
            $profilepic = ", profilepic='$profilepic'";
        }


        if( !empty(trim($_POST['password'])) ){ // New password entered


            $sql = "UPDATE users SET
                country='$country',
                password='$password',
                email='$email',
                profileabout='$bio',
                bmonth='$bmonth',
                bday='$bday',
                byear='$byear'
                $profilepic
                WHERE id='$id'";

            $this->execute($sql);

        }else{ //No new password entered
            $sql = "UPDATE users SET country='$country', profileabout='$bio', bmonth='$bmonth', bday='$bday', byear='$byear', email='$email' $profilepic WHERE id='$id'";

            $this->execute($sql);
        }

    }


}
