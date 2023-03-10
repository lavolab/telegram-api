<?php

namespace Lavolab\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use Lavolab\TelegramAPI\Telegram\Methods\SendDocument;
use Lavolab\TelegramAPI\Telegram\Types\Chat;
use Lavolab\TelegramAPI\Telegram\Types\Custom\InputFile;
use Lavolab\TelegramAPI\Telegram\Types\Document;
use Lavolab\TelegramAPI\Telegram\Types\Message;
use Lavolab\TelegramAPI\Telegram\Types\User;
use Lavolab\TelegramAPI\tests\Mock\MockTgLog;

class SendDocumentTest extends TestCase
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

    public function testSendDocument()
    {
        $sendDocument = new SendDocument();
        $sendDocument->chat_id = 12341234;
        $sendDocument->document = new InputFile(__FILE__);

        $promise = $this->tgLog->performApiRequest($sendDocument);

        $promise->then(function (Message $result) use ($sendDocument) {
            $this->assertInstanceOf(Message::class, $result);
            $this->assertEquals(18, $result->message_id);
            $this->assertInstanceOf(User::class, $result->from);
            $this->assertInstanceOf(Chat::class, $result->chat);
            $this->assertEquals(12345678, $result->from->id);
            $this->assertEquals('unreal4uBot', $result->from->username);
            $this->assertEquals($sendDocument->chat_id, $result->chat->id);
            $this->assertEquals('unreal4u', $result->chat->username);

            $this->assertEquals(1452640889, $result->date);
            $this->assertNull($result->sticker);
            $this->assertNull($result->voice);
            $this->assertNull($result->video);

            $this->assertInstanceOf(Document::class, $result->document);
            $this->assertEquals('XXX-YYY-ZZZ-01', $result->document->file_id);
            $this->assertNull($result->document->thumb);
        });
    }
}
