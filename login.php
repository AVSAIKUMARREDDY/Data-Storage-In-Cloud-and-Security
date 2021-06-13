<?php 
session_start();
include 'db-s3-sns.php';

$_SESSION["verify"] = "false";
$_SESSION['activity']="";

$username = $_POST['username'];
$password=$_POST['password'];
//$username="saikumar";
//$password="12345";
$_SESSION['username']=$username;
$_SESSION['time-stamp']=new DateTime(date("Y-m-d h:i:sa"));
if(isset($_POST['username']) and isset($_POST['password']))
{       
	
    	$password=hash("sha256",$password);
	$key = $marshaler->marshalJson('
    	{
        	"username": "'.$username .'", 
        	"password": "'.$password.'"
    	}
	');
	$params = [
   	 		'TableName' => 'credentials',
   	 		'Key' => $key
		];


	try{
		
		$result = $dynamodbclient->getItem($params);
		if(sizeof($result['Item'])==3)
			{	//echo $result['Item']['mail']['S'];
				$_SESSION["verify"] = "true";
				$_SESSION['status']="success";
				$_SESSION['mail']=$result['Item']['mail']['S'];
				include 'otpmail.php'; 
				header( "Location: otp.php" );
				exit();

			}
		else
		{	echo 'unsuccesful login';
			$item = $marshaler->marshalJson('
        			{       "time-stamp":"'.$_SESSION['time-stamp']->format('Y-m-d H:i:sa').'",
					"username": "'.$username.'",
					"status":"failure"
				}
        			');
			$params=[
					'TableName'=>'login-users',
					'Item'=>$item
				];
				$dynamodbclient->putItem($params);
				header( "Location: login1.html" );

			exit();
		}
	}
	catch (DynamoDbException $e) {
    					echo "Unable to add item:\n";
    					echo $e->getMessage() . "\n";
				     }


}
?>
