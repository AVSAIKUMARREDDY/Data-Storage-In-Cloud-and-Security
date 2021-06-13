<?php

require '../vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;



$marshaler = new Marshaler();
$dynamodbclient= DynamoDbClient::factory(array(
                 'region'  => 'us-east-1',
		 'version' => 'latest'
		 ));

use Aws\S3;
use Aws\S3\S3Client;
use Aws\Credentials\CredentialProvider;

$s3client = new S3Client([
    'region' => 'us-east-1',
    'version' => 'latest'
]);

use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;

$snsclient = new SnsClient([
    'region' => 'us-east-1',
    'version' => 'latest'
]);

?>
