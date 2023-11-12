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


    <!-- LOG IN FORM -->
    <section class="about-us">
        <h1 class="header-text hidden-slide">Login In Your Account</h1>
        <div class="about">
            <div class="about-flex">
                <form action="../authscript/loginscript.php" method='post'>
                    <?php if(isset($_GET['error'])){ ?>
                    <p class='error'><?php  echo $_GET['error']; ?></p>
                    <?php }   ?>
                    <input type="text" placeholder="Email address" name='email'>
                    <input type="password" placeholder="Enter password" name='passcode'>
                    <div class="check-box">
                        <input type="checkbox" name="" id=""> Remember me
                    </div>
                    <button name='submit' type='submit'>Submit</button>
                </form>
            </div>
            <div class="about-img img-display-none none-display">
                <img src="../images/bg-girl3.png" class="img-bg" alt="">
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