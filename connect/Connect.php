<?php
/**
 * Created by PhpStorm.
 * User: Lulus
 * Date: 16/11/2016
 * Time: 12:33
 */
namespace connect;

class connect
{
    protected $db;

    private $user = ""; //login DB
    private $pass =""; // password DB
    private $host = ""; // Host
    private $dbname = ""; // DbName

    public function __construct ()
    {
         $connexion = null;

        $connexion = new \PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user, $this->pass);
        $this->db = $connexion;
    }
    public function getConnection(){
        return $this->db;
    }

}