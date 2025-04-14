<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Flash message helper
 * Usage:
 *  - Set a message: flash('register_success', 'You are now registered', 'alert-success');
 *  - Display message: flash('register_success');
 */
function flash($name = '', $message = '', $class = 'alert alert-success') {
    if (!empty($name)) {
        if (!empty($message)) {
            // Set flash message
            $_SESSION[$name] = '<div class="'.$class.'">'.$message.'</div>';
        } elseif (!empty($_SESSION[$name])) {
            // Display flash message
            echo $_SESSION[$name];
            unset($_SESSION[$name]); // Remove message after displaying
        }
    }
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Redirect helper
 */
// function redirect($location) {
//     header("Location: " . URLROOT . '/' . $location);
//     exit();
// }
