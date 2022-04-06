<?php

$con = new mysqli("localhost","root","","oscc");
if($con->connect_error) {
    die("Failed to connect : ".$con->connect_error);
}

?>