<?php
/**
 * Created by PhpStorm.
 * User: Lulus
 * Date: 16/11/2016
 * Time: 13:24
 */

require_once('autoload.php');

use model\Crud;
use model\Orm;

$crud =  new Crud();
$orm = new Orm();




//----- create in database ------//

//$crud = $crud->create('users',['login'=>'paule','password'=>'sdrjog', 'email'=>'polo@gmail.fr','adresse_id'=>'2']);

//----- update in database ------//

$crud = $crud->update('users',['login'=>'lussdslusss','password'=>'124s423'],'id','3');

//----- delete in database ------//

//$crud = $crud->delete('users','id','2');



//----- Get all ------//

//$orm = $orm->getAll('users');

//----- Select By Id------//

//$orm = $orm->selectById('users','1');

//----- Multiple Select ------//

//$orm = $orm->selectWithParam('users',['id = 4','login = paule','email = polo@gmail.fr']);

//----- Order By ------//

//$orm = $orm->orderBy('users','id');

//----- Left join ------//

//$orm = $orm->leftJoin('users','login','adresse','adresse','id','user_id');

//----- CountAll------//

//$orm = $orm ->countAll('users');

//----- Is Exist ------//

//$orm = $orm ->exist('users','id','1');

var_dump($orm);