<?php
// URL Helper - Contains functions for URL handling

/**
 * Redirect to a specific page.
 *
 * @param string $page The page to redirect to.
 */
function redirect($page) {
    header("Location: " . URLROOT . '/' . $page);
    exit();
}

/**
 * Get the base URL for assets (CSS, JS, Images).
 *
 * @param string $path Optional path to append.
 * @return string
 */
function asset_url($path = '') {
    return URLROOT . '/public/' . $path;
}

/**
 * Get the current URL.
 *
 * @return string
 */
function current_url() {
    return "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
