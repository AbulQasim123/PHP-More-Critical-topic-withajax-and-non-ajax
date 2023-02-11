<?php
        // PDO Method
    // $term= $_GET['term'];
    // $con= new PDO('mysql:host=localhost;dbname=phpapp','root','');
    // $sql= "select name from autocomplete where name like '%$term%'";
    // $stmt= $con->prepare($sql);
    // $stmt->execute();
    // $arr= $stmt->fetchAll(PDO::FETCH_ASSOC);
    // // print_r($arr);
    // $data= array();
    // foreach ($arr as $key => $value) {
    //     $data[]= $value['name'];
    // }
    // echo json_encode($data);

    include 'Template_php/connect.php';
    $term= $_GET['term'];
    $sql= "select name from city where name like '%$term%'";
    $result= mysqli_query($conn,$sql);

        $data= array();
        while ($arr= mysqli_fetch_assoc($result)) {
            $data[]= $arr['name'];
        } 
        echo json_encode($data);


    // $data = array();
    // foreach ($arr as $key => $value) {
    //     $data[]= $value['name'];
    // }
    // echo json_encode($data);



?>
