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
$events = json_decode($content, true);

if (!is_null($events['events'])) {
    //Loop through each event 
    foreach ($events['events'] AS $event) {

        //Get replyToken
        $replyToken = $event['replyToken'];
//        $ask = $event['message']['text'];
//
//        switch (strtolower($ask)) {
//            case 'm':
//                $respMessage = 'What sup man.Go away!';
//                break;
//            case 'f':
//                $respMessage = 'Love you lady.';
//                break;
//            default:
//                $respMessage = 'What is your sex? M or F';
//                break;
//        }

        $httpClient = new CurlHTTPClient($channel_token);
        $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
//        $textMessageBuilder = new TextMessageBuilder($respMessage);
//        $response = $bot->replyMessage($replyToken, $textMessageBuilder);

        $actionBuilder = array(
            new MessageTemplateActionBuilder(
                'Message Template',// ข้อความแสดงในปุ่ม
                'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
            ),
            new UriTemplateActionBuilder(
                'Uri Template', // ข้อความแสดงในปุ่ม
                'https://www.ninenik.com'
            ),
            new DatetimePickerTemplateActionBuilder(
                'Datetime Picker', // ข้อความแสดงในปุ่ม
                http_build_query(array(
                    'action' => 'reservation',
                    'person' => 5
                )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
                'datetime', // date | time | datetime รูปแบบข้อมูลที่จะส่ง ในที่นี้ใช้ datatime
                substr_replace(date("Y-m-d H:i"), 'T', 10, 1), // วันที่ เวลา ค่าเริ่มต้นที่ถูกเลือก
                substr_replace(date("Y-m-d H:i", strtotime("+5 day")), 'T', 10, 1), //วันที่ เวลา มากสุดที่เลือกได้
                substr_replace(date("Y-m-d H:i"), 'T', 10, 1) //วันที่ เวลา น้อยสุดที่เลือกได้
            ),
            new PostbackTemplateActionBuilder(
                'Postback', // ข้อความแสดงในปุ่ม
                http_build_query(array(
                    'action' => 'buy',
                    'item' => 100
                )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
                'Postback Text'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
            ),
        );
        $imageUrl = 'https://www.mywebsite.com/imgsrc/photos/w/simpleflower';
        $replyData = new TemplateMessageBuilder('Button Template',
            new ButtonTemplateBuilder(
                'button template builder', // กำหนดหัวเรื่อง
                'Please select', // กำหนดรายละเอียด
                $imageUrl, // กำหนด url รุปภาพ
                $actionBuilder  // กำหนด action object
            )
        );

        $response = $bot->replyMessage($replyToken, $replyData);

    }
}
echo "OK";