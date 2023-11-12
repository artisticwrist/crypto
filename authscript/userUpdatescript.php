<?php
// Start the session
session_start();

// Include the database connection
include '../connect/connect.php';

// Get the current user's email from the session
$currentUser = $_SESSION['email'];

// Check if the form was submitted
if(isset($_POST['submit'])) {
    // Get the updated details from the form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $mobile = $_POST['mobile'];
    $passcode = $_POST['passcode'];

    // Update the user's details in the database
    $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', country='$country', mobile='$mobile', passcode='$passcode' WHERE email='$currentUser'";
    // $result = mysqli_query($con, $sql);
    if(mysqli_query($con, $sql)){
        echo "<script>alert('Update Successful. Login again !');</script>";
        echo "<script>setTimeout(function(){window.location.href='../php/login.php'},1000);</script>";
    }else{
        echo "<script>alert('Error updating record: ' . mysqli_error($con));</script>";
    }
}
mysqli_close($con);
?>
