<?php

namespace Lavolab\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use Lavolab\TelegramAPI\Telegram\Methods\EditMessageText;
use Lavolab\TelegramAPI\tests\Mock\MockTgLog;

class EditMessageTextTest extends TestCase
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
     * @expectedExceptionMessage chat_id
     */
    public function testMissingMandatoryExportField()
    {
        $editMessageText = new EditMessageText();
        $editMessageText->export();
    }

    /**
     * @expectedException \Lavolab\TelegramAPI\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage text
     */
    public function testMissingMandatoryTextField()
    {
        $editMessageText = new EditMessageText();
        $editMessageText->inline_message_id = 12341234;
        $editMessageText->export();
    }

    /**
     * @expectedException \Lavolab\TelegramAPI\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage message_id
     */
    public function testMissingMandatoryMessageIdField()
    {
        $editMessageText = new EditMessageText();
        $editMessageText->chat_id = 12341234;
        $editMessageText->text = 'Hello world';
        $editMessageText->export();
    }

    public function testMissingMandatoryInlineMessageIdField()
    {
        $editMessageText = new EditMessageText();

        $this->assertContains('inline_message_id', $editMessageText->getMandatoryFields());
    }
}
