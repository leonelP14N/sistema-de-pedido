<?php

/* namespace Controllers; */

use Core\Controller;
use Middlewares\AuthMiddleware;
use Models\Request;

class DashboardController extends Controller
{
    private $requestModel;

    public function __construct()
    {
        $this->requestModel = new Request();
    }

    public function index()
    {
        $pendingCount = $this->requestModel->countRequestsByStatus('pending');
        $acceptedCount = $this->requestModel->countRequestsByStatus('accepted');
        $rejectedCount = $this->requestModel->countRequestsByStatus('rejected');
        AuthMiddleware::isAuthenticated();
        $this->render('dashboard/index', [
            'title' => 'Painel de Controle',
            'pendingCount' => $pendingCount,
            'acceptedCount' => $acceptedCount,
            'rejectedCount' => $rejectedCount
        ]);
    }
}
