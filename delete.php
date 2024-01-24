<?php 
    $id = $_POST['id'];
    $con=new mysqli("localhost","root","","test");
    if($con->connect_error)
    {
        die("failed".$con->connect_error);
    }
    else
    {
        
        $deletequery = "delete from users where id=$id";
        $query = mysqli_query($con,$deletequery);
        header('location:index.html');
    }
?>