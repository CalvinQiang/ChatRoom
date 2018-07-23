## Sometimes's ChartRoom Api Document

本项目基于easyswoole框架实现的聊天室功能，后端与前端分离实现，以websocket协议传输封装好的json格式进行消息的传递

---

#### 传输消息概述
* [用户加入房间](#intoRoom)
>     {"controller": "Chat","action": "intoRoom","data":{"roomId":"1000"}}
* [用户给房间的每一个人发消息](#sendToRoom)
>       {"controller": "Chat","action": "sendToRoom","data":{"roomId":"1000","message":"测试消息"}}

* [用户指定一个人发送消息](#sendToRoom)
>       {"controller": "Chat","action": "sendToUser","data":{"roomId":"1000","message":"测试消息"}}


