###【api-room】发送信息到房间
---
###简要描述：
* Client端指定roomFd，将消息发送给房间的每一个人

####请求Json:
    {"controller": "Chat","action": "sendToRoom","data":{"roomId":"1000","message":"测试消息"}}

####请求参数：
| 键名| 键值 | 必选 | 类型 |
|:----------:|:------------:|:-----------:|:-------------:|
|controller|Chat|是|String|
|action|sendToRoom|是|String|
####请求值：
| 参数名 | 必选 | 类型 | 说明|
|:----------:|:------------:|:-----------:|:-----------:|
|roomId|是|String| Client端指定的roomId|
|message|是|String| Client端发送给房间每一个用户的消息|

####返回示例

```json
{"status":true,"message":null,"data":{"roomId":"1000"}}
```

####返回参数说明

| 参数名  | 类型 | 说明|
|:----------:|:------------:|:-----------:|
|roomId|String| Client端指定的roomId|


 