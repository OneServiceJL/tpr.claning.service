<?php
session_start();
require_once '../config/db.php';

// Check login status
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../login.php');
    exit();
}

// Check if reservation ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "Invalid reservation ID";
    header('Location: reservation.php');
    exit();
}

$reservation_id = (int)$_GET['id'];

// Delete the reservation
$sql = "DELETE FROM reservations WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $reservation_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Reservation deleted successfully!";
} else {
    $_SESSION['error'] = "Error deleting reservation";
}

// Redirect back to reservations page
header('Location: reservation.php');
exit();
