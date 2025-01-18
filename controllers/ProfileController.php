<?php
namespace Controllers;

use Core\Controller;
use Models\User;

class ProfileController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function index() {
        AuthMiddleware::isAuthenticated();
        $userId = $_SESSION['user']['id'];
        $user = $this->userModel->getUserById($userId);
        $this->render('profile/index', ['user' => $user]);
    }

    public function edit() {
        AuthMiddleware::isAuthenticated();
        $userId = $_SESSION['user']['id'];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $this->userModel->updateUser($userId, $name, $email);
            header('Location: ?controller=profile&action=index');
        } else {
            $user = $this->userModel->getUserById($userId);
            $this->render('profile/edit', ['user' => $user]);
        }
    }
    
}
