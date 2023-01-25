<?php

namespace Lavolab\TelegramAPI\tests\Mock;

use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use Lavolab\TelegramAPI\InternalFunctionality\TelegramResponse;
use Lavolab\TelegramAPI\RequestHandlerInterface;

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