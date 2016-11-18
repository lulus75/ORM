<?php
/**
 * Created by PhpStorm.
 * User: Lulus
 * Date: 16/11/2016
 * Time: 13:24
 */

require_once('autoload.php');

use connect\connect;

function connect()
{
    $object = new connect();
    $object = $object->getConnection();
    return $object;
}

    $table = $argv[2];
    $stmt = connect()->prepare("SHOW columns FROM ".$table);
    $stmt->execute();
    $fields = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

function createTab($tabs)
{
    $ret = '';
    for ($i = 0 ; $i < $tabs ; $i++)
        $ret .= ' ';
    return $ret;
}

$className = $argv[1];

$tabs = 2;
$insert = "<?php\n\nnamespace entity;\n\n";
$insert .=  "class $className \n{\n";

$insert .= "\n";
foreach ($fields as $field)
{
    $insert .= createTab($tabs) . 'protected $'.$field.";\n";
}

$insert .= "\n";

foreach ($fields as $field)
{
    $insert .= createTab($tabs) . 'public function get'.ucfirst($field)."()\n";
    $insert .= createTab($tabs) . "{\n";
    $insert .= createTab($tabs+2) . 'return $this->'.$field.";\n";
    $insert .= createTab($tabs) . "}\n\n";
    $insert .= createTab($tabs) . 'public function set'.ucfirst($field).'($'.$field.")\n";
    $insert .= createTab($tabs) . "{\n";
    $insert .= createTab($tabs+2) . '$this->'.$field.' = $'.$field.";\n";
    $insert .= createTab($tabs) . "}\n\n";
}
$insert .= "}\n";

$dir_to_save = "entity/";

file_put_contents($dir_to_save.$className.".php", $insert);