<?php
error_reporting(0);
ini_set('display_errors', 0);
    require_once 'db_conn.php';
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    if($role=="receptionist")
    {
        $query1="select otp from recptb where email='$email'";
        $query2="update recptb set password='$password' where email='$email'";
        $query3="update recptb set otp=NULL where email='$email'";
    }
    elseif($role=="doctor")
    {
        $query1="select otp from doctb where email='$email'";
        $query2="update doctb set password='$password' where email='$email'";
        $query3="update doctb set otp=NULL where email='$email'";
    }
    else
    {
        $query1="select otp from patreg where email='$email'";
        $query2="update patreg set password='$password' where email='$email'";
        $query3="update doctb set otp=NULL where email='$email'";
    }
	$result=mysqli_query($con,$query1);
	if(mysqli_num_rows($result)==1)
    {
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            if($row['otp']==$otp && $row['otp']!=null)
            {
	            $result=mysqli_query($con,$query2);
	            $result=mysqli_query($con,$query3);
                echo "Password changed successfully. <br>";
                echo "<a href='index1.php'>Login</a>";
            }
            else
            {
                echo "Invalid OTP <br>";
                echo "<a href='javascript:history.back()'>Re-Enter OTP</a>";
            }
        }
    }
?>
