<?php

namespace Lavolab\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use Lavolab\TelegramAPI\Telegram\Methods\SetWebhook;
use Lavolab\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use Lavolab\TelegramAPI\tests\Mock\MockTgLog;

class SetWebhookTest extends TestCase
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

    /**
     * @expectedException \Lavolab\TelegramAPI\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage url
     */
    public function testMandatoryFields()
    {
        $setWebhook = new SetWebhook();
        $this->tgLog->performApiRequest($setWebhook);
    }

    public function testSetWebhook()
    {
        $setWebhook = new SetWebhook();
        $setWebhook->url = 'https://example.com/';

        $promise = $this->tgLog->performApiRequest($setWebhook);

        $promise->then(function (ResultBoolean $result) {
            $this->assertInstanceOf(ResultBoolean::class, $result);
            $this->assertTrue($result->data);
        });
    }

    public function testUnsetWebhook()
    {
        $this->tgLog->specificTest = 'unset';

        $setWebhook = new SetWebhook();
        $setWebhook->url = '';

        $promise = $this->tgLog->performApiRequest($setWebhook);

        $promise->then(function (ResultBoolean $result) {
            $this->assertInstanceOf(ResultBoolean::class, $result);
            $this->assertTrue($result->data);
        });
    }
}
