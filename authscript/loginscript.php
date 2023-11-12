<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "../connect/connect.php";
if (isset($_POST['email']) && isset($_POST['passcode'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['passcode']);

    if (empty($email)) {
        header("Location: login.php?error=User name is required");
        exit();
    }else if(empty($pass)){
        header("Location: login.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE email='$email' AND passcode='$pass'";

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['passcode'] === $pass) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['passcode'] = $row['passcode'];
                header("Location: ../php/user.php");
                exit();
            }else{
                header("Location: ../php/login.php?error=Incorrect Email or Password");
                exit();
            }

        }else{
            header("Location:  ../php/login.php?error=Incorrect Email or Password");
            exit();
        }
    }

}else{
    header("Location:  ../php/login.php");
    exit();
}

?>