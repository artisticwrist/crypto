<?php

    include '../connect/connect.php';


    // Retrieve the 'userid' from the URL parameter
    $cookieName = "id";
    $cookieValue = $_GET['userid'];
   

    // Set the 'userid' as a cookie with an expiration time of 30 days
    setcookie($cookieName, $cookieValue, time() + 300, "/");

    $current_id = $_COOKIE[$cookieName];


    if(isset($_GET['submit'])) {
        $updateBal = $_GET['bal'];

        $sql = "UPDATE verified_users SET current_balance='$updateBal' WHERE verified_id='$current_id'";
        $query = mysqli_query($con, $sql);

        if($query){
            echo "<script> alert('Update Successful. !'); </script>";
        echo "<script>setTimeout(function(){window.location.href='../php/admin.php'},100);</script>";
        }else{
            echo "error";
        }
    }












?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap');


    body {
        font-family: 'Poppins', sans-serif;
        height: 100vh;
        background-color: black;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        color: white;
    }


    body form,
    body h1 {
        margin: 10px;
    }

    body form {
        display: flex;
        flex-direction: column;
    }

    form input,
    form button {
        width: 250px;
        height: 45px;
        margin: 15px;
    }

    input:focus,
    input:target {
        color: white;
    }

    form input {
        color: white;
        background: none;
        border-top-width: 0px;
        border-left-width: 0px;
        border-right-width: 0px;
    }

    form button {
        background: white;
        border: none;
        border-radius: 5px;
    }
    </style>
</head>

<body>
    <h1>Update user balance</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
        <input type="text" placeholder="update balance" name="bal">
        <button name='submit'>submit</button>
    </form>
</body>

</html>