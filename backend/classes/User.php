<!-- // backend/classes/User.php -->
<?php
include_once '../../envirement/config.php';

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;
    public $role;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register() {
        $query = "INSERT INTO " . $this->table_name . " (username, password, role) VALUES (:username, :password, :role)";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        $this->role = htmlspecialchars(strip_tags($this->role));

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login() {
        $query = "SELECT id, username, password, role FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $stmt->bindParam(':username', $this->username);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['password'])) {
            $this->id = $user['id'];
            $this->role = $user['role'];
            return true;
        }
        return false;
    }

    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public static function logout() {
        session_start();
        session_destroy();
        header('Location: ../../view/login.php');
        exit();
    }
}
?>
