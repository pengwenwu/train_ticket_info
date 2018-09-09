<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/9/9
 * Time: 20:37
 */
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public static function sendMail($to = 'pww932589183@163.com', $title = '', $content = '')
    {
        $mail = new PHPMailer;
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.qq.com';
        $mail->SMTPAuth = true;
        $mail->Username = '932589183@qq.com';
        $mail->Password = 'btlxbxhfpvkjbbea';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('932589183@qq.com', 'pena');
        $mail->addAddress($to);

        $mail->Subject = $title;
        $mail->Body = $content;

        $mail->send();
    }
}
