<?php
include('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $status = $_POST['status']; // Ensure status is properly set
    $date = date('Y-m-d H:i:s'); // Use correct format for MySQL datetime
    
    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = $_FILES['image']['type'];
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        
        // Validate image file
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($imageExtension, $allowedExtensions)) {
            $uploadDir = '../assets/';
            $newImageName = uniqid('img_', true) . '.' . $imageExtension;
            $imagePath = $uploadDir . $newImageName;
            
            if (move_uploaded_file($imageTmpPath, $imagePath)) {
                // Image upload successful
                $imagePathForDB = 'assets/' . $newImageName;
                
                // Update query with image path
                $sql = "UPDATE users SET name='$name', email='$email', role='$role', status='$status', created_at='$date', image='$imagePathForDB' WHERE id=$id";
            } else {
                die('Error uploading image');
            }
        } else {
            die('Invalid image file type');
        }
    } else {
        // Update query without image path
        $sql = "UPDATE users SET name='$name', email='$email', role='$role', status='$status', created_at='$date' WHERE id=$id";
    }
  
    if ($connection->query($sql) === TRUE) {
        $_SESSION['message'] = 'User Account Updated Successfully';
        header('Location: ../pages/profile.php');
        exit();
    } else {
        die('Error updating user: ' . $connection->error);
        header('Location: ../pages/profile.php');
        exit();
    }
}
?>


