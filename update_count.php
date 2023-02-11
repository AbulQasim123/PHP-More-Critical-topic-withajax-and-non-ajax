<?php
    include 'Template_php/connect.php';
    $type= $_POST['type'];
    $id= $_POST['id'];
    if ($type == 'like') {
        $sql= "update likedislike set like_count= like_count+1 where id= '$id' ";
    }else{
        $sql= "update likedislike set dislike_count= dislike_count+1 where id= '$id' ";
    }
    $result= mysqli_query($con,$sql);
?>