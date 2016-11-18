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

class Crud
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

    public function create($table, array $data)
    {
        $start = $this->logTime();
        $fields = array_keys($data);
        $values = array_values($data);

        $queryFields = '';
        $queryValues = '';
        for($i = 0 ; $i < count($fields); $i++){
            if($i <  count($fields)-1){
            $queryFields .= '`'.$fields[$i].'`,';
                $queryValues.= "'".$values[$i]."',";
            }else{
                $queryFields .= '`'.$fields[$i].'`';
                $queryValues.= "'".$values[$i]."'";
            }
        }
        $stmt = $this->connect()->prepare("INSERT INTO `$table`($queryFields) VALUES ($queryValues)");
        $stmt->execute();

        $result = $stmt->fetchAll();

            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $this->successLog($stmt,$req);


        return $result;
    }
    public function update($table, array $data, $field, $value)
    {
        $start = $this->logTime();
        $fields = array_keys($data);
        $values = array_values($data);

        $query = '';
        for($i = 0 ; $i < count($fields); $i++){
            if($i <  count($fields)-1){
            $query .= '`'.$fields[$i].'`='."'".$values[$i]."'".',';
            }else{
                $query .= '`'.$fields[$i].'`='."'".$values[$i]."'".'';
            }

        }
        $stmt = $this->connect()->prepare("UPDATE `$table` SET $query WHERE $field = $value");
        $stmt->execute();

        $result = $stmt->fetchAll();

            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $this->successLog($stmt,$req);


        return $result;
    }

    public function delete($table, $field, $value)
    {
        $start = $this->logTime();

        $stmt = $this->connect()->prepare("DELETE FROM   $table    WHERE   $field = $value");
        $stmt->execute();
        $result = $stmt->fetchAll();

            $end = $this->logTime();
            $req = $this->getTimeRequest($end,$start);
            $this->successLog($stmt,$req);

        return $result;
    }

}