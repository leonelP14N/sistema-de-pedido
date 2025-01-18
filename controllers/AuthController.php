<?php

/* public function login($email, $password);
public function register($name, $email, $password);
public function logout(); */

//namespace Controllers;

use Core\Controller;
use Models\User;

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->userModel->getUserByEmail($email)) {
                echo "E-mail já cadastrado!";
                header("Location: index.php?controller=auth&action=login");
            } else {
                $this->userModel->createUser($name, $email, $password);
                echo "Cadastro realizado com sucesso!";
                header("Location: index.php?controller=home");
            }
        } else {
            $this->render('auth/register');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->getUserByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = $user;
                header("Location: index.php?controller=home");
            } else {
                echo "Credenciais inválidas!";
            }
        } else {
            $this->render('auth/login');
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
    }
}
