<?php

namespace Lavolab\TelegramAPI\tests\Telegram\Types\Custom;

use PHPUnit\Framework\TestCase;
use Lavolab\TelegramAPI\Telegram\Types\Custom\InputFile;

class InputFileTest extends TestCase
{
    /**
     * @expectedException \Lavolab\TelegramAPI\Exceptions\FileNotReadable
     */
    public function testInvalidFile()
    {
        new InputFile('non-existant-file.txt');
    }
}
