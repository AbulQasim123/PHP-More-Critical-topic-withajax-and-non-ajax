<?php
    include 'Template_php/connect.php';
    $id = $_POST['id'];
    $sql = "select * from student where id= '$id' " ;
    $result = mysqli_query($con,$sql);
    while ($row= mysqli_fetch_assoc($result)) {
        $arr= $row;
    }
    echo json_encode($arr);
?>
