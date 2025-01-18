<?php

namespace Models;

use Core\Model;

class Request extends Model {
    public function createRequest($productId, $userId) {
        $sql = "INSERT INTO requests (product_id, user_id) VALUES (:product_id, :user_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':product_id' => $productId,
            ':user_id' => $userId,
        ]);
        return $this->db->lastInsertId();
    }

    public function getRequestsByStatus($status) {
        $sql = "SELECT r.id, p.name AS product_name, u.name AS user_name, r.status, r.created_at
                FROM requests r
                JOIN products p ON r.product_id = p.id
                JOIN users u ON r.user_id = u.id
                WHERE r.status = :status";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':status' => $status]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateRequestStatus($id, $status) {
        $sql = "UPDATE requests SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':status' => $status,
        ]);
    }

    public function countRequestsByStatus($status) {
        $allowedStatuses = ['pending', 'accepted', 'rejected'];
        if (!in_array($status, $allowedStatuses)) {
            throw new \InvalidArgumentException('Status inválido');
        }
    
        $sql = "SELECT COUNT(*) AS total FROM requests WHERE status = :status";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':status', $status, \PDO::PARAM_STR);
        $stmt->execute();
        return (int)$stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }
    
    
    public function getMonthlyReportData() {
        $sql = "SELECT 
                    DATE_FORMAT(created_at, '%Y-%m') AS month,
                    status,
                    COUNT(*) AS total
                FROM requests
                GROUP BY DATE_FORMAT(created_at, '%Y-%m'), status
                ORDER BY month ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
}