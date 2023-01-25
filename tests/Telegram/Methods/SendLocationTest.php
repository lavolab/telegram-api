<?php

namespace Lavolab\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use Lavolab\TelegramAPI\Telegram\Methods\SendLocation;
use Lavolab\TelegramAPI\Telegram\Types\Chat;
use Lavolab\TelegramAPI\Telegram\Types\Location;
use Lavolab\TelegramAPI\Telegram\Types\Message;
use Lavolab\TelegramAPI\Telegram\Types\User;
use Lavolab\TelegramAPI\tests\Mock\MockTgLog;

class SendLocationTest extends TestCase
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

    public function testSendLocation()
    {
        $sendLocation = new SendLocation();
        $sendLocation->chat_id = 12341234;
        $sendLocation->latitude = 43.296482;
        $sendLocation->longitude = 5.369763;

        $promise = $this->tgLog->performApiRequest($sendLocation);

        $promise->then(function (Message $result) use ($sendLocation) {
            $this->assertInstanceOf(Message::class, $result);

            $this->assertEquals(13, $result->message_id);
            $this->assertInstanceOf(User::class, $result->from);
            $this->assertInstanceOf(Chat::class, $result->chat);
            $this->assertEquals(123456789, $result->from->id);
            $this->assertEquals('unreal4uBot', $result->from->username);
            $this->assertEquals($sendLocation->chat_id, $result->chat->id);
            $this->assertEquals('unreal4u', $result->chat->username);

            $this->assertEquals(1452209867, $result->date);
            $this->assertNull($result->audio);

            $this->assertInstanceOf(Location::class, $result->location);
            // We have to round because what we send isn't necessarily what we get
            $this->assertEquals(round($sendLocation->latitude, 6), round($result->location->latitude, 6));
            $this->assertEquals(round($sendLocation->longitude, 6), round($result->location->longitude, 6));
        });
    }
}
