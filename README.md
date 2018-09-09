> 要国庆放假了，所以肯定要买票回家，但是只买到特快的。动车还未开始出售。
> 
> 像我这种懒人肯定不会每天去查什么时候开售，所以写了一个简单的脚本，在开售的时候邮件通知我。
  
  
### 使用
环境要求：php，composer，linux  

#### composer加载email邮件库
```php
composer require phpmailer/phpmailer
```

#### email配置
```php
$mail = new PHPMailer;
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'smtp.qq.com';
$mail->SMTPAuth = true;
$mail->Username = '932589183@qq.com';
$mail->Password = 'xxxxx';  // 这里使用qq或者163邮箱smtp的授权码
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->CharSet = 'UTF-8';

$mail->setFrom('932589183@qq.com', 'pena');
$mail->addAddress($to);

$mail->Subject = $title;
$mail->Body = $content;

$mail->send();
```

#### crontab定时脚本
这里设置一个小时执行一次  
```bash
0 * * * * /my_docker/train_email/start.sh >> /my_docker/train_email/access.log 2>&1
```

#### sh执行脚本
start.sh
```bash
#!/bin/bash
/usr/local/bin/php /my_docker/train_email/index.php
```

### 原理
原理比较简单，就是根据浏览器network里的请求，判断某一个车次是否已经开售。如果开售则邮件通知。

### 测试结果
![车票](http://pic.pwwtest.com/%E6%9F%A5%E8%AF%A2%E8%BD%A6%E7%A5%A8_20180909223024.png)