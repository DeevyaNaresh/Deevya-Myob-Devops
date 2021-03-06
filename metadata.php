<?php
/**
 * API to return metadata about this application
 * @API-DISCOVERY
 */
include_once "app.php";
$result = array();
$result['statusCode'] = 200;
$result['endpoint'] = "http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}";
$result["metadata"] = array(
    "version" => getVersionNumber(),
    "description" => "technical test",
    "lastcommitsha" => getLastCommit(),
    "commitLog" => getCommitLog()
);
echo json_encode($result);