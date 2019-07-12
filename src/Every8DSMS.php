<?php

namespace Virtualorz\Every8DSMS;

use DB;
use Session;
use Route;

class Every8DSMS
{

    protected static $message= [
        'status' => 0,
        'status_string' => '',
        'message' => '',
        'data' => []
    ];


    public function send($message = '',$phone = '',$subject = ''){

        $every8D = Config('every8DSMS');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $every8D['Api_url'].'sendSMS.ashx?UID='.$every8D['account'].'&PWD='.$every8D['password'].'&SB='.$subject.'&MSG='.$message.'&DEST='.$phone);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        if(is_string($result)){
            $tmp = explode(',',$result);
            $CREDIT = intval($tmp[0]);
            $SENDED = intval($tmp[1]);
            $COST = intval($tmp[2]);
            $UNSEND = intval($tmp[3]);
            $BATCH_ID = $tmp[4];

            if($CREDIT >= 0 && $SENDED == 1 && $UNSEND == 0){
                self::$message['status'] = 1;
                self::$message['status_string'] = "發送成功";
                self::$message['message'] = '成功發送至'.$phone.' 共花費'.$COST.'點';
                self::$message['data']['CREDIT'] = $CREDIT;
                self::$message['data']['SENDED'] = $SENDED;
                self::$message['data']['COST'] = $COST;
                self::$message['data']['UNSEND']= $UNSEND;
                self::$message['data']['BATCH_ID'] = $BATCH_ID;
            }
            else{
                self::$message['status'] = 0;
                self::$message['status_string'] = "發送失敗";
                self::$message['message'] = '主機端發⽣不明錯誤，請與廠商窗⼝聯繫。';
            }
        }
        else{
            self::$message['status'] = 0;
            self::$message['status_string'] = "發送失敗";
            self::$message['message'] = '主機端發⽣不明錯誤，請與廠商窗⼝聯繫。';
        }

       return self::$message;
    }

    public function getCredit(){

        $every8D = Config('every8DSMS');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $every8D['Api_url'].'getCredit.ashx?UID='.$every8D['account'].'&PWD='.$every8D['password']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        if(is_string($result)){
            self::$message['status'] = 1;
            self::$message['status_string'] = "查詢成功";
            self::$message['message'] = '';
            self::$message['data'] = $result;
        }
        else{
            self::$message['status'] = 0;
            self::$message['status_string'] = "查詢成功";
            self::$message['message'] = '主機端發⽣不明錯誤，請與廠商窗⼝聯繫。';
        }

        return self::$message;
    }

}
