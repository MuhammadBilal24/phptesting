<?php
include('../config/database.php');

// Fetch all users
$sql = 'SELECT * FROM users';
$userdata = $connection->query($sql);

// insert user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    $status = 0;
    $date = date('Y-m-d H:i:s'); 

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = $connection->query($checkEmailQuery);

    if ($checkEmailResult->num_rows > 0) {
        $_SESSION['message'] = 'Email already registered.';
        header('Location: ../pages/users.php');
        exit();
    } else {
        // Insert query
        $sql = "INSERT INTO users (name, email, password, role, status, created_at) VALUES ('$name', '$email', '$password', '$role', '$status', '$date')";
        $inserted = $connection->query($sql);

        if (!$inserted) {
            die('Failed: ' . $connection->error);
        } else {
            $_SESSION['message'] = 'Account Registered Successfully';
            header('Location: ../pages/users.php');
            exit();
        }
    }
}


// Delete All
if (isset($_POST['deleteall'])) {
    $sql = "TRUNCATE TABLE users";
    $deleted = $connection->query($sql);

    if (!$deleted) {
        die('Failed: ' . $connection->error);
    } else {
        $_SESSION['message'] = 'All Users Accounts Deleted Permanently';
        header('Location: ../pages/users.php');
        exit();
    }
}

// Fetch user by ID for editing
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
   
}

// Update user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $status = $_POST['status']; // Ensure status is properly set
  $date = date('Y-m-d H:i:s'); // Use correct format for MySQL datetime
  // Update query
  $sql = "UPDATE users SET name='$name', email='$email', role='$role', status='$status', created_at='$date' WHERE id=$id";

  if ($connection->query($sql) === TRUE) {
      $_SESSION['message'] = 'User Account Updated Successfully';
      header('Location: ../pages/users.php');
  } else {
      die('Error updating user: ' . $connection->error);
      header('Location: ../pages/users.php');

  }
}
// Update Ends

// Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletebtn'])) {
    $id = $_POST['id'];

    // Delete query
    $sql = "DELETE FROM users WHERE id=$id";

    // Execute the query
    if ($connection->query($sql) === TRUE) {
        $_SESSION['message'] = 'User deleted successfully';
    } else {
        die('Error deleting user: ' . $connection->error);
    }

    // Redirect to the users.php page after deletion
    header('Location: ../pages/users.php');
    exit();
}

?>

