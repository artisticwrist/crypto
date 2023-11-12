<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../connect/connect.php';

if(isset($_POST['submit'])){
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $pass=$_POST['passcode'];
    $mobile=$_POST['mobile'];
    $country=$_POST['country'];
    $gender=$_POST['gender'];


    $checkUser = "SELECT * from `users` where email='$email'";
    $result=mysqli_query($con,$checkUser);
    $count = mysqli_num_rows($result);


    if($count>0){
        header("Location: signup.php?error=User already exist");
    }else{
        $sql="insert into `users` (firstname,lastname,email,passcode,mobile,country,gender)
        values('$firstname','$lastname','$email','$pass','$mobile','$country','$gender')";
        if($con->query($sql)){
        echo "<script>alert('Sign up successful. Please login with your details.');</script>";
        echo "<script>setTimeout(function(){window.location.href='../php/login.php'},500);</script>";
        }else{
            die(mysqli_error($con));
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/style.css'>
    <link rel="stylesheet" href="../css/animate.css">
    <style>
    nav {
        z-index: 999;
    }
    </style>
</head>

<body>
    <!-- NAVIGATION BAR -->
    <?php
        include '../php/components/nav.php';
    ?>

    <!-- SIGN UP-->
    <section class="about-us">
        <h1 class="header-text hidden-slide">Get An Account Today</h1>
        <div class="about">
            <div class="about-img img-display-none  none-display">
                <img src="../images/bg-girl2.png" class="img-bg" alt="">
            </div>
            <div class="about-flex">
                <form method='post'>
                    <?php if(isset($_GET['error'])){ ?>
                    <p class='error'><?php  echo $_GET['error']; ?></p>
                    <?php } ?>
                    <input type="text" placeholder="Email address" name='email'>
                    <input type="text" placeholder="First Name" name='firstname'>
                    <input type="text" placeholder="Last Name" name='lastname'>
                    <input type="number" name="mobile" placeholder="mobile number">
                    <select name="country" id="">
                        <option value="libya">Libya</option>
                        <option value="us">US</option>
                        <option value="ukraine">UKRAINE</option>
                    </select>
                    <select name="gender" id="">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="non-binary">Non binary</option>
                        <option value="others">Others</option>
                    </select>

                    <input type="password" placeholder="Enter password" name='passcode'>
                    <button name='submit' type='submit'>Submit</button>
                </form>
            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <?php
        include '../php/components/footer.php';
    ?>
    <script src="../js/animate.js"></script>
</body>

</html>