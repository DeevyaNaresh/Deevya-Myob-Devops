<?php
/**
 * App Name
 */
$appName = "Deevya-devops";
$user = "Deevya";
/**
 * get the current Software Version number as defined by the developers / code base
 * @return string
 */
function getVersionNumber() {
    $versionPath = dirname(__FILE__)."/version.txt";
    return file_exists($versionPath)
        ? trim(file_get_contents($versionPath))
        : "unknown";
}
/**
 * Get last commit from GIT
 * @return string
 */
function getLastCommit() {
    $result = exec("git log --pretty=format:'%h' -n 1");
    return $result;
}
/**
 *  get the a hash from the files, including datetime, size & user, ls -lsR | md5
 * if the folder has changed in anyway we can detect this.  i.e. FileCount, FileSizes, DateTimes, file owners, file groups, e.g. all file permissions
 *
 * The targeted system may not contain the hash type we want, so we need to check for it.
 *
 *
 * @return string
 */
function getCheckSum() {
    // the host we have targeted does not have MD5 command line, so we are going to use php internal,  we have local MacOS and remote Shared Hosted Linux wityh limited commands
    // we are going to use PHP version of MD5
    $result = array();
    exec("ls -lsR ..", $result);
    return md5(join("", $result));
}
/**
 * get the Git commit log so we can see what has been updated via the API
 * @return array
 */
function getCommitLog() {
    $result = array();
    exec('git log --pretty=format:\"%h%x09%an%x09%ad%x09%s\" | tr "\t" "|" | sed "s/\"/ /g" ', $result);
    return array_reverse($result);
}
function getTargetHostStats() {
    $result = array();
    $result['kernel'] = kernelVersion();
    $result['user'] = executionUser();
    $result['disk'] = array();
    exec('df -Ph', $result['disk']);
    $result['memory'] = array();
    exec('free -h | head -n2 | tail -n1', $result['memory']);
    return $result;
}
/**
 * Files in this folder are possibly API's those that contain @API-DISCOVERY, are API's
 */
function discoverAPIs(){
    $result = array();
    $apiFilenames = array();
    exec("grep -l '@API-DISCOVERY' *.php", $apiFilenames);
    $P = dirname($_SERVER['REQUEST_URI']);
    foreach ($apiFilenames as $apiFilename) {
        if ($apiFilename == 'app.php') {
            continue;
        };
        $result[str_replace('.php','',$apiFilename)] = "http://{$_SERVER['SERVER_NAME']}{$P}/{$apiFilename}" ;
    }
    return $result;
}
function kernelVersion() {
    return exec("uname -a");
}
function executionUser() {
    return exec("whoami");
}
