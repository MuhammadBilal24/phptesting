<?php
include('../config/database.php');
// include('../middleware.php');

// Insert
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registerbtn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = '';
    $status = 0;
    $date = date('Y-m-d H:i:s'); 

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = $connection->query($checkEmailQuery);

    if ($checkEmailResult->num_rows > 0) {
        $_SESSION['message'] = 'Email already registered.';
        header('Location: ../auth/register.php');
        exit();
    } else {
        // Insert query
        $sql = "INSERT INTO users (name, email, password, role, status, created_at) VALUES ('$name', '$email', '$password', '$role', '$status', '$date')";
        $inserted = $connection->query($sql);

        if (!$inserted) {
            die('Failed: ' . $connection->error);
        } else {
            $_SESSION['message'] = 'Account Registered Successfully';
            header('Location: ../auth/register.php');
            exit();
        }
    }
}

?>

