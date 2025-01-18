<?php

namespace Middlewares;

class AuthMiddleware {
    public static function allowRoles(array $roles) {
        session_start();

        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        $userRole = $_SESSION['user']['role'];
        if (!in_array($userRole, $roles)) {
            header("Location: index.php?controller=home");
            exit;
        }
    }
    public static function checkAccess($requiredRole) {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== $requiredRole) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
    }
}
