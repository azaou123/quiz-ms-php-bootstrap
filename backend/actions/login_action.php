<!-- // backend/actions/login_action.php -->
<?php
include '../classes/User.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if ($user->login()) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['role'] = $user->role;
        header('Location: ../../views/html/');
    } else {
        echo "Invalid username or password.";
    }
}
?>
