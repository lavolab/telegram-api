<?php

namespace lavolab\TelegramAPI\tests\Mock;

use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use lavolab\TelegramAPI\RequestHandlerInterface;

class MockRequestHandler implements RequestHandlerInterface
{
    public function post(string $filename, array $formFields): PromiseInterface
    {
        $deferred = new Deferred();

        $contents = file_get_contents($filename);

        $deferred->resolve(new TelegramResponse($contents));
        return $deferred->promise();
    }

    public function get(string $filename): PromiseInterface
    {
        $deferred = new Deferred();

        $contents = file_get_contents($filename);

        $deferred->resolve(new TelegramResponse($contents));
        return $deferred->promise();
    }
}