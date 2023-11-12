<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome to wincoin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/animate.css">
    <script src="https://www.cryptohopper.com/widgets/js/script"></script>
    <script src="https://cdn.jsdelivr.net/gh/coinponent/coinponent@1.2.6/dist/coinponent.js"></script>
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

    <!-- HOME PAGE -->
    <section class="home">
        <!-- HEADER HOME -->
        <header>
            <div class="head hidden">
                <h1>Buy your first Bitcoin today</h1>
                <p>Buy, sell, trade, and invest in Bitcoin & crypto - all in one safe and simple app.</p>
                <button><a href="">Sign up</a></button>
            </div>
            <img src="../images/bg-girl.png" class="img-bg hidden-slide" alt="">
        </header>

        <!-- WIDGET -->
        <div class="cryptohopper-web-widget" data-id="2" data-realtime="on"></div>

        <!-- SECTION BUY BTC -->
        <header class="buy_btc__section">
            <img src="../images/bg-girl.png" class="img-bg hidden" alt="">
            <div class="head">
                <h1 class="hidden-slide">Buy quickly and easily</h1>
                <p style="color: rgb(39,147,255);" class="hidden-slide"><b>Buy as little as $20 worth to get
                        started!</b></p>
                <p class="hidden-slide">Use your credit card, payment app, or bank account to buy Bitcoin and other
                    crypto</p>
                <button class="hidden-slide"><a href="../php/signup.php">Sign up</a></button>
            </div>
        </header>

        <!-- SECTION BUY BTC -->
        <header class="buy_btc__section colomn-reverse">
            <div class="head">
                <h1 class="hidden-slide">About Wincoin</h1>
                <p style="color: rgb(39,147,255);" class="hidden-slide"><b>Buy as little as $20 worth to get
                        started!</b></p>
                <p class="hidden-slide">Use your credit card, payment app, or bank account to buy Bitcoin and other
                    crypto</p>
                <button class="hidden-slide"><a href="about.php">Our Services</a></button>
            </div>
            <div class="home-img">
                <img src="../images/circle-Career.png" class=" hidden-blur" alt="">
            </div>
        </header>
    </section>


    <!-- FOOTER -->
    <?php
        include '../php/components/footer.php';
    ?>

    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
                pageLanguage: 'en'
            },
            'google_translate_element'
        );
    }
    </script>
    <script type="text/javascript"
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="js/app.js"></script>
    <script src="../js/animate.js"></script>
</body>

</html>