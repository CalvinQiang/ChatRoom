###【api-room】进入房间
---
###简要描述：
* Client端指定roomId来进入相应的房间

####请求Json:
    {"controller": "Chat","action": "intoRoom","data":{"roomId":"1000"}}

####请求参数：
| 键名| 键值 | 必选 | 类型 | 
|:----------:|:------------:|:-----------:|:-------------:|
|controller|Chat|是|String|
|action|intoRoom|是|String|
####请求值：
| 参数名 | 必选 | 类型 | 说明|
|:----------:|:------------:|:-----------:|:-----------:|
|roomId|是|String| Client端指定的roomId|

####返回示例

```json
{"status":true,"message":null,"data":{"roomId":"1000"}}
```

####返回参数说明

| 参数名  | 类型 | 说明|
|:----------:|:------------:|:-----------:|
|roomId|String| Client端指定的roomId|


 