<?php

class Like extends Db {

    function add($like_data){

        $project_id = $this->data['project_id'];
        // $this->data is the same as $_POST but the former is safer

        $user_id = (int)$_SESSION['user_logged_in'];


        // CHECK IF ALREADY LIKED
        $sql = "SELECT * FROM likes WHERE posts_id = '$project_id' AND user_id = '$user_id'";
        $like = $this->select($sql)[0];


        if( !empty($like['id']) ){ // already liked, delete the like
            $sql = "DELETE FROM likes WHERE posts_id = '$project_id' AND user_id = '$user_id'";
            $this->execute($sql);
            $like_data['liked'] = 'unliked'; // unliked it
            $like_data['error'] = false;
        }else{
            $sql = "INSERT INTO likes (posts_id, user_id) VALUES('$project_id', '$user_id')";
            $like_id = (int)$this->execute_return_id($sql);

            if ( !empty($like_id) ){
                if( $like_id != 0 && is_numeric($like_id) ){
                    $like_data['liked'] = 'liked';
                    $like_data['error'] = false;
                }
            }
        }

        $sql = "SELECT COUNT(id) AS like_count FROM likes WHERE posts_id = '$project_id'";
        $like_count = $this->select($sql)[0]; //this holds the like count
        $like_data['like_count'] = $like_count['like_count'];

        return $like_data;

    }




}
