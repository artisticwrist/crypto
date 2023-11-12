<?php
include 'connect/connect.php';

if(isset($_POST['submit'])){
    $message=$_POST['message'];
    $email=$_POST['email'];

    $sql="insert into `contactMessage` (email,message)
    values('$email','$message')";
    if($con->query($sql)){
        header('Location:contact.php?success= message sent successfully');
    }else{
        die(mysqli_error($con));
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
    <?php
        include '../php/components/nav.php';
    ?>

    <!-- CONTACT US -->
    <section class="about-us">
        <h1 class="header-text hidden-slide">Contact Wincoin.com</h1>
        <div class="about">
            <div class="about-flex">
                <form method='post'>
                    <input type="text" placeholder="Email" name='email'>
                    <textarea name="" id="" cols="30" rows="10" name='message'>Type Message....</textarea>
                    <button name='submit' type='submit'>Submit</button>
                </form>
            </div>
            <div class="about-img">
                <img src="../images/bg-girl.png" class="none-display" alt="">
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