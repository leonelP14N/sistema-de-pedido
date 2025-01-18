<?php
session_start();
// Inclua os arquivos necessários
require_once '../core/Controller.php';
require_once '../config/database.php';
require_once '../models/Request.php';
require_once '../models/User.php';
require_once '../models/Product.php';

// Use namespaces se aplicável
use Core\Controller;
use Models\Request;

// Redireciona para a página de login se o usuário não estiver autenticado
if (!isset($_SESSION['user']) && !in_array($_GET['controller'] ?? '', ['auth'])) {
    header('Location: ?controller=auth&action=login');
    exit;
}

// Configuração básica para roteamento
$controller = $_GET['controller'] ?? 'dashboard'; // Controlador padrão: "home"
$action = $_GET['action'] ?? 'index';        // Ação padrão: "index"

// Formatar o nome do controlador
$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = "../controllers/" . $controllerName . ".php";

// Verificar se o arquivo do controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Instanciar a classe do controlador
    if (class_exists($controllerName)) {
        $controllerInstance = new $controllerName();

        // Verificar se o método existe no controlador
        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            echo "Ação não encontrada: $action";
        }
    } else {
        echo "Classe do controlador não encontrada: $controllerName";
    }
} else {
    echo "Arquivo do controlador não encontrado: $controllerFile";
}


?>
