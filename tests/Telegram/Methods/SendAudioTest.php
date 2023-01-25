<?php

namespace Lavolab\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use Lavolab\TelegramAPI\Telegram\Methods\SendAudio;
use Lavolab\TelegramAPI\Telegram\Types\Audio;
use Lavolab\TelegramAPI\Telegram\Types\Chat;
use Lavolab\TelegramAPI\Telegram\Types\Custom\InputFile;
use Lavolab\TelegramAPI\Telegram\Types\Message;
use Lavolab\TelegramAPI\Telegram\Types\User;
use Lavolab\TelegramAPI\tests\Mock\MockTgLog;

class SendAudioTest extends TestCase
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

    public function testSendAudio()
    {
        $sendAudio = new SendAudio();
        $sendAudio->chat_id = 12341234;
        $sendAudio->audio = new InputFile('examples/binary-test-data/ICQ-uh-oh.mp3');
        $sendAudio->title = 'The famous ICQ new message alert';

        $promise = $this->tgLog->performApiRequest($sendAudio);

        $promise->then(function (Message $result) use ($sendAudio) {
            $this->assertInstanceOf(Message::class, $result);
            $this->assertEquals(16, $result->message_id);
            $this->assertInstanceOf(User::class, $result->from);
            $this->assertInstanceOf(Chat::class, $result->chat);
            $this->assertEquals(12345678, $result->from->id);
            $this->assertEquals('unreal4uBot', $result->from->username);
            $this->assertEquals($sendAudio->chat_id, $result->chat->id);
            $this->assertEquals('unreal4u', $result->chat->username);

            $this->assertEquals(1452635645, $result->date);
            $this->assertNull($result->document);
            $this->assertNull($result->voice);
            $this->assertNull($result->video);

            $this->assertInstanceOf(Audio::class, $result->audio);
            $this->assertEquals('XXX-YYY-ZZZ-01', $result->audio->file_id);
            $this->assertEquals($sendAudio->title, $result->audio->title);
        });
    }

    /**
     * @expectedException \Lavolab\TelegramAPI\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage chat_id
     */
    public function testExportException()
    {
        $sendAudio = new SendAudio();
        $sendAudio->export();
    }

    public function testMinimalisticExport()
    {
        $sendAudio = new SendAudio();
        $sendAudio->chat_id = 12341234;
        $sendAudio->audio = new InputFile('examples/binary-test-data/ICQ-uh-oh.mp3');
        $export = $sendAudio->export();

        // Only 2 of the 9 fields are present
        $this->assertCount(2, $export);
    }

    public function testNonMandatoryExport()
    {
        $sendAudio = new SendAudio();
        $sendAudio->chat_id = 12341234;
        $sendAudio->audio = new InputFile('examples/binary-test-data/ICQ-uh-oh.mp3');
        $sendAudio->caption = 'My special caption';
        $export = $sendAudio->export();

        // Only 3 of the 9 fields are present
        $this->assertCount(3, $export);
        $this->assertSame('My special caption', $export['caption']);
    }
}
