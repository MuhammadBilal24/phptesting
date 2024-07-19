<?php
include('../config/database.php');

// Remaining Tasks
$status = 5;
$data= "SELECT * FROM notepad where status !='$status'";
$taskdata=$connection->query($data);


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
        header('Location: ../pages/dashboard');
    }
}
// Insert Ends

// Task Update
if(isset($_POST['checked']))
{
    $id = $_POST['id'];
    $status = $_POST['status'];
    $sql= "UPDATE notepad set status= $status where id = $id";
    $result = $connection->query($sql);
    if($result)
    {
        $_SESSION['message']='Task Completed';
        header('Location: ../pages/dashboard');
        exit;
    }
}
// Task Update Ends

// Task Deleted
if(isset($_GET['statusid']))
{
    $id=$_GET['statusid'];
    $sql= "DELETE FROM notepad where id=$id";
    $result = $connection->query($sql);
    if($result)
    {
        $_SESSION['message']='Task Delete';
        header('Location: ../pages/dashboard'); 
    }
}
// Task Deleted End
if(isset($_GET['Alldeleted']))
{
    $sql="TRUNCATE TABLE notepad";
    $result=$connection->query($sql);
    if($result)
    {
        $_SESSION['message']='Tasks All Deleted';
        header('Location: ../pages/dashboard');
    }
}

?>