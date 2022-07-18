<?php
//receptionist login
error_reporting(0);
ini_set('display_errors', 0);
session_start();
require_once 'db_conn.php';
if(isset($_POST['adsub'])){
	$username=$_POST['username1'];
	$password=$_POST['password2'];
	$query="select * from recptb where username='$username'";
	$result=mysqli_query($con,$query);
	$row=mysqli_fetch_array($result);
  	$hash=$row['password'];
  	if (password_verify($password, $hash)) {
		$_SESSION['receptionist'] = $row['username'];
		$_SESSION['username'] = $row['username'];
		header("Location:admin-panel1.php");
  	} else {
  	  echo("<script>alert('Invalid Username or Password. Try Again!');
          window.location.href = 'index3.php';</script>");
  	}
}
else
{
	if(isset($_SESSION['receptionist'])){
		//if user logged in
	
		if(isset($_POST['update_data']))
		{
			$contact=$_POST['contact'];
			$status=$_POST['status'];
			$query="update appointmenttb set payment='$status' where contact='$contact';";
			$result=mysqli_query($con,$query);
			if($result)
				header("Location:updated.php");
		}
	
	
	
	
		function display_docs()
		{
			global $con;
			$query="select * from doctb";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			{
				$name=$row['name'];
				# echo'<option value="" disabled selected>Select Doctor</option>';
				echo '<option value="'.$name.'">'.$name.'</option>';
			}
		}
	
		if(isset($_POST['doc_sub']))
		{
			$name=$_POST['name'];
			$query="insert into doctb(name)values('$name')";
			$result=mysqli_query($con,$query);
			if($result)
				header("Location:adddoc.php");
		}
	}
	else
	{
	  header("Location:index3.php");
	}
}