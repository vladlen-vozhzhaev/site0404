<?php
    class User{
        static function reg(){
            global $mysqli;
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $result = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
            if($result->num_rows){
                return "Такой пользователь уже существует";
            }else{
                $mysqli->query("INSERT INTO users (name, lastname, email, pass) VALUES ('$name', '$lastname', '$email', '$pass')");
                header('Location: /login');
            }
        }

        static function login(){
            global $mysqli;
            $email = $_POST['email']; // Получаем eamil из input
            $pass = $_POST['pass']; // Получаем pass из input
            $result = $mysqli->query("SELECT * FROM users WHERE email = '$email'"); // Ищем в БД пользователя с таким email
            if($result->num_rows){ // Если пользователь есть, то
                $row = $result->fetch_assoc(); // Преобразуем ответ от БД в ассоциативный массив
                if(password_verify($pass, $row['pass'])){ // Проверяем пароль
                    $_SESSION['name'] = $row['name']; // Сохраняем имя пользователя в сессию
                    $_SESSION['lastname'] = $row['lastname']; // Сохраняем фамилию в сессию
                    $_SESSION['email'] = $row['email']; // Сохраняем email в сессию
                    $_SESSION['id'] = $row['id']; // Сохраняем id в сессию
                    $_SESSION['avatar'] = $row['avatar']; // Сохраняем аватарку пользователя в сессию
                    header("Location: /profile"); // Перенаправляем пользователя на страницу профиль
                }else{
                    return "error";
                }
            }else{
                return "error";
            }
        }

        static function getUser(){
            return json_encode($_SESSION);
        }

        static function uploadAvatar(){
            // Алгоритм загрузки фото
            global $mysqli;
            $fileName = time().$_FILES['userAvatar']['name'];
            $extention = explode(".", $fileName)[count(explode(".", $fileName))-1];
            if($extention == 'jpg' or $extention == 'png'){
                $dir = "img/".$fileName;
                if( move_uploaded_file($_FILES['userAvatar']['tmp_name'], $dir) ) {
                    echo "Файл успешно загружен";
                }else{
                    echo "Ошибка";
                }
                $userId = $_SESSION['id'];
                $mysqli->query("UPDATE `users` SET `avatar`='/$dir' WHERE id = '$userId'");
                $_SESSION['avatar'] = "/$dir";
                header("Location: /profile");
            }else{
                echo "Ошибка, недопустимый формат файла";
            }
        }
    }