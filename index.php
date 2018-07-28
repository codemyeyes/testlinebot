<?php
require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token = '4nSgLi2JvUwvnTVc43xg1GhB2I6cNcbfD0ETN1iSfLJfR2dU2nHjvy9oLXqhAx3lL3nr+5EZJwcU1UIN/JLawSiAyiCIfbVP7LSycYRx/QIFNbBcjLhhftxqEmgnDhyh7Y4kHox48oZ/cxEQASoleQdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'ec9368121f4aa1a96f2be3bb7def2cd0';

//Get message from Line API
$content = file_get_contents('php://input');
$events=json_decode($content, true);

if (!is_null($events['events'])) {
    //Loop through each event 
    foreach($events['events']as $event){
    // Line API send a lot of event type, we interested in message only. 
        if ($event['type'] == 'message') {
            switch($event['message']['type']) {
                case 'text':

                    //Get replyToken
                    $replyToken = $event['replyToken']; 
                    
                    //Reply message
                    $respMessage='Hello, your message is '.$event['message']['text'];

                    $httpClient=newCurlHTTPClient($channel_token); 
                    $bot=newLINEBot($httpClient, array('channelSecret'=> $channel_secret)); 
                    $textMessageBuilder=newTextMessageBuilder($respMessage);
                    $response=$bot->replyMessage($replyToken, $textMessageBuilder); 
                break;
            } 
        }
    }   
}
echo "OK";