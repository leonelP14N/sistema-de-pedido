<?php
//namespace Controller;

require_once '../middlewares/AuthMiddleware.php';

use Core\Controller;
use Models\Product;
use Middlewares\AuthMiddleware;

class ProductController extends Controller {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
        AuthMiddleware::allowRoles(['admin', 'editor']); // Apenas admin e editor podem acessar
    }

    public function index() {
        $products = $this->productModel->getAllProducts();
        $this->render('products/index', ['products' => $products]);
    }

    public function create() {
        AuthMiddleware::allowRoles(['admin', 'editor']); // Apenas admin pode cadastrar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $status = $_POST['status'];

            $this->productModel->createProduct($name, $description, $price, $status);
            header("Location: index.php?controller=product&action=index");
        } else {
            $this->render('products/create');
        }
    }

    public function edit() {
        AuthMiddleware::allowRoles(['admin', 'editor']); // Apenas admin pode editar
        $id = $_GET['id'];
        $product = $this->productModel->getProductById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $status = $_POST['status'];

            $this->productModel->updateProduct($id, $name, $description, $price, $status);
            header("Location: index.php?controller=product&action=index");
        } else {
            $this->render('products/edit', ['product' => $product]);
        }
    }

    public function delete() {
        AuthMiddleware::allowRoles(['admin']); // Apenas admin pode excluir
        $id = $_GET['id'];
        $this->productModel->deleteProduct($id);
        header("Location: index.php?controller=product&action=index");
    }
}