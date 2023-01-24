<?php

namespace lavolab\TelegramAPI\tests\InternalFunctionality;

use PHPUnit\Framework\TestCase;
use lavolab\TelegramAPI\InternalFunctionality\TelegramDocument;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;

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
