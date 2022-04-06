<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="login.css">
</head>
<?php

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
//database connection

    require_once 'dbconnection.php';
    $stmt = $con->prepare("select * from signup where username = ?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if($data['password'] === $password) {
            header('location: about1.html');
            // echo "<h2>Login Successfully</h2>";
        }else{
        echo "<h2 style='text-align:center;color:black;'>Invalid E-mail or Password</h2>";
        }
    }else{
        echo "<h2 style='text-align:center;color:black;'>Invalid E-mail or Password</h2>";
    }  
}
?>
<body>
    <div class="center">
        <h1>LOGIN</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="txt_field">
                <input type="text" name="username" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="pass"><a href="for.php">Forgot Password?</a> </div>
            <input type="submit" value="Login" name="login">
            <div class="signup_link">
                Not a member? <a href="signup.html">Signup</a>
            </div>
        </form>
    </div>
</body>

</html>