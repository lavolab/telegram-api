<?php

namespace Lavolab\TelegramAPI\tests\InternalFunctionality;

use PHPUnit\Framework\TestCase;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramDocument;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;

class TelegramDocumentTest extends TestCase
{
    public function testToString()
    {
        $headers = [
            'Content-Type' => [
                'text'
            ],
            'Content-Length' => [
                20
            ]
        ];
        $tgResponse = new TelegramResponse('{"ok":true,"result":"test"}', $headers);
        $tgDocument = new TelegramDocument($tgResponse);
        
        $this->assertEquals('{"ok":true,"result":"test"}', (string) $tgDocument);
    }
}
