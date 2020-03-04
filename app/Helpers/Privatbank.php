<?php

namespace App\Helpers;



class Privatbank
{
    private static $url='https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5';
    private static $currencies=['USD','EUR'];

    public static function convert($price){

        $currencies=json_decode(file_get_contents(self::$url),true);
        $data=[];
        foreach($currencies as $currency){
            if(in_array($currency['ccy'],self::$currencies) && $currency['buy']>0){
                $data[$currency['ccy']]=round($price/$currency['buy'],2);
            }
        }
        return $data;
    }

}
