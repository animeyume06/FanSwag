<?php

class Post extends Db {


    // GET ALL POSTS
    function get_all(){

        $user_id = (int)$_SESSION['user_logged_in'];

        if (!empty($_POST['search'])) { // Searching something

            $search = trim($this->data['search']);

            $sql = "SELECT posts.*,
                users.id AS user_id,
                users.username,
                users.profilepic,
                likes.id AS like_id,
                (SELECT COUNT(likes.id) FROM likes WHERE likes.posts_id = posts.id) AS like_count,
                IF(posts.user_id = '$user_id', 'true', 'false') AS user_owns
                FROM posts
                LEFT JOIN users
                on posts.user_id = users.id
                LEFT JOIN likes
                ON posts.id = likes.posts_id
                AND likes.user_id = '$user_id'
                WHERE posts.name LIKE '%$search%'
                OR posts.inspiration LIKE '%$search%'
                OR users.username LIKE '%$search%'
                OR CONCAT(users.username, ' ', posts.name, ' ', posts.inspiration) LIKE '%$search%'
                ORDER BY posts.postedtime DESC";

        }else{ // Not searching something

            $sql = "SELECT posts.*,
                users.id AS user_id,
                users.username,
                users.profilepic,
                likes.id AS like_id,
                (SELECT COUNT(likes.id) FROM likes WHERE likes.posts_id = posts.id) AS like_count,
                IF(posts.user_id = '$user_id', 'true', 'false') AS user_owns
                FROM posts
                LEFT JOIN users
                ON posts.user_id = users.id
                LEFT JOIN likes
                ON posts.id = likes.posts_id
                AND likes.user_id = '$user_id'
                ORDER BY posts.postedtime DESC";

        }

        $posts = $this->select($sql);

        return $posts;

    }

    function get_by_id($id){
        $id = (int)$id;

        $sql = "SELECT * FROM posts WHERE id = '$id'";

        $project = $this->select($sql)[0];

        return $project;
    }

    function get_by_user_id(){

        $user_id = (int)$_SESSION['user_logged_in'];
        $other_user = (int)$_GET['user_id'];

        if ( empty($_GET['user_id']) ) {

            $sql = "SELECT posts.*,
            users.id AS user_id,
            users.username,
            users.profilepic,
            likes.id AS like_id,
            (SELECT COUNT(likes.id) FROM likes WHERE likes.posts_id = posts.id) AS like_count
            FROM posts
            LEFT JOIN users
            ON posts.user_id = users.id
            LEFT JOIN likes
            ON posts.id = likes.posts_id
            AND likes.user_id = '$user_id'
            WHERE posts.user_id = '$user_id'
            ORDER BY posts.postedtime DESC";

        }else{

            $sql = "SELECT posts.*,
            users.id AS user_id,
            users.username,
            users.profilepic,
            likes.id AS like_id,
            (SELECT COUNT(likes.id) FROM likes WHERE likes.posts_id = posts.id) AS like_count
            FROM posts
            LEFT JOIN users
            ON posts.user_id = users.id
            LEFT JOIN likes
            ON posts.id = likes.posts_id
            AND likes.user_id = '$user_id'
            WHERE posts.user_id = '$other_user'
            ORDER BY posts.postedtime DESC";

        }


            $posts = $this->select($sql);

            return $posts;

    }


    // ADD POST
    function add(){

        $user_id = (int)$_SESSION['user_logged_in'];
        $name = trim($this->data['project-name']);
        $inspiration = trim($this->data['project-inspiration']);
        $about = trim($this->data['project-comments']);
        $postedtime = time();

        // Upload the file
        $util = new Util;
        $fileuploadArr = $util->file_upload(APP_ROOT."/views/assets/files/", "fileToUpload");
        $project_img = $fileuploadArr['filename'];

        // STORE PROJECT INFO INTO DATABASE
        $sql = "INSERT INTO posts (user_id, name, inspiration, about, projectimg, postedtime) VALUES ('$user_id', '$name', '$inspiration', '$about', '$project_img', '$postedtime')";

        $this->execute($sql);

    }

    // CHECK USER'S OWNERSHIP OF POST
    function check_ownership($id){

        $id = (int)$id;

        $sql = "SELECT * FROM posts WHERE id = '$id'";

        $project = $this->select($sql)[0];

        if ($project['user_id'] == $_SESSION['user_logged_in']){
            return true;
        }else{
            header("Location: /");
            exit();
        }

    }

    // EDIT PROJECT
    function edit($id){

        $id = (int)$id;
        $this->check_ownership($id); // Make sure user owns post that's being edited

        $current_user_id = (int)$_SESSION['user_logged_in'];
        $name = trim($this->data['project-name']);
        $inspiration = trim($this->data['project-inspiration']);
        $about = trim($this->data['project-comments']);

        if( !empty($_FILES['fileToUpload']['name']) ){ // Check if new file submitted

            // Delete old project image file
            $old_project_image = trim($this->get_by_id($id)['projectimg']);
            if( !empty($old_project_image) ){
                if( file_exists(APP_ROOT.'/views/assets/files/'.$old_project_image )){
                    unlink( APP_ROOT.'/views/assets/files/'.$old_project_image ); //it is the function that will delete a file or folder in php
                }
            }

            $util = new Util;
            $fileuploadArr = $util->file_upload();
            $project_img = $fileuploadArr['filename'];

            $sql = "UPDATE posts SET name='$name', inspiration='$inspiration', about='$about', projectimg='$project_img' WHERE id='$id' AND user_id='$current_user_id'";

            $this->execute($sql);

            }else{ // if no new file was submitted

                $sql = "UPDATE posts SET name='$name', inspiration='$inspiration', about='$about' WHERE id='$id' AND user_id='$current_user_id'";

                $this->execute($sql);
            }

        }


    // DELETE POST WITHOUT REFRESH
    function delete(){
        $current_user_id = (int)$_SESSION['user_logged_in'];
        $project_id = (int)$this->data['project_id'];

        // Delete old project image file
        $project_image = trim($this->get_by_id($id)['projectimg']);
        if( !empty($project_image) ){
            if( file_exists(APP_ROOT.'/views/assets/files/'.$project_image )){
                unlink( APP_ROOT.'/views/assets/files/'.$project_image ); //it is the function that will delete a file or folder in php
            }
        }

        $sql = "DELETE FROM posts WHERE id='$project_id' AND user_id='$current_user_id'";
        $this->execute($sql);
    }

    // DELETE POST WITH REFRESH
    function delete_refresh(){
        $current_user_id = (int)$_SESSION['user_logged_in'];
        $id = (int)$_GET['id'];
        $this->check_ownership($id);

        // Delete old project image file
        $project_image = trim($this->get_by_id($id)['projectimg']);
        if( !empty($project_image) ){
            if( file_exists(APP_ROOT.'/views/assets/files/'.$project_image )){
                unlink( APP_ROOT.'/views/assets/files/'.$project_image ); //it is the function that will delete a file or folder in php
            }
        }

        $sql = "DELETE FROM posts WHERE id='$id' AND user_id='$current_user_id'";
        $this->execute($sql);
    }


}
