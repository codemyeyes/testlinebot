<?php
require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token = '6Dp095D57jSNkHOBVUW/VxnZzTJeiNvMb8i4WKevKX51CXUx1Ww4Ym3qwMiqWFmrL3nr+5EZJwcU1UIN/JLawSiAyiCIfbVP7LSycYRx/QISOJDBqsjczyJUlSkS/kWOffmiGTzmIY02IZh/0lvRPwdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'ec9368121f4aa1a96f2be3bb7def2cd0';

$httpClient = new CurlHTTPClient($channel_token);
$bot = new LINEBot($httpClient, array('channelSecret'=> $channel_secret));

//Get message from Line API
$content = file_get_contents('php://input');
$events=json_decode($content, true);

if (!is_null($events['events'])) {
    //Loop through each event 
    foreach($events['events'] AS $event){
    // Line API send a lot of event type, we interested in message only. 
        if ($event['type'] == 'message') {
            //Get replyToken
            $replyToken = $event['replyToken']; 

            switch($event['message']['type']) {
                case 'audio':
                    $messageID = $event['message']['id']; 

                    //Create video file on server.
                    $fileID = $event['message']['id'];
                    $response = $bot->getMessageContent($fileID); 
                    $fileName = 'linebot.m4a'; 
                    $file=fopen($fileName, 'w');
                    fwrite($file, $response->getRawBody());

                    $respMessage='Hello, your audio ID is '.$messageID;
                    break;
                default:
                    $respMessage='Please send audio only';
                    break;
            }
            $textMessageBuilder = new TextMessageBuilder($respMessage);
            $response=$bot->replyMessage($replyToken, $textMessageBuilder);
        }
    }   
}
echo "OK";