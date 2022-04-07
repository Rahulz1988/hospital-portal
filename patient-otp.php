<?php
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    $password = $_POST['password'];
    $con=mysqli_connect("localhost","root","","myhmsdb");
    $query="select otp from patreg where email='$email';";
	$result=mysqli_query($con,$query);
	if(mysqli_num_rows($result)==1)
    {
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            if($row['otp']==$otp)
            {
                $query="update patreg set password='$password' where email='$to_email';";
	            $result=mysqli_query($con,$query);
            }
        }
    }
?>
