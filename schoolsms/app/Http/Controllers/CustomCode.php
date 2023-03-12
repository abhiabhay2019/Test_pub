<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
class CustomCode{
    public $guid;
    
    function CreateId(){
        $microTime = microtime();
list($a_dec, $a_sec) = explode(" ", $microTime);

$dec_hex = dechex($a_dec* 1000000);
$sec_hex = dechex($a_sec);

substr($dec_hex, 0, 5);
substr($sec_hex, 0, 6);

$guid = "";
$guid .= $dec_hex;
$guid .= $this->create_guid_section(3);
$guid .= '-';
$guid .= $this->create_guid_section(4);
$guid .= '-';
$guid .= $this->create_guid_section(4);
$guid .= '-';
$guid .= $this->create_guid_section(4);
$guid .= '-';
$guid .= $sec_hex;
$guid .= $this->create_guid_section(6);

return $guid;
    }
    
    function create_guid_section($characters){
$return = "";
for($i=0; $i<$characters; $i++)
{
$return .= dechex(mt_rand(0,15));
}
return $return;
}

function Get_Record($tableName, $colName, $colID){
    $data = DB::select("SELECT * FROM $tableName WHERE $colName = '$colID'");
    return $data;
}
}

?>