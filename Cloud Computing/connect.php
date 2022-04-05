<?php
$username = $_POST['username'];
$password = $_POST['password'];
//database connection

$con = new mysqli("localhost","root","","oscc");
if($con->connect_error) {
    die("Failed to connect : ".$con->connect_error);
}
else{
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
        echo "<h2>Invalid E-mail or Password</h2>";
        }
    }else{
        echo "<h2>Invalid E-mail or Password</h2>";
    }
}
?>