<?php
require_once 'admin/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $service_type = $_POST['service_type'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $address = $_POST['address'];

    $sql = "INSERT INTO reservations (name, email, phone, service_type, reservation_date, reservation_time, address) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $name, $email, $phone, $service_type, $reservation_date, $reservation_time, $address);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Reservation submitted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error submitting reservation']);
    }
    exit();
}
