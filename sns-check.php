<?php
$topic="arn:aws:sns:us-east-1:544826746679:upload-done-to-s3";
$message="{\"bucket\":\"$bucket\",\"directory\":\"$directory\"}";

try {
    $result = $snsclient->publish([
        'Message' => $message,
        'TopicArn' => $topic
    ]);
} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
} 

?>
