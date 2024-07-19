<?php
include('../config/database.php');

// Delete all users
if (isset($_POST['deleteall'])) {
    $sql = "TRUNCATE TABLE users";
    $deleted = $connection->query($sql);

    if (!$deleted) {
        die('Failed: ' . $connection->error);
    } else {
        $_SESSION['message'] = 'Users Table Deleted';
        header('Location: ../pages/settings.php');
        exit();
    }
}

// Delete all notepad
if (isset($_POST['deleteallnotepad'])) {
    $sql = "TRUNCATE TABLE notepad";
    $deleted = $connection->query($sql);

    if (!$deleted) {
        die('Failed: ' . $connection->error);
    } else {
        $_SESSION['message'] = 'Notepad Table Deleted';
        header('Location: ../pages/settings.php');
        exit();
    }
}

// Pages update hide/show
if(isset($_POST['pagesupdate']))
{
    $id= $_POST['id'];
    $status= $_POST['status'];
    
    $sql="UPDATE settings set status='$status' where id=$id ";
    $result= $connection->query($sql);
    $_SESSION['pagemessage']="Section Pages Updated";
    header('Location: ../pages/settings.php');
}

//Content update
if(isset($_POST['updatecontent']))
{
    $id= $_POST['id'];
    $value= $_POST['value'];
    $sql="UPDATE settings set value= '$value' where id=$id ";
    $result= $connection->query($sql);
    $_SESSION['contentmessage']="Content Updated";
    header('Location: ../pages/settings.php');
}

?>