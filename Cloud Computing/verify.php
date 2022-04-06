<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="for.css">
    <title>Forgot Password</title>
</head>

<body>
    <?php
    if(!isset($_SESSION['otp'])){
        session_start();

        
    }
    if(!isset($_SESSION['otp'])){
        echo "<script>window.location.href='index.html'</script>";
    }
    if(isset($_POST['verify'])){
        // die(print_r($_SESSION));
        if($_SESSION['otp']==$_POST['verifyOTP']){
            unset($_SESSION['otp']);
            $_SESSION['validation']="success";
            echo "<script>window.location.href='changepwd.php'</script>";
        }
        else{
            die("error");
        }
    }
    ?>
    <div class="container">
        <h1>verify otp</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="email">
                <input type="text" name="verifyOTP" required>
                <span></span>
                <label>Enter Your OTP</label>
            </div>
            <div class="but">
                <button type="submit" name="verify">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>