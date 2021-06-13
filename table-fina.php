<?php
include 'db-s3-sns.php';
session_start();
if($_SESSION['verify']=='false')
        {
                header('Location: login1.html');
                exit();
        }

if(isset($_POST['logout']))
	{
		$dat=date("Y-m-d h:i:sa");
		$cur=new DateTime($dat);

		$diff=$cur->diff($_SESSION['time-stamp']);

		$duration=(($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i);
		//print_r($_SESSION['activity']);
		$item = $marshaler->marshalJson('
                                {       "time-stamp":"'.$_SESSION['time-stamp']->format('Y-m-d H:i:sa').'",
                                        "username": "'.$_SESSION['username'].'",
					"status":"'.$_SESSION['status'].'",
					"duration(mins)":"'.$duration.'",
					"logout":"'.$dat.'",
					"activity":"'.$_SESSION['activity'].'"
                                }
                                ');
                        $params=[
                                        'TableName'=>'login-users',
                                        'Item'=>$item
                                ];
				$dynamodbclient->putItem($params);
				session_destroy();
                                 header( "Location: login1.html" );

		exit();
	}
elseif(isset($_POST['upload']))
	{       
		header("Location: upload.php");
		exit();
	}


?>
<!DOCTYPE html>
        <html>
        <head>
                <link rel="stylesheet" href="css/table.css">
        </head>
        <body>

	<h2 style="text-align: center;">welcome mr/ms <?php echo $_SESSION['username']; ?> </h2>
         <form method="post">
	<input type="submit" name="logout" value="logout">
        
        <input type="submit" name="upload" value="upload">
         </form>
        <table style="width:100%;border: 1px solid lightgray;">
    <tr>
    <th>ID</th>
    <th>RGB</th>
    <th>THERMAL</th>
    <th>SPECTROSCOPY</th>
    <th>ULTRASONIC</th>
  </tr>
	<?php
		$params = [
    			'TableName' => 'CoconutParametres',
    			'ProjectionExpression' => '#id,rgb,thermal,spectroscopy,ultrasonic',
     			'ExpressionAttributeNames'=> [ '#id' => 'id' ]
			];
                 try{
    			while (true) {
				$result = $dynamodbclient->scan($params);
       			foreach ($result['Items'] as $i) {
				$coconut=$marshaler->unmarshalItem($i);
				echo "<tr> <td>{$coconut['id']}</td>";
				echo "<td>";
				$x=0;
				foreach ($coconut['rgb'] as $rgb)
				{      $x=$x+1;
					echo "<a href=$rgb> image$x </a>";	
				}
				
				echo " $x </td><td>";
                               $x=0;
				foreach ($coconut['thermal'] as $rgb)
				{$x=$x+1;
				 echo "<a href=$rgb> thermal$x </a>";
				}
                                         
				echo " $x</td><td>";
				$x=0;
				foreach ($coconut['spectroscopy'] as $rgb)
				{$x=$x+1;
				echo "<a href=$rgb> spectroscopy$x </a>";
				}
				echo " $x</td><td>";
				$x=0;
				foreach ($coconut['ultrasonic'] as $rgb)
				{$x=$x+1;
				echo "<a href=$rgb> ultrasonic$x </a>";
				}
				echo " $x</td></tr>";
				flush();
				ob_flush();
			}
			if (isset($result['LastEvaluatedKey'])) {
            		$params['ExclusiveStartKey'] = $result['LastEvaluatedKey'];
        		} else {
            			break;
			}
			}
		 }

    			

		 catch (DynamoDbException $e) {
    			echo "Unable to scan:\n";
    			echo $e->getMessage() . "\n";
			}

                  ?>

   
</table>
</body>
</html>
