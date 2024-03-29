<?php

namespace app\controllers;
use app\framework\database\Connection;
class LoginController
{
    public function index()
    {
        view('login');
    }
    public function store(){
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        if(empty($email) || empty($password)){
            var_dump("Usuário ou senha inválidos");
            die();
        }
        $connection = Connection::getConnection();
        $prepare = $connection->prepare("select * from users where email = :email");
        $prepare->execute([
            'email'=> $email
        ]);
        $userFound = $prepare->fetchObject();
        if(!$userFound){
            var_dump("Usuário ou senha inválidos");
            die();
        }
        if(!password_verify($password,$userFound->password)){
            var_dump("Usuário ou senha inválidos");
            die();
        };
        $_SESSION['logged'] = true;
        unset($userFound->password);
        $_SESSION['user'] = $userFound;
        return redirect('/dashboard');

    }
}
