<?php
session_start();

// Check if user is logged in
function checkLogin()
{
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: login.php');
        exit();
    }
}

// Only show dashboard if logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    $dashboard = true;
} else {
    $dashboard = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPR Amdin Panel </title>
    <!-- Add favicon/logo for the title bar -->
    <link rel="icon" type="image/png" href="../img/Logo.png">
    <link rel="shortcut icon" type="image/png" href="../img/Logo.png">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    <?php if ($dashboard): ?>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading bg-dark text-white p-3">Admin Panel</div>
                <div class="list-group list-group-flush">
                    <a href="index.php" class="list-group-item list-group-item-action <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <a href="pages/post.php" class="list-group-item list-group-item-action <?php echo basename($_SERVER['PHP_SELF']) == 'pages/post.php' ? 'active' : ''; ?>">
                        <i class="fas fa-calendar-alt me-2"></i>Post
                    </a>
                    <a href="pages/services.php" class="list-group-item list-group-item-action <?php echo basename($_SERVER['PHP_SELF']) == 'pages/services.php' ? 'active' : ''; ?>">
                        <i class="fas fa-broom me-2"></i>Services
                    </a>
                    <a href="pages/reservation.php" class="list-group-item list-group-item-action <?php echo basename($_SERVER['PHP_SELF']) == 'pages/reservation.php' ? 'active' : ''; ?>">
                        <i class="fas fa-users me-2"></i>Reservations
                    </a>
                    <a href="pages/settings.php" class="list-group-item list-group-item-action <?php echo basename($_SERVER['PHP_SELF']) == 'pages/settings.php' ? 'active' : ''; ?>">
                        <i class="fas fa-cog me-2"></i>Settings
                    </a>
                </div>
            </div>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <button class="btn btn-light border" id="sidebarToggle">
                            <i class="fas fa-bars text-dark"></i>
                        </button>
                        <div class="ms-auto">
                            <a href="logout.php" class="btn btn-outline-light">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </div>
                    </div>
                </nav>

                <div class="container-fluid p-4">
                    <h2>Welcome to Admin Dashboard</h2>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Bookings</h5>
                                    <p class="card-text display-4">0</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Users</h5>
                                    <p class="card-text display-4">0</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Services</h5>
                                    <p class="card-text display-4">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container mt-5">
            <div class="alert alert-danger text-center" role="alert">
                <?php if (isset($_SESSION['error'])): ?>
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                <?php else: ?>
                    Please log in to access the admin panel.
                <?php endif; ?>
            </div>
            <div class="text-center mb-3">
                <a href="../index.php" class="btn btn-secondary">
                    <i class="fas fa-home me-2"></i>Return to Homepage
                </a>
            </div>
            <div class="container mt-5">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="text-center">Admin Login</h3>
                                </div>
                                <div class="card-body">
                                    <form action="login.php" method="POST">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <script src="assets/js/script.js"></script>
            <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>