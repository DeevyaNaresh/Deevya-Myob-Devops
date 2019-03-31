<?php
/**
 * Created by PhpStorm.
 * User: Deevya
 * Date: 31/3/18
 * Time: 17:30
 */
include_once "api/app.php";
class testApp extends \PHPUnit\Framework\TestCase
{
    public function testVersion()
    {
        $testValue = getVersionNumber();
        $expectedValue = trim(file_get_contents("api/version.txt"));
        $this->assertEquals($testValue, $expectedValue, "Version number does not match");
    }
    public function testLastCommit()
    {
        $testValue = getLastCommit();
        $testValueLength = strlen($testValue);
        $this->assertGreaterThan(0, $testValueLength, "Last commit value length is ZERO");
    }
}
