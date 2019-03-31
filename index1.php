<?php
/**
 * @API-DISCOVERY
 */
include_once "app.php";
$result = array();
$result['statusCode'] = 200;
$result['endpoint'] = "http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";
$result['authors'] = array();
$result['authors']['Deevya'] = array(
    "linkedin" => "https://www.linkedin.com/in/deevya-naresh-kumar/",
);
$result['code-inspection'] = array();
$result['code-inspection']['travis'] = "https://travis-ci.org/DeevyaNaresh/Deevya-Myob-Devops";
$result['code-inspection']['github'] = "https://github.com/DeevyaNaresh/Deevya-Myob-Devops";
$result['endpoints'] = discoverAPIs();
file_put_contents("C:\Windows\Temp\Deevya.log", '$_SERVER = ' . print_r($_SERVER, true) . "\n", FILE_APPEND);
file_put_contents("C:\Windows\Temp\Deevya.log", '$fred = ' . print_r($fred, true) . "\n", FILE_APPEND);
echo json_encode($result);
