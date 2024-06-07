<!-- // view/dashboard.php -->
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "! You are logged in as " . htmlspecialchars($_SESSION['role']) . ".";
echo '<br><a href="../backend/actions/logout_action.php">Logout</a>';
?>
