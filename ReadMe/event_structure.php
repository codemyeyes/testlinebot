<?php
// EVENT GET FROM USER

$strMsg = '
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
$strImage = '
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

// ดูข้อความที่ LINE API ส่งมาให้เราถา้ หากมีใครส่ง Sticker ให้บอท
$strImage = '
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
                "type": "sticker", // ( text, image, sticker, file, video, audio, location )
                "packageId": "1",
                "stickerId": "1"
            }
        }
    ]
}
';

// ดูข้อความที่ LINE API ส่งมาให้เราถา้ หากมีใครส่ง VDO ให้บอท
$strVdo = '
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
                "type": "video" // ( text, image, sticker, file, video, audio, location )
            }
        }
    ]
}
';

// ดูข้อความที่ LINE API ส่งมาให้เราถา้ หากมีใครส่ง Audio ให้บอท
$strAudio = '
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
                "type": "audio" // ( text, image, sticker, file, video, audio, location )
            }
        }
    ]
}
';

// ดูข้อความที่ LINE API ส่งมาให้เราถา้ หากมีใครส่ง Location ให้บอท
$strLocation = '
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
                "type": "location", // ( text, image, sticker, file, video, audio, location )
                "title": "my location",
                "address": "〒150-0002 東京都渋谷区渋谷2丁目21−1", 
                "latitude": 35.65910807942215,
                "longitude": 139.70372892916203
            }
        }
    ]
}
';

// EVENT SEND TO USER
$sendText = '
{
    "events": 
    [ 
        {
            "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
            "type": "message", "timestamp": 1462629479859, 
            "source": {
                "type": "user",
                "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
            }, 
            "message": {
                "id": "325708",
                "type": "text",
                "text": "Hello, world"
            }
        }
    ]
}
';

// Message Events
$messageEvents = '
{
    "events": 
    [ 
        {
            "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA", 
            "type": "message",
            "timestamp": 1462629479859,
            "source": {
                "type": "user",
                "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
            }, 
            "message": {
                "id": "325708",
                "type": "file", 
                "fileName": "file.txt", 
                "fileSize": 2138
            } 
        }
    
    ]
}
';


// Follow Events
$followEvents = '
{
    "events": 
    [ 
        {
            "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA", 
            "type": "follow",
            "timestamp": 1462629479859,
            "source": {
                "type": "user",
                "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
            }
        }
    ]
}
';

// Unfollow Events
$unfollowEvents = '
{
    "events": 
    [ 
        {
            "type": "unfollow",
            "timestamp": 1462629479859,
            "source": {
                "type": "user",
                "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
            }
        }
    ]
}
';

// Join Events
$joinEvents = '
{
    "events": 
    [ 
        {
            "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA", 
            "type": "join",
            "timestamp": 1462629479859,
            "source": {
                "type": "group",
                "groupId": "cxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
            }
        }
    ]
}
';

// Join Events
$leaveEvents = '
{
    "events": 
    [ 
        {
            "type": "leave",
            "timestamp": 1462629479859,
            "source": {
                "type": "group",
                "groupId": "cxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
            }
        }
    ]
}
';
