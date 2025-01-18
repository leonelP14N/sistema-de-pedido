<?php

require_once '../middlewares/AuthMiddleware.php';

//namespace Controllers;

use Core\Controller;
use Models\Request;
use Middlewares\AuthMiddleware;

class RequestController extends Controller {
    private $requestModel;

    public function __construct() {
        $this->requestModel = new Request();
        AuthMiddleware::allowRoles(['admin', 'editor', 'viewer']);
    }

    public function index() {
        $requests = $this->requestModel->getRequestsByStatus('pending');
        $this->render('requests/index', ['requests' => $requests]);
    }

    public function accept() {
        AuthMiddleware::allowRoles(['admin', 'editor']);
        $id = $_GET['id'];
        $this->requestModel->updateRequestStatus($id, 'accepted');
        header("Location: index.php?controller=request&action=index");
    }

    public function reject() {
        AuthMiddleware::allowRoles(['admin', 'editor']);
        $id = $_GET['id'];
        $this->requestModel->updateRequestStatus($id, 'rejected');
        header("Location: index.php?controller=request&action=index");
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            $userId = $_SESSION['user']['id'];
            $this->requestModel->createRequest($productId, $userId);
            header("Location: index.php?controller=request&action=index");
        }
    }
    //Exportar dados da tabela em csv
    public function exportCSV() {
        $requests = $this->requestModel->getRequestsByStatus('pending');
    
        // Definir cabeçalhos HTTP
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="solicitacoes.csv"');
    
        // Criar o arquivo CSV
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Produto', 'Usuário', 'Status', 'Data']);
    
        foreach ($requests as $request) {
            fputcsv($output, [
                $request['id'],
                $request['product_name'],
                $request['user_name'],
                $request['status'],
                $request['created_at']
            ]);
        }
    
        fclose($output);
        exit;
    }

    //Exportar dados da tabela
    public function exportPDF() {
        $requests = $this->requestModel->getRequestsByStatus('pending');
    
        // Incluir TCPDF
        require_once './libs/tcpdf/tcpdf.php';
    
        // Criar instância do PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema');
        $pdf->SetTitle('Solicitações');
        $pdf->SetHeaderData('', '', 'Lista de Solicitações', '');
    
        $pdf->setHeaderFont(['helvetica', '', 12]);
        $pdf->setFooterFont(['helvetica', '', 10]);
        $pdf->SetMargins(15, 27, 15);
        $pdf->SetAutoPageBreak(TRUE, 25);
    
        $pdf->AddPage();
    
        // Conteúdo do PDF
        $html = '<h1>Lista de Solicitações</h1>';
        $html .= '<table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Usuário</th>
                            <th>Status</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>';
    
        foreach ($requests as $request) {
            $html .= '<tr>
                        <td>' . $request['id'] . '</td>
                        <td>' . $request['product_name'] . '</td>
                        <td>' . $request['user_name'] . '</td>
                        <td>' . ucfirst($request['status']) . '</td>
                        <td>' . $request['created_at'] . '</td>
                      </tr>';
        }
    
        $html .= '</tbody></table>';
    
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('solicitacoes.pdf', 'D');
        exit;
    }
    
    public function statistics() {
        try {
            $pending = $this->requestModel->countRequestsByStatus('pending');
            $accepted = $this->requestModel->countRequestsByStatus('accepted');
            $rejected = $this->requestModel->countRequestsByStatus('rejected');
    
            $this->render('requests/statistics', [
                'pending' => (int)$pending,
                'accepted' => (int)$accepted,
                'rejected' => (int)$rejected,
            ]);
        } catch (\Exception $e) {
            // Log do erro e redirecionamento
            error_log($e->getMessage());
            header('Location: /?controller=request&action=index&error=database');
        }
    }
    

    public function detailedReport() {
        // Obter todas as solicitações, agrupadas por status e mês
        $reportData = $this->requestModel->getMonthlyReportData();
    
        // Passar os dados para a view
        $this->render('requests/detailed_report', ['reportData' => $reportData]);
    }
    
    
}