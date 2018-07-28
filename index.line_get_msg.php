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
    // Line API send a lot of event type, we interested in message only. 
        if ($event['type'] == 'message') {
            switch($event['message']['type']) {
                case 'text':

                    //Get replyToken
                    $replyToken = $event['replyToken']; 
                    
                    //Reply message
                    $respMessage='Hello, your message is ' . $event['message']['text'];

                    $httpClient = new CurlHTTPClient($channel_token); 
                    $bot = new LINEBot($httpClient, array('channelSecret'=> $channel_secret)); 
                    $textMessageBuilder = new TextMessageBuilder($respMessage);
                    $response=$bot->replyMessage($replyToken, $textMessageBuilder); 
                break;
            } 
        }
    }   
}
echo "OK";