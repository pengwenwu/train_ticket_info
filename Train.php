<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/9/9
 * Time: 10:01
 */
require __DIR__ . '/Email.php';

class Train
{
    private $url;
    private $train_num;
    private $to = 'pww932589183@163.com';

    public function __construct($url, $train_num)
    {
        $this->url = $url;
        $this->train_num = $train_num;
    }

    public function getSaleInfo()
    {
        $res = $this->exec($this->url, 'get');

        $date = date('Y-m-d H:i:s');
        if ($this->canBuyTicket($res, $this->train_num)) {
            $title = '可以购买车次为' . $this->train_num . '的车票了';
            $content = $title;
            Email::sendMail($this->to, $title, $content);
            echo $date . '已发送通知邮件';
            exit();
        }
        echo $date . '：' . $this->train_num . '未到售票时间', "\n";
    }

    private function exec($url, $type)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; SeaPort/1.2; Windows NT 5.1; SV1; InfoPath.2)');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        if ($type == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
        }

        $data = curl_exec($ch);

        curl_close($ch);

        return json_decode($data, 1);
    }

    /**
     * 校验是否可以预订车票
     */
    private function canBuyTicket($data, $train_num = 'D5506')
    {
        if (!$data || $data['status'] != true) {
            return false;
        }
        $result = $data['data']['result'];

        foreach ($result as $k => $v) {
            if (strpos($v, $train_num) !== false && strpos($v, 'IS_TIME_NOT_BUY') === false) {
                return true;
            }
        }
        return false;
    }
}
