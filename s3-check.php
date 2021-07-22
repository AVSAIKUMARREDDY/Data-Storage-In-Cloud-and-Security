<?php
	include 'db-s3-sns.php';
	$total = count($_FILES['upload']['name']);
	echo "total no of selected files ".$total."</br>";
	flush();
	ob_flush();
	$size=0;
	for( $i=0 ; $i < $total ; $i++ )
		$size+= filesize($_FILES['upload']['tmp_name'][$i]);
	echo "total size of selected files ".($size/1024)."KB"."</br>";
	echo "uploading started <br/>";
	flush();
	ob_flush();
	$per=0;
	for( $i=0 ; $i < $total ; $i++ ) {
		$file  = $_FILES['upload']['tmp_name'][$i];
		$file_name=$_FILES['upload']['name'][$i];
		$type=$_FILES['upload']['type'][$i];

		if(strpos($file_name,".jpg")!==false)
			$test="rgb/";
		elseif(strpos($file_name,".BMT")!==false)
			$test="thermal/";
		elseif(strpos($file_name,"spectro")!==false)
			$test="spectroscopy/";
		else
			$test="ultrasonic/";
	$s3client->putObject(array(
     		'Bucket'     => 'my-rgb-bucket-matic',
    		'SourceFile' => $file,
		'Key'        => "parent/".$test.$file_name,
		'ContentType' =>$type, 
    		'ContentDisposition' => 'inline', 
    		'ACL'          => 'public-read'
	));
	$per+=(filesize($file)/$size)*100;
	echo "percentage uploaded ".$per." % </br>";
	flush();
	ob_flush();
}	
    echo "finished uploading </br>";	
	flush();
	ob_flush();
	$_SESSION['bucket']="my-rgb-bucket-matic";
        $_SESSION['directory']="parent";
	$_SESSION['activity']=$_SESSION['activity']." uploaded : " .$_SESSION['directory'].",";
?>
