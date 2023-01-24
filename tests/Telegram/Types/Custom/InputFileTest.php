<?php

namespace lavolab\TelegramAPI\tests\Telegram\Types\Custom;

use PHPUnit\Framework\TestCase;
use lavolab\TelegramAPI\Telegram\Types\Custom\InputFile;

class InputFileTest extends TestCase
{
    /**
     * @expectedException \lavolab\TelegramAPI\Exceptions\FileNotReadable
     */
    public function testInvalidFile()
    {
        new InputFile('non-existant-file.txt');
    }
}
