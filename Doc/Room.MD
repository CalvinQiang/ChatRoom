* userId(用户ID) -> fd（websocketId） 一对多
* fd <-----> roomId 多对多


- 1.进入房间
{"controller": "Chat","action": "intoRoom","data":{"userId":"1","roomId":"1000"}}

{"controller": "Chat","action": "intoRoom","data":{"userId":"2","roomId":"1000"}}

{"controller": "Chat","action": "sendToRoom","data":{"roomId":"1000","message":"发送房间消息"}}

{"controller": "Chat","action": "sendToUser","data":{"userId":"1","message":"发送私聊消息"}}

