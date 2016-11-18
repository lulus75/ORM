<?php
/**
 * Created by PhpStorm.
 * User: Lulus
 * Date: 16/11/2016
 * Time: 13:24
 */

namespace model;

use connect\connect;
use log\Log;

class Orm
{

    private function connect()
    {
        $object = new connect();
        $object = $object->getConnection();
        return $object;
    }

    private function logTime(){
        $logTime = new Log();
         return $logTime = $logTime->getTime();
    }

    private function successLog($request, $requestTime){
        $success = new Log();
        $success->successLog($request, $requestTime);
        return $success;
    }
    private function errorLog($request, $requestTime, $errorMessage){
        $error = new Log();
        $error->errorLog($request, $requestTime,$errorMessage);
        return $error;
    }

    private function getTimeRequest($start,$end){
        $reqTime = new Log();
        return $reqTime->getReqTime($start,$end);
    }


    public function getAll($table)
    {
        $start = $this->logTime();

        $stmt = $this->connect()->prepare("SELECT * FROM ".$table);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(empty($result)){
        $end = $this->logTime();
        $req = $this->getTimeRequest($end,$start);
            $result = 'Table Name not found in database';
        $this->errorLog($stmt,$req,$result);
        }else{
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $this->successLog($stmt,$req);
        }
        return $result;
    }

    public function selectById($table, $id)
    {
        $start = $this->logTime();

        $stmt = $this->connect()->prepare("SELECT * FROM ".$table." WHERE id = ".$id);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(empty($result)){
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $result = 'Table Name not found or invalid id';
            $this->errorLog($stmt,$req,$result);
        }else{
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $this->successLog($stmt,$req);
        }

        return $result;
    }

    public function selectWithParam($table, $param = array()){

        $start = $this->logTime();

        if(count($param) == 1){
            $stmt = $this->connect()->prepare("SELECT * FROM ".$table." WHERE ".$param[0]);
        }else{
            $query = "";
            for($i = 0 ; $i < count($param); $i++){

                if($i == 0 ){
                    $tab = explode('=',$param[$i]);

                    $query .= " WHERE ".$tab[0].'= \''.$tab[1].'\'';
                    $tab1 = explode('=',$query);
                    $res = str_replace(' ','',$tab1[1]);
                    $query = $tab1[0].'='.$res;

                }else{
                    $tab = explode('=',$param[$i]);
                    $query2 = " AND ".$tab[0].'= \''.$tab[1].'\'';
                    $tab2 = explode('=',$query2);
                    $res2 = str_replace(' ','',$tab2[1]);
                    $query2 = $tab2[0].'='.$res2;
                    $query = $query.$query2;
                }
            }
            $stmt = $this->connect()->prepare("SELECT * FROM ".$table.$query);
        }

        $stmt->execute();
        $result = $stmt->fetchAll();

        if(empty($result)){
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $result = 'Table Name not found or invalid parameters';
            $this->errorLog($stmt,$req,$result);
        }else{
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $this->successLog($stmt,$req);
        }

        return $result;
    }

    public function orderBy($table, $param)
    {
        $start = $this->logTime();

        $stmt = $this->connect()->prepare("SELECT * FROM ".$table." ORDER BY ".$param);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(empty($result)){
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $result = 'Table Name not found or invalid row';
            $this->errorLog($stmt,$req,$result);
        }else{
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $this->successLog($stmt,$req);
        }

        return $result;
    }

    public function leftJoin($table1,$field1,$table2,$field2,$identifier1,$identifier2)
    {
        $start = $this->logTime();

        $stmt = $this->connect()->prepare("SELECT $table1.$field1 , $table2.$field2 FROM  $table1 LEFT JOIN  $table2  ON  $table1.$identifier1  =  $table2.$identifier2");
        $stmt->execute();
        $result = $stmt->fetchAll();

        if(empty($result)){
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $result = 'Invalid parameter, check order //TableName1-row1 TableName2-row2 identifier1-identifier2';
            $this->errorLog($stmt,$req,$result);
        }else{
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $this->successLog($stmt,$req);
        }

        return $result;
    }

    public function countAll($table)
    {
        $start = $this->logTime();

        $stmt = $this->connect()->prepare("SELECT COUNT(*) FROM ".$table);
        $stmt->execute();
        $result = $stmt->fetch();

        if(empty($result)){
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $result = 'Table Name not found';
            $this->errorLog($stmt,$req,$result);
        }else{
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $this->successLog($stmt,$req);
        }

        return $result;
    }


    public function exist($table,$field, $value)
    {
        $start = $this->logTime();

        $stmt = $this->connect()->prepare("SELECT EXISTS (SELECT * FROM $table WHERE $field =  $value  ) AS isExist");
        $stmt->execute();
        $result = $stmt->fetch();


        if(empty($result)){
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $result = 'Table Name or field not found';
            $this->errorLog($stmt,$req,$result);
        }else{
            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $this->successLog($stmt,$req);
        }

        return $result;
    }

}