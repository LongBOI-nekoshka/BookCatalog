<?php

namespace Controller;

require_once __DIR__.'/../Models/UserModels.php';

use Models\UserModels;

class AuthController
{
    public function loginPage()
    {
        session_start();
        if(!isset($_SESSION['id'])) {
            require_once __DIR__.'/../../resources/html/login.html';
        }else {
            require_once __DIR__.'/../../resources/html/index.html';
        }
    }

    public function registerPage()
    {
        session_start();
        if(!isset($_SESSION['id'])) {
            require_once __DIR__.'/../../resources/html/register.html';
        }else {
            require_once __DIR__.'/../../resources/html/index.html';    
        }
    }

    public function login()
    {
        session_start();
        $UserModels = new UserModels;
        $sql = $UserModels->returnConn();
        $user = $sql->query("Select * from users u where u.Username = '".$_POST['Username']."'")->fetch_assoc();
        $requestUri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        if($user) {
            if(password_verify($_POST['Password'],$user['Password'])) {
                $_SESSION['id'] = $user['id']; 
            }
        }
    }

    public function register()
    {
        $UserModels = new UserModels;
        $user = $UserModels->insert([
            "Username"=>$_POST['username'] ?? 'aaaaa',
            "Password"=>password_hash($_POST['password'] ?? 'aaaaa',PASSWORD_DEFAULT),
            "Firstname"=>$_POST['first_name'] ?? 'aaaaa',
            "Lastname"=>$_POST['last_name'] ?? 'aaaaa',
            "Middlename"=>$_POST['middlename'] ?? 'aaaaa',
        ]);
        $requestUri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        if(strpos($requestUri,'FreelanceExam/resources/public/')) {
            header("Location: /FreelanceExam/resources/public/");
        }else {
            header("Location: /login");
        }
    }

    public function logout()
    {
        session_start();
        if(isset($_SESSION['id'])) {
            unset($_SESSION['id']);
        }
        $requestUri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        if(strpos($requestUri,'FreelanceExam/resources/public/')) {
            header("Location: /FreelanceExam/resources/public/");
        }else {
            header("Location: /");
        }
    }
}