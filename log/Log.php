<?php
/**
 * Created by PhpStorm.
 * User: Lulus
 * Date: 18/11/2016
 * Time: 00:20
 */

namespace log;

use DateTime;

class Log
{
    public function getTime(){
        return microtime(true);
    }

    public function getReqTime($end,$start){
        return $reqTime = $end - $start;
    }

    public function successLog($request, $requestTime){

        $date = new DateTime();
        $currentDate = $date->format('Y-m-d H:i:s');

        if (!file_exists("log/success.log")){
            file_put_contents("log/success.log", "Execution Date : ".$currentDate."\r\n"."Request : ".$request->queryString."\r\n"."In ".$requestTime."ms\r\n"."\r\n\r\n\r\n");
        }else{
        $file = fopen("log/success.log","a+");
        fputs($file, "Execution Date : ".$currentDate."\r\n"."Request : ".$request->queryString."\r\n"."In ".$requestTime."ms\r\n"."\r\n\r\n\r\n");
        fclose($file);
        }

    }

    public function errorLog($request, $requestTime, $errorMessage){

        $date = new DateTime();
        $currentDate = $date->format('Y-m-d H:i:s');
        if (!file_exists("log/error.log")){
            file_put_contents("log/error.log", "Execution Date : ".$currentDate."\r\n"."Request : ".$request->queryString."\r\n"."In ".$requestTime."ms\r\n"."With error : ".$errorMessage."\r\n\r\n\r\n");
        }else{
            $file = fopen("log/error.log","a+");
            fputs($file, "Execution Date : ".$currentDate."\r\n"."Request : ".$request->queryString."\r\n"."In ".$requestTime."ms\r\n"."With error : ".$errorMessage."\r\n\r\n\r\n");
            fclose($file);

        }

    }
}