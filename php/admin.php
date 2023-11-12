<?php
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
                echo "<script>alert('Applicatioon sent successfully. You'll be verified and ready to trade as soon as managemnt confirms your payment.')</script>";
            }else{
                echo "Error trying to submit application. PLease try again later.";
            } 
        }
    
}


// DELETE USER FROM USERS TABLE

if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="delete from `users` where id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
        header('Location:../php/admin.php');
    }else{
        die(mysqli_error($con));
    }
}


// INSERT VERIFIED USERS INTO VERIFIED_USER TABLE
if(isset($_GET['verifiedid'])){
    $verifiedid = $_GET['verifiedid'];
    $verified_email = $_GET['verified_email'];
    $current_balance = 0;
    $package = $_GET['verified_package'];

    $sql = "INSERT INTO `verified_users` (verified_id,verified_email,package,current_balance) VALUES('$verifiedid','$verified_email','$package','$current_balance')";
    $query = mysqli_query($con,$sql);

    if(!$query){
        echo "problem dey oooo";
    }

    $delsql="delete from `package` where user_id=$verifiedid";
    $result=mysqli_query($con,$delsql);
    if($result){
        header('location: ../php/admin.php');
    }else{
        die(mysqli_error($con));
    }

};




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css?v=1">
</head>

<body>


    <!-- SIDE NAV -->
    <div class="admin-nav">
        <h1>wincoin</h1>
        <ul>
            <li onclick="allUsers()">View users</li>
            <li onclick="pendingRequest()">Pending request</li>
            <li onclick="verifiedUsers()">Verified users</li>
            <li><a href="../authscript/logout.php" style="color:white;text-decoration:none;">Logout</a></li>
        </ul>
    </div>




    <section class="admin__body">
        <nav>
            <div>
                <h1>Welcome Admin</h1>
                <p>0 number of users.</p>
            </div>
        </nav>
        <nav>
            <ul>
                <li onclick="allUsers()">View users</li>
                <li onclick="pendingRequest()">Pending request</li>
                <li onclick="verifiedUsers()">Verified users</li>
            </ul>
        </nav>

        <!-- LIST OF ALL USERS -->
        <div class="table all-users">
            <h4>All users</h4>
            <div class="table__row thead">
                <div class="flex">sl no</div>
                <div class="flex">firstname</div>
                <div class="flex">lastname</div>
                <div class="flex email-box">email</div>
                <div class="fllex">actions</div>
            </div>

            <?php

                $sql="Select * from `users`";
                $result=mysqli_query($con,$sql);
                if($result){
                    while($row=mysqli_fetch_assoc($result)){
                        $verified = "SELECT * FROM verified_users";
                        $id=$row['id'];
                        $firstname=$row['firstname'];
                        $lastname=$row['lastname'];
                        $email=$row['email'];
                        $mobile=$row['mobile'];
                        $country=$row['country'];
                        $pass=$row['passcode'];
                        $gender=$row['gender'];
                        echo '
                        <div class="table__row tbody">
                            <div class="flex">'.$id.'</div>
                            <div class="flex">'.$firstname.'</div>
                            <div class="flex">'.$lastname.'</div>
                            <div class="flex email-box">'.$email.'</div>
                            <div class="fllex">
                                <button onclick="upadteUser()"><a href="../authscript/updateUserInfo.php?infoId='.$id.'"><img src="../images/svg/settings.svg" alt=""></a></button>
                                <button><a href="../php/admin.php?deleteid='.$id.'"><img src="../images/svg/bin.svg" alt=""></a></button>
                            </div>
                        </div>
                        ';

                    }
                
                }


            ?>

        </div>

        <!-- PENDING REQUEST -->
        <div class="table pending-request display-none">
            <h4>Pending requets</h4>
            <div class="table__row thead">
                <div class="flex">sl no</div>
                <div class="flex email-box">email</div>
                <div class="flex email-box">image</div>
                <div class="flex">package</div>
                <div class="flex">verify</div>
            </div>
            <?php

                $sql="Select * from `package`";
                $result=mysqli_query($con,$sql);
                if($result){
                    while($row=mysqli_fetch_assoc($result)){
                        $id=$row['id'];
                        $user_id=$row['user_id'];
                        $package=$row['package'];
                        $image=$row['payment_proof'];
                        $user_email=$row['user_email'];
                        echo '
                        <div class="table__row tbody">
                            <div class="flex">'.$user_id.'</div>
                            <div class="flex email-box">'.$user_email.'</div>
                            <div class="flex email-box" onclick="showPaymentModal()">'.$image.'</div>
                            <div class="flex">'.$package.'</div>
                            <div class="flex">
                                <button><a href="../php/admin.php?verifiedid='.$user_id.'&&verified_email='.$user_email.'&&verified_package='.$package.'"><img src="../images/svg/check.svg" alt=""></a></button>
                            </div>
                        </div>
                        ';

                        echo '
                        <div class="payment-modal display-none" onclick="closePaymentModal()" id="payment-modal">
                                <img src="../uploads/'.$image.'" alt="">
                        </div>';

                    }

                };

            ?>
        </div>


        <!-- VERIFIED USERS -->
        <div class="table verified-users display-none">
            <h4>Verified users</h4>
            <div class="table__row thead">
                <div class="flex">sl no</div>
                <div class="flex email-box">email</div>
                <div class="flex ">package</div>
                <div class="flex ">balance</div>
                <div class="fllex">actions</div>
            </div>

            <!-- content -->
            <?php

                $sql="Select * from `verified_users`";
                $result=mysqli_query($con,$sql);
                if($result){
                    while($row=mysqli_fetch_assoc($result)){
                        $id=$row['id'];
                        $user_id=$row['verified_id'];
                        $user_email=$row['verified_email'];
                        $user_package=$row['package'];
                        $user_balance=$row['current_balance'];
                        echo '
                        <div class="table__row tbody">
                            <div class="flex">'.$user_id.'</div>
                            <div class="flex email-box">'.$user_email.'</div>
                            <div class="flex">'.$user_package.'</div>
                            <div class="flex">'.$user_balance.'</div>
                            <div class="fllex">
                                <button><a href="../authscript/adminUpdateUser.php?userid='.$user_id.'&&userbalance='.$user_balance.'"><img src="../images/svg/settings.svg" alt=""></a></button>
                            </div>
                        </div>

                        ';
            }

            }




            ?>
        </div>




        <!-- UPDAT USERS -->
        <div class="update-user display-none">

            <h4>Update user</h4>
            <form action="">
                <div class="input-box">
                    <p>firstname</p>
                    <input type="text">
                </div>
                <div class="input-box">
                    <p>lastname</p>
                    <input type="text">
                </div>
                <div class="input-box">
                    <p>email</p>
                    <input type="text">
                </div>
                <div class="input-box">
                    <p>mobile</p>
                    <input type="text">
                </div>
                <div class="input-box">
                    <p>country</p>
                    <input type="text">
                </div>
                <div class="input-box">
                    <p>password</p>
                    <input type="text">
                </div>
                <button>Submit</button>
            </form>
        </div>


    </section>



    <script src="../js/admin.js"></script>
</body>

</html><?php
}else{
    header('location: loginAdmin.php');
};
?>