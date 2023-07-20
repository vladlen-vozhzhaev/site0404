<?php
    class Blog{
        static function getArticles(){
            global $mysqli;
            $result = $mysqli->query("SELECT * FROM `articles`");
            $articles = [];
            $i = 0;
            while ( ($row = $result->fetch_assoc()) != null ){
                $articles[$i]['title'] = $row['title'];
                $articles[$i]['article'] = $row['article'];
                $articles[$i]['author'] = $row['author'];
                $articles[$i]['id'] = $row['id'];
                $i++;
            }
            return json_encode($articles);
        }

        static function getArticleById($id){
            global $mysqli;
            $result = $mysqli->query("SELECT * FROM `articles` WHERE id = '$id'");
            $row = $result->fetch_assoc();
            return json_encode($row);
        }

        static function editArticleById(){
            $title = $_POST['title'];
            $article = $_POST['article'];
            $author = $_POST['author'];
            $id = $_POST['id'];
            global $mysqli;
            $mysqli->query("UPDATE `articles` SET `title`='$title',`article`='$article',`author`='$author' WHERE id='$id'");
            header("Location: /article/".$id);
        }

        static function deleteArticle($id){
            global $mysqli;
            $mysqli->query("DELETE FROM `articles` WHERE id='$id'");
            header("Location: /blog");
        }

        static function test(){
            return "ничего сложного";
        }
    }