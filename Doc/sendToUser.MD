###【api-room】发送私密消息
---
###简要描述：
* Client端指定roomId来进入相应的房间

####请求Json:
    {"controller": "Chat","action": "sendToUser","data":{"userId":"1000","message":"测试消息"}}

####请求参数：
| 键名| 键值 | 必选 | 类型 | 
|:----------:|:------------:|:-----------:|:-------------:|
|controller|Chat|是|String|
|action|sendToUser|是|String|
####请求值：
| 参数名 | 必选 | 类型 | 说明|
|:----------:|:------------:|:-----------:|:-----------:|
|userId|是|String| Client端指定发送消息的接受者|
|message|是|String| Client将要发送的消息|

####返回示例

```json
{"status":true,"message":null,"data":{"userId":"1000"}}
```

####返回参数说明

| 参数名  | 类型 | 说明|
|:----------:|:------------:|:-----------:|
|userId|String| 消息接受者的ID|


 