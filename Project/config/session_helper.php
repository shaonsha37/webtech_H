<?php
/**
 * Session Helper Functions
 * Provides robust session handling for AMPPS/Windows environment
 */

function safe_session_start() {
    if (session_status() == PHP_SESSION_NONE) {
        // Disable warnings temporarily
        $old_error_reporting = error_reporting();
        error_reporting(E_ALL & ~E_WARNING);
        
        // Try to start session
        if (!@session_start()) {
            // Try with system temp directory
            ini_set('session.save_path', sys_get_temp_dir());
            if (!@session_start()) {
                // Last resort: try with empty path
                ini_set('session.save_path', '');
                @session_start();
            }
        }
        
        // Restore error reporting
        error_reporting($old_error_reporting);
    }
}

function safe_session_write_close() {
    if (session_status() == PHP_SESSION_ACTIVE) {
        @session_write_close();
    }
}

function safe_session_destroy() {
    if (session_status() == PHP_SESSION_ACTIVE) {
        @session_destroy();
    }
}

function is_user_logged_in() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function require_login() {
    if (!is_user_logged_in()) {
        $_SESSION['error'] = "Please login to access this page.";
        header("Location: index.php?page=user&action=login");
        exit();
    }
}

function get_user_id() {
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}

function get_user_name() {
    return isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
}
?> 