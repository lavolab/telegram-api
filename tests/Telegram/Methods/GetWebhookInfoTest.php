<?php

namespace lavolab\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use lavolab\TelegramAPI\Telegram\Methods\GetWebhookInfo;
use lavolab\TelegramAPI\Telegram\Types\WebhookInfo;
use lavolab\TelegramAPI\tests\Mock\MockTgLog;

class GetWebhookInfoTest extends TestCase
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

    public function testGetWebhookInfo()
    {
        $getWebhookInfo = new GetWebhookInfo();

        $promise = $this->tgLog->performApiRequest($getWebhookInfo);

        $promise->then(function (WebhookInfo $result) {
            $this->assertInstanceOf(WebhookInfo::class, $result);
            $this->assertSame('https://telegram.unreal4u.com/XXXYYYZZZ', $result->url);
            $this->assertFalse($result->has_custom_certificate);
            $this->assertEmpty($result->pending_update_count);
        });
    }

    public function testGetWebhookInfoNotSet()
    {
        $this->tgLog->specificTest = 'notset';

        $getWebhookInfo = new GetWebhookInfo();

        $promise = $this->tgLog->performApiRequest($getWebhookInfo);

        $promise->then(function (WebhookInfo $result) {
            $this->assertInstanceOf(WebhookInfo::class, $result);
            $this->assertEmpty($result->url);
            $this->assertFalse($result->has_custom_certificate);
            $this->assertEmpty($result->pending_update_count);
        });
    }
}
