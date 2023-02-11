<?php
    // print_r($_POST);
    $pincode= $_POST['pincode'];
    $data = file_get_contents('http://postalpincode.in/api/pincode/' .$pincode);
    
    $data= json_decode($data);
    // echo "<pre>";
    // print_r($data);
    if (isset($data->PostOffice['0'])) {
        // print_r($data->PostOffice['0']);
        $arr['Tehsil']= $data->PostOffice['0']->Taluk;
        $arr['District']= $data->PostOffice['0']->District;
        $arr['State']= $data->PostOffice['0']->State;
        echo json_encode($arr);
    }else{
        echo "no";
    }
?>