<?php
if(isset($_SESSION['is_user_loggedin']))
{
    return true;
}
else
{
    header("Location: ../login.php");
}
?>