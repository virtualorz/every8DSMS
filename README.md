# Usage
Use for Laravel website to send SMS message via [every8d](https://tw.every8d.com) service

# Install
    composer require virtualorz/every8DSMS
    
# Config
edit config/app.php
    
    'providers' => [
        ...
        Virtualorz\Every8DSMS\Every8DSMSServiceProvider::class
    ]
    
    'aliases' => [
        ...
        'Every8DSMS' => Virtualorz\Every8DSMS\Facades\Every8DSMS::class,
    ]
   
# Publish data
    php artisan vendor:publish --provider="Virtualorz\Every8DSMS\Every8DSMSServiceProvider"
    
# Edit Config
edit config/every8DSMS.php , <br />
account for every8d login account,<br />
password for every8d login password.<br />
please, DO NOT EDIT 'Api_url'
    
# Method

###### send($message, $phone, $subject)
    send $message to $phone, $phone can be multiple numbers, for example "09889876543,09777876543", $subject can be null
    
    return value :
    data['status'] = 1; //1 for success 0 for fail
    data['status_string'] = ""; //success or fail
    data['message'] = '';//success cost message or fail message
    data['data'] = [
        'CREDIT' => '',// the recent point on every8d
        'SENDED' => '',// hwo many sms send this time
        'COST' => '',// cost point this time
        'UNSEND' => '',// how many can not send sms
        'BATCH_ID' => '',// id for this send
    ]

###### getCredit()
    get the point on every8d
    
    return value :
        data['status'] = 1; //1 for success 0 for fail
        data['status_string'] = ""; //success or fail
        data['message'] = '';//success cost message or fail message
        data['data'] = recent point

   
# 中文版本文件
[Every8DSMS : 傳送簡訊超簡單](http://www.alvinchen.club/2019/07/12/%e4%bd%9c%e5%93%81laravel-package-every8dsms-%e5%82%b3%e9%80%81%e7%b0%a1%e8%a8%8a%e8%b6%85%e7%b0%a1%e5%96%ae/)
