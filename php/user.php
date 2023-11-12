<?php
ini_set('memory_limit', '256M');
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../connect/connect.php";
session_start();

if (isset($_SESSION['passcode']) && isset($_SESSION['email']) ) {

    $userid = $_SESSION['id'];
    $user_email = $_SESSION['email'];
    $user_verified = 'not_verified';

    if(isset($_POST['submit'])){

        $packageRow = "SELECT * FROM package where user_id='$userid'";
        $packageQuery = mysqli_query($con,$packageRow);

        if(mysqli_num_rows($packageQuery)> 0){
            echo "<script>alert('You are already on a plan. Contact customer if you like to upgrade.')</script>";
        }else{
            $paymentProof = $_FILES['image']['name'];
            $imageTmp = $_FILES['image']['tmp_name'];
            
            // Move the uploaded image to the designated directory
            $uploadPath = '../uploads/' . $paymentProof;
            move_uploaded_file($imageTmp, $uploadPath);

            $package = $_POST['package'];

            // set package price and start count to user balance
            if($package === 'oneweek'){
                $rio = 500;
                $current_balance = 0;
            }elseif($package === 'twoweeks'){
                $rio = 1000;
                $current_balance = 0;
            }elseif($package === 'onemonth'){
                $rio = 3000;
                $current_balance = 0;
            }elseif($package === 'threemonths'){
                $rio = 6000;
                $current_balance = 0;
            }
        
        
        
            // insert data to pacakage table
        
            $sql = "insert into `package` (user_id,user_email,user_verified,package,current_balance,rio,payment_proof) values('$userid','$user_email','$user_verified', '$package',  '$current_balance', '$rio','$paymentProof')";
        
            $query = mysqli_query($con,$sql);
        
            if($query){
                echo "<script>alert('Application sent successfully. Appliaction will be responded to within 24hrs.');</script>";
            }else{
                echo "Error trying to submit application. PLease try again later.";
            } 
        }
    
}



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>User page</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/user.css?v=1'>

</head>

<body>
    <!-- ASIDE NAV -->
    <aside class="nav">
        <h1 class="logo">Wincoin</h1>
        <ul>
            <li onclick="openDashboardHome()">Dashboard</li>
            <li onclick="openProfile()">Profile</li>
            <li onclick="openTransaction()">Transaction</li>
            <li onclick="openWithdraw()">Withdraw</li>
            <li onclick="openDeposit()">Deposit</li>
            <li onclick="openModal()">Logout</li>
        </ul>
    </aside>

    <!-- DASHBOARD -->
    <section class="user-section-flex">

        <!-- DASHBOARD HOME PAGE -->
        <section class="dahboard-homepage" id="dashboard-homepage">
            <!-- DASHBOARD NAV -->
            <nav class="user-top-nav">
                <!-- SEARCH BOX -->
                <div class="search-box">
                    <?php 
                        $verify_sql = "SELECT * FROM verified_users";
                        $query = mysqli_query($con, $verify_sql);
                                    
                        if($query){
                            while($row=mysqli_fetch_assoc($query)){
                                $email=$row['verified_email'];
                                            
                                if($_SESSION['email']===$email){
                                    echo '<img src="../images/verified.svg" alt="" class="verify-img">';
                                }
                            }
                        }
                    ?>
                    <p><?php echo $_SESSION['firstname'] . " "; echo $_SESSION['lastname']?></p>

                </div>
                <!-- TOP NAV OPTIONS -->
                <div class="option-container">
                    <div class="profile-option">
                        <img src="../images/profile.jpg" alt="">
                        <select name="" id="">
                            <option onclick="openProfile()">Profile</option>
                            <option onclick="openModal()">Logout</option>
                        </select>
                    </div>
                </div>

                <!-- HAM BURGER -->
                <div class="ham-burger" onclick="openSideNav()">
                    <div class="burger"></div>
                    <div class="burger"></div>
                    <div class="burger"></div>
                </div>
            </nav>

            <!-- USER BALANCE -->
            <div class="balance-container">
                <div class="balance">
                    <p>Balance</p>
                    <h2>$<?php 
                
                    $bal = "SELECT current_balance FROM verified_users WHERE verified_id=$userid";
                    $sql = mysqli_query($con, $bal);

                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);

                        echo $row["current_balance"];
                    } else {
                        echo 0;
                    }

                    ?>.00</h2>
                </div>
                <div class="balance">
                    <p>Total balance</p>
                    <h2>$<?php 
                
                $bal = "SELECT current_balance FROM verified_users WHERE verified_id=$userid";
                $sql = mysqli_query($con, $bal);

                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                    echo $row["current_balance"];
                } else {
                    echo 0;
                }

                ?>.00</h2>
                </div>
                <div class="balance">
                    <p>Expected rio</p>
                    <h2>$<?php 
                
                $bal = "SELECT package FROM verified_users WHERE verified_id=$userid";
                $sql = mysqli_query($con, $bal);

                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                    if($row['package'] === "twoweeks"){
                        echo 200;
                    }elseif($row['package'] === "threeweeks"){
                        echo 500;
                    }elseif($row['package'] === "onemonth"){
                        echo 1500;
                    }
                } else {
                    echo 0;
                }

                ?>.00</h2>
                </div>
            </div>

            <!-- MARKET PRICES -->
            <div class="content-container">
                <div class="content-flex">
                    <div class="contents">
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright">
                                <a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span
                                        class="blue-text">Track all markets on TradingView</span></a>
                            </div>
                            <script type="text/javascript"
                                src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                            {
                                "symbol": "BINANCE:XRPUSDT",
                                "width": "100%",
                                "colorTheme": "dark",
                                "isTransparent": true,
                                "locale": "en"
                            }
                            </script>
                        </div>
                        <!-- TradingView Widget END -->
                    </div>

                    <div class="contents">
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright">
                                <a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span
                                        class="blue-text">Track all markets on TradingView</span></a>
                            </div>
                            <script type="text/javascript"
                                src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                            {
                                "symbol": "BITSTAMP:BTCUSD",
                                "width": "100%",
                                "colorTheme": "dark",
                                "isTransparent": true,
                                "locale": "en"
                            }
                            </script>
                        </div>
                        <!-- TradingView Widget END -->
                    </div>

                    <div class="contents">
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright">
                                <a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span
                                        class="blue-text">Track all markets on TradingView</span></a>
                            </div>
                            <script type="text/javascript"
                                src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                            {
                                "symbol": "FX:EURUSD",
                                "width": "100%",
                                "colorTheme": "dark",
                                "isTransparent": true,
                                "locale": "en"
                            }
                            </script>
                        </div>
                        <!-- TradingView Widget END -->
                    </div>
                </div>
            </div>
            <!-- TRADING CHART -->
            <section class="chart">
                <div class="cryptohopper-web-widget" data-id="8" data-theme="midnight" data-box_design="5"
                    data-coins="bitcoin"></div>
            </section>
        </section>

        <!-- USER PROFILE / EDIT PAGE -->
        <section class="user-profile user-page-layout" id="user-profile">

            <!-- HAM BURGER -->
            <div class="ham-burger" onclick="openSideNav()">
                <div class="burger"></div>
                <div class="burger"></div>
                <div class="burger"></div>
            </div>

            <h2>Your Profile</h2>
            <form action="../authscript/userUpdatescript.php" method="post">
                <?php
                $currentUser = $_SESSION['email'];
                $sql = "SELECT * FROM users WHERE email='$currentUser'";
                $gotResult = mysqli_query($con, $sql);

            
                if($gotResult){
                    if(mysqli_num_rows($gotResult)>0){
                        while($row = mysqli_fetch_array($gotResult)){
                            ?>
                <div class="input-box">
                    <label for="">First name</label>
                    <input type="text" value="<?php echo $row['firstname']?>" name="firstname">
                </div>
                <div>
                    <label for="">Last name</label>
                    <input type="text" value="<?php echo $row['lastname']?>" name="lastname">
                </div>
                <div>
                    <label for="">Email</label>
                    <input type="text" value="<?php echo $row['email']?>" name="email">
                </div>
                <div>
                    <label for="">Country</label>
                    <input type="text" value="<?php echo $row['country']?>" name="country">
                </div>
                <div>
                    <label for="">Mobile</label>
                    <input type="text" value="<?php echo $row['mobile']?>" name="mobile">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" value="<?php echo $row['passcode']?>" name="passcode">
                </div>

                <button name="submit" type="submit">Update profile</button>
                <?php
                    }
                        
                            }
                        }
                    ?>

            </form>
        </section>


        <!-- DEPOSIT -->
        <section class="deposit user-page-layout" id="deposit">

            <!-- HAM BURGER -->
            <div class="ham-burger" onclick="openSideNav()">
                <div class="burger"></div>
                <div class="burger"></div>
                <div class="burger"></div>
            </div>

            <form action="../php/user.php" method="post" enctype="multipart/form-data">
                <div class="choose-plan" id="choose-plan">
                    <p>Choose a package plan </p>
                    <select name="package" id="">
                        <option>SELECT PACKAGE</option>
                        <option value="oneweek">One week</option>
                        <option value="twoweeks">Two weeks</option>
                        <option value="onemonth">One Month</option>
                        <option value="threemonths">Three Months</option>
                    </select>
                    <button type="button" onclick="nextOPtion()">Next</button>
                </div>
                <div class="form-submit display-none" id="form-submit">
                    <p>Kindly attach transaction details after making paymnent. It'll take less than 30 min for your
                        account to be verified</p>
                    <input type="file" name="image">
                    <b onclick="viewPackage()" style="cursor: pointer;">Back</b>
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>
        </section>

        <!-- WITHDRAW -->
        <section class="user-profile user-page-layout" id="withdraw">

            <!-- HAM BURGER -->

            <div class="ham-burger" onclick="openSideNav()">
                <div class="burger"></div>
                <div class="burger"></div>
                <div class="burger"></div>
            </div>

            <form action="">
                <label for="">Type Amount</label>
                <input type="text" placeholder="Firstname">
                <label for="">Account Name</label>
                <input type="text" placeholder="Firstname">
                <label for="">Bank Name</label>
                <input type="text" placeholder="Bank name">
                <label for="">Accoount Number</label>
                <input type="text" placeholder="Account number">
                <label for="">Password</label>
                <input type="password" placeholder="Input your password">
                <button>Submit Request</button>

            </form>
        </section>

        <!-- TRANSACTIONS -->
        <section class="transaction" id="transaction">

            <!-- HAM BURGER -->
            <div class="ham-burger" onclick="openSideNav()">
                <div class="burger"></div>
                <div class="burger"></div>
                <div class="burger"></div>
            </div>

            <h1>You have no transaction yet</h1>
        </section>
    </section>


    <section class="user-section-flex-two">
        <div class="withdraw-deposit-btn">
            <button class="deposit-btn" onclick="openDeposit()">Deposit</button>
            <button class="withdraw-btn" onclick="openWithdraw()">Withdraw</button>
        </div>

        <!-- BTC LABELS -->
        <div class="btc-labels">
            <div class="content-flex">
                <div class="content">
                    <div class="cryptohopper-web-widget" data-id="7" data-theme="midnight"
                        data-background_color="#ffffff" data-coins="bnb,xrp,cardano" data-numcoins="undefined"
                        data-fullwidth="1"></div>
                </div>
            </div>
        </div>

        <!-- MULTICURRENCY -->
        <div class="multicurrency">
            <div class="cryptohopper-web-widget" data-id="3" data-fullwidth="1" data-coins="ethereum"
                data-theme="midnight"></div>
        </div>
    </section>


    <!-- MODAL LOGOUT -->

    <section class="logout-modal">
        <p>Are you sure you want to log out?</p>
        <div class="logout-btn-container">
            <button id="btn-cancel" onclick="closeModal()">Cancel</button>
            <button id="btn-logout">
                <a href="../authscript/logout.php" style="color:white;text-decoration:none;">Logout</a>
            </button>
        </div>
    </section>



    <script src="https://www.cryptohopper.com/widgets/js/script"></script>
    <script src="../js/app.js"></script>
</body>

</html>
<?php
}else{
    header('location: login.php');
};
?>