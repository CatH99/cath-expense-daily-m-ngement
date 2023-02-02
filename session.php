<?php
include('config.php');

$user_check=$_SESSION['login_user'];
$ses_sql=mysqli_query($conn,"SELECT ID, name, username, email FROM user WHERE username = '$user_check'");
$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$username=$row['username'];
$useremail=$row['email'];
$userid=$row['ID'];
$name=$row['name'];
if(!isset($_SESSION['login_user'])){
    header("location:login.php");
    die();
}
?>