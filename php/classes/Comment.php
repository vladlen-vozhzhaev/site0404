<?php

class Comment{
    static function addComment(){
        global $mysqli;
        $comment = $_POST['comment'];
        $userId = $_SESSION['id'];
        $mysqli->query("INSERT INTO `comments`(`user_id`, `comment`) VALUES ('$userId', '$comment')");
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
}