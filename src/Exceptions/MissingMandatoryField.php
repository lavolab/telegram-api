<?php

declare(strict_types = 1);

namespace lavolab\TelegramAPI\Exceptions;

class MissingMandatoryField extends \RuntimeException
{
    public $method;

    public $methodInstance;
}
