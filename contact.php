<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
if(isset($_SESSION['admin']) || isset($_SESSION['receptionist']) || isset($_SESSION['doctor']) || isset($_SESSION['patient'])){
	//if user logged in
	//do nothing
}
else
{
	header("Location:index1.php");
}
require_once 'db_conn.php';
if(isset($_POST['btnSubmit']))
{
	$name = $_POST['txtName'];
	$email = $_POST['txtEmail'];
	$contact = $_POST['txtPhone'];
	$message = $_POST['txtMsg'];

	$query="insert into contact(name,email,contact,message) values('$name','$email','$contact','$message');";
	$result = mysqli_query($con,$query);
	
	if($result)
    {
    	echo '<script type="text/javascript">'; 
		echo 'alert("Message sent successfully!");'; 
		echo 'window.location.href = "contact.html";';
		echo '</script>';
    }
}