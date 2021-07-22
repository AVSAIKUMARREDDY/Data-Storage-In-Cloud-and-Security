<?php
include 'db-s3-sns.php';
$topic="arn:aws:sns:us-east-1:544826746679:upload-done-to-s3";
$message="{\"bucket\":\"".$_SESSION['bucket']."\","."\"directory\":\"".$_SESSION['directory']."\"}";
echo $message;
try{
    $result = $snsclient->publish([
        'Message' => $message,
        'TopicArn' => $topic
    ]);
} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
} 

?>
