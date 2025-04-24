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
        <a href="pages/users.php" class="list-group-item list-group-item-action <?php echo basename($_SERVER['PHP_SELF']) == 'pages/users.php' ? 'active' : ''; ?>">
            <i class="fas fa-users me-2"></i>Users
        </a>
        <a href="pages/settings.php" class="list-group-item list-group-item-action <?php echo basename($_SERVER['PHP_SELF']) == 'pages/settings.php' ? 'active' : ''; ?>">
            <i class="fas fa-cog me-2"></i>Settings
        </a>
    </div>
</div>