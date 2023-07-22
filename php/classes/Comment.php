<?php

class Comment{
    static function addComment(){
        global $mysqli;
        $comment = $_POST['comment'];
        $articleId = $_POST['articleId'];
        $userId = $_SESSION['id'];
        $mysqli->query("INSERT INTO `comments`(`user_id`, `comment`, `article_id`) VALUES ('$userId', '$comment', '$articleId')");
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    static function getComments(){
        global $mysqli;
        $articleId = $_POST['articleId'];
        $result = $mysqli->query("SELECT users.name, comments.comment FROM comments, users WHERE article_id = '$articleId' AND users.id = user_id");
        $comments = [];
        $i = 0;
        while (($row = $result->fetch_assoc()) != null ){
            $comments[$i]['name'] = $row['name'];
            $comments[$i]['comment'] = $row['comment'];
            $i++;
        }
        return json_encode($comments);
    }
}