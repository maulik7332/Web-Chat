<?php 
    $conn = mysqli_connect("localhost","root","","chatapp");
    if(!$conn){
        echo "Databas Connected" . mysqli_connect_error();
    }
?>