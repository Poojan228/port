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
    if(!isset($_SESSION['validation'])){
        session_start();  
    }
    if(!isset($_SESSION['validation'])){
        echo "<script>window.location.href='index.html'</script>";
    }
    if(isset($_GET['error']))
    {
        echo "<script>alert({$_GET['error']})</script>";
        echo "<script>window.location.href='verify.php'</script>";
    }
    if(isset($_POST['newpwd'])){
        require_once 'dbconnection.php';
        $newpwd = $_POST['newpwd'];
        $sql = "UPDATE signup SET password='{$newpwd}' WHERE e_mail='".$_SESSION['Remail']."'";
        $result=mysqli_query($con,$sql);
        if($result){
            unset($_SESSION['Remail']);
            echo "<script>window.location.href='login.html'</script>";

        }
        else{
            echo "<script>window.location.href='verify.php?error=Can't Change Your Password ! Please Retry'</script>";
        }

    }
    ?>
    <div class="container">
        <h1>Change Password</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="email">
                <input type="text" name="newpwd" required>
                <span></span>
                <label>Enter new password</label>
            
            </div>
            <div class="but">
                <button type="submit" name="changepass">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>