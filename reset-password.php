<?php
error_reporting(0);
ini_set('display_errors', 0);
    require_once 'db_conn.php';

    //send email
    function sendMail($email, $otp, $role)
    {
        $subject = "OTP to reset password";

        $message = $otp."<b>is the OTP for resetting your Souparnika account password.</b>";
        $message .= "<h1>This is headline.</h1>";

        $header = "From:noreply@souparnikahealth.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $retval = mail ($email,$subject,$message,$header);

        if( $retval == true ) {
            echo '
            <!doctype html>
            <html lang="en-US">
                
                <head>
                    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                    <title>Reset Password</title>
                    <meta name="description" content="Reset Password.">
                    <style type="text/css">
                        a:hover {text-decoration: underline !important;}
                    </style>
                </head>
                
                <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                    <!--100% body table-->
                    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
                        <tr>
                            <td>
                                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                                    align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="height:80px;">&nbsp;</td>
                                    </tr>
                                        <td style="height:20px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                                <tr>
                                                    <td style="height:40px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:0 35px;">
                                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family: Rubik,sans-serif;">You have
                                                            requested to reset your password</h1>
                                                        <span
                                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                                            Please Check your email also in spam folder to get the otp. 
                                                        </p>
                                                        <form action="verify-otp.php" method="POST">
                                                            <input type="text" placeholder="Enter OTP" name="otp" style="border-color:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px; required">
                                                            <input type="text" placeholder="New Password" name="password" style="border-color:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px; required">
                                                            <input type="text" name="email" value="'.$email.'" hidden readonly required">
                                                            <input type="text" name="role" value="'.$role.'" hidden readonly required">
                                                            <br>
                                                            <input type="submit" style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;" vlaue="Reset Password">
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="height:40px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    <tr>
                                        <td style="height:20px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="height:80px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--/100% body table-->
                </body>
            
            </html>';
        }else {
           echo "OTP could not be sent...";
        }
    }

    //setting otp
    $role=$_POST['role'];
    $email=$_POST['email'];
    $otp = mt_rand(1000,9999);

    if($role=="receptionist")
    {
        $query="update recptb set otp='$otp' where email='$email'";
    }
    elseif($role=="doctor")
    {
        $query="update doctb set otp='$otp' where email='$email'";
    }
    else
    {
        $query="update patreg set otp='$otp' where email='$email'";
    }
    $result=mysqli_query($con,$query);
    if($result)
    {
        sendMail($email, $otp, $role);
    }
    else
    {
        echo "Account not found !";
    }
?>