<?php
session_start();
require_once '../config/db.php';

// Check login status
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../login.php');
    exit();
}

// Handle user management
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_user'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $role = $_POST['role'];

        $sql = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $password, $email, $role);

        if ($stmt->execute()) {
            $_SESSION['success'] = "User added successfully!";
        } else {
            $_SESSION['error'] = "Error adding user";
        }
    }
}

// Fetch all users
$sql = "SELECT * FROM users ORDER BY created_at DESC";
$users = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Admin Dashboard</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <?php include '../includes/sidebar.php'; ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?php include '../includes/navbar.php'; ?>

            <div class="container-fluid px-4">
                <h2 class="mt-4">Settings</h2>

                <!-- Success/Error Messages -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['success'];
                        unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <!-- Analytics Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-line me-1"></i> Website Analytics
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <canvas id="visitsChart"></canvas>
                            </div>
                            <div class="col-md-6">
                                <canvas id="usersChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Management Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-users me-1"></i> User Management
                    </div>
                    <div class="card-body">
                        <!-- Add User Form -->
                        <form method="POST" class="mb-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="col-md-2">
                                    <select name="role" class="form-select" required>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="add_user" class="btn btn-primary w-100">Add User</button>
                                </div>
                            </div>
                        </form>

                        <!-- Users Table -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($user = $users->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                                        <td><?php echo $user['created_at']; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" onclick="editUser(<?php echo $user['id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteUser(<?php echo $user['id']; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample analytics data - Replace with real Google Analytics data
        const visitsData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Website Visits',
                data: [1200, 1900, 3000, 5000, 4000, 3000],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        const usersData = {
            labels: ['Active Users', 'Inactive Users'],
            datasets: [{
                data: [300, 50],
                backgroundColor: ['rgb(54, 162, 235)', 'rgb(255, 99, 132)']
            }]
        };

        // Create charts
        const visitsChart = new Chart(
            document.getElementById('visitsChart'), {
                type: 'line',
                data: visitsData,
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Monthly Website Visits'
                        }
                    }
                }
            }
        );

        const usersChart = new Chart(
            document.getElementById('usersChart'), {
                type: 'doughnut',
                data: usersData,
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'User Statistics'
                        }
                    }
                }
            }
        );

        // User management functions
        function editUser(userId) {
            // Implement edit user functionality
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                window.location.href = `delete_user.php?id=${userId}`;
            }
        }
    </script>
</body>

</html>