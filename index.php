<?php
require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token = '6Dp095D57jSNkHOBVUW/VxnZzTJeiNvMb8i4WKevKX51CXUx1Ww4Ym3qwMiqWFmrL3nr+5EZJwcU1UIN/JLawSiAyiCIfbVP7LSycYRx/QISOJDBqsjczyJUlSkS/kWOffmiGTzmIY02IZh/0lvRPwdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'ec9368121f4aa1a96f2be3bb7def2cd0';

$httpClient = new CurlHTTPClient($channel_token);
$bot = new LINEBot($httpClient,array('channelSecret' =>$channel_secret));

$host = 'ec2-23-21-238-28.compute-1.amazonaws.com';
$dbname = 'd5hb6iga0kqmnd'; 
$user = 'qjpjdxczqljfdi';
$pass = '51bf424af67c828b222d1fff444a74a87247aefcd9570560d19dc6e027c34529'; 
$connection=new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);

//Get message from Line API
$content = file_get_contents('php://input');
$events=json_decode($content, true);

if (!is_null($events['events'])) {
    //Loop through each event 
    foreach($events['events'] AS $event){

        if ($event['type'] == 'message') {
            
            switch($event['message']['type']) {
                case 'text':
                    $sql = sprintf(
                        "SELECT * FROM slips WHERE slip_date='%s' AND user_id='%s' ", 
                        date('Y-m-d'),
                        $event['source']['userId']
                    );
                    $result = $connection->query($sql);
                    if($result!==false && $result->rowCount()>0){ //Save database
                        $params = array(
                            'name'=> $event['message']['text'], 
                            'slip_date'=> date('Y-m-d'), 
                            'user_id'=> $event['source']['userId'],
                        );
                        $statement=$connection->prepare('UPDATE slips SET name=:name WHERE slip_date=:slip_date AND user_id=:user_id');
                        $statement->execute($params);
                    }else {
                        $params = array(
                            'user_id'=> $event['source']['userId'], 
                            'slip_date'=> date('Y-m-d'),
                            'name'=> $event['message']['text'],
                        );
                        $statement = $connection->prepare('INSERT INTO slips (user_id, slip_date, name) VALUES(:user_id, :slip_date, :name)');
                        $effect = $statement->execute($params); 
                    }
                    //Bot response
                    $respMessage='Your data has saved. text';
                    $replyToken = $event['replyToken'];
                    $textMessageBuilder = new TextMessageBuilder($respMessage);
                    $response=$bot->replyMessage($replyToken, $textMessageBuilder); 
                    break;

                case 'image':
                    //Get file content.
                    $fileID = $event['message']['id'];
                    $response = $bot->getMessageContent($fileID); 
                    $fileName = md5(date('Y-m-d')).'.jpg';
                    
                    if ($response->isSucceeded()) { //Create file.
                        $file=fopen($fileName, 'w'); 
                        fwrite($file, $response->getRawBody());
                        $sql = sprintf(
                            "SELECT * FROM slips WHERE slip_date='%s' AND user_id='%s' ",
                            date('Y-m-d'),
                            $event['source']['userId']
                        ); 
                        $result = $connection->query($sql);
                        
                        if($result!==false && $result->rowCount()>0){ //Save database
                            $params = array(
                                'image'=> $fileName,
                                'slip_date'=> date('Y-m-d'), 
                                'user_id'=> $event['source']['userId'],
                            );
                            $statement=$connection->prepare('UPDATE slips SET image=:image WHERE slip_date=:slip_date AND user_id=:user_id');
                            $statement->execute($params);
                        } else {
                            $params = array(
                                'user_id'=> $event['source']['userId'],
                                'image'=> $fileName, 
                                'slip_date'=> date('Y-m-d'),
                            );
                            $statement=$connection->prepare('INSERT INTO slips (user_id, image, slip_date)VALUES(:user_id, :image, :slip_date)');
                            $statement->execute($params); 
                        }
                    }
                    
                    //Bot response
                    $respMessage='Your data has saved. image';
                    $replyToken = $event['replyToken'];
                    $textMessageBuilder = new TextMessageBuilder($respMessage); 
                    $response=$bot->replyMessage($replyToken, $textMessageBuilder);
                    break;
            }
        }
    }   
}
echo "OK";