<?php
	include 'db-s3-sns.php';
       $pat=$_POST['myfile'];
        echo "<br/> selected folder :  ".$pat."<br />";
        $basesource =$pat;
        $directory=explode("/",$pat);
        $directory=$directory[count($directory)-1];
        $basedest = 's3://my-rgb-bucket-matic';
        $bucket="my-rgb-bucket-matic";
        $inc=0;
        $per=100/(count(scandir($basesource))-2);
	$basedest=$basedest.'/'.$directory.'/';
	echo "uploading started <br/>";
	flush();
	ob_flush();
	echo " percentage uploaded $inc% please be patient <br/>";
        flush();
        ob_flush();

        foreach(scandir($basesource) as $i)
        {
                if(!($i=='.' or  $i=='..'))
		{       
			echo "$i has been uplaoding <br/>";
			flush();
			ob_flush();
                        $manager = new \Aws\S3\Transfer($s3client, $basesource.'/'.$i, $basedest.$i);
                        $manager->transfer();
			echo "$i uploaded <br/>";
			flush();
			ob_flush();
			$inc=$inc+$per;
			echo " percentage uploaded $inc% please be patient <br/>";
			flush();
			ob_flush();
		}
	       	
	}
	$_SESSION['activity']=$_SESSION['activity']." uploaded : " .$directory.",";
 
?>
