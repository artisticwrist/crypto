<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/style.css'>
    <link rel="stylesheet" href="../css/animate.css">
</head>
<style>
nav {
    z-index: 999;
}
</style>

<body>

    <!-- NAVIGATION BAR -->

    <?php
        include '../php/components/nav.php';
    ?>

    <!-- ABOUT US -->
    <section class="about-us">
        <h1 class="header-text">About Wincoin.com</h1>
        <div class="about">
            <div class="about-flex">
                <h1>Our mission is to create more economic freedom in the world</h1>
                <p>We define economic freedom as the ability to make choices with respect to one’s personal resources,
                    unencumbered by trusted third parties or borders or lack of access. We believe economic freedom is
                    the foundation of peace and prosperity, and by creating more of it for people, we are reducing
                    suffering in the world. Our mission is to help everyone, everywhere be more economically free.</p>
            </div>
            <div class="about-img">
                <img src="../images/bg-girl.png" class="img-bg none-display none-display" alt="">
            </div>
        </div>
        <div class="about-box">
            <h1 class="hidden-slide">What we’re doing about it</h1>
            <p class="hidden-slide">Since 2015, Bitcoin.com has been a global leader in introducing newcomers to crypto.
                We make it easy for
                anyone to buy, spend, trade, invest, earn, and stay up-to-date on cryptocurrency and the future of
                finance.</p>
        </div>
        <div class="about">
            <div class="about-img hidden">
                <img src="../images/news-img.png" alt="">
            </div>
            <div class="about-flex">
                <h1 class="hidden-slide">News</h1>
                <p class="hidden-slide">Stay informed with timely and objective news content relevant to the crypto
                    industry, published daily
                    by Bitcoin.com News.</p>
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