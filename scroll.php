<?php
// Dynamicall add/remove input field in php
include 'Template_php/connect.php';
if (isset($_POST['submit'])) {
    $count_value = $_POST['text_value'];
    foreach ($count_value as $value) {
        if ($value != '') {
            $sql = "insert into addremovefield(`name`) values('$value') ";
            mysqli_query($con, $sql);
        }
    }
}
// PHP Ajax Like Dislike script
$sql = "select * from likedislike";
$res = mysqli_query($con, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrolling page</title>
    <script type="text/javascript" src="jquery\myjquery.js"></script>
    <script type="text/javascript" src="jquery-ui-1.12.1\jquery-ui.min.js"></script>
    <script type="text/javascript" src="bootstrap-4.0.0-dist\js\bootstrap.js"></script>
    <link rel="stylesheet" href="font-awesome\css\font-awesome.css">
    <link rel="stylesheet" href="bootstrap-4.0.0-dist\css\bootstrap.css">
    <link rel="stylesheet" href="jquery-ui-1.12.1\jquery-ui.min.css">

    <style>
        .align_para {
            text-align: justify;
            margin-top: 50px;
            font-style: Oblique;
        }

        /* Scroll to back top button */
        #go_top {
            display: none;
            position: fixed;
            background: #fdbe33;
            color: #121518;
            width: 50px;
            height: 45px;
            font-size: 30px;
            text-decoration: none;
            text-align: center;
            right: 15px;
            bottom: 15px;
        }

        .error_field {
            color: red;
        }

        /* Visitor counter php script and mysql */
        #visitor_counter {
            margin-right: 40px;
            color: yellow;
            font-weight: bold;
            font-size: 18px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <?php
        // Visitor counter php script and mysql
    include 'Template_php/connect.php';
    $sql1 = "update visitor_count set visitor_counter = visitor_counter+1";
    mysqli_query($con, $sql1);
    $sql2 = "select visitor_counter from visitor_count";
    $result = mysqli_query($con, $sql2);
    $row = mysqli_fetch_assoc($result);
    $counter = $row['visitor_counter'];
    $count = strlen($counter);

    ?>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: #857421">
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar_content">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar_content">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a href="" class="nav-link font-weight-bold">Home</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link font-weight-bold">Service</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link font-weight-bold">Contact</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link font-weight-bold">About</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link font-weight-bold">More</a>
                </li>
            </ul>
            <div id="visitor_counter">
                <!-- Visitor counter php script and mysql -->
                <?php
                echo '<span>User visit </span>';
                for ($i = 0; $i < $count; $i++) {
                    echo '<span>' . $counter[$i] . '</span>';
                }
                echo '<span> time on that page.</span>';
                ?>
            </div>
            <form action="" class="form-inline my-2 my-lg-2 mr-2">
                <input type="search" name="search" id="search" class="form-control mr-sm-2" placeholder="Search">
                <button type="button" class="btn btn-info" id="search" name="search">Search</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h4>Fetch json data with ajax.</h4>
                    <select name="student_list" id="student_list" class="form-control" onchange="getdata(this.options[this.selectedIndex].value)">
                        <option value="">Select student name</option>
                        <?php
                        include 'Template_php/connect.php';
                        $sql = "select id,name from `student` ";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>

                </div>
                <div class="table-responsive" id="student_detail" style="display:none;">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td><span id="name"></span></td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td><span id="city"></span></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><span id="email"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <h4>Dynamically Add/Remove input field in php.</h4>
                <div class="wrap">
                    <form action="" method="post">
                        <div class="form-group" id="myform">
                            <input type="text" name="text_value[]" id="text_value" class="form-control">
                            <button type="button" class="btn btn-primary btn-sm" style="margin-left:335px; margin-top: -65px" onclick="Add_more()">Add More</button>
                        </div>
                        <input type="submit" value="Add Record" id="submit" name="submit" class="btn btn-primary btn-sm">
                        <input type="hidden" name="field_count" id="field_count" value="1">
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <h4>PHP Ajax Like Dislike script</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <th>Post</th>
                                <th>Like</th>
                                <th>Dislike</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                                    <td><?php echo $row['post']; ?></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm">
                                            <span class="icon-thumbs-up-alt font-weight-bold like" onclick="like_update('<?php echo $row['id'] ?>')"> Like (<span id="like_loop_<?php echo $row['id'] ?>"><?php echo $row['like_count'] ?></span>)</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm">
                                            <span class="icon-thumbs-up-alt font-weight-bold like" onclick="dislike_update('<?php echo $row['id'] ?>')"> Dislike (<span id="dislike_loop_<?php echo $row['id'] ?>"><?php echo $row['dislike_count'] ?></span>)</span>
                                        </a>
                                    </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Get city,state from pincode -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h5>Get City, State from pincode.</h5>
                <form action="" method="post" id="formpincode" autocomplete="off">
                    <div class="form-group">
                        <label for="pincode" class="font-weight-bold">Pincode</label>
                        <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Enter 6 digit pin code number" autocomplete="new_password">
                        <button type="button" class="btn btn-primary btn-sm my-2" onclick="Get_detail()">Get detail</button>
                    </div>
                    <div class="form-group">
                        <input type="text" id="Tehsil" disabled class="form-control" placeholder="Tehsil">
                        <input type="text" id="District" disabled class="form-control" placeholder="District">
                        <input type="text" id="State" disabled class="form-control" placeholder="State">
                    </div>
                </form>
                <div class="glob">
                    <h5>PHP Inbuilt function glob() very important.</h5>
                    <?php
                    $arr = glob("Images/*.jpg");
                    echo "<pre>";
                    print_r($arr);

                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Jquery textbox autocomplete with php</h5>
                <div class="form-group">
                    <label for="Search" class="font-weight-bold">Search</label>
                    <input type='text' name='txt' placeholder='Enter Search' value='' class='form-control auto'>
                </div>
                <div id="login_box">
                    <h5>How to create secure php login script with ajax.</h5>
                    <form action="" method="post">
                        <div class='form-group'>
                            <label for="username" class="font-weight-bold">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                            <span class="error_field" id="username_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="password" class="font-weight-bold">Password</label>
                            <input type="text" name="password" id="password" class="form-control" placeholder="Password">
                            <span class="error_field" id="password_error"></span>
                        </div>
                        <div class="form-group">
                            <input type="button" value="Login" name="submit" onclick="form_login()" class="btn btn-success btn-block">
                        </div>
                        <span class="error_field" id="result_msg"></span>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Export data to excel in php.</h5>
                <div class="table-responsive">
                    <a href="export.php">
                        <button type="button" class="btn btn-primary">Export</button>
                    </a>
                    <table class="table table-bordered table-sm my-1 text-center">
                        <thead class='thead-dark'>
                            <tr>
                                <th>Name</th>
                                <th>City</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <?php
                        include 'Template_php/connect.php';
                        $sql = "select * from exporthtml";
                        $result = mysqli_query($con, $sql);
                        ?>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['city']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                </tr>
                        </tbody>
                    <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="align_para">
                    <h4>Heading 1</h4>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero amet consectetur nisi cum soluta voluptas, alias deleniti modi voluptatum perspiciatis omnis temporibus error quaerat officia fuga accusantium, aperiam voluptate illum.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="align_para">
                    <h4>Heading 2</h4>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero amet consectetur nisi cum soluta voluptas, alias deleniti modi voluptatum perspiciatis omnis temporibus error quaerat officia fuga accusantium, aperiam voluptate illum.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="align_para">
                    <h4>Heading 3</h4>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero amet consectetur nisi cum soluta voluptas, alias deleniti modi voluptatum perspiciatis omnis temporibus error quaerat officia fuga accusantium, aperiam voluptate illum.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--How to Create a Carousel-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div id="demo" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                    </ul>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="Images\los-angeles.jpg" alt="Los Angeles" width="1365" height="300">
                            <div class="carousel-caption">
                                <h3>Los Angeles</h3>
                                <p>We had such a great time in LA!</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="Images\chicago.jpg" alt="Chicago" width="1365" height="300">
                            <div class="carousel-caption">
                                <h3>Chicago</h3>
                                <p>Thank you, Chicago!</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="Images\newyork.jpg" alt="New York" width="1365" height="300">
                            <div class="carousel-caption">
                                <h3>New York</h3>
                                <p>We love the Big Apple!</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="align_para">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam totam inventore est fugit nam, minima alias ratione voluptas velit, ullam error, ab distinctio rerum voluptates similique! Cumque repudiandae consectetur aliquam pariatur velit assumenda ullam laudantium similique sint necessitatibus nulla sapiente vitae facere, mollitia non itaque fugit at! Itaque distinctio optio laborum esse accusantium autem iure eaque a sapiente amet, voluptas aperiam facilis numquam exercitationem modi. Laborum perspiciatis fuga aliquid, omnis asperiores ab nam facilis adipisci consequatur laudantium repellendus aperiam necessitatibus nisi velit illo voluptatum esse tempora enim sit beatae hic sequi, praesentium assumenda? Nulla atque placeat magnam eveniet soluta aperiam saepe! Ut earum quidem adipisci eius, quas veniam harum magnam porro consequuntur, omnis modi fuga temporibus pariatur exercitationem et molestias.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis dicta sapiente esse nihil amet, magni obcaecati voluptates odit dolores nemo, doloribus et autem nostrum, officia optio cum. Voluptate soluta eum sequi numquam exercitationem cum ipsam minus non fuga voluptatem officia adipisci tempore unde accusamus culpa atque reprehenderit debitis hic nostrum omnis, deserunt reiciendis autem! Ullam quam dolorum aperiam fugit nostrum asperiores beatae eligendi laudantium omnis expedita aspernatur, soluta voluptate? Exercitationem quos dolor unde nulla quam eos delectus accusantium vel iste aliquid, quidem quia, officiis cupiditate deleniti architecto repellat voluptate iusto, natus blanditiis ipsam porro facilis magni at? Eos quibusdam rerum dolorum amet maiores magnam totam hic at commodi, voluptas quae, libero tenetur magni sapiente numquam nulla. Repudiandae qui beatae libero adipisci, deserunt, debitis autem consectetur nam quisquam veniam nemo atque quam explicabo at laboriosam provident vero molestias hic dolore vitae. Aspernatur rerum, velit doloribus sequi veniam porro laudantium tempora consequatur.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur eum et recusandae debitis, nostrum nobis libero maxime quisquam placeat blanditiis odio ducimus, incidunt molestiae fugiat fuga necessitatibus tenetur hic, cupiditate tempore voluptatem voluptatum minus? Doloremque, ducimus? Pariatur id corrupti eligendi dolores dicta quas odio soluta omnis inventore rerum, praesentium officia, optio ut obcaecati iusto. Dignissimos voluptas sunt facilis veritatis? Similique, vel ipsam exercitationem, voluptatem repellendus dolore quis delectus corrupti distinctio minima blanditiis nam iusto et sunt consequuntur fugiat saepe, asperiores praesentium ea explicabo nemo? Quibusdam, eaque sequi! Distinctio, assumenda a illum, id quisquam obcaecati cum beatae repellendus corporis eius, doloremque qui possimus cumque ratione sed. Consectetur fugit aut eum eligendi doloremque facilis perferendis atque, quam tenetur eveniet minus delectus nam a magnam voluptas amet ex dolor eaque voluptatum nulla labore quisquam, asperiores quod. Labore pariatur deleniti, officiis consequatur eveniet esse, nostrum accusamus inventore nobis temporibus sunt vero suscipit? Et consequatur officia numquam! Quidem sint, temporibus commodi assumenda consequuntur ipsum animi perspiciatis. Necessitatibus mollitia maxime a consectetur similique reprehenderit quo, ullam omnis facilis nesciunt repellat animi magnam molestiae porro tempora non dignissimos quis placeat totam aperiam? Consequatur sit in ab repellat quidem recusandae velit dolor rerum ratione totam enim similique obcaecati doloribus veniam laboriosam assumenda magnam inventore nam cupiditate nostrum, labore quia tempore fugiat officia. Minima et nisi, repudiandae iure at sequi excepturi nesciunt culpa natus sint aliquam magni eius iste eos dignissimos, quis beatae, molestias veritatis necessitatibus! Distinctio veritatis consectetur provident dolorem ex repudiandae! Explicabo expedita similique unde veritatis eveniet nesciunt accusamus error nostrum in neque ullam, placeat deserunt fugit laudantium qui doloremque modi? Fugiat illum ratione ipsum veniam, temporibus voluptatibus perspiciatis recusandae eius non alias mollitia nemo odit sed quisquam reprehenderit dolore quae doloremque nam ullam aut doloribus omnis obcaecati molestiae blanditiis? Recusandae architecto quos ea aliquam dolor incidunt nisi quod quia doloribus laboriosam, asperiores, blanditiis maxime tempore assumenda tenetur vero maiores dolorum alias id. Cupiditate voluptate molestiae incidunt facilis ex aliquam voluptates doloribus quam. Dolores enim modi quaerat quisquam voluptates autem mollitia architecto nemo incidunt consectetur repellendus laboriosam nihil similique dicta possimus, cum veniam nobis suscipit ipsum tempora aliquid? Exercitationem maiores delectus impedit vero quos, quia ullam cum aut est rerum ducimus sint sunt, expedita tenetur vel quisquam minima consequuntur, nulla tempora. Dolore totam explicabo quidem consectetur. Molestiae at fugiat excepturi omnis minima. Dicta aut alias ducimus pariatur impedit voluptate inventore aspernatur itaque facere nulla quod iure, corrupti vel consequuntur et atque. Obcaecati vel officia numquam tempore autem pariatur explicabo totam veritatis blanditiis, asperiores dolorum ex iusto quam earum eos nesciunt accusamus quasi non iste ad suscipit tenetur necessitatibus dignissimos. Iusto, repellat minima. Enim vitae nostrum quisquam pariatur numquam dolorem dolorum minus perspiciatis? Officia veritatis necessitatibus, ad corrupti pariatur hic itaque dolorum quia error eligendi voluptatibus nisi ducimus aliquam nobis vero perspiciatis facere consequatur a molestias id! Quos aut labore iste officiis autem? Maxime quam quia consectetur nesciunt exercitationem eum minus optio vel commodi perferendis, nisi tempora, fugit doloribus, sit ullam similique placeat necessitatibus! Nemo odio repellendus magni!
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Scroll to back top button -->
    <a href="javascript:void(0)" id="go_top">
        <i class="icon-chevron-up"></i>
    </a>

    <?php
    // jquery_script.php
    include 'jquery_script.php';
    ?>

</body>

</html>
