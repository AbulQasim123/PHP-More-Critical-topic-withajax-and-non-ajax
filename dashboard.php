<?php 
    session_start();
    if (!isset($_SESSION['LOGIN_NAME'])) {
        header('location:scroll.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['LOGIN_NAME']; ?></title>
</head>
<body>
    <h3>Welcome <?php echo $_SESSION['LOGIN_NAME']; ?></h3> 
    <a href="logout.php">Logout</a>
</body>
</html>