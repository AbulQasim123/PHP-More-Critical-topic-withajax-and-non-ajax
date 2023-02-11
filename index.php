<?php 
	// echo "<h2>hello world</h2>";
	$name=  $city = $education_str = $education = $gender = $malechecked = $femalechecked = "";
	
	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		$password = $_POST['password'];
		$city = $_POST['city'];
		if (isset($_POST['gender'])) {
			$gender = $_POST['gender'];
			if ($gender == 'Male') {
				$malechecked = "checked='checked' ";
			}
			if ($gender== 'Female') {
				$femalechecked = "checked= 'checked' ";
			}
		}
		
		if (isset($_POST['education'])) {
			$education = $_POST['education'];
			// $education_str = implode(" , " , $education);
		}
		echo "Name= $name <br>";
		echo "Password= $password <br>";
		echo "City= $city <br>";
		echo "Gender= $gender <br>";
		echo "education= $education <br>";
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Practical</title>
	<script src="crudapp\config\jquery-3.6.0.min.js"></script>
	<script src="jquery-ui-1.12.1\jquery-ui.min.js"></script>
    <script src="bootstrap-4.0.0-dist\js\bootstrap.min.js"></script>
	<link rel="stylesheet" href="bootstrap-4.0.0-dist\css\bootstrap.min.css">
	<link rel="stylesheet" href="jquery-ui-1.12.1\jquery-ui.min.css">
	<link rel="stylesheet" href="font-awesome\css\font-awesome.css">
	<base href="Images/"></base>
	
</head>
<body>
    <div class="container-fluid">
    	<h5>Complete tutorials for php form handling.</h5>
		<div class="row">
			<div class="col-lg-6">
				<form action="" method="post">
					<div class="form-group">
							<label for="name" class="font-weight-bold">Name</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?php echo $name?>">
					</div>
					<div class="form-group">
						<label for="password" class="font-weight-bold">Password</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password">
					</div>
					<div class="form-group">
						<label for="gender" class="font-weight-bold">Gender</label>
						<div class="form-control">
							<b>Male </b> <input type="radio" name="gender" id="male" class="" value="Male" <?php echo $malechecked; ?>>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<b>Female </b> <input type="radio" name="gender" id="female" class="" value="Female" <?php echo $femalechecked; ?>>
						</div>
					</div>
					<div class="form-group">
						<label for="city" class="font-weight-bold">City</label>
						<?php
							$city_Arr= array("Delhi", "Kanpur", "Allhabad", "Aligrah", "Hydrabad");
						?>
						<select name="city" id="city" class="form-control">
							<option value="">Select value</option>
							<?php
								foreach ($city_Arr as $value) {
									$isselect = "";
									if ($city_Arr == $value) {
										$isselect = "selected";
									}
									echo "<option value='$isselect'>" .$value." </option>";
								}
							?>
						</select>
					</div>
					<div class="form-group form-control">
						<label for="education" class="font-weight-bold">Education</label><br>
						<?php
						$education = array();
							$education_array = array('B.tech', 'M.tech', 'B.Sc', 'M.Sc');
							foreach ($education_array as $list) {
								// echo "$list <input type='checkbox' value='$list'  ";
								if (in_array($list, $education)) {
									echo "<b> $list <input type='checkbox' value='$list' checked='checked' name='education'></b>";
								}else{
									echo "<b>$list  <input type='checkbox' value='$list' name='education'></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								}
							}
						?>
					</div>
					<input type="submit" value="Submit" id="btn" name="btn" class="btn btn-primary">
				</form>	
			</div>
			<div class="col-lg-6">
				<h5>One html tag can change everythings. (Important tag)</h5>
				<p><img src="chicago.jpg" class="img-fluid img-thumbnail" style="height: 400px; width: 300px;" alt="Image not found"></p>
				<p><img src="newyork.jpg" class="img-fluid img-thumbnail" style="height: 400px; width: 300px; margin-left:325px; margin-top: -461px;" alt="Image not found"></p>
			</div>
		</div>
	</div>	
			
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-5">
				<h3>Learn php array</h3>
				<ol type="1" class="font-weight-bold">
					<li>Why array are required  ?</li>
					<li>What is array ?</li>
					<li>Type of array ?</li>
					<li>Use of array ?</li>
				</ol>
				<div>1) Because variable store only single information at a time. </div>
				<div>2) Array is a variable which is used to store multiple information at a time.</div>
				<p>3) <b> There are three type of array</b>
					
					<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b>Index Array:-</b> Array with a numeric index.
					<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b>Assoc Array:-</b> Array with named key.
					<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b>Multidimensional Array:-</b> Array containing one or more array.
					
				</p>
			</div>
			<div class="col-md-4">
				<?php
					$array= array('New delhi', 'Noida', 'Farrukhabad', 'Hydrabad','Tamilnadu');
				?>
				<div class="">
					<h4>Use of Array.</h4>
					<label for="city_name" class="font-weight-bold">State</label>
					<select name="city_name" id="city_name" class="form-control">
							<option value="">Select city</option>
							<?php
								foreach ($array as $value) {
									echo "<option>". $value ."</option>";
								}
							?>
					</select>
				</div>
				<div class="">
					<?php
						$arr= array(
							array('S.no', 'Name', 'City'),
							array('1', 'Vishal', 'Delhi'),
							array('2', 'Pawan', 'Noida'),
						);
						// echo "<pre>";
						// print_r($arr);
					?>
					<div style="font-size: 23px;">other uses</div>
					<table class="table table-bordered table-sm">
						
						<?php
							foreach ($arr as $arrlist) {
								echo "<tr>";
									foreach ($arrlist as $arrdetail) {
										echo "<td>". $arrdetail ."</td>";
									}
								echo "</tr>";
							}
						?>
					</table>
				</div>
			</div>
			<div class="col-md-3">
				<div id="barcode">
					<h5>How to generate QR Code using html</h5>
					<img src="https://api.qrserver.com/v1/create-qr-code/?data=HelloWorld&amp;size=250x200" alt="No Barcode found">
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div>
					<h5>Copy text to clipboard using javascript</h5>
					<input type="copy_text" name="text" id="copy_text" class="form-control"><br>
					<button type="button" id="copy_btn" onclick="textcopy()" class="btn btn-primary">Copy</button>
				</div>
				<div>
					<h5>Javascript on/off bulb switch</h5>
					<img src="bulb_off.gif" alt="Image not found" id="set_bulb" class="img-fluid img-thumbnail" style="width: 200px; height: 150px">
					<button type="button" class="btn btn-primary btn-sm" onclick="bulb_on()">On</button>
					<button type="button" class="btn btn-danger btn-sm" onclick="bulb_off()">Off</button>
				</div>
			</div>
		</div>
	</div>
    <script>
			// Copy text to clipboard using javascript
		function textcopy(){
			document.getElementById('copy_text').select();
			document.execCommand('copy');
			document.getElementById('copy_btn').innerHTML= 'Copied';
		}
		function bulb_off(){
			document.getElementById('set_bulb').src= "bulb_off.gif";
		}
		function bulb_on(){
			document.getElementById('set_bulb').src= "bulb_on.gif";
		}
	</script>
    
</body>
</html>