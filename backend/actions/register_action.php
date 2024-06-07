<!-- // backend/actions/register_action.php -->
<?php
include '../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $user->role = $_POST['role'];

    if ($user->register()) {
        header('Location: ../../views/login.php');
    } else {
        echo "Error: Could not register user.";
    }
}
?>
