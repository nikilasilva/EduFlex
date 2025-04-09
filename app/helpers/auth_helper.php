<?php

function checkRole($requiredRole) {
    // Start session if it hasn't been started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['user'])) {
        header("Location: " . URLROOT . "/Login/index");
        exit();
    }
    
    // If user doesn't have the required role
    if ($_SESSION['user']['role'] !== $requiredRole) {
        http_response_code(403);
        require_once '../app/views/inc/ErrorPages/403.php';
        exit();
    }
}

// You might also want a function to check multiple allowed roles
function checkRoles($allowedRoles) {
    // Start session if it hasn't been started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // If user is not logged in
    if (!isset($_SESSION['user'])) {
        header("Location: " . URLROOT . "/Login/index");
        exit();
    }
    
    // If user's role is not in the allowed roles array
    if (!in_array($_SESSION['user']['role'], $allowedRoles)) {
        http_response_code(403);
        require_once '../app/views/inc/ErrorPages/403.php';
        exit();
    }
}
?>