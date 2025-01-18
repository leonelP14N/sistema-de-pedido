<?php
namespace Core;

class Controller {
    public function render($view, $data = []) {
        extract($data);
        require_once "../views/" . $view . ".php";
    }
}

// Arquivo: core/Model.php
namespace Core;

use Config\Database;

class Model {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
}