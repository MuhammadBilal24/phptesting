<?php
include('../config/database.php');

// Data get for table
$data= "SELECT * FROM notepad";
$notepad=$connection->query($data);

// Insert
if($_SERVER['REQUEST_METHOD']=== 'POST' && isset($_POST['insert']))
{
    $task =  $_POST['task'];
    $status= $_POST['status'];
    $sql= "INSERT INTO notepad (task , status) values('$task','$status')";
    $result= $connection->query($sql);
    if($result)
    {
        $_SESSION['message']='Task Added';
        header('Location: ../pages/notepad.php');
    }
}
// Insert Ends

// data get for edit modal
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM notepad WHERE id = '$id'";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
   
}

// update task
if(isset($_POST['updatetask']))
{
    $id = $_POST['id'];
    $task = $_POST['task'];
    $status = $_POST['status'];
    $sql= "UPDATE notepad set task = '$task', status = '$status' where id = $id";
    $result = $connection->query($sql);
    if($result)
    {
        $_SESSION['message']='Task Updated';
        header('Location: ../pages/notepad.php');
        exit;
    }
}
// update task Ends

// single Task Deleted
if(isset($_GET['taskid']))
{
    $id=$_GET['taskid'];
    $sql= "DELETE FROM notepad where id=$id";
    $result = $connection->query($sql);
    if($result)
    {
        $_SESSION['message']='Task Delete';
        header('Location: ../pages/notepad.php'); 
    }
}
// Task Deleted End

// Task Deleted all
if(isset($_GET['deleteall']))
{
    $sql="TRUNCATE TABLE notepad";
    $result=$connection->query($sql);
    if($result)
    {
        $_SESSION['message']='Tasks All Deleted';
        header('Location: ../pages/notepad.php');
    }
}
?>