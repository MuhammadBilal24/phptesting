<?php
session_start();

$servername="localhost";
$username="root";
$password="";
$dbname="phptesting";

$connection= new mysqli($servername, $username, $password, $dbname);

if($connection->connect_error)
{
    die("Connection Failed:" .$connection->connect_error);
}
?>