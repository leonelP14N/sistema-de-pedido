<?php
/* 
namespace Controllers;
*/
use Core\Controller; 

class HomeController extends Controller
{
    public function index()
    {
        $this->render('home/index', [
            'title' => 'Página Inicial',
            'welcomeMessage' => 'Bem-vindo ao Sistema Completo!'
        ]);
    }
}
