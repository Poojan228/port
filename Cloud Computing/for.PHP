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
        require_once 'dbconnection.php';
        require 'Mailer/PHPMailerAutoload.php';
        session_start();
        if(isset($_POST['forgetSubmit']))
        {
            $_SESSION['Remail'] = $_POST['forgetEmail'];
            echo "<script>window.location.href='for.php';</script>";
        }
        if(isset($_SESSION['Remail']))
        {
            
            $mail = new PHPMailer;


            $mail->isSMTP();                                     
            $mail->Host = 'smtp.gmail.com';  
            $mail->SMTPAuth = true;                               
            $sql = 'SELECT * FROM smtp';
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);
            $mail->Username = "{$row['email']}";                 
            $mail->Password = "{$row['password']}";                           
            $mail->SMTPSecure = 'tls';                            
            $mail->Port = 587;                                    

            $mail->setFrom("{$row['email']}", 'OSCC');
            $mail->addAddress("{$_SESSION['Remail']}", "Siddhi");     
            $mail->addReplyTo('no-reply@gmail.com', 'Do Not Reply');

            $mail->isHTML(true);                                  
            $_SESSION['otp'] = rand(1000,9999);
            $mail->Subject = 'Verification OTP';
            $mail->Body    = "<h4>Your OTP For Verification is : <b>{$_SESSION['otp']}</b></h4>";

            if(!$mail->send()) {
                $error='OTP could not be sent. Server Unreachable !';
                echo "<script>window.location.href='for.php?{$error}';</script>";
            }
            else
            {
                $success="OTP is being send to {$_SESSION['Remail']}";
                echo "<script>window.location.href='verify.php?{$success}';</script>";
            }
        }
    ?>
    <div class="container">
        <h1>Forgot Password?</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="email">
                <input type="email" name="forgetEmail" required>
                <span></span>
                <label>E-mail</label>
            </div>
            <div class="but">
                <button type="submit" name="forgetSubmit">Get OTP</button>
            </div>
        </form>
    </div>
</body>

</html>