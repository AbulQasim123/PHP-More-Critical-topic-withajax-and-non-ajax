<?php 
    include 'connect.php';
    $sql= "select * from exporthtml";
    $result= mysqli_query($con,$sql);
    $html= '<table><table class="table table-bordered table-sm my-1 text-center">
        <tr>
            <th>Name</th>
            <th>City</th>
            <th>Email</th>
        </tr>';
    while ($row= mysqli_fetch_assoc($result)) {
        $html.='<tr>
            <td>'.$row['name'].'</td>
            <td>'.$row['city'].'</td>
            <td>'.$row['email'].'</td>
        </tr>';
    }
    $html.='</table>';
    header('Content-Type:application/xls');
    header('Content-Disposition:attachment; filename=report.xls');
    echo $html;
?>