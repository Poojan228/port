<?php
    $username = $_POST['username'];
    $e_mail = $_POST['e_mail'];
    $password = $_POST['password'];

    //Database
    $conn = new mysqli('localhost','root','','oscc');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into signup(username, e_mail, password) value(?, ?, ?)");
        $stmt->bind_param("sss",$username, $e_mail, $password,);
        $stmt->execute();
        header('location: login.html');
        echo "Registration Successful.";
        $stmt->close();
        $conn->close();
    }
?>