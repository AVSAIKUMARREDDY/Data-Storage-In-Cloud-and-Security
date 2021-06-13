<?php
session_start();
if(isset($_POST['submit']))
	{
		if($_POST['otp']==$_SESSION['otp'])
		{	header("Location: table-fina.php");
			exit();
		}
		else
		{        
			 echo '<script type ="text/JavaScript">';  
			echo 'alert("invalid otp please enter agian only 3 chances furtehr it will close")';  
			 echo '</script>';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta dir="ltr">
     <meta name="viewport" content="width=device-width,initial-scale=1.0"> 
     <title>MATIC</title>
     <link rel="stylesheet" href="css/login.css">
     
</head>
<body>

        <div class="limiter">
                <div class="container-login100" style="background-image: url('images/1.jpg');">
                        <div class="wrap-login100 p-t-30 p-b-50">
                                <span class="login100-form-title p-b-41">
                                MATIC
                                </span>
                                <form class="login100-form validate-form p-b-33 p-t-5" method="POST">

                                        <div class="wrap-input100 validate-input" data-validate = "Enter username">
                                                <input class="input100" type="text" name="otp" placeholder="enter-otp-receievd-in-mail">
                                                <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                                        </div>

                                        <div class="container-login100-form-btn m-t-32">
                                         <input class="login100-form-btn" type="submit" name="submit" value="LOGIN">
                                        </div>



                                </form>
                       </div>
                </div>
        </div>

        <div id="dropDownSelect1"></div>

</body>
</html>

