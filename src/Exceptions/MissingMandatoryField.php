<?php

declare(strict_types = 1);

namespace Lavolab\TelegramAPI\Exceptions;

class MissingMandatoryField extends \RuntimeException
{
    public $method;

    public $methodInstance;
}
