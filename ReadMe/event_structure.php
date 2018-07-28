<?php
$str = '
{
    "events": [ 
        {
            "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA", 
            "type": "message", // คือประเภทของ event
            "timestamp": 1462629479859,
            "source": {
                "type": "user",
                "userId": "U206d25c2ea6bd87c17655609a1c37cb8" // คือไอดีของผูส้ ่งข้อความมา
            }, 
            "message": {
                "id": "325708",
                "type": "text", // ( text, image, sticker, file, video, audio, location )
                "text": "Hello, world" // คือข้อความที่คนส่งคุยกบั บอท
            }
        }
    ]
}
';

// ดูข้อความที่ LINE API ส่งมาให้เราถา้ หากมีใครส่งรูปภาพให้บอท

$str = '
{
    "events": [ 
        {
            "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA", 
            "type": "message", // คือประเภทของ event
            "timestamp": 1462629479859,
            "source": {
                "type": "user",
                "userId": "U206d25c2ea6bd87c17655609a1c37cb8" // คือไอดีของผูส้ ่งข้อความมา
            }, 
            "message": {
                "id": "325708",
                "type": "text", // ( text, image, sticker, file, video, audio, location )
                "text": "Hello, world" // คือข้อความที่คนส่งคุยกบั บอท
            }
        }
    ]
}
';$str = '
{
    "events": [ 
        {
            "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA", 
            "type": "message", // คือประเภทของ event
            "timestamp": 1462629479859,
            "source": {
                "type": "user",
                "userId": "U206d25c2ea6bd87c17655609a1c37cb8" // คือไอดีของผูส้ ่งข้อความมา
            }, 
            "message": {
                "id": "325708",
                "type": "image" // ( text, image, sticker, file, video, audio, location )
            }
        }
    ]
}
';

