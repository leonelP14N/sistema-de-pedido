<?php

require_once '../middlewares/AuthMiddleware.php';

use Core\Controller;
use Models\User;
use Middlewares\AuthMiddleware;

class UserController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
        AuthMiddleware::checkAccess('admin'); // Apenas admin pode gerenciar usuários
    }

    public function index() {
        AuthMiddleware::allowRoles(['admin']);
        $users = $this->userModel->getAllUsers();
        $this->render('users/index', ['users' => $users]);
    }

    public function create() {
        AuthMiddleware::allowRoles(['admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $role = $_POST['role'];

            $this->userModel->createUser($name, $email, $password, $role);
            header('Location: ?controller=user&action=index');
        } else {
            $this->render('users/create');
        }
    }

    public function activate() {
        AuthMiddleware::allowRoles(['admin']);
        $userId = $_GET['id'];
        $this->userModel->updateUserStatus($userId, 'active');
        header('Location: ?controller=user&action=index');
    }

    public function deactivate() {
        AuthMiddleware::allowRoles(['admin']);
        $userId = $_GET['id'];
        $this->userModel->updateUserStatus($userId, 'inactive');
        header('Location: ?controller=user&action=index');
    }
}
