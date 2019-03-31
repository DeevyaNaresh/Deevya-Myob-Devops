<?php
/**
 * Created by PhpStorm.
 * User: Deevya
 * Date: 31/3/2019
 * Time: 12:36
 */
class testEndpointHello extends \PHPUnit\Framework\TestCase
{
    private $endpointBase = "http://DeevyaNaresh.com/staging/Deevya-myob-devops/api";
    private $endpointData = null;
    public function setUp() {
        $this->endpointData = file_get_contents("{$this->endpointBase}/hello.php");
    }
    public function testEndpointHelloContent()
    {
        $testValue = $this->endpointData;
        $this->assertNotNull($testValue, "Cannot get endpoint [hello]");
    }
    public function testEndpointHelloMessage()
    {
        $testValue = json_decode($this->endpointData, true);
        $this->assertNotFalse($testValue, "Endpoint data is not JSON");
        $this->assertArrayHasKey('message', $testValue, "key missing [message]");
        $this->assertEquals("Hello World", $testValue['message'], "Messages are not the same");
    }
}