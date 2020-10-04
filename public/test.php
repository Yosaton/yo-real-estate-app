<?php 
// header('HTTP/1.1 200 OK');

/* GET ALL VARIABLES GET & POST */
foreach ($_REQUEST AS $key => $value){
    $message .= "$key => $value ($_SERVER[REQUEST_METHOD])\n";
}
$input = file_get_contents("php://input");
$array = print_r(json_decode($input, true), true);
file_put_contents('fbmessenger.txt', $message.$array."\nREQUEST_METHOD: $_SERVER[REQUEST_METHOD]\n----- Request Date: ".date("d.m.Y H:i:s")." IP: $_SERVER[REMOTE_ADDR] -----\n\n", FILE_APPEND);
echo $_REQUEST['hub_challenge'];