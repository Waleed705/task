<?php
include 'config.php';
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "1st";
    private $conn;

    public function __construct() {
        $this->connect();
        $this->createTable();
    }

    // Create connection
    private function connect() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die(json_encode(array('status' => 'error', 'message' => 'Connection failed: ' . $this->conn->connect_error)));
        }
    }

    // Create table if not exists
    private function createTable() {
        $table = "CREATE TABLE IF NOT EXISTS task(
            id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            fname VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL UNIQUE,
            mpassword VARCHAR(255) NOT NULL
        )";

        if (!$this->conn->query($table)) {
            echo json_encode(array('status' => 'error', 'message' => 'Table not created: ' . $this->conn->error));
            die();
        }
    }

    // Handle Signup
    public function handleSignup($data) {
        $error_message = array();

        // Validate name
        if (empty($data['name'])) {
            $error_message[] = "Name is required";
        } else {
            $name = $data['name'];
        }
        // Validate email
        if (empty($data['email'])) {
            $error_message[] = "Email is required";
        } else {
            $email = $data['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_message[] = "Please insert a valid Email.";
            }
        }

        // Validate password
        if (empty($data['password'])) {
            $error_message[] = "Password is required";
        } else {
            $password = $data['password'];
        }

        // Check if email already exists
        $check = $this->conn->prepare("SELECT * FROM task WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $error_message[] = "Email is already taken.";
        }

        // Return errors if any
        if (!empty($error_message)) {
            echo json_encode(array('status' => 'error', 'messages' => $error_message));
            die();
        }

        // Insert user
        $stmt = $this->conn->prepare("INSERT INTO task (fname, email, mpassword) VALUES (?, ?, ?)");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            $response = array('status' => 'success', 'url' => HOME_URL . '/template/login.php');
            echo json_encode($response);
            die();
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Registration failed: ' . $stmt->error));
        }
    }

    // Handle Login
    public function handleLogin($data) {
        $error_message = array();

        // Validate email
        if (empty($data['email'])) {
            $error_message[] = "Email is required";
        } else {
            $email = $data['email'];
        }

        // Validate password
        if (empty($data['password'])) {
            $error_message[] = "Password is required";
        } else {
            $password = $data['password'];
        }

        if (!empty($error_message)) {
            print_r(json_encode($error_message));
            die();
        }

        // Prepare the SQL query
        $stmt = $this->conn->prepare("SELECT * FROM task WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['mpassword'])) {
                $response = array('status' => 'success', 'url' => 'https://www.wp-sqr.com/');
                print_r(json_encode($response));
            } else {
                echo json_encode("Invalid password");
            }
        } else {
            echo json_encode("Invalid email");
        }

        die();
    }
}

// Instantiate the Database class
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    if (is_array($data) && isset($data['form'])) {
        if ($data['form'] == 'signup') {
            $db->handleSignup($data);
        } elseif ($data['form'] == 'login') {
            $db->handleLogin($data);
        }
    }
}

?>
