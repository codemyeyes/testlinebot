<?php
require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
// use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use \LINE\LINEBot\MessageBuilder\ImageMessageBuilder;

$channel_token = '6Dp095D57jSNkHOBVUW/VxnZzTJeiNvMb8i4WKevKX51CXUx1Ww4Ym3qwMiqWFmrL3nr+5EZJwcU1UIN/JLawSiAyiCIfbVP7LSycYRx/QISOJDBqsjczyJUlSkS/kWOffmiGTzmIY02IZh/0lvRPwdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'ec9368121f4aa1a96f2be3bb7def2cd0';

//Get message from Line API
$content = file_get_contents('php://input');
$events=json_decode($content, true);

if (!is_null($events['events'])) {
    //Loop through each event 
    foreach($events['events'] AS $event){

        //Get replyToken
        $replyToken = $event['replyToken']; 

        // Image
        $originalContentUrl = 'https://cdn.shopify.com/s/files/1/1217/6360/products/Shinkansen_Tokaido_ShinFuji_001_1e44e709-ea47-41ac-91e4-89b2b5eb193a_grande.jpg?v=1489641827';
        $previewImageUrl = 'https://cdn.shopify.com/s/files/1/1217/6360/products/Shinkansen_Tokaido_ShinFuji_001_1e44e709-ea47-41ac-91e4-89b2b5eb193a_grande.jpg?v=1489641827';

        $httpClient = new CurlHTTPClient($channel_token);
        $bot = new LINEBot($httpClient, array('channelSecret'=> $channel_secret));
        
        // $textMessageBuilder = new TextMessageBuilder($respMessage);
        $textMessageBuilder = new ImageMessageBuilder($originalContentUrl, $previewImageUrl);
        $response=$bot->replyMessage($replyToken, $textMessageBuilder);
    }   
}
echo "OK";