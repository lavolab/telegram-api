<?php

namespace Lavolab\TelegramAPI\tests;

use PHPUnit\Framework\TestCase;
use Lavolab\TelegramAPI\Telegram\Methods\GetMe;
use Lavolab\TelegramAPI\tests\Mock\MockTgLog;

class TgLogTest extends TestCase
{
    /**
     * @var MockTgLog
     */
    private $tgLog;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        $this->tgLog = new MockTgLog('TEST-TEST');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->tgLog = null;
    }

    public function testComposeApiMethodUrl()
    {
        $this->assertSame(
            'https://api.telegram.org/botTEST-TEST/GetMe',
            $this->tgLog->composeApiMethodUrl(new GetMe())
        );
    }

    /*public function testBuildMultipartFormData(array $data, string $fileKeyName, $stream = null, array $expected = [])
    {
        $call = new \ReflectionMethod('Lavolab\\TelegramAPI\\TgLog', 'buildMultipartFormData');
        $call->setAccessible(true);
        $result = $call->invokeArgs(new \Lavolab\TelegramAPI\TgLog('TEST-TEST'), [$data, $fileKeyName, $stream]);
        $this->assertEquals($expected, $result);
    }*/
}
