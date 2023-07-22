<?php
    session_start();
    $path = $_SERVER['REQUEST_URI']; //  /artilce/2
    $method = $_SERVER['REQUEST_METHOD']; // Получаем метод запроса GET или POST
    $pathArr = explode("/", $path); // ['' ,'article', '2']
    $mysqli = new mysqli('localhost', 'root', '', 'blog0404');
    require_once('php/classes/Blog.php');
    require_once('php/classes/User.php');
    require_once('php/classes/Comment.php');
    require_once('php/classes/Route.php');
    // Работа с пользователем
    Route::get('/login', 'views/login.html');
    Route::get('/reg', 'views/reg.html');
    Route::get('/profile', 'views/profile.html');
    Route::get('/getUser', function(){return User::getUser();});
    Route::get('/logout', function() {return User::logout();});
    Route::post('/login', function(){return User::login();});
    Route::post('/reg',function () {return User::reg();});
    Route::post('/uploadAvatar', function(){return User::uploadAvatar();});
    // Работа с блогом
    Route::get('/addArticle', 'views/addArticle.html');
    Route::get('/blog', 'views/blog.html');
    Route::get('/getArticles', function(){return Blog::getArticles();});
    Route::get('/article', 'views/article.html');
    Route::get('/getArticle', function(){
        global $pathArr;
        $id = $pathArr[2];
        return Blog::getArticleById($id);
    });
    Route::get('/deleteArticle', function(){
        global $pathArr;
        $id = $pathArr[2];
        return Blog::deleteArticle($id);
    });
    Route::get('/editArticle', 'views/editArticle.html');
    Route::post('/editArticle', function(){return Blog::editArticleById();});
    // Работа с комментариями
    Route::post('/addComment', function(){return Comment::addComment();});
    Route::post('/getComments', function(){return Comment::getComments();});