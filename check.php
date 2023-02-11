<?php 
    
    session_start();
    include 'Template_php\connect.php';
    $username= $_POST['username'];
    $password= $_POST['password'];
    $sql = "select * from securelogin where username= '$username' and password= '$password' ";
    $result= mysqli_query($con,$sql);
    if (mysqli_num_rows($result) == 1) {
        $rows= mysqli_fetch_assoc($result);
        if ($rows['username']== $username and $rows['password']== $password) {
            $_SESSION['LOGIN_NAME']= $rows['username'];
            echo "correct";
        }
    }else{
        echo "wrong";
    }
?>