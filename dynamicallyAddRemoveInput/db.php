<?php
try{
	$con=new PDO("mysql:host=localhost;dbname=phpapp","root","");
}catch(PDOExection $e){
	echo $e->getMessage();
}
?>