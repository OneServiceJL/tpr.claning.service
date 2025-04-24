<?php
session_start();

// Set your admin credentials
$admin_username = 'admin';
$admin_password = 'admin123'; // Change this to a secure password

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error'] = 'Invalid credentials';
        header('Location: index.php');
        exit();
    }
}
