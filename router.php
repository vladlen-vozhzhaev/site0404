<?php
    session_start();
    $path = $_SERVER['REQUEST_URI']; //  /artilce/2
    $method = $_SERVER['REQUEST_METHOD']; // Получаем метод запроса GET или POST
    $pathArr = explode("/", $path); // ['' ,'article', '2']
    $mysqli = new mysqli('localhost', 'root', '', 'blog0404');
    require_once('php/classes/Blog.php');
    require_once('php/classes/User.php');
    require_once('php/classes/Comment.php');
    if($path == "/login" and $method == "GET"){
        $content = file_get_contents('views/login.html');
    }else if($path == "/login" and $method == "POST"){
        exit(User::login());
    }else if($path == "/reg" and $method == "GET"){
        $content =  file_get_contents('views/reg.html');
    }else if($path == "/reg" and $method == "POST"){
        exit(User::reg());
    }else if($path == "/profile"){
        $content = file_get_contents('views/profile.html');
    }else if($path == "/getUser"){
        exit(User::getUser());
    }else if($path == "/addArticle"){
        $content =  file_get_contents('views/addArticle.html');
    }else if($path == "/blog"){
        $content = file_get_contents('views/blog.html');
    }else if($path == "/getArticles"){
        exit(Blog::getArticles());
    }else if($path == "/test"){
        exit(Blog::test());
    }else if($pathArr[1] == "article"){
        $content = file_get_contents('views/article.html');
    }else if($pathArr[1] == "getArticle") { // /getArticle/2
        $id = $pathArr[2];
        exit(Blog::getArticleById($id));
    }else if($path == "/editArticle"){
        exit(Blog::editArticleById());
    }else if($pathArr[1] == "editArticle"){
        $content = file_get_contents('views/editArticle.html');
    }else if($pathArr[1] == "deleteArticle"){
        $id = $pathArr[2];
        exit(Blog::deleteArticle($id));
    }else if($path == "/uploadAvatar"){
        exit(User::uploadAvatar());
    }else if($path == "/addComment"){
        exit(php::addComment());
    }else{
        $content = "Такой не сущетсвует, ошибка 404";
    }

    require_once('template.php');