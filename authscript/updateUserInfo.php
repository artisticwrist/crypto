<?php
    include '../connect/connect.php';


    // Retrieve the 'userid' from the URL parameter
    $cookie_name = "id";
    $cookie_value = $_GET['infoId'];
   

    // Set the 'userid' as a cookie with an expiration time of 30 days
    setcookie($cookie_name, $cookie_value, time() + 300, "/");


    $current_id = $_COOKIE[$cookie_name];

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
    $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', country='$country', mobile='$mobile', passcode='$passcode' WHERE id='$current_id'";
    // $result = mysqli_query($con, $sql);
    if(mysqli_query($con, $sql)){
        echo "<script>alert('Update Successful !');</script>";
        echo "<script>setTimeout(function(){window.location.href='../php/admin.php'},1000);</script>";
    }else{
        echo "<script>alert('Error updating record: ' . mysqli_error($con));</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <?php
            $sql = "SELECT * FROM users WHERE id='$current_id'";
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
</body>

</html>