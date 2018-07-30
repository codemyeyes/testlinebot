<?php
require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token = '6Dp095D57jSNkHOBVUW/VxnZzTJeiNvMb8i4WKevKX51CXUx1Ww4Ym3qwMiqWFmrL3nr+5EZJwcU1UIN/JLawSiAyiCIfbVP7LSycYRx/QISOJDBqsjczyJUlSkS/kWOffmiGTzmIY02IZh/0lvRPwdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'ec9368121f4aa1a96f2be3bb7def2cd0';

//Get message from Line API
$content = file_get_contents('php://input');
$events=json_decode($content, true);

if (!is_null($events['events'])) {
    //Loop through each event 
    foreach($events['events'] AS $event){

        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            //Get replyToken
            $replyToken = $event['replyToken']; 

            $appointments=explode(',', $event['message']['text']);

            if(count($appointments) == 2) {
                $host = 'ec2-174-129-223-193.compute-1.amazonaws.com';
                $dbname = 'd74bjtc28mea5m'; 
                $user = 'eozuwfnzmgflmu';
                $pass = '2340614a293db8e8a8c02753cd5932cdee45ab90bfcc19d0d306754984cbece1'; 
                $connection=newPDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
                
                $params = array(
                    'time'=> $appointments[0], 
                    'content'=> $appointments[1],
                );
                $statement=$connection->prepare("INSERT INTO appointments (time, content)VALUES(:time,:content)");
                $result = $statement->execute($params);
                $respMessage='Your appointment has saved.';
            }else{
                $respMessage='You can send appointment like this "12.00,House keeping."';
            }

            $httpClient = new CurlHTTPClient($channel_token);
            $bot = new LINEBot($httpClient, array('channelSecret'=> $channel_secret));

            $textMessageBuilder = new TextMessageBuilder($respMessage);
            $response=$bot->replyMessage($replyToken, $textMessageBuilder);
            
        }
        
    }   
}
echo "OK";