## 项目说明

#### 文件结构说明

- App\Util文件夹包含：

    1. CacheKey：所有存储于缓存中的键值。常驻数据严格以CacheKey中的常量作为键，
    非常驻数据（如：邮件发送周期限制缓存则CacheKey+其他信息组成缓存键）；
    
    2. Codes：项目所有错误码及错误提示均定义在此处，包含对外错误码、对内错误码；
    
    3. TablesName:配置了项目所有数据表；
    
    4. Tool：一些通用工具方法；
    
- App\Services文件夹包含：

    1. CacheService：所有常驻、非数据表的缓存操作都在此处处理；
    
    2. EmailService：所有邮件发送操作都在此处处理；
    
    3. PusherService：所有广播推送操作都在此处处理；
    
    4. VerificationCodeService：所有验证码操作都在此处理；


#### 功能说明

- 缓存
    1. 本项目缓存包含两部分，一部分为非常驻缓存（如：邮件、手机验证码发送周期控制，
    此部分缓存具有时效性），另一部分为常驻缓存（如：数据表、排行榜等）；
    
    2. 非常驻缓存没有纳入统一管理，缓存代码位置请跟踪代码；
    
    3. 常驻缓存分为两部分，一部分为数据表缓存，此部分缓存读取、设置位于各自模型中，
    另一部分为非数据表缓存（如：排行榜缓存），此部分缓存读取、设置位于服务CacheService
    中。
    
- 版本控制
    1. 版本控制位于VersionController，依赖于缓存服务，版本控制分为两部分，一为零散缓存
    ，一为数据表缓存（包含受版本控制的数据表缓存和不受版本控制的数据表缓存）。