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

            try {
                //Check to see user already answer
                $host = 'ec2-23-21-238-28.compute-1.amazonaws.com';
                $dbname = 'd5hb6iga0kqmnd'; 
                $user = 'qjpjdxczqljfdi';
                $pass = '51bf424af67c828b222d1fff444a74a87247aefcd9570560d19dc6e027c34529'; 
                $connection=new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
                
                $sql=sprintf("SELECT*FROM poll WHERE user_id='%s' ", $event['source']['userId']);
                $result = $connection->query($sql); 
                error_log($sql);

                if($result==false || $result->rowCount()<=0){ 
                    switch($event['message']['text']) {
                        case '1':
                            // Insert
                            $params = array(
                                'userID'=> $event['source']['userId'], 
                                'answer'=> '1',
                            );
                            $statement=$connection->prepare('INSERT INTO poll (user_id, answer) VALUES(:userID, :answer )'); 
                            $statement->execute($params);

                            // Query
                            $sql=sprintf("SELECT*FROM poll WHERE answer='1' AND user_id='%s' ",$event['source']['userId']);
                            
                            $result = $connection->query($sql);
                            $amount = 1; 
                            if($result){
                                $amount = $result->rowCount(); 
                            }
                            $respMessage='จํานวนคนตอบว่าเพื่อน='.$amount;
                            break;

                        case '2':
                            // Insert
                            $params = array(
                                'userID'=> $event['source']['userId'], 
                                'answer'=> '2',
                            );
                            $statement=$connection->prepare('INSERT INTO poll (user_id, answer) VALUES(:userID, :answer )'); 
                            $statement->execute($params);

                            // Query
                            $sql=sprintf("SELECT*FROM poll WHERE answer='2' AND user_id='%s' ",$event['source']['userId']);
                            
                            $result = $connection->query($sql);
                            $amount = 1; 
                            if($result){
                                $amount = $result->rowCount(); 
                            }
                            $respMessage='จํานวนคนตอบว่าแฟน='.$amount;
                            break;

                        case '3':
                            // Insert
                            $params = array(
                                'userID'=> $event['source']['userId'], 
                                'answer'=> '3',
                            );
                            $statement=$connection->prepare('INSERT INTO poll (user_id, answer) VALUES(:userID, :answer )'); 
                            $statement->execute($params);

                            // Query
                            $sql=sprintf("SELECT*FROM poll WHERE answer='3' AND user_id='%s' ",$event['source']['userId']);
                            
                            $result = $connection->query($sql);
                            $amount = 1; 
                            if($result){
                                $amount = $result->rowCount(); 
                            }
                            $respMessage='จํานวนคนตอบว่าพ่อแม่='.$amount;
                            break;

                        case '4':
                            // Insert
                            $params = array(
                                'userID'=> $event['source']['userId'], 
                                'answer'=> '4',
                            );
                            $statement=$connection->prepare('INSERT INTO poll (user_id, answer) VALUES(:userID, :answer )'); 
                            $statement->execute($params);

                            // Query
                            $sql=sprintf("SELECT*FROM poll WHERE answer='4' AND user_id='%s' ",$event['source']['userId']);
                            
                            $result = $connection->query($sql);
                            $amount = 1; 
                            if($result){
                                $amount = $result->rowCount(); 
                            }
                            $respMessage='จํานวนคนตอบว่าบุคคลอื่นๆ='.$amount;
                            break;
                        
                        default:
                            $respMessage = "
                                บุคคลทีเราโทรหาบ่อยที่สุด คือ ? \n\r 
                                กด1 เพื่อน\n\r
                                กด2 แฟน\n\r
                                กด3 พ่อแม่\n\r
                                กด4 บุคคลอื่นๆ\n\r ";
                            break;
                    }
                } else {
                    $respMessage = 'คุณได้ตอบโพลล์นี้แล้ว';
                }
                        
                $httpClient = new CurlHTTPClient($channel_token);
                $bot = new LINEBot($httpClient, array('channelSecret'=> $channel_secret));

                $textMessageBuilder = new TextMessageBuilder($respMessage);
                $response=$bot->replyMessage($replyToken, $textMessageBuilder);
            } catch(Exception$e){ 
                error_log($e->getMessage());
            }
            
        }
        
    }   
}
echo "OK";