<?php
session_start();
require_once '../config/db.php';

// Check login status
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../login.php');
    exit();
}

// Check if post ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "Invalid post ID";
    header('Location: post.php');
    exit();
}

$post_id = (int)$_GET['id'];

// Get image path before deleting the post
$sql = "SELECT image_path FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $image_path = "../" . $row['image_path'];

    // Delete the post from database
    $delete_sql = "DELETE FROM posts WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $post_id);

    if ($delete_stmt->execute()) {
        // Delete the associated image file
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $_SESSION['success'] = "Post deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting post";
    }
} else {
    $_SESSION['error'] = "Post not found";
}

// Redirect back to posts page
header('Location: post.php');
exit();
