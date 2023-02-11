<?php require "config/config.php"; ?>

<?php
    if((isset($_POST['submit']))){

        $fullname = mysqli_real_escape_string($con,trim($_POST['fullname']));
        $email = mysqli_real_escape_string($con,trim($_POST['email']));
        $username = mysqli_real_escape_string($con,trim($_POST['username']));
        $password = mysqli_real_escape_string($con,trim($_POST['password']));

        $fullname_valid = $email_valid = $password_valid = $username_valid = false;

        //Check Fullname
        if(!empty($fullname)){
            if(strlen($fullname) > 2 && strlen($fullname) <= 30){
                if(!preg_match('/[^a-zA-Z\s]/', $fullname)){

                    // All Test Passed !!
                    $fullname_valid = true;
                    echo "Fullname is OK !! <br>";

                }else { /*Invalid Characters --> */ echo "Fullname can contain only alphabets <br>"; }
            } else { /* Invalid Length --> */ echo "Fullname must be between 2 to 30 chars long. <br>"; }
        } else { /* Blank Input --> */ echo "Fullname can not be blank !! <br>";}

        //Check Email
        if(!empty($email)){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){

                    // All Test Passed !!
                    $email_valid = true;
                    echo "Email is OK !! <br>";

            } else { /* Invalid Email --> */ echo $email."is an Invalid Email Address. <br>"; }
        } else { /* Blank Input --> */ echo "email can not be blank !! <br>";}


        //Check Username
        if(!empty($username)){
            if(strlen($username) >= 4 && strlen($username) <= 15){
                if(!preg_match('/[^a-zA-Z\d_.]/', $username)){

                    // All Test Passed !!
                    $username_valid = true;
                    echo "Username is OK !! <br>";

                }else { /*Invalid Characters --> */ echo "Username can contain alphabets,digits,underscore '_' and period '.' symbols <br>"; }
            } else { /* Invalid Length --> */ echo "Username must be between 2 to 15 chars long. <br>"; }
        } else { /* Blank Input --> */ echo "Username can not be blank !! <br>";}


        //Check Password
        if(!empty($password)){
            if(strlen($password) >= 5 && strlen($password) <= 15){

                    // All Test Passed !!
                    $password_valid = true;
                    $password = md5($password);
                    echo "Password is OK !! <br>";


            } else { /* Invalid Length --> */ echo $password." = password must be between 5 to 15 chars long. <br>"; }
        } else { /* Blank Input --> */ echo "Password can not be blank !! <br>";}

        if($fullname_valid && $email_valid && $password_valid && $username_valid){

            $query = "INSERT INTO users(fullname,email,username,password) VALUES('$fullname','$email','$username','$password')";
            $fire = mysqli_query($con,$query) or die("Can not insert data into database. ".mysqli_error($con));
            if($fire){
                echo "Data Submitted to Database.";
            }
        }
    }
    ?>


    <?php
        if(isset($_GET['del'])){
            $id = $_GET['del'];
            $query = "DELETE FROM users WHERE id = $id";
            $fire = mysqli_query($con,$query) or die("Can not delete the data from database.". mysqli_error($con));
            if($fire) {
                echo "Data deleted from database";
                header("Location:index.php");
            };
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="config/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="config/bootstrap.css" />
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 flex-container">
                <!-- Show Data Here -->
                <div class="col-lg-8 col-xs-12">
                    <h3>User Data</h3>
                    <hr>
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                             <?php
                                $query = "SELECT * FROM users";
                                $fire = mysqli_query($con,$query) or die("Can not fetch data from database ".mysqli_error($con));
                                //if($fire) echo "We got the data from database.";

                                if(mysqli_num_rows($fire) > 0 ){
                                    while($user = mysqli_fetch_assoc($fire)){ ?>
                                <tr>
                                    <td><?php echo $user['username'] ?></td>
                                    <td><?php echo $user['fullname'] ?></td>
                                    <td><?php echo $user['email'] ?></td>
                                    <td>
                                        <a href="<?php $_SERVER['PHP_SELF'] ?>?del=<?php echo $user['id'] ?>"
                                           class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-warning"
                                            href="update.php?upd=<?php echo $user['id'] ?>"
                                            >Update</a>
                                    </td>
                                </tr>

                                   <?php
                                    }
                                }
                                else{ ?>
                                    <tr>
                                      <td colspan="3" class="text-center">
                                          <h2 class="text-muted">There is No Data to Show !!</h2>
                                      </td>
                                  </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                    </div>





                </div>
                <!-- Signup form -->
                <div class="col-lg-4 col-xs-12">
                    <h3>Signup</h3>
                    <hr>
                    <form name="signup" id="signup" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label  for="fullname">Fullname</label>
                            <input  name="fullname" id="fullname" type="text" class="form-control" placeholder="fullname">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" id="email" type="text" class="form-control" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input name="username" id="username" type="text" class="form-control" placeholder="username" >
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" id="password" type="password" class="form-control" placeholder="password" >
                        </div>
                        <div class="form-group">
                           <button name="submit" id="submit" class="btn btn-primary btn-block">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
