<?php

namespace lavolab\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use lavolab\TelegramAPI\Telegram\Methods\SendSticker;
use lavolab\TelegramAPI\Telegram\Types\Chat;
use lavolab\TelegramAPI\Telegram\Types\Message;
use lavolab\TelegramAPI\Telegram\Types\PhotoSize;
use lavolab\TelegramAPI\Telegram\Types\Sticker;
use lavolab\TelegramAPI\Telegram\Types\User;
use lavolab\TelegramAPI\tests\Mock\MockTgLog;

class SendStickerTest extends TestCase
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

    public function testSendSticker()
    {
        $sendSticker = new SendSticker();
        $sendSticker->chat_id = 12341234;
        $sendSticker->sticker = 'BQADBAADsgUAApv7sgABW0IQT2B3WekC';

        $promise = $this->tgLog->performApiRequest($sendSticker);

        $promise->then(function (Message $result) use ($sendSticker) {
            $this->assertInstanceOf(Message::class, $result);
            $this->assertEquals(17, $result->message_id);
            $this->assertInstanceOf(User::class, $result->from);
            $this->assertInstanceOf(Chat::class, $result->chat);
            $this->assertEquals(12345678, $result->from->id);
            $this->assertEquals('unreal4uBot', $result->from->username);
            $this->assertEquals($sendSticker->chat_id, $result->chat->id);
            $this->assertEquals('unreal4u', $result->chat->username);

            $this->assertEquals(1452640389, $result->date);
            $this->assertNull($result->document);
            $this->assertNull($result->voice);
            $this->assertNull($result->video);

            $this->assertInstanceOf(Sticker::class, $result->sticker);
            $this->assertEquals($sendSticker->sticker, $result->sticker->file_id);
            $this->assertInstanceOf(PhotoSize::class, $result->sticker->thumb);
            $this->assertEquals(128, $result->sticker->thumb->height);

            $this->assertSame('{"key":"value"}', json_encode($result->sticker->unknown_field));
        });
    }
}
