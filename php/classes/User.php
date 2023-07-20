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
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $result = $mysqli->query("SELECT * FROM users WHERE email = '$email'");
            if($result->num_rows){
                $row = $result->fetch_assoc();
                if(password_verify($pass, $row['pass'])){
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['id'] = $row['id'];
                    header("Location: /profile")
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
    }