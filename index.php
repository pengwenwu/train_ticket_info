<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/9/9
 * Time: 20:42
 */

require __DIR__ . '/Train.php';

// network请求地址(10.1南京到泰州)
$url = 'https://kyfw.12306.cn/otn/leftTicket/queryA?leftTicketDTO.train_date=2018-10-01&leftTicketDTO.from_station=NJH&leftTicketDTO.to_station=UTH&purpose_codes=ADULT';
$train_num = 'D5506'; // 车次

$train = new Train($url, $train_num);
$train->getSaleInfo();
