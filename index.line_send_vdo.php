<?php
require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
// use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
// use \LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
// use \LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use \LINE\LINEBot\MessageBuilder\VideoMessageBuilder;

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

        // Video
        $originalContentUrl = 'https://www.select2web.com.com/the-fuji.mp4'; 
        $previewImageUrl = 'https://www.select2web.com.com/the-fuji.jpg';

        $httpClient = new CurlHTTPClient($channel_token);
        $bot = new LINEBot($httpClient, array('channelSecret'=> $channel_secret));
        
        $textMessageBuilder = new VideoMessageBuilder($originalContentUrl, $previewImageUrl);
        $response=$bot->replyMessage($replyToken, $textMessageBuilder);
    }   
}
echo "OK";