# Laverify

验证码简化

## 安装

```bash
composer require hitmanv/laverify
```

## 用法

```php
use Hitmanv\Laverify\VerifyCode;

// 生成验证码
VerifyCode::gen($type, $target, $ttl=300); // type -> 不同用途的验证码 target -> 验证码对象 手机号码或邮箱等
VerifyCode::verify($type, $target, $code);
```

中间件使用

```php
// kernel 添加
'vc' => Hitmanv\Laverify\VerifyCodeMiddleware::class,

// 使用
someroute()->middleware('vc:type,target_key,code_key')
```

## License
[MIT](https://choosealicense.com/licenses/mit/)