<?php
session_start();

include("db_conection.php");

if(isset($_POST['register']))
{
    $user_email = $_POST['ruser_email'];
    $user_password = $_POST['ruser_password'];
    $user_firstname = $_POST['ruser_firstname'];
    $user_lastname = $_POST['ruser_lastname'];
    $user_contactnum = $_POST['ruser_contactnumber'];
    $user_address = $_POST['ruser_address'];
    $user_region = $_POST['ruser_region'];
    $user_city = $_POST['ruser_city'];
    $user_payment =$_POST['ruser_payment'];


    //Check if the Ref Number has exactly 13 digits
    if(strlen($user_payment) !== 13 || !is_numeric($user_payment))
    {
        echo "<script>alert('Contact number must have exactly 11 numeric digits!')</script>";
        echo "<script>window.open('index.php','_self')</script>";
        exit();
    }
   
    // Check if the contact number has exactly 11 digits
    if(strlen($user_contactnum) !== 11 || !is_numeric($user_contactnum))
    {
        echo "<script>alert('Contact number must have exactly 11 numeric digits!')</script>";
        echo "<script>window.open('index.php','_self')</script>";
        exit();
    }

    $check_user = "SELECT * FROM users WHERE user_email='$user_email'";
    $run_query = mysqli_query($dbcon, $check_user);

    if(mysqli_num_rows($run_query) > 0)
    {
        echo "<script>alert('Customer is already exist, Please try another one!')</script>";
        echo "<script>window.open('index.php','_self')</script>";
        exit();
    }

    $saveaccount = "INSERT INTO users (user_email, user_password, user_firstname, user_contactnumber, user_lastname, user_address, user_region, user_city, user_payment) VALUES ('$user_email', '$user_password', '$user_firstname', '$user_contactnum', '$user_lastname', '$user_address', '$user_region', '$user_city', '$user_payment')";
    
    if(mysqli_query($dbcon, $saveaccount))
    {
        echo "<script>alert('Data successfully saved, You may now login!')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
    else
    {
        echo "<script>alert('Error saving data!')</script>";
    }
}
?>
