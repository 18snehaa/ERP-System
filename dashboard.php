<?php
session_start();

// Protect dashboard: redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Include your existing dashboard HTML
include 'dashboard.html';
?>
